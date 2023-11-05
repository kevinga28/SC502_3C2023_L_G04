<?php
require_once '../config/Conexion.php';

class Empleado extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $conn;
    private $cedula;
    private $imagen;
    private $nombre;
    private $apellido;
    private $genero;
    private $correo;
    private $contrasena;
    private $telefono;
    private $rol;
    private $provincia;
    private $distrito;
    private $canton;
    private $otros;

    public function __construct() {
        // Constructor vacío
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getImagen() {
        return $this->imagen;
    }

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

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function getGenero() {
        return $this->genero;
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

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    public function getDistrito() {
        return $this->distrito;
    }

    public function setCanton($canton) {
        $this->canton = $canton;
    }

    public function getCanton() {
        return $this->canton;
    }

    public function setOtros($otros) {
        $this->otros = $otros;
    }

    public function getOtros() {
        return $this->otros;
    }


    /*=====  End of Encapsuladores de la Clase  ======*/

    /*=============================================
	=            Metodos de la Clase              =
	=============================================*/
    public static function getConexion()
    {
        self::$conn = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$conn = null;
    }


    public function listarEmpleados()
    {
        $query = "SELECT * FROM empleado";
        $arr = array();

        try {
            self::getConexion();
            $resultado = self::$conn->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $item) {
                $empleado = new Empleado();
                $empleado->setCedula($item['cedula']);
                $empleado->setImagen($item['imagen']);
                $empleado->setNombre($item['nombre']);
                $empleado->setApellido($item['apellido']);
                $empleado->setGenero($item['genero']);
                $empleado->setCorreo($item['correo']);
                $empleado->setContrasena($item['contrasena']);
                $empleado->setTelefono($item['telefono']);
                $empleado->setRol($item['rol']);
                $empleado->setProvincia($item['provincia']);
                $empleado->setDistrito($item['distrito']);
                $empleado->setCanton($item['canton']);
                $empleado->setOtros($item['otros']);                
                $arr[] = $empleado;
            }

            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function verificarExistenciaEmpleado()
{
    $query = "SELECT cedula, correo FROM empleado WHERE cedula=:cedula OR correo=:correo";

    try {
        self::getConexion();
        $cedula = $this->getCedula();
        $correo = $this->getCorreo();
        $resultado = self::$conn->prepare($query);
        $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
        $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
        $resultado->execute(); 
        self::desconectar();

        $encontrado = false;
        foreach ($resultado->fetchAll() as $item) {
            $encontrado = true;
        }
        return $encontrado;
    } catch (PDOException $Exception) {
        self::desconectar();
        $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
        return $error;
    }
}


    public function insertar()
    {
        $query = "INSERT INTO `empleado` (`cedula`, `imagen`, `nombre`, `apellido`,`genero`, `correo`, `contrasena`, `telefono`, `rol`, `provincia`, `distrito`, `canton`, `otros`)
                VALUES (:cedula, :imagen, :nombre, :apellido, :genero, :correo, :contrasena, :telefono, :rol, :provincia, :distrito, :canton, :otros)";
    
        try {
            self::getConexion();
            $cedula = $this->getCedula();
            $imagen = $this->getImagen();
            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $genero = $this->getGenero();
            $correo = $this->getCorreo();
            $contrasena = $this->getContrasena();
            $telefono = $this->getTelefono();
            $rol = $this->getRol();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();
    
            $resultado = self::$conn->prepare($query);

            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":imagen", $imagen, PDO::PARAM_LOB); 
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":genero", $genero, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":rol", $rol, PDO::PARAM_STR);
            $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
            $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
            $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
            $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);
            
            $resultado->execute(); 
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

}