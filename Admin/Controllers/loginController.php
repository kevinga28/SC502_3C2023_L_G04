<?php

require_once '../Model/InicioSesion.php';
require_once '../Model/Empleado.php';
session_start();
switch ($_GET["op"]) {
    case 'login':


        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        $clavehash = hash('SHA256', trim($contrasena));
        $empleado = new Empleado();


        $cliente = new InicioSesion();

        if ($cliente->iniciarSesion($correo, $clavehash)) {
            $datosUsuario = $cliente->obtenerDatosUsuario($correo);


            if ($datosUsuario) {
                $empleado->setCorreo($datosUsuario['correo']);
                $empleado->setNombre($datosUsuario['nombre']);
                $empleado->setApellido($datosUsuario['apellido']);
                $empleado->setCedula($datosUsuario['cedula']);
                $empleado->setTelefono($datosUsuario['telefono']);
                $empleado->setProvincia($datosUsuario['provincia']);
                $empleado->setCanton($datosUsuario['canton']);
                $empleado->setDistrito($datosUsuario['distrito']);
                $empleado->setGenero($datosUsuario['genero']);
                $empleado->setRol($datosUsuario['rol']);
                $empleado->setContrasena($datosUsuario['contrasena']);
                $empleado->setOtros($datosUsuario['otros']);



                // Asigna otras propiedades según sea necesario

                $_SESSION['usuario'] = $empleado;
                echo 1;
            }
        } else {
            echo 2;
        }
        break;



    case 'logout':

        $cliente = new InicioSesion();
        $cliente->logOut();
        echo 1;
        break;






}



?>