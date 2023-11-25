<?php

class AuthController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
            $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
            $clavehash = hash('SHA256', trim($contrasena));
            $empleado = new Empleado();
            $empleado->setCedula($cedula);
            $empleado->setContrasena($clavehash);


            if ($empleado->login()) {
                $_SESSION['cedula'] = $empleado->getCedula();
                $_SESSION['datosEmpleado'] = $empleado->obtenerEmpleadoPorCedula($empleado->getCedula());

                // Obtener el rol del empleado desde los datos del empleado
                $datosEmpleado = $_SESSION['datosEmpleado'];
                $_SESSION['rol'] = $datosEmpleado['rol'];

                // Verificar si se estableció correctamente el rol
                if (isset($_SESSION['rol'])) {
                    echo "Rol obtenido: " . $_SESSION['rol'];
                } else {
                    echo "No se pudo obtener el rol.";
                    return false;
                }

                return true;
            } else {
                echo "Login fallido. Por favor verificar los credenciales.";
                return false;
            }
        }
        return false;
    }

    public function verificarAcceso($allowedRoles)
    {
        if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $allowedRoles)) {
            header('Location: ../acceso_denegado.php');
            exit;
        }
    }

    public function obtenerRolUsuario()
    {
        if (isset($_SESSION['rol'])) {
            return $_SESSION['rol'];
        } else {
            return null;
        }
    }
}
