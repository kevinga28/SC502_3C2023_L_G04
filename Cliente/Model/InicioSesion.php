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

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->IdCliente;
    }

    /**
     * @param mixed $IdCliente
     */
    public function setIdCliente($IdCliente)
    {
        $this->IdCliente = $IdCliente;
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


    public function logOut() {
        $_SESSION=[];
        session_destroy();

    }

}
?>