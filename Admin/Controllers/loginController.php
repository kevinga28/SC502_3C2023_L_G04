<?php

require_once '../Model/Empleado.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar inicio de sesión
    $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
    $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";

    $clavehash = hash('SHA256', trim($contrasena));

    // No necesitas hacer hash aquí, se manejará en el método login
    $empleado = new Empleado();
    
    $empleado->setCedula($cedula);
    $empleado->setContrasena($clavehash);

    $loginSuccess = $empleado->login();

    if ($loginSuccess) {
        $rol = $loginSuccess; // Obtener el rol antes de la sesión
        $_SESSION['rol'] = $rol;
        echo "<script>console.log('Rol: $rol');</script>";

        $allowedPages = [];
        
        switch ($rol) {
            case 'Admin':
                $allowedPages = ['*']; // Permitir solo estas páginas para el rol Admin
                break;
            case 'Estilista':
                $allowedPages = ['/admin/views/index.php', '/admin/views/calendar.php'];
                break;
            case 'Empleado':
                $allowedPages = ['/admin/views/index.php', '/admin/views/employee_dashboard.php'];
                break;
            default:
                echo "Unknown role: $rol. Please contact the administrator.";
                exit();
        }
    
        var_dump($allowedPages);  // Agrega esta línea para depurar
    
        $currentPage = basename($_SERVER['PHP_SELF']);

        if (!in_array($currentPage, $allowedPages)) {
            echo "Access denied. You don't have permission to access this page. Current Page: $currentPage";
            exit();
        }

        // Iniciar sesión
        $_SESSION['cedula'] = $empleado->getCedula();
        $_SESSION['datosEmpleado'] = $empleado->obtenerEmpleadoPorCedula($empleado->getCedula());
        $_SESSION['nombre'] = $_SESSION['datosEmpleado']['nombre'];
        $_SESSION['apellido'] = $_SESSION['datosEmpleado']['apellido'];
        $_SESSION['imagen'] = $_SESSION['datosEmpleado']['imagen'];
        $_SESSION['genero'] = $_SESSION['datosEmpleado']['genero'];
        $_SESSION['correo'] = $_SESSION['datosEmpleado']['correo'];
        $_SESSION['telefono'] = $_SESSION['datosEmpleado']['telefono'];
        $_SESSION['provincia'] = $_SESSION['datosEmpleado']['provincia'];
        $_SESSION['distrito'] = $_SESSION['datosEmpleado']['distrito'];
        $_SESSION['canton'] = $_SESSION['datosEmpleado']['canton'];
        $_SESSION['otros'] = $_SESSION['datosEmpleado']['otros'];

        // Redirigir a la página de inicio
        header("Location: ../views/$currentPage");
        exit();
    } else {
        echo "Login failed. Please check your credentials.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "logout") {

    $_SESSION = array();

    // Borrar la cookie de sesión, si existe
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Destruir la sesión
    session_destroy();

    // Redirigir a la página de inicio de sesión
    header("Location: ../views/login.html");
    exit();
}
?>