<?php
require_once '../config/Conexion.php';

class Producto extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $Codigo = null;
    private $nombre = null;
    private $descripcion = null;
    private $cantidad = null;
    private $precio = null;

    public function __construct()
    {
    }

    public function getCodigo()
    {
        return $this->Codigo;
    }
    public function setCodigo($Codigo)
    {
        $this->Codigo = $Codigo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /*=====  End of Encapsuladores de la Clase  ======*/

    /*=============================================
	=            Metodos de la Clase              =
	=============================================*/
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function listarProductos()
    {
        $query = "SELECT * FROM producto";
        $arr = array();
        
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            
            foreach ($resultado->fetchAll() as $articulo) {
                $producto = new Producto();
                $producto->setCodigo($articulo['Codigo']);
                $producto->setNombre($articulo['nombre']);
                $producto->setDescripcion($articulo['descripcion']);
                $producto->setCantidad($articulo['cantidad']);
                $producto->setPrecio($articulo['precio']);
                $arr[] = $producto;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function verificarProducto()
    {
        $query = "SELECT * FROM producto WHERE Codigo= :Codigo";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $Codigo = $this->getCodigo();
            $resultado->bindParam(":Codigo", $Codigo, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            $encontrado = false;
            foreach ($resultado->fetchAll() as $articulo) {
                $encontrado = true;
            }
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    /*=====  [CRUD] Guardar Productos de la Clase  ======*/

    public function insertar(){
        $query = "INSERT INTO `producto` ( `Codigo`, `nombre`, `descripcion`,  `cantidad`, `precio`)
            VALUES ( :Codigo, :nombre, :descripcion, :cantidad, :precio)";

        try {
            self::getConexion();   
            $Codigo = $this->getCodigo();
            $nombre = $this->getNombre();
            $descripcion = $this->getDescripcion();
            $cantidad = $this->getCantidad();
            $precio = $this->getPrecio();

            $resultado = self::$cnx->prepare($query);
            
            $resultado->bindParam(":Codigo", $Codigo, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            $resultado->bindParam(":precio", $precio, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    /*=====  [CRUD] Leer Productos de la Clase  ======*/

    public static function obtenerProductoCodigo($codigo)
    {
        $query = "SELECT * FROM producto WHERE Codigo = :Codigo";
        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);

            $stmt->bindParam(":Codigo", $Codigo, PDO::PARAM_INT);
            $stmt->execute();

            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            self::desconectar();

            return $producto;
        } catch (PDOException $e) {
            return null;
        }
    }

    /*=====  [CRUD] Actualizar Productos de la Clase  ======*/

    public function actualizarProducto()
    {
        $query = "UPDATE producto SET nombre = :nombre, descripcion = :descripcion, cantidad = :cantidad, precio = :precio WHERE Codigo = :Codigo";
        try {
            self::getConexion();

            $nombre = $this->getNombre();
            $descripcion = $this->getDescripcion();
            $cantidad = $this->getCantidad();
            $precio = $this->getPrecio();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $resultado->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
            $resultado->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
            $resultado->bindParam(':precio', $this->precio, PDO::PARAM_STR);
            $resultado->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);

            self::$cnx->beginTransaction();

            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount();;
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    /*=====  [CRUD] Borrar Productos de la Clase  ======*/

    public function eliminarProducto()
    {
        $query = "DELETE FROM producto WHERE Codigo = :Codigo";
        try {
            self::getConexion();
            $Codigo = $this->getCodigo();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':Codigo', $this->Codigo, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            return $resultado->rowCount();
            return true;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }
}
