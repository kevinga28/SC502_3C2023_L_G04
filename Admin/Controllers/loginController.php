<?php

require_once '../Model/Empleado.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar inicio de sesión
    $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
    $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";

    // Realizar la verificación del usuario y contraseña
    $empleado = new Empleado();

    $clavehash = hash('SHA256', trim($contrasena));
    $empleado->setCedula($cedula);
    $empleado->setContrasena($clavehash);



    if ($empleado->login()) {
        $datosUsuario = $empleado->obtenerEmpleadoPorCedula($empleado->getCedula());

        $empleado->setCedula($datosUsuario['cedula']);
        $empleado->setCorreo($datosUsuario['correo']);
        $empleado->setNombre($datosUsuario['nombre']);
        $empleado->setApellido($datosUsuario['apellido']);
        $empleado->setTelefono($datosUsuario['telefono']);
        $empleado->setContrasena($datosUsuario['contrasena']);
        $empleado->setDistrito($datosUsuario['distrito']);
        $empleado->setCanton($datosUsuario['canton']);
        $empleado->setRol($datosUsuario['rol']);
        $empleado->setProvincia($datosUsuario['provincia']);
        $empleado->setOtros($datosUsuario['otros']);






        // Obtener el rol del usuario
        $rol = $empleado->getRol();
        $_SESSION['rol'] = $rol;
        var_dump($rol); 

        // Definir las páginas permitidas según el rol
        $allowedPages = [];
        
        switch ($rol) {
            case 'Admin':
                $allowedPages = ['index.php'];
                break;
            case 'Estilista':
                $allowedPages = ['index.php', 'calendar.php'];
                break;
            case 'Gerente':
                $allowedPages = ['index.php', 'employee_dashboard.php'];
                break;
            default:
                echo "Unknown role: $rol. Please contact the administrator.";
                exit();
        }

        $currentPage = basename($_SERVER['PHP_SELF']);

        if (in_array($currentPage, $allowedPages)) {
            // Almacenar datos relevantes en la sesión
            $_SESSION['cedula'] = $empleado->getCedula();
            $_SESSION['datosEmpleado'] = $empleado->obtenerEmpleadoPorCedula($empleado->getCedula());
            // ... Almacenar otros datos de sesión

            header("Location: ../views/$currentPage");
            exit();
        } else {
            echo "Access denied. You don't have permission to access this page. Current Page: $currentPage";
        }
    } else {
        echo "Login failed. Please check your credentials.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "logout") {
    // Cerrar sesión
    $_SESSION = array();
    session_destroy();

    // Redirigir a la página de inicio de sesión
    header("Location: ../views/login.html");
    exit();
}