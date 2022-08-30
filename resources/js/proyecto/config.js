import { Toast } from "../helpers.js";

const formSearch = document.querySelector("#form-search");
document.addEventListener("DOMContentLoaded", () => {
    // Buscador
    if (formSearch) {
        formSearch.addEventListener("submit", (e) => {
            const elements = [...formSearch.elements];

            if (elements[0].value == "" || elements[0].value.length < 3) {
                e.preventDefault();
                Toast.fire({
                    icon: "warning",
                    title: "Debes ingresar un valor para la búsqueda y debe contener al menos 3 caracteres.",
                });

                elements[0].focus();
                return;
            }
        });
    }
});
