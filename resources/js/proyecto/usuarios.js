import { showSpinner, hideSpinner, Toast } from "../helpers";
import Swal from "sweetalert2";

const eliminar_usuario = document.querySelectorAll(
    'button[name="eliminar_usuario"]'
);
document.addEventListener("DOMContentLoaded", () => {
    if (eliminar_usuario && eliminar_usuario.length > 0) {
        eliminar_usuario.forEach((element) => {
            element.addEventListener("click", eliminar_usuario_);
        });
    }
});

const eliminar_usuario_ = (e) => {
    let usuario = parseInt(e.target.dataset.id | 0);
    if (usuario !== 0) {
        Swal.fire({
            title: "¡Confirma tu petición!",
            text: "¿Deseas eliminar este usuario?",
            icon: "question",
            showCancelButton: true,
            cancelButtonColor: "#494D4F",
            confirmButtonColor: "#E44988",
            confirmButtonText: "Sí, elimínalo",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                showSpinner();

                const url = `/usuario/${usuario}`;
                const params = {
                    usuario,
                };

                axios
                    .delete(url, {
                        params,
                    })
                    .then((response) => {
                        // Destructuring
                        const { status, msg, type } = response.data;

                        // Mostrar alerta
                        Toast.fire({
                            icon: `${type}`,
                            title: `${msg}`,
                        });

                        if (type == "success") {
                            // Eliminar del DOM
                            e.target.parentElement.parentElement.remove();
                        }
                        hideSpinner();
                    })
                    .catch((error) => {
                        hideSpinner();
                        // console.log(error.response)
                        Toast.fire({
                            icon: "error",
                            title: `Hubo un problema con tu petición - Eliminar Usuarios`,
                            timer: 7000,
                        });
                    });
            }
        });
    }
};
