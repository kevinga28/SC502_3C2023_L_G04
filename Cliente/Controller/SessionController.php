<?php

require_once '../../Admin/Model/Cliente.php';
require_once '../Model/InicioSesion.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../Admin/Views/plugins/phpMailer/Exception.php';
require '../../Admin/Views/plugins/phpMailer/PHPMailer.php';
require '../../Admin/Views/plugins/phpMailer/SMTP.php';





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
                $cliente->setIdCliente($datosUsuario['IdCliente']);
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
        $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";

        $clavehash = hash('SHA256', trim($contrasena));

        $cliente = new Cliente();




        $cliente->setCorreo($correo);
        $cliente->setnombre($nombre);
        $cliente->setApellido($apellido);
        $cliente->setContrasena($clavehash);
        $cliente->setTelefono($telefono);
        $cliente->setTipoCliente($tipoCliente);
        $cliente->setProvincia($provincia);
        $cliente->setDistrito($distrito);
        $cliente->setCanton($canton);
        $cliente->setOtros($otros);

        if ($cliente->verificarExistenciaCliente()) {
            echo 1; // El cliente ya existe
        } else if (strlen($contrasena) < 8) {
            echo 2; // Contraseña demasiado corta
        } else if ($cliente->guardarEnDb()) {
            echo 3; // Cliente registrado exitosamente

        } else if(strlen($contrasena) === 8) {
            echo 4; //
        }
        break;


    case 'recuperar':
        $cliente = new Cliente();
        $clienteSession = new InicioSesion();
        $correoUsuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $fechaExpiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $cliente->setCorreo($correoUsuario);



        $mail = new PHPMailer(true);
        $datosUsuario = $clienteSession->obtenerDatosUsuario($correoUsuario);

        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $fechaExpiracion = date('Y-m-d H:i:s', strtotime('+15 minutes')); //  a 15 minutos



        if ($cliente->verificarExistenciaCliente()) {
            try {
                // Configuración del servidor
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'salonevolve3@gmail.com'; // Reemplaza con tu dirección de correo de Gmail
                $mail->Password   = 'rhmp kutn inxh qmwe'; // Reemplaza con la contraseña de tu cuenta de Gmail
                $mail->SMTPSecure = 'TLS'; // Puedes cambiarlo a 'ssl' si es necesario
                $mail->Port       = 587; // Puerto TLS predeterminado

                // Detalles del mensaje
                $mail->setFrom('salonevolve3@gmail.com', 'Evolve');
                $mail->addAddress($correoUsuario);
                $mail->isHTML(true);
                $mail->Subject = 'Recuperar Contraseña';

                $mail->Body =   'Para recuperar su contraseña, por favor ingrese al siguiente link: <a href="http://localhost/SC502_3C2023_L_G04/Cliente/views/login/actualizarPassword.php?id='.$datosUsuario['IdCliente']. '&token='.$token.'">click</a>';

                //$mail->Body    = 'Para recuperar su contraseña por favor ingrese al siguiente link<a href="http://localhost/Evol/Cliente/views/login/actualizarPassword.php?id='.$datosUsuario['IdCliente'].'">click</a>';

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                echo 1;

                // Enviar el correo
                $mail->send();
                break;

                // Si llegamos aquí, el correo se envió con éxito

            } catch (Exception $e) {
                // Manejar la excepción si ocurre
                echo 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
                break;
            }
        } else {
            // Cliente no encontrado
            echo 0;
        }
        break;

    case 'actualizarPassword':


        $cliente = new Cliente();
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
        $token = isset($_POST["token"]) ? trim($_POST["token"]) : "";

        $clavehash = hash('SHA256', trim($contrasena));

        $cliente->setContrasena($clavehash);
        $cliente->setIdCliente($id);

        // Agrega la lógica para verificar el token, puedes compararlo con el token almacenado en la base de datos
        if (strlen($contrasena) > 8){


            if ($cliente->actualizarContrasenaCliente()) {
                echo 1;
                break;
            } else {
                echo 2;
                break;
            }


        }else{
            echo 3;
            break;
        }









}
