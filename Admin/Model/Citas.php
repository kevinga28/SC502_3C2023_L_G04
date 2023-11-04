<?php
require_once '../config/Conexion.php';

class Citas {
    private $cedulaCliente;
    private $cedulaEmpleado;
    private $tratamiento;
    private $fechaCita;
    private $horaCita;

    public function __construct($cedulaCliente, $cedulaEmpleado, $tratamiento, $fechaCita, $horaCita) {
        $this->cedulaCliente = $cedulaCliente;
        $this->cedulaEmpleado = $cedulaEmpleado;
        $this->tratamiento = $tratamiento;
        $this->fechaCita = $fechaCita;
        $this->horaCita = $horaCita;
    }

  
    public function getCedulaCliente() {
        return $this->cedulaCliente;
    }

    public function setCedulaCliente($cedulaCliente) {
        $this->cedulaCliente = $cedulaCliente;
    }

    public function getCedulaEmpleado() {
        return $this->cedulaEmpleado;
    }

    public function setCedulaEmpleado($cedulaEmpleado) {
        $this->cedulaEmpleado = $cedulaEmpleado;
    }

    public function getTratamiento() {
        return $this->tratamiento;
    }

    public function setTratamiento($tratamiento) {
        $this->tratamiento = $tratamiento;
    }

    public function getFechaCita() {
        return $this->fechaCita;
    }

    public function setFechaCita($fechaCita) {
        $this->fechaCita = $fechaCita;
    }

    public function getHoraCita() {
        return $this->horaCita;
    }

    public function setHoraCita($horaCita) {
        $this->horaCita = $horaCita;
    }
    
    //creación de una cita
    public function crearCita($cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita) {
    include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

    // Escapa y valida las entradas para evitar SQL Injection
    $cedulaCliente = mysqli_real_escape_string($conn, $cedulaCliente);
    $cedulaEmpleado = mysqli_real_escape_string($conn, $cedulaEmpleado);
    $tratamientos = implode(", ", array_map('mysqli_real_escape_string', array_fill(0, count($tratamientos), $conn), $tratamientos));
    $fechaCita = mysqli_real_escape_string($conn, $fechaCita);
    $horaCita = mysqli_real_escape_string($conn, $horaCita);

    // Prepara la consulta SQL usando consultas preparadas
    $sql = "INSERT INTO cita (cedulaCliente, cedulaEmpleado, tratamiento, fechaCita, horaCita) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita);

    if ($stmt->execute()) {
        return "Cita creada con éxito";
    } else {
        return "Error al crear la cita: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedulaCliente = $_POST["BusquedaCliente"];
    $cedulaEmpleado = $_POST["estilista"];
    $tratamientos = $_POST["tratamiento"];
    $fechaCita = $_POST["fechaCita"];
    $horaCita = $_POST["horaCita"];

    $resultado = crearCita($cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita);

    echo $resultado; // Puedes mostrar un mensaje de éxito o error en tu HTML
}
    }


    // edición de una cita
    public function editarCita($idCita, $cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita) {
    include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

    // Escapa y valida las entradas para evitar SQL Injection
    $idCita = mysqli_real_escape_string($conn, $idCita);
    $cedulaCliente = mysqli_real_escape_string($conn, $cedulaCliente);
    $cedulaEmpleado = mysqli_real_escape_string($conn, $cedulaEmpleado);
    $tratamientos = implode(", ", array_map('mysqli_real_escape_string', array_fill(0, count($tratamientos), $conn), $tratamientos));
    $fechaCita = mysqli_real_escape_string($conn, $fechaCita);
    $horaCita = mysqli_real_escape_string($conn, $horaCita);

    // Prepara la consulta SQL para actualizar la cita usando un identificador único (ID)
    $sql = "UPDATE cita 
            SET cedulaCliente = ?, cedulaEmpleado = ?, tratamiento = ?, fechaCita = ?, horaCita = ?
            WHERE idCita = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita, $idCita);

    if ($stmt->execute()) {
        return "Cita actualizada con éxito";
    } else {
        return "Error al actualizar la cita: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCita = $_POST["idCita"];
    $cedulaCliente = $_POST["BusquedaCliente"];
    $cedulaEmpleado = $_POST["estilista"];
    $tratamientos = $_POST["tratamiento"];
    $fechaCita = $_POST["fechaCita"];
    $horaCita = $_POST["horaCita"];

    $resultado = editarCita($idCita, $cedulaCliente, $cedulaEmpleado, $tratamientos, $fechaCita, $horaCita);

    echo $resultado; // Puedes mostrar un mensaje de éxito o error en tu HTML
}

// Esta función lista el historial de citas
    public function listarHistorialCitas() {
    include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

    $sql = "SELECT idCita, cedulaCliente, cedulaEmpleado, tratamiento, fechaCita, horaCita FROM cita";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table id="tabla" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="tabla_info">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido(s)</th>';
        echo '<th>Tratamiento</th>';
        echo '<th>Correo</th>';
        echo '<th></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["idCita"] . '</td>';
            // Agrega más columnas aquí según tus necesidades
            echo '<td>Nombre del cliente</td>';
            echo '<td>Apellido(s) del cliente</td>';
            echo '<td>' . $row["tratamiento"] . '</td>';
            echo '<td>Correo del cliente</td>';
            echo '<td>';
            echo '<a type="button" class="btn btn-danger float-right" style="margin-right: 8px;" href="eliminar.php?id=' . $row["idCita"] . '"><i class="fas fa-trash"></i> Eliminar</a>';
            echo '<a type="button" class="btn btn-success float-right" style="margin-right: 8px;" href="editarCita.php?id=' . $row["idCita"] . '"><i class="fas fa-pencil-alt"></i> Editar</a>';
            echo '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verCita.php?id=' . $row["idCita"] . '"><i class="fas fa-eye"></i> Ver</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No se encontraron citas en el historial.";
    }

    $conn->close();
}

// Llama a la función para listar el historial de citas
listarHistorialCitas();


?>