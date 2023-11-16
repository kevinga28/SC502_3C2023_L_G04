<?php
require_once '../config/Conexion.php';

class Factura extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $IdFactura;
    private $IdCita;
    private $metodoPago;
    private $pagoTotal;


    /*=============================================
	=            Contructores de la Clase          =
	=============================================*/
    public function __construct()
    {
    }


    /*=============================================
	=            Encapsuladores de la Clase       =
	=============================================*/

    public function getIdFactura()
    {
        return $this->IdFactura;
    }

    public function setIdFactura($IdFactura)
    {
        $this->IdFactura = $IdFactura;
    }

    public function getIdCita()
    {
        return $this->IdCita;
    }

    public function setIdCita($IdCita)
    {
        $this->IdCita = $IdCita;
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
    $query = "SELECT f.*, c.nombre AS nombreCliente, c.apellido AS apellidoCliente , p.nombre AS nombreProducto, p.precio AS precioProducto
        FROM factura f
        INNER JOIN cita ci ON f.IdCita = ci.IdCita
        INNER JOIN cliente c ON ci.IdCliente = c.IdCliente
        INNER JOIN producto p ON f.codigoProducto = p.Codigo;";

    $facturas = array();

    try {
        self::getConexion();
        $resultado = self::$cnx->prepare($query);
        $resultado->execute();
        self::desconectar();

        foreach ($resultado->fetchAll(PDO::FETCH_ASSOC) as $encontrado) {
            $factura = array(
                'IdFactura' => $encontrado['IdFactura'],
                'IdCita' => $encontrado['IdCita'],
                'MetodoPago' => $encontrado['metodoPago'],
                'PagoTotal' => $encontrado['pagoTotal'],
                'NombreCliente' => $encontrado['nombreCliente'],
                'ApellidoCliente' => $encontrado['apellidoCliente'],
                'Correo' => $encontrado['correo'],
                'NombreProducto' => $encontrado['nombreProducto'],
            );
            $facturas[] = $factura;
        }

        return $facturas;
    } catch (PDOException $Exception) {
        self::desconectar();
        $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
        return json_encode($error);
    }
}
    public function buscarCitaPorId($idCita)
    {
        $query = "SELECT c.*, f.*, cli.nombre AS nombreCliente, cli.apellido AS apellidoCliente, cli.correo, emp.nombre AS nombreEmpleado, emp.apellido AS apellidoEmpleado
        FROM cita c
        INNER JOIN factura f ON c.IdCita = f.IdCita
        INNER JOIN cliente cli ON c.IdCliente = cli.IdCliente
        INNER JOIN empleado emp ON c.cedulaEmpleado = emp.cedula
        WHERE c.IdCita = :idCita";
    
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idCita", $idCita, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
    
            $encontrado = $resultado->fetch(PDO::FETCH_ASSOC);
            if ($encontrado) {
                return $encontrado; // Devuelve todos los datos de la cita y del cliente en un arreglo asociativo
            } else {
                return null; // No se encontró la cita
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function agregarFactura()
    {
        try {
            self::getConexion();

            $IdCita = $this->getIdCita();
            $metodoPago = $this->getMetodoPago();
            $pagoTotal = $this->getPagoTotal();

            $queryFactura = "INSERT INTO `factura` (`IdCita`, `metodoPago`, `pagoTotal`) 
            VALUES (:IdCita, :metodoPago, :pagoTotal)";

            $resultadoFactura = self::$cnx->prepare($queryFactura);
            $resultadoFactura->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $resultadoFactura->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultadoFactura->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);

            $resultadoFactura->execute();

            $IdFactura = self::$cnx->lastInsertId();

            self::desconectar();

            return $IdFactura;
        } catch (PDOException $Exception) {
            self::desconectar();
            throw $Exception;
        }
    }

    public function agregarProductoFactura($IdFactura, $codigo, $cantidad, $precioUnitario)
    {
        try {
            self::getConexion();
    
            // Verifica si existen registros en la tabla factura con el ID proporcionado
            $consultaFactura = "SELECT COUNT(*) FROM `factura` WHERE `IdFactura` = :IdFactura";
            $resultadoFactura = self::$cnx->prepare($consultaFactura);
            $resultadoFactura->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
            $resultadoFactura->execute();
            $existeFactura = $resultadoFactura->fetchColumn();
    
            // Verifica si existen registros en la tabla producto con el código proporcionado
            $consultaProducto = "SELECT COUNT(*) FROM `producto` WHERE `codigo` = :codigo";
            $resultadoProducto = self::$cnx->prepare($consultaProducto);
            $resultadoProducto->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $resultadoProducto->execute();
            $existeProducto = $resultadoProducto->fetchColumn();
    
            if ($existeFactura && $existeProducto) {
                // Ambos IDs son válidos, procede a la inserción
                $queryProducto = "INSERT INTO `detalle_factura` (`IdFactura`, `CodigoProducto`, `Cantidad`, `PrecioUnitario`) 
                        VALUES (:IdFactura, :CodigoProducto, :Cantidad, :PrecioUnitario)";
    
                $resultadoProducto = self::$cnx->prepare($queryProducto);
                $resultadoProducto->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
                $resultadoProducto->bindParam(":CodigoProducto", $codigo, PDO::PARAM_INT);
                $resultadoProducto->bindParam(":Cantidad", $cantidad, PDO::PARAM_INT);
                $resultadoProducto->bindParam(":PrecioUnitario", $precioUnitario, PDO::PARAM_STR);
                $resultadoProducto->execute();
    
                // Cierra la conexión a la base de datos
                self::desconectar();
            } else {
                echo "Error: El ID de factura o producto no existe.";
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }


    public function verificarExistenciaFactura()
    {
        $query = "SELECT IdFactura FROM factura WHERE IdFactura = :IdFactura";

        try {
            self::getConexion();
            $IdFactura = $this->getIdFactura();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
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

    public function actualizarFactura()
    {
        $query = "UPDATE factura 
            SET IdCita = :IdCita, codigoProducto = :codigoProducto, metodoPago = :metodoPago,
                pagoTotal = :pagoTotal
            WHERE IdFactura = :IdFactura";

        try {
            self::getConexion();

            $IdCita = $this->getIdCita();
            $codigoProducto = $this->getCodigoProducto();
            $metodoPago = $this->getMetodoPago();
            $pagoTotal = $this->getPagoTotal();
            $IdFactura = $this->getIdFactura();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $resultado->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_INT);
            $resultado->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultado->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);
            $resultado->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);

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

    public static function obtenerFacturaPorIdFactura($IdFactura)
    {
        $query = "SELECT * FROM factura WHERE IdFactura = :IdFactura";
        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);

            $stmt->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
            $stmt->execute();

            $factura = $stmt->fetch(PDO::FETCH_ASSOC);

            self::desconectar();

            return $factura;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function eliminarFactura($IdFactura)
    {
        $query = "DELETE FROM factura WHERE IdFactura = :IdFactura";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
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
