<?php
require_once '../config/Conexion.php';

class Tratamiento extends Conexion
{
    protected static $cnx;
    private $IdTratamiento;
    private $nombre;
    private $precio;
    private $duracion;

    private $descripcion;

    public function __construct()
    {
    }


    public function setIdTratamiento($IdTratamiento)
    {
        $this->IdTratamiento = $IdTratamiento;
    }

    public function getIdTratamiento()
    {
        return $this->IdTratamiento;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }


    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }


    public function listarTratamientos()
    {
        $query = "SELECT * FROM tratamiento";

        $tratamientos = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->query($query);

            while ($tratamiento = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $tratamientos[] = $tratamiento;
            }

            self::desconectar();

            return $tratamientos;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function guardarEnDb()
    {
        $query = "INSERT INTO `tratamiento` (`nombre`, `descripcion`, `precio`, `duracion`) VALUES (:nombre, :descripcion, :precio, :duracion)";

        try {
            self::getConexion();

            $nombre = $this->getNombre();
            $descripcion = $this->getDescripcion();
            $precio = $this->getPrecio();
            $duracion = $this->getDuracion();
            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":precio", $precio, PDO::PARAM_STR);
            $resultado->bindParam(":duracion", $duracion, PDO::PARAM_STR);


            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function verificarExistenciaTratamiento()
    {
        $query = "SELECT 1 FROM tratamiento WHERE nombre=:nombre LIMIT 1";

        try {
            self::getConexion();
          
            $nombre = $this->getNombre();

            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        
            $stmt->execute();

            $existeTratamiento = $stmt->fetch(PDO::FETCH_ASSOC);

            self::desconectar();

            return ($existeTratamiento !== false); // Devuelve true si se encontró al menos un tratamiento
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
    public function actualizarTratamiento()
    {
        $query = "UPDATE tratamiento 
                  SET nombre = :nombre, descripcion = :descripcion, precio = :precio, duracion = :duracion
                  WHERE IdTratamiento = :IdTratamiento";
    
        try {
            self::getConexion();
    
            $nombre = $this->getNombre();
            $descripcion = $this->getDescripcion();
            $precio = $this->getPrecio();
            $duracion = $this->getDuracion();
            $IdTratamiento = $this->getIdTratamiento(); 
    
            $resultado = self::$cnx->prepare($query);
    
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":precio", $precio, PDO::PARAM_STR); 
            $resultado->bindParam(":duracion", $duracion, PDO::PARAM_STR);
            $resultado->bindParam(":IdTratamiento", $IdTratamiento, PDO::PARAM_INT);
    
            self::$cnx->beginTransaction();
    
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
    
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public static function obtenerTratamientoPorId($IdTratamiento)
    {
        $query = "SELECT * FROM tratamiento WHERE IdTratamiento = :IdTratamiento";
        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);

            $stmt->bindParam(":IdTratamiento", $IdTratamiento, PDO::PARAM_INT);
            $stmt->execute();

            $tratamiento = $stmt->fetch(PDO::FETCH_ASSOC);

           
            self::desconectar();

            return $tratamiento;
        } catch (PDOException $e) {
         
            return null;
        }
    }

    public function eliminarTratamiento()
    {
        $query = "DELETE FROM tratamiento WHERE IdTratamiento = :IdTratamiento";

        try {
            self::getConexion();
            $IdTratamiento = $this->getIdTratamiento();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":IdTratamiento", $IdTratamiento, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            return $resultado->rowCount(); 
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

}
