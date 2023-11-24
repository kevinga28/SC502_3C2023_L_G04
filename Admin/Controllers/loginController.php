<?php
require_once '../Model/Empleado.php';
require_once 'AuthController.php';

$authController = new AuthController();

if ($authController->login()) {
    // Si el login es exitoso, redireccionar a la página de inicio
    header("Location: ../views/index.php");
    exit();
}

// Verificar acceso para diferentes roles
$authController->verificarAcceso(['Admin']);
$authController->verificarAcceso(['Gerente', 'Estilista']);
$authController->verificarAcceso(['Admin','Estilista','Gerente']);
?>