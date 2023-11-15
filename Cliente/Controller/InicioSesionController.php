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

    case 'insertar':

        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";

        $clavehash = hash('SHA256', trim($contrasena));

        $cliente = new Registro();

        $cliente->setCorreo($correo);
        $cliente->setnombre($nombre);
        $cliente->setApellido($apellido);
        $cliente->setContrasena($clavehash);
        $cliente->setTelefono($telefono);

        if ($cliente->verificarExistenciaCliente()) {
            echo 1; // El cliente ya existe
        } else if (strlen($contrasena) < 8) {
            echo 2; // Contraseña demasiado corta
        } else if ($cliente->guardarUsuario()) {
            echo 3; // Cliente registrado exitosamente
        } else {
            echo 4; // Error al registrar el cliente
        }
}
