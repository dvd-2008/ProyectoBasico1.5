document.addEventListener("DOMContentLoaded", function () {
    const productosLink = document.querySelector('.sidebar a[href="#"]');
    
    const mainContent = document.querySelector(".main-content");

    productosLink.addEventListener("click", function (event) {
        event.preventDefault();

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    mainContent.innerHTML = xhr.responseText;
                    initializeDeleteButtons();
                    initializeReloj(); // Agregar inicialización del reloj
                } else {
                    console.error("Error al cargar la tabla de productos");
                }
            }
        };
        xhr.open("GET", "view/tabla_prod.php", true);
        xhr.send();
    });

// Integración del reloj
function initializeReloj() {
    const relojDiv = document.createElement("div");
    relojDiv.classList.add("reloj");
    relojDiv.innerHTML = '<h5><span id="tiempo">00 : 00 :00</span></h5>';
    mainContent.appendChild(relojDiv);

    // Función para mostrar la hora actual
    function actualizarReloj() {
        const tiempo = new Date();
        const horas = tiempo.getHours().toString().padStart(2, "0");
        const minutos = tiempo.getMinutes().toString().padStart(2, "0");
        const segundos = tiempo.getSeconds().toString().padStart(2, "0");
        const tiempoString = `${horas} : ${minutos} : ${segundos}`;
        document.getElementById("tiempo").textContent = tiempoString;
    }

    // Actualizar el reloj cada segundo
    setInterval(actualizarReloj, 1000);
}

function initializeDeleteButtons() {
    const deleteButtons = document.querySelectorAll(".btn.btn-danger");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const url = this.getAttribute("href");

            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteProduct(url);
                }
            });
        });
    });
}

function deleteProduct(url) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                Swal.fire(
                    "¡Eliminado!",
                    "¡El producto ha sido eliminado correctamente!",
                    "success"
                ).then(() => {
                    // Recargar la tabla de productos después de eliminar
                    const productosLink = document.querySelector(
                        '.sidebar a[href="#"]'
                    );
                    productosLink.click();
                });
            } else {
                Swal.fire(
                    "Error",
                    "¡Hubo un error al eliminar el producto!",
                    "error"
                );
            }
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}

// SweetAlert al hacer clic en Cerrar Sesión
const logoutBtn = document.getElementById("logoutBtn");
logoutBtn.addEventListener("click", function (event) {
    event.preventDefault();
    Swal.fire({
        title: "¡Gracias por visitarnos!",
        text: "Hasta pronto",
        icon: "success",
    }).then(() => {
        window.location.href = this.getAttribute("href");
    });
});

// Integración del reloj también en index.php
initializeReloj();
});