<?php

require_once '../Model/Cliente.php';

if (isset($_GET["op"])) {
    switch ($_GET["op"]) {
        case 'insertar':

            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
            $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";

            $clavehash = hash('SHA256', trim($contrasena));

            $cliente = new Cliente();

            $cliente->setCorreo($correo);

            if ($cliente->verificarExistenciaCliente()) {

                echo 3;

            } else {
                // El cliente no existe, procede a registrar
                $cliente->setNombre($nombre);
                $cliente->setApellido($apellido);
                $cliente->setContrasena($clavehash);
                $cliente->setTelefono($telefono);

                // Intenta guardar el cliente
                if ($cliente->guardarUsuario()) {
                    // Cliente registrado exitosamente
                    echo 1;
                } else {
                    // Error al registrar el cliente
                    echo 2;
                }
            }

    }
}

?>
