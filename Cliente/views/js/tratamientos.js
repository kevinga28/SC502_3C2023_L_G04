document.addEventListener("DOMContentLoaded", function() {
    // Selecciona el "Cabello" por su ID
    const cabelloLink = document.getElementById("sub-tratamientos");

    // Selecciona el menú desplegable de la clase
    const menuCabello = document.querySelector(".nav.nav-treeview");

    // Agrega un controlador a "Cabello"
    cabelloLink.addEventListener("click", function() {
        // Cambia como se ve el menú desplegable
        menuCabello.style.display = (menuCabello.style.display === "none") ? "block" : "none";

        // Cambia el ícono para que apunte hacia al lado cuando el menú se cierra
        const icon = cabelloLink.querySelector("i");
        if (menuCabello.style.display === "none") {
            icon.classList.remove("fa-angle-down");
            icon.classList.add("fa-angle-left");
        } else {
            icon.classList.remove("fa-angle-left");
            icon.classList.add("fa-angle-down"); 
            // Cambia el ícono para que apunte hacia abajo cuando se abra el menu
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Selecciona el enlace "Cabello" por su ID
    const cabelloLink = document.getElementById("sub-tratamientos-cabello");
    const unasLink = document.getElementById("sub-tratamientos-unas");
    const pielLink = document.getElementById("sub-tratamientos-piel");

    // Selecciona el menú desplegable por su clase
    const menuCabello = document.querySelector(".nav.nav-treeview-cabello");
    const menuUnas = document.querySelector(".nav.nav-treeview-unas");
    const menuPiel = document.querySelector(".nav.nav-treeview-piel");

    // Función para gestionar el clic en los enlaces
    function handleLinkClick(link, menu) {
        link.addEventListener("click", function() {
            // Cambia la visibilidad del menú desplegable
            menu.style.display = (menu.style.display === "none") ? "block" : "none";

            // Cambia la clase del ícono para que apunte hacia al lado cuando el menú se cierra
            const icon = link.querySelector("i");
            if (menu.style.display === "none") {
                icon.classList.remove("fa-angle-down");
                icon.classList.add("fa-angle-left");
            } else {
                icon.classList.remove("fa-angle-left");
                icon.classList.add("fa-angle-down");
            }
        });
    }

    // Aplica la funcionalidad a los enlaces "Cabello", "Uñas" y "Piel"
    handleLinkClick(cabelloLink, menuCabello);
    handleLinkClick(unasLink, menuUnas);
    handleLinkClick(pielLink, menuPiel);
});
