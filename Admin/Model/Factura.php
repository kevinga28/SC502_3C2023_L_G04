<?php
require_once '../config/Conexion.php';
require_once 'Cliente.php';
require_once 'Producto.php';
class Factura extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $ID_Factura;
    private $ID_Cita;
    private $codigoProducto;
    private $metodoPago;
    private $pagoTotal;

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


    public function getIdFactura()
    {
        return $this->ID_Factura;
    }

    public function setIdFactura($ID_Factura)
    {
        $this->ID_Factura = $ID_Factura;
    }

    public function getIdCita()
    {
        return $this->ID_Cita;
    }

    public function setIdCita($ID_Cita)
    {
        $this->ID_Cita = $ID_Cita;
    }

    public function getCodigoProducto()
    {
        return $this->codigoProducto;
    }

    public function setCodigoProducto($codigoProducto)
    {
        $this->codigoProducto = $codigoProducto;
    }

    public function getMetodoPago()
    {
        return $this->metodoPago;
    }

    public function setMetodoPago($metodoPago)
    {
        $this->metodoPago = $metodoPago;
    }

    public function getPagoTotal()
    {
        return $this->pagoTotal;
    }

    public function setPagoTotal($pagoTotal)
    {
        $this->pagoTotal = $pagoTotal;
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

    public function listarFacturas()
    {
        $query = "SELECT f.ID_Factura, f.metodoPago, f.pagoTotal, c.*, p.*
              FROM factura f
              JOIN cita c ON f.ID_Cita = c.ID_Cita
              JOIN producto p ON f.codigoProducto = p.Codigo";

        $facturas = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $factura = new Factura();
                $factura->setIdFactura($encontrado['ID_Factura']);
                $factura->setMetodoPago($encontrado['metodoPago']);
                $factura->setPagoTotal($encontrado['pagoTotal']);

                $cita = new Cita();
                $cita->setIdCita($encontrado['ID_Cita']);
                // Setear otras propiedades de la tabla 'cita' si es necesario
                $factura->setCita($cita);

                $producto = new Producto();
                $producto->setCodigo($encontrado['Codigo']);
                // Setear otras propiedades de la tabla 'producto' si es necesario
                $factura->setProducto($producto);

                $facturas[] = $factura;
            }

            return $facturas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }
    public function verificarExistenciaDb()
    {
        $query = "SELECT ID_Factura FROM factura WHERE ID_Factura = :idFactura";

        try {
            self::getConexion(); // Abre la conexión a la base de datos

            $idFactura = $this->getIdFactura();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idFactura", $idFactura, PDO::PARAM_INT);
            $resultado->execute();

            self::desconectar(); // Cierra la conexión a la base de datos

            $encontrado = false;

            if ($resultado->rowCount() > 0) {
                $encontrado = true;
            }

            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error; // Manejo de errores
        }
    }

    public function guardarEnDb()
    {
        $query = "INSERT INTO factura (ID_Cita, codigoProducto, metodoPago, pagoTotal)
                  VALUES (:idCita, :codigoProducto, :metodoPago, :pagoTotal)";

        try {
            self::getConexion(); // Abre la conexión a la base de datos

            $idCita = $this->getIdCita();
            $codigoProducto = $this->getCodigoProducto();
            $metodoPago = $this->getMetodoPago();
            $pagoTotal = $this->getPagoTotal();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":idCita", $idCita, PDO::PARAM_INT);
            $resultado->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_INT);
            $resultado->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultado->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);

            $resultado->execute();

            self::desconectar(); // Cierra la conexión a la base de datos
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error; // Manejo de errores
        }
    }



    public static function mostrarPorId($ID_Factura)
    {
        $query = "SELECT * FROM factura WHERE ID_Factura = :ID_Factura";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":ID_Factura", $ID_Factura, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetch();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function llenarCampos($id)
    {
        $query = "SELECT * FROM facturas WHERE id = :id";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id", $id, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            $facturaEncontrada = $resultado->fetch();

            if ($facturaEncontrada) {
                $this->setIdFactura($facturaEncontrada['ID_Factura']);
                $this->setIdCita($facturaEncontrada['ID_Cita']);
                $this->setCodigoProducto($facturaEncontrada['codigoProducto']);
                $this->setMetodoPago($facturaEncontrada['metodoPago']);
                $this->setPagoTotal($facturaEncontrada['pagoTotal']);
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function actualizarFactura()
    {
        $query = "UPDATE facturas 
              SET ID_Cita=:ID_Cita, codigoProducto=:codigoProducto, 
                  metodoPago=:metodoPago, pagoTotal=:pagoTotal 
              WHERE ID_Factura=:ID_Factura";

        try {
            self::getConexion(); // Abre la conexión a la base de datos

            $ID_Factura = $this->getIdFactura();
            $ID_Cita = $this->getIdCita();
            $codigoProducto = $this->getCodigoProducto();
            $metodoPago = $this->getMetodoPago();
            $pagoTotal = $this->getPagoTotal();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":ID_Factura", $ID_Factura, PDO::PARAM_INT);
            $resultado->bindParam(":ID_Cita", $ID_Cita, PDO::PARAM_INT);
            $resultado->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_INT);
            $resultado->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultado->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);

            self::$cnx->beginTransaction(); // Inicia una transacción
            $resultado->execute();
            self::$cnx->commit(); // Confirma la transacción
            self::desconectar(); // Cierra la conexión a la base de datos

            return $resultado->rowCount(); // Devuelve la cantidad de filas afectadas
        } catch (PDOException $Exception) {
            self::$cnx->rollBack(); // Revierte la transacción en caso de error
            self::desconectar(); // Cierra la conexión a la base de datos
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error; // Manejo de errores
        }
    }

    

    /*=====  End of Metodos de la Clase  ======*/
}
