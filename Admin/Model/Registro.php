<?php
require_once 'Conexion.php'; 

class Registro {
    private $nombre;
    private $apellido;
    private $correo;
    private $contrasena;
    private $telefono;
    private $dia;
    private $mes;
    private $ano;

    public function __construct() {
        // Constructor vacío
    }

    // Getters y setters para los atributos
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }

    public function getDia() {
        return $this->dia;
    }

    public function setMes($mes) {
        $this->mes = $mes;
    }

    public function getMes() {
        return $this->mes;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function getAno() {
        return $this->ano;
    }

    public function guardarUsuario() {
        $conexion = Conexion::conectar(); 

        $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, telefono, dia, mes, ano) 
                VALUES (:nombre, :apellido, :correo, :contrasena, :telefono, :dia, :mes, :ano)";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':dia', $this->dia);
        $stmt->bindParam(':mes', $this->mes);
        $stmt->bindParam(':ano', $this->ano);

        if ($stmt->execute()) {
            echo '<script>alert("Registro exitoso. El usuario se ha registrado correctamente.");</script>';
        } else {
            echo '<script>alert("Error al registrar el usuario. Por favor, inténtalo de nuevo.");</script>';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $telefono = $_POST["telefono"];
    $dia = $_POST["dia"];
    $mes = $_POST["mes"];
    $ano = $_POST["ano"];

    $usuario = new Registro();
    $usuario->setNombre($nombre);
    $usuario->setApellido($apellido);
    $usuario->setCorreo($correo);
    $usuario->setContrasena($contrasena);
    $usuario->setTelefono($telefono);
    $usuario->setDia($dia);
    $usuario->setMes($mes);
    $usuario->setAno($ano);

    $usuario->guardarUsuario();
}
?>