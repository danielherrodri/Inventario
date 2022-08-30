<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('updated_at', 'DESC')
            ->paginate(env('APP_PAGINATE'));
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol' => ['required', 'exists:App\Models\Rol,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'apepaterno' => ['required', 'string', 'max:255'],
            'apematerno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        try {
            User::create([
                'name' => $request->nombre,
                'firstName' => $request->apepaterno,
                'lastName' => $request->apematerno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_id' => $request->rol
            ]);

            return redirect()->route('usuario.index')->with('msg', 'Usuario registrado exitosamente')->with('type', 'success');
        } catch (\Throwable $th) {
            $msg = '';
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Ocurrió un error al registrar el usuario, intenta nuevamente.';
            }
            return redirect()->back()->with('type', 'error')->with('msg', $msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'rol' => ['required', 'exists:App\Models\Rol,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'apepaterno' => ['required', 'string', 'max:255'],
            'apematerno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'acceso' => ['required']
        ]);

        try {
            $usuario->name = $request->nombre;
            $usuario->firstName = $request->apepaterno;
            $usuario->lastName = $request->apematerno;
            $usuario->email = $request->email;
            $usuario->rol_id = $request->rol;
            $usuario->acceso = $request->acceso;

            if ($request->password) {
                $usuario->password = Hash::make($request->password);
            }
            $usuario->save();
            return redirect()->route('usuario.index')->with('msg', 'Usuario modificado exitosamente')->with('type', 'success');
        } catch (\Throwable $th) {
            $msg = '';
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Ocurrió un error al modificar el usuario, intenta nuevamente.';
            }
            return redirect()->back()->with('type', 'error')->with('msg', $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        try {
            $usuario->delete();
            return response()->json(['status' => true, 'type' => 'success', 'msg' => 'Usuario eliminado exitosamente']);
        } catch (\Throwable $th) {
            $msg = '';
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Ocurrió un error al tratar de eliminar al usuario, intenta nuevamente.';
            }
            return response()->json(['status' => false, 'type' => 'error', 'msg' => $msg]);
        }
    }

    public function search(Request $request)
    {
        try {
            // Query
            $busqueda = $request->input('q');

            $usuarios = User::with(['rol'])
                ->join('rol', 'rol.id', '=', 'users.rol_id')
                ->where(function ($q) use ($busqueda) {
                    $q->Where('rol.nombre', 'LIKE', "%$busqueda%")
                        ->orWhere('email', 'LIKE', "%$busqueda%")
                        ->orWhere(DB::raw("CONCAT(name, ' ',firstName, ' ',lastName)"), 'LIKE', "%$busqueda%")
                        ->orWhere(DB::raw('convert(varchar,convert(datetime,users.created_at,120),23)'), '=', $busqueda)
                        ->orWhere(DB::raw('convert(varchar,convert(datetime,users.updated_at,120),23)'), '=', "$busqueda");
                })
                ->orderBy('users.updated_at', 'desc')
                ->paginate(env('APP_PAGINATE'));

            return view('usuarios.index', compact('usuarios'));
        } catch (\Throwable $th) {
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Hubo un problema con tu petición - (Usuario - Buscar)';
            }

            return redirect()->back()->with('type', 'error')->with('msg', $msg);
        }
    }
}
