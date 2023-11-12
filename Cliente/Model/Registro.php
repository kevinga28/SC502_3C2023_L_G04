<?php

require_once '../config/Conexion.php';

class Registro
{
    protected static $cnx;

    private $nombre;
    private $apellido;
    private $genero;
    private $correo;
    private $contrasena;
    private $telefono;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public static function getCnx()
    {
        return self::$cnx;
    }

    /**
     * @param mixed $cnx
     */
    public static function setCnx($cnx)
    {
        self::$cnx = $cnx;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * @param mixed $contrasena
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
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
        $sql = "INSERT INTO cliente(nombre, apellido, correo, contrasena, telefono) 
        VALUES (:nombre, :apellido, :correo, :contrasena, :telefono)";

        try {
            self::getConexion();  // Debes utilizar self::$cnx para acceder a la conexión

            $nombre = strtoupper($this->getNombre());
            $apellido = strtoupper($this->getApellido());
            $correo = $this->getCorreo();
            $contrasena = $this->getContrasena();
            $telefono = $this->getTelefono();


            $stmt = self::$cnx->prepare($sql);  // Cambia $conexion a self::$cnx
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':telefono', $telefono);


            // Ejecutar la consulta
            $stmt->execute();


            if ($stmt->rowCount() > 0) {

                return true;
            } else {

                return false;
            }

        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }

    public function verificarExistenciaCliente()
    {
        $query = "SELECT COUNT(*) FROM cliente WHERE correo=:correo";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);

            $correo = $this->getCorreo();

            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->execute();

            $count = $resultado->fetchColumn();

            if ($count > 0) {
                return true; // El cliente existe
            } else {
                return false; // El cliente no existe
            }
        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }






}