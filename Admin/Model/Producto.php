<?php
require_once '../config/Conexion.php';

class Producto extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $codigo = null;
    private $nombre = null;
    private $descripcion = null;
    private $cantidad = null;
    private $precio = null;

    /*=====  End of Atributos de la Clase  ======*/

    /*=============================================
	=            Contructores de la Clase          =
	=============================================*/
    public function __construct()
    {
    }
    /*=====  End of Contructores de la Clase  ======*/

    /*=============================================
	=            Encapsuladores de la Clase       =
	=============================================*/


    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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

    /*=====  [CRUD] Guardar Productos de la Clase  ======*/

    public function crearProducto()
    {
        $query = "INSERT INTO `producto` ( `nombre`, `descripcion`,  `cantidad`, `precio`)
            VALUES ( :nombre, :descripcion, :cantidad, :precio)";

        try {
            self::getConexion();
           
            $nombre = $this->getNombre();
            $descripcion = $this->getDescripcion();
            $cantidad = $this->getCantidad();
            $precio = $this->getPrecio();


            $resultado = self::$cnx->prepare($query);
            
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

    public function leerProductos()
    {
        $query = "SELECT * FROM producto";
        $arr = array();
        
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            
            foreach ($resultado->fetchAll() as $encontrado) {
                $producto = new Producto();
                $producto->setCodigo($encontrado['codigo']);
                $producto->setNombre($encontrado['nombre']);
                $producto->setDescripcion($encontrado['descripcion']);
                $producto->setCantidad($encontrado['cantidad']);
                $producto->setPrecio($encontrado['precio']);
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
        $query = "SELECT codigo FROM cliente WHERE codigo= :codigo";

        try {
            self::getConexion();
            $codigo = $this->getCodigo();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            $encontrado = false;
            foreach ($resultado->fetchAll() as $reg) {
                $encontrado = true;
            }
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public static function obtenerProductoCodigo($codigo)
    {
        $query = "SELECT * FROM producto WHERE codigo = :codigo";
        try {
            // Conecta a la base de datos
            self::getConexion();

            // Prepara la consulta
            $stmt = self::$cnx->prepare($query);

            // Asigna el codigo y ejecuta la consulta
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();

            // Obtiene los resultados y los devuelve como un arreglo asociativo
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cierra la conexión a la base de datos
            self::desconectar();

            return $cliente;
        } catch (PDOException $e) {
            // Manejo de errores, por ejemplo, loguear el error
            return null;
        }
    }

    /*=====  [CRUD] Actualizar Productos de la Clase  ======*/

    public function actualizarProducto()
    {
        $query = "UPDATE producto SET nombre = :nombre, descripcion = :descripcion, cantidad = :cantidad, precio = :precio WHERE codigo = :codigo";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $resultado->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
            $resultado->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
            $resultado->bindParam(':precio', $this->precio, PDO::PARAM_STR);
            $resultado->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            return true;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    /*=====  [CRUD] Borrar Productos de la Clase  ======*/

    public function eliminarProducto()
    {
        $query = "DELETE FROM producto WHERE codigo = :codigo";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            return true;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    /*=====  End of Metodos de la Clase  ======*/
}
