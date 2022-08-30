<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        if (Auth::check()) {
            if (auth('web')->user()->rol->id == 1) {
                return redirect()->route('product.index');
            } else {
                return redirect()->route('usuario.index');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
