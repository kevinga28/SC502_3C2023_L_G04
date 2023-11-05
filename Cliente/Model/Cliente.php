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
    private $anio;
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

    public function setAnio($anio)
    {
        $this->anio = $anio;
    }

    public function getAnio()
    {
        return $this->anio;
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
        VALUES (:nombre, :apellido, :correo, :contrasena, :telefono, :dia, :mes, :anio)";

        try {
            self::getConexion();  // Debes utilizar self::$cnx para acceder a la conexión
            $nombre = strtoupper($this->getNombre());
            $apellido = strtoupper($this->getApellido());
            $correo = $this->getCorreo();
            $contrasena = $this->getContrasena();
            $telefono = $this->getTelefono();
            $dia = $this->getDia();
            $mes = $this->getMes();
            $anio = $this->getAnio();

            $stmt = self::$cnx->prepare($sql);  // Cambia $conexion a self::$cnx
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':dia', $dia);
            $stmt->bindParam(':mes', $mes);
            $stmt->bindParam(':anio', $anio);

            // Ejecutar la consulta
            $stmt->execute();

            // Comprobar si la consulta se ejecutó con éxito
            if ($stmt->rowCount() > 0) {
                // Aquí puedes retornar un mensaje de éxito
                return "Registro exitoso. El usuario se ha registrado correctamente.";
            } else {
                // Aquí puedes retornar un mensaje de error
                return "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
            }

        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
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





    public function obtenerDatosUsuario($correo)
    {
        $query = "SELECT * FROM usuario WHERE correo = :correo";

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":correo", $correo);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Devuelve los datos del usuario como un arreglo asociativo
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null; // Devuelve null si no se encuentra el usuario
            }
        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }







}