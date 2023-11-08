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
}

?>
