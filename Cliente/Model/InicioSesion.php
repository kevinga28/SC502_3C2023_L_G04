<?php
require_once '../config/Conexion.php';

class InicioSesion extends Conexion
{
    protected static $cnx;
    private $nombre;
    private $correo;
    private $contrasena;

    public function __construct()
    {


    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @param mixed $contrasena
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }



    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getContrasena()
    {
        return $this->contrasena;
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
        $query = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena";

        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":contrasena", $contrasena);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
                echo '<script>alert("hola.");</script>';
            } else {
                return false;
                echo '<script>alert("Credenciales incorrectas. Por favor, verifica tus datos.");</script>';

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






}

?>
