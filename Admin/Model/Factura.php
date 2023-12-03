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
        $query = "SELECT 
        f.IdFactura, 
        f.IdCita, 
        f.metodoPago, 
        f.pagoTotal, 
        c.nombre AS nombreCliente, 
        c.apellido AS apellidoCliente, 
        GROUP_CONCAT(DISTINCT p.nombre ORDER BY p.nombre SEPARATOR ', ') AS nombresProductos,
        GROUP_CONCAT(DISTINCT t.nombre ORDER BY t.nombre SEPARATOR ', ') AS nombresTratamientos
    FROM 
        factura f
    INNER JOIN 
        cita ci ON f.IdCita = ci.IdCita
    INNER JOIN 
        cliente c ON ci.IdCliente = c.IdCliente
    LEFT JOIN 
        detalle_factura df ON f.IdFactura = df.IdFactura
    LEFT JOIN 
        producto p ON df.CodigoProducto = p.codigo
    LEFT JOIN 
        cita_tratamiento ct ON ci.IdCita = ct.IdCita
    LEFT JOIN 
        tratamiento t ON ct.IdTratamiento = t.IdTratamiento
    GROUP BY f.IdFactura;";

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
                    'NombreCliente' => $encontrado['nombreCliente'],
                    'ApellidoCliente' => $encontrado['apellidoCliente'],
                    'Tratamiento' => $encontrado['nombresTratamientos'],
                    'NombreProducto' => $encontrado['nombresProductos'],
                    'MetodoPago' => $encontrado['metodoPago'],
                    'PagoTotal' => $encontrado['pagoTotal'],
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

    public function existeFacturaParaCita($IdCita)
    {
        try {
            self::getConexion();
            $consulta = self::$cnx->prepare("SELECT COUNT(*) as total FROM factura WHERE IdCita = :IdCita");
            $consulta->bindParam(':IdCita', $IdCita);
            $consulta->execute();

            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            // Si la consulta devuelve un total mayor que 0, significa que existe al menos una factura para esa cita
            return $resultado['total'] > 0;
        } catch (PDOException $e) {
            // Manejo de errores si la consulta falla
            throw new Exception("Error al verificar la existencia de factura para la cita: " . $e->getMessage());
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

            $idFactura = self::$cnx->lastInsertId();

            self::desconectar();

            return $idFactura;
        } catch (PDOException $Exception) {
            self::desconectar();
            throw $Exception;
        }
    }

    public function agregarProductoFactura($idFactura, $codigo, $cantidad)
    {
        try {
            self::getConexion();

            // Verifica si existe la factura con el ID proporcionado
            $consultaFactura = "SELECT 1 FROM `factura` WHERE `idFactura` = :IdFactura LIMIT 1";
            $stmtFactura = self::$cnx->prepare($consultaFactura);
            $stmtFactura->bindParam(":IdFactura", $idFactura, PDO::PARAM_INT);
            $stmtFactura->execute();
            $existeFactura = $stmtFactura->fetchColumn();

            // Verifica si existe el producto con el código proporcionado
            $consultaProducto = "SELECT 1 FROM `producto` WHERE `codigo` = :codigo LIMIT 1";
            $stmtProducto = self::$cnx->prepare($consultaProducto);
            $stmtProducto->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $stmtProducto->execute();
            $existeProducto = $stmtProducto->fetchColumn();

            if ($existeFactura && $existeProducto) {
                // Ambos IDs son válidos, procede a la inserción
                $queryProducto = "INSERT INTO `detalle_factura` (`idFactura`, `CodigoProducto`, `Cantidad`) 
                        VALUES (:IdFactura, :CodigoProducto, :Cantidad)";

                $stmtInsert = self::$cnx->prepare($queryProducto);
                $stmtInsert->bindParam(":IdFactura", $idFactura, PDO::PARAM_INT);
                $stmtInsert->bindParam(":CodigoProducto", $codigo, PDO::PARAM_INT);
                $stmtInsert->bindParam(":Cantidad", $cantidad, PDO::PARAM_INT);
                $stmtInsert->execute();

                // Cierra la conexión a la base de datos
                self::desconectar();
            } else {
                if (!$existeFactura) {
                    throw new Exception("Error: El ID de factura ($idFactura) no existe.");
                } else {
                    throw new Exception("Error: El código de producto ($codigo) no existe.");
                }
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
            SET IdCita = :IdCita,  metodoPago = :metodoPago,
                pagoTotal = :pagoTotal
            WHERE IdFactura = :IdFactura";

        try {
            self::getConexion();

            $IdCita = $this->getIdCita();
            $metodoPago = $this->getMetodoPago();
            $pagoTotal = $this->getPagoTotal();
            $IdFactura = $this->getIdFactura();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
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

    public function eliminarProductos($IdFactura)
    {
        try {
            self::getConexion();

            // Elimina los registros de cita_tratamiento asociados a esta cita
            $queryEliminar = "DELETE FROM detalle_factura WHERE IdFactura = :IdFactura";
            $stmtEliminar = self::$cnx->prepare($queryEliminar);
            $stmtEliminar->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
            $stmtEliminar->execute();

            // Cierra la conexión a la base de datos
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }

    public static function obtenerFacturaPorIdFactura($IdFactura)
    {
        $query = "SELECT 
        f.IdFactura, 
        f.IdCita, 
        f.metodoPago, 
        f.pagoTotal, 
        c.nombre AS nombreCliente, 
        c.apellido AS apellidoCliente,
        c.correo AS correoCliente,
        e.nombre AS nombreEstilista,
        e.apellido AS apellidoEstilista,
        ci.fechaCita,
        ci.horaCita,
        df.Cantidad AS cantidad,
        GROUP_CONCAT(DISTINCT p.nombre ORDER BY p.nombre SEPARATOR ', ') AS nombresProductos,
        GROUP_CONCAT(DISTINCT t.nombre ORDER BY t.nombre SEPARATOR ', ') AS nombresTratamientos
    FROM 
        factura f
    INNER JOIN 
        cita ci ON f.IdCita = ci.IdCita
    INNER JOIN 
        cliente c ON ci.IdCliente = c.IdCliente
    LEFT JOIN 
        detalle_factura df ON f.IdFactura = df.IdFactura
    LEFT JOIN 
        producto p ON df.CodigoProducto = p.Codigo
    LEFT JOIN 
        cita_tratamiento ct ON ci.IdCita = ct.IdCita
    LEFT JOIN 
        tratamiento t ON ct.IdTratamiento = t.IdTratamiento
    LEFT JOIN 
        empleado e ON ci.cedulaEmpleado = e.cedula
    WHERE 
        f.IdFactura = :IdFactura
    GROUP BY f.IdFactura";

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
        try {
            self::getConexion();

            // Iniciar una transacción
            self::$cnx->beginTransaction();

            // 1. Eliminar registros relacionados 
            $queryDeleteRelacionados = "DELETE FROM detalle_factura WHERE IdFactura = :IdFactura";
            $stmtDeleteRelacionados = self::$cnx->prepare($queryDeleteRelacionados);
            $stmtDeleteRelacionados->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
            $stmtDeleteRelacionados->execute();

            // 2. Eliminar la Factura principal
            $queryEliminarFactura = "DELETE FROM factura WHERE IdFactura = :IdFactura";
            $stmtEliminarFactura = self::$cnx->prepare($queryEliminarFactura);
            $stmtEliminarFactura->bindParam(":IdFactura", $IdFactura, PDO::PARAM_INT);
            $stmtEliminarFactura->execute();

            // Confirmar la transacción si no hubo errores
            self::$cnx->commit();

            self::desconectar();

            // Verificar el número de filas afectadas
            $numFilasEliminadas = $stmtDeleteRelacionados->rowCount() + $stmtEliminarFactura->rowCount();

            return $numFilasEliminadas; // Devuelve el número de filas eliminadas
        } catch (PDOException $e) {
            // En caso de error, deshacer la transacción
            self::$cnx->rollBack();
            self::desconectar();
            return 0; // Error
        }
    }
}
