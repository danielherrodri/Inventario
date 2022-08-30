import { showSpinner, hideSpinner, Toast } from "../helpers";
import Swal from "sweetalert2";
import moment from "moment";

const fecha_compra_hidden = document.querySelector("#fecha_compra_hidden");
const eliminar_producto = document.querySelectorAll(
    'button[name="eliminar_producto"]'
);

document.addEventListener("DOMContentLoaded", () => {
    if (eliminar_producto && eliminar_producto.length > 0) {
        eliminar_producto.forEach((element) => {
            element.addEventListener("click", eliminar_producto_);
        });
    }
    if (fecha_compra_hidden) {
        $("#fecha_compra").attr(
            "value",
            moment(fecha_compra_hidden.value).format("YYYY-MM-DD")
        );
    }
});

const eliminar_producto_ = (e) => {
    let product = parseInt(e.target.dataset.id | 0);
    Swal.fire({
        title: "¡Confirma tu petición!",
        text: "¿Deseas eliminar este producto?",
        icon: "question",
        showCancelButton: true,
        cancelButtonColor: "#494D4F",
        confirmButtonColor: "#E44988",
        confirmButtonText: "Sí, elimínalo",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.value) {
            showSpinner();

            const url = `/product/${product}`;
            const params = {
                product,
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
                        title: `Hubo un problema con tu petición - Eliminar Productos`,
                        timer: 7000,
                    });
                });
        }
    });
};
