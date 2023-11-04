<?php


    require_once '../Model/Cliente.php';
    switch ($_GET["op"]){
        case 'insertar':
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
            $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
            $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";

            $cliente = new Cliente();
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setCorreo($correo);
            $cliente->setContrasena($contrasena);
            $cliente->setTelefono($telefono);
            $cliente->guardarUsuario();
            echo 1;
            break;


    }

?>