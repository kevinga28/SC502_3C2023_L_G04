<?php

require_once '../../Admin/config/Conexion.php';


class InicioSesion extends Conexion
{
    protected static $cnx;
    private $IdCliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $contrasena;
    private $telefono;
    private $tipoCliente;
    private $provincia;
    private $distrito;
    private $canton;
    private $otros ;













    public function __construct()
    {

    }
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }


    public function verificarInicioSesion($correo, $contrasena)
    {
        $query = "SELECT * FROM cliente WHERE correo = :correo AND contrasena = :contrasena";

        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":contrasena", $contrasena);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;

            } else {
                return false;


            }
        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }


    public function iniciarSesion($correo, $contrasena)
    {
        return $this->verificarInicioSesion($correo, $contrasena);
    }


    public function obtenerDatosUsuario($correo)
    {
        $query = "SELECT * FROM cliente WHERE correo = :correo";

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":correo", $correo);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }

    

    public function guardarUsuario()
    {
        $sql = "INSERT INTO `cliente` ( `nombre`, `apellido`,  `correo`, `contrasena`, `telefono`, `tipoCliente`, `provincia`, `distrito`, `canton`, `otros`)
            VALUES ( :nombre, :apellido, :correo, :contrasena, :telefono, :tipoCliente, :provincia, :distrito, :canton, :otros)";

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

    public function logOut() {
        $_SESSION=[];
        session_destroy();

    }

}
?>