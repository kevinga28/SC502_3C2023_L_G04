<<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí obtén los datos del formulario
    $cedulaCliente = $_POST["BusquedaCliente"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $tratamiento = implode(', ', $_POST["tratamiento"]);
    $estilista = $_POST["estilista"];
    $fechaCita = $_POST["fechaCita"];
    $horaCita = $_POST["horaCita"];
    $pagoTotal = $_POST["pagoTotal"];

    // Conecta a la base de datos (reemplaza con tus propios detalles de conexión)
    $host = "127.0.0.1";
    $usuario = "root";
    $contrasena = "No";
    $base_de_datos = "Evolvedb";

    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para insertar la cita en la base de datos
    $sql = "INSERT INTO cita (cedulaCliente, nombre, apellido, correo, tratamiento, estilista, fechaCita, horaCita, pagoTotal) VALUES ('$cedulaCliente', '$nombre', '$apellido', '$correo', '$tratamiento', '$estilista', '$fechaCita', '$horaCita', '$pagoTotal')";

    if ($conexion->query($sql) === TRUE) {
        echo "Cita creada con éxito";
    } else {
        echo "Error al crear la cita: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Acceso no autorizado";
}
?>

