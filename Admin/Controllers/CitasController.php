<?php
require_once 'Citas.php'; 
if (isset($_GET["op"])) {
    $operacion = $_GET["op"];
    $citas = new Citas();

    switch ($operacion) {
        case 'crear':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $cedulaCliente = isset($_POST["BusquedaCliente"]) ? trim($_POST["BusquedaCliente"]) : "";
                $cedulaEmpleado = isset($_POST["estilista"]) ? trim($_POST["estilista"]) : "";
                $tratamientos = isset($_POST["tratamiento"]) ? $_POST["tratamiento"] : [];
                $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
                $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";

                $resultado = $citas->crearCita($cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita);

             
                echo $resultado;
            }
            break;

        case 'editar':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               
                $idCita = isset($_POST["idCita"]) ? trim($_POST["idCita"]) : "";
                $cedulaCliente = isset($_POST["BusquedaCliente"]) ? trim($_POST["BusquedaCliente"]) : "";
                $cedulaEmpleado = isset($_POST["estilista"]) ? trim($_POST["estilista"]) : "";
                $tratamientos = isset($_POST["tratamiento"]) ? $_POST["tratamiento"] : [];
                $fechaCita = isset($_POST["fechaCita"]) ? trim($_POST["fechaCita"]) : "";
                $horaCita = isset($_POST["horaCita"]) ? trim($_POST["horaCita"]) : "";

               
                $resultado = $citas->editarCita($idCita, $cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita);

        
                echo $resultado;
            }
            break;

        case 'listar':
           
            $citas->listarHistorialCitas();
            break;

        
    }
}
?>
