<?php

require_once '../../Admin/Model/Cliente.php';
require_once '../Model/InicioSesion.php';


    session_start();


switch ($_GET["op"]) {
    case 'login':
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        $clavehash = hash('SHA256', trim($contrasena));

        $clienteSession = new InicioSesion();
        $cliente = new Cliente();

        if ($clienteSession->iniciarSesion($correo, $clavehash)) {
            $datosUsuario = $clienteSession->obtenerDatosUsuario($correo);

            if ($datosUsuario) {
                $cliente->setCorreo($datosUsuario['correo']);
                $cliente->setNombre($datosUsuario['nombre']);
                $cliente->setApellido($datosUsuario['apellido']);
                $cliente->setTelefono($datosUsuario['telefono']);
                $cliente->setContrasena($datosUsuario['contrasena']);
                $cliente->setDistrito($datosUsuario['distrito']);
                $cliente->setCanton($datosUsuario['canton']);
                $cliente->setProvincia($datosUsuario['provincia']);
                $cliente->setOtros($datosUsuario['otros']);

                // Asigna otras propiedades según sea necesario

                $_SESSION['usuarioCliente'] = $cliente;
                echo 1;
            }
        } else {
            echo 2;
        }
        break;

    case 'logout':
        $clienteIni = new InicioSesion();
        $clienteIni->logOut();
        echo 1;
        break;
}



?>