<?php

require_once '../Model/InicioSesion.php';
    switch ($_GET["op"]) {
        case 'login':


            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";


            $cliente = new InicioSesion();
;

            $cliente->setCorreo($correo);
            $cliente->setContrasena($contrasena);
            if($cliente->iniciarSesion($correo,$contrasena)){
                echo 1;


            }else{
                echo 2;
            }





            break;

}



?>