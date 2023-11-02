<?php


require_once '../config/Conexion.php';

class Cliente extends Conexion
{
    protected static $cnx;
    private $cedula;
    private $nombre;
    private $apellido;
    private $genero;
    private $tipoCliente;
    private $correo;
    private $contrasena;
    private $telefono;
    private $canton;
    private $distrito;
    private $dia;
    private $mes;
    private $ano;
    private $otros;

    public function __construct()
    {
        // Constructor vacío
    }

    // Getters y setters para los atributos
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setDia($dia)
    {
        $this->dia = $dia;
    }

    public function getDia()
    {
        return $this->dia;
    }

    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    public function getMes()
    {
        return $this->mes;
    }

    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    public function getAno()
    {
        return $this->ano;
    }


    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }





    public function guardarUsuario()
    {
        $sql = "INSERT INTO usuario (nombre, apellido, correo, contrasena, telefono, dia, mes, ano) 
            VALUES (:nombre, :apellido, :correo, :contrasena, :telefono, :dia, :mes, :ano)";

        self::getConexion();  // Debes utilizar self::$cnx para acceder a la conexión
        $nombre = strtoupper($this->getNombre());
        $apellido = strtoupper($this->getApellido());
        $correo = $this->getCorreo();
        $contrasena = $this->getContrasena();
        $telefono = $this->getTelefono();
        $dia = $this->getDia();
        $mes = $this->getMes();
        $ano = $this->getAno();

        $stmt = self::$cnx->prepare($sql);  // Cambia $conexion a self::$cnx
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':dia', $dia);
        $stmt->bindParam(':mes', $mes);
        $stmt->bindParam(':ano', $ano);


        if ($stmt->execute()) {
            echo '<script>alert("Registro exitoso. El usuario se ha registrado correctamente.");</script>';
        } else {
            echo '<script>alert("Error al registrar el usuario. Por favor, inténtalo de nuevo.");</script>';
        }
    }



}