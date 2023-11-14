<?php

require_once '../Model/Cliente.php';
    session_start();
    switch ($_GET["op"]) {
        case 'login':


            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
            $clavehash = hash('SHA256', trim($contrasena));


            $cliente = new Cliente();
            if ($cliente->iniciarSesion($correo, $clavehash)) {
                $datosUsuario = $cliente->obtenerDatosUsuario($correo);


                if ($datosUsuario) {
                    $cliente->setCorreo($datosUsuario['correo']);
                    $cliente->setNombre($datosUsuario['nombre']);
                    $cliente->setApellido($datosUsuario['apellido']);
                    $cliente->setTelefono($datosUsuario['telefono']);

                    // Asigna otras propiedades según sea necesario

                    $_SESSION['usuario'] = $cliente;
                    echo 1;
                }
            } else {
                echo 2;
            }



}



?>