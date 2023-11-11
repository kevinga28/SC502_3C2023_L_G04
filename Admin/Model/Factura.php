<?php
require_once '../config/Conexion.php';
require_once '../Model/Cita.php';

class Factura extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $IdFactura;
    private $IdCita;
    private $codigoProducto;
    private $metodoPago;
    private $pagoTotal;


    /*========================================================================
	=            Atributos de la Clase Cliente mediante la cita            =
	========================================================================*/
    private $nombreCliente;
    private $apellidoCliente;
    private $correo;
    private $nombreProducto;



    /*=============================================
	=            Contructores de la Clase          =
	=============================================*/
    public function __construct()
    {
    }


    /*=============================================================
	=            Encapsuladores de la Clase Cita con cliente      =
	===============================================================*/

    public function setNombreCliente($nombre)
    {
        $this->nombreCliente = $nombre;
    }

    public function setApellidoCliente($apellido)
    {
        $this->apellidoCliente = $apellido;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }

    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    public function getApellidoCliente()
    {
        return $this->apellidoCliente;
    }

    public function getCorreo()
    {
        return $this->correo;
    }


    public function getNombreProducto()
    {
        return $this->nombreProducto;
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
        $query = "SELECT f.*, c.nombre AS nombreCliente, c.apellido AS apellidoCliente, c.correo AS correo, p.nombre AS nombreProducto
        FROM factura f
        INNER JOIN cita ci ON f.IdCita = ci.IdCita
        INNER JOIN cliente c ON ci.IdCliente = c.IdCliente
        INNER JOIN producto p ON f.codigoProducto = p.Codigo;";

        $arr = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $factura = new Factura();
                $factura->setIdFactura($encontrado['IdFactura']);
                $factura->setIdCita($encontrado['IdCita']);
                $factura->setMetodoPago($encontrado['metodoPago']);
                $factura->setPagoTotal($encontrado['pagoTotal']);
                $factura->setNombreCliente($encontrado['nombreCliente']); // Nombre del cliente
                $factura->setApellidoCliente($encontrado['apellidoCliente']);
                $factura->setCorreo($encontrado['correo']); // Apellido del cliente
                $factura->setNombreProducto($encontrado['nombreProducto']);
                $arr[] = $factura;
            }

            return $arr;
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
        $query = "INSERT INTO `factura` (`IdCita`, `codigoProducto`, `metodoPago`, `pagoTotal`) 
            VALUES (:IdCita, :codigoProducto, :metodoPago, :pagoTotal)";

        try {
            self::getConexion();

            $IdCita = $this->getIdCita();
            $codigoProducto = $this->getCodigoProducto();
            $metodoPago = $this->getMetodoPago();
            $pagoTotal = $this->getPagoTotal();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $resultado->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_INT);
            $resultado->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultado->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
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
