import { Toast, showSpinner, hideSpinner, validateForm } from "./helpers";
import Swal from "sweetalert2";

const fecha = document.querySelector("#fechaHoy");
const btnCerrarSesion = document.querySelector("#closeSession");
const actionMsg = document.querySelector("#actionMsg");
const spinnerLoader = document.querySelector(".page-loader");

const toggleMenu = document.querySelector('[data-toggle="#dropdown-menu"]');
const marcar_leido_one = document.querySelectorAll(
    'span[name="marcar_leido_one"]'
);
const marcar_todo = document.querySelector("#marcar_todo");
const loginForm = document.querySelector("#login_form");

document.addEventListener("DOMContentLoaded", () => {
    if (marcar_leido_one && marcar_leido_one.length > 0) {
        marcar_leido_one.forEach((element) => {
            element.addEventListener("click", marcar_leido);
        });
    }

    if (marcar_todo) {
        marcar_todo.addEventListener("click", marcar_todo_);
    }

    if (fecha) fecha.innerText = moment().format("LLLL");
    if (btnCerrarSesion)
        btnCerrarSesion.addEventListener("click", () => loader_cerrarsession());

    // Validar msg
    if (actionMsg) showNotification();

    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            const array = [...loginForm.elements];

            if (!validateForm(array)) {
                e.preventDefault();
            }
        });
    }

    // Ejecutar eventos
    runDropdowns();
    runModals();
    runCollapses();
    runChecked();
});

//Marca como leída una notificación
const marcar_leido = (e) => {
    e.stopPropagation();
    e.preventDefault();
    let id = e.target.dataset.id;
    if (id !== "") {
        showSpinner();

        const url = `/notificacion/marcar/${id}`;
        const params = {
            id,
        };

        axios
            .get(url, {
                params,
            })
            .then((response) => {
                // Destructuring
                const { status, type, msg } = response.data;

                if (!status) {
                    Toast.fire({
                        icon: type,
                        title: `Hubo un problema con tu petición - ${error.response.data.msg}`,
                        timer: 7000,
                    });
                } else {
                    location.reload();
                }
                hideSpinner();
            })
            .catch((error) => {
                hideSpinner();
                // console.log(error.response)
                Toast.fire({
                    icon: "error",
                    title: `Hubo un problema con tu petición - ${error.response.data.msg}`,
                    timer: 7000,
                });
            });
    }
};

const marcar_todo_ = (e) => {
    showSpinner();

    const url = `/notificacion/marcartodo`;
    axios
        .get(url)
        .then((response) => {
            // Destructuring
            const { status, type, msg } = response.data;
            console.log(response.data);

            if (!status) {
                Toast.fire({
                    icon: type,
                    title: `Hubo un problema con tu petición - ${error.response.data.msg}`,
                    timer: 7000,
                });
            } else {
                location.reload();
            }
            hideSpinner();
        })
        .catch((error) => {
            hideSpinner();
            // console.log(error.response)
            Toast.fire({
                icon: "error",
                title: `Hubo un problema con tu petición - ${error.response.data.msg}`,
                timer: 7000,
            });
        });
};

// Cerrar sesión
const loader_cerrarsession = () => {
    spinnerLoader.removeAttribute("hidden");
    spinnerLoader.style = {
        visibility: "",
        opacity: "",
    };
    sessionStorage.clear();
};

// Mostrar mensaje
const showNotification = () => {
    let type = actionMsg.dataset.type.trim();
    let msg = actionMsg.dataset.msg.trim();

    if (type == "success") {
        Toast.fire({
            icon: "success",
            title: msg,
        });
    } else if (type == "warning") {
        Toast.fire({
            icon: "warning",
            title: msg,
            timer: 5000,
        });
    } else if (type == "error") {
        Toast.fire({
            icon: "error",
            title: msg,
            timer: 7000,
        });
    } else if (type == "info") {
        Swal.fire({
            icon: "info",
            confirmButtonColor: "#374151",
            confirmButtonText: "Entendido",
            html: `Se capturó con éxito el reporte con número de folio <b>${msg}</b>, recuérdale que próximamente uno de nuestros asesores se pondrá en contacto con él/ella.
                   <br><br>Recuérdale al cliente que estará recibiendo la llamada desde una lada 777`,
        });
    } else if (type == "info-2") {
        Swal.fire({
            icon: "info",
            confirmButtonColor: "#374151",
            confirmButtonText: "Entendido",
            html: `${msg}`,
        });
    }

    // Limpiar
    actionMsg.dataset.type = "";
    actionMsg.dataset.msg = "";
};

// Dropdown
function dropdownEvent(e) {
    e.preventDefault();

    const element = document.querySelector(e.target.dataset.dropdown);

    const classesOut = [
        "transition",
        "ease-out",
        "duration-150",
        "transform",
        "opacity-0",
        "scale-75",
    ];

    const classesIn = [
        "transition",
        "ease-in",
        "duration-100",
        "transform",
        "opacity-100",
        "scale-100",
    ];

    if (element.classList.contains("hidden")) {
        element.classList.add(...classesIn);
        element.classList.remove("hidden");
        setTimeout(() => {
            element.classList.remove(...classesIn);
        }, 100);
    } else {
        element.classList.add(...classesOut);
        setTimeout(() => {
            element.classList.remove(...classesOut);
            element.classList.add("hidden");
        }, 150);
    }
}

function runDropdowns() {
    const dropdownBundle = document.querySelectorAll("[data-dropdown]");

    if (dropdownBundle.length > 0) {
        const dropdowns = [...dropdownBundle];
        dropdowns.forEach((dropdown, i) =>
            dropdown.addEventListener("click", dropdownEvent)
        );
    }
}

// Modals
function modalEvent(e) {
    e.preventDefault();

    const element = document.querySelector(
        e.target.dataset.modal || e.target.dataset.dismiss
    );

    const classesOut = [
        "transition",
        "ease-out",
        "duration-150",
        "transform",
        "opacity-0",
        "scale-75",
    ];

    const classesIn = [
        "transition",
        "ease-in",
        "duration-100",
        "transform",
        "opacity-100",
        "scale-100",
    ];

    if (element.classList.contains("hidden")) {
        element.classList.add(...classesIn);
        element.classList.remove("hidden");
        setTimeout(() => {
            element.classList.remove(...classesIn);
        }, 100);
    } else {
        element.classList.add(...classesOut);
        setTimeout(() => {
            element.classList.remove(...classesOut);
            element.classList.add("hidden");
        }, 150);
    }
}

function runModals() {
    const modalsBundle = document.querySelectorAll("[data-modal]");
    const dismissBundle = document.querySelectorAll("[data-dismiss]");

    if (dismissBundle.length > 0) {
        const dismiss = [...dismissBundle];
        dismiss.forEach((modal) => modal.addEventListener("click", modalEvent));
    }

    if (modalsBundle.length > 0) {
        const modals = [...modalsBundle];
        modals.forEach((modal) => modal.addEventListener("click", modalEvent));
    }
}

// Collapse
function collapseEvent(e) {
    e.preventDefault();

    const element = document.querySelector(e.target.dataset.collapse);

    if (element) {
        // if(element.classList.contains('hidden')){
        //     element.classList.remove('hidden')
        // } else {
        //     element.classList.add('hidden')
        // }
        element.classList.toggle("hidden");
    }
}

function runCollapses() {
    const collapseBundle = document.querySelectorAll("[data-collapse]");

    if (collapseBundle.length > 0) {
        const collapses = [...collapseBundle];
        collapses.forEach((collapse) =>
            collapse.addEventListener("click", collapseEvent)
        );
    }
}

// Checked
function checkedEvent(e) {
    const element = document.querySelector(e.target.dataset.checked);

    if (e.target.checked) {
        element.classList.remove("hidden");
    } else {
        element.classList.add("hidden");
    }
}

function runChecked() {
    const checkedBundle = document.querySelectorAll("[data-checked]");

    if (checkedBundle.length > 0) {
        const checkeds = [...checkedBundle];
        checkeds.forEach((checked) =>
            checked.addEventListener("click", checkedEvent)
        );
    }
}

if (toggleMenu) {
    toggleMenu.addEventListener("click", () => {
        const element = document.querySelector(toggleMenu.dataset.toggle);
        $(element).slideToggle();
    });
}
