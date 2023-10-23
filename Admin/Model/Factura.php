<?php
require_once '../config/Conexion.php';

class Factura extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $correo = null;
    private $telefono = null;
    private $tipoCliente = null;
    private $tratamiento = null;
    private $metodoPago = null;
    private $estilista = null;
    private $totalPago = null;
    private $fechaCita = null;
    private $horaCita = null;

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


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }
    public function setTipoCliente($tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;
    }
    public function getTratamiento()
    {
        return $this->tratamiento;
    }
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;
    }
    public function getMetodoPago()
    {
        return $this->metodoPago;
    }
    public function setMetodoPago($metodoPago)
    {
        $this->metodoPago = $metodoPago;
    }

    public function getEstilista()
    {
        return $this->estilista;
    }
    public function setEstilista($estilista)
    {
        $this->estilista = $estilista;
    }

    public function getTotalPago()
    {
        return $this->totalPago;
    }
    public function setTotalPago($totalPago)
    {
        $this->totalPago = $totalPago;
    }

    public function getFechaCita()
    {
        return $this->fechaCita;
    }
    public function setFechaCita($fechaCita)
    {
        $this->fechaCita = $fechaCita;
    }
    public function getHoraCita()
    {
        return $this->horaCita;
    }
    public function setHoraCita($horaCita)
    {
        $this->horaCita = $horaCita;
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
        $query = "SELECT * FROM facturas";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $factura = new Factura();
                $factura->setId($encontrado['id']);
                $factura->setNombre($encontrado['nombre']);
                $factura->setApellido($encontrado['apellido']);
                $factura->setCorreo($encontrado['correo']);
                $factura->setTelefono($encontrado['telefono']);
                $factura->setTipoCliente($encontrado['tipoCiente']);
                $factura->setTratamiento($encontrado['tratamiento']);
                $factura->setMetodoPago($encontrado['metodoPago']);
                $factura->setEstilista($encontrado['estilista']);
                $factura->setTotalPago($encontrado['totalPago']);
                $factura->setFechaCita($encontrado['fechaCita']);
                $factura->setHoraCita($encontrado['horaCita']);
                $arr[] = $factura;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function verificarExistenciaDb()
    {
        $query = "SELECT * FROM facturas where correo=:correo";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $email = $this->getCorreo();
            $resultado->bindParam(":correo", $email, PDO::PARAM_STR);
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

    public function guardarEnDb()
    {
        $query = "INSERT INTO `facturas`(`nombre`, `apellido`, `correo`, `telefono`, `tipoCliente`, `tratamiento`, `metodoPago`,  `estilista`, `totalPago`, `fechaCita`, `horaCita`,`created_at`) 
            VALUES (:nombre,:apellido,:correo,:telefono,:tipoCliente,:tratamiento,:metodoPago,:estilista,:totalPago,:fechaCita,:horaCita,now())";
        try {
            self::getConexion();
            $nombre = strtoupper($this->getNombre());
            $apellido = strtoupper($this->getApellido());
            $correo = $this->getCorreo();
            $telefono = $this->getTelefono();
            $tipoCliente = $this->getTipoCliente();
            $tratamiento = $this->getTratamiento();
            $metodoPago = $this->getMetodoPago();
            $estiista = $this->getEstilista();
            $totalPago = $this->getTotalPago();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":tipoCliente", $tipoCliente, PDO::PARAM_STR);
            $resultado->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultado->bindParam(":estiista", $estiista, PDO::PARAM_STR);
            $resultado->bindParam(":totalPago", $totalPago, PDO::PARAM_STR);
            $resultado->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultado->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }



    public static function mostrar($correo)
    {
        $query = "SELECT * FROM facturas where correo=:id";
        $id = $correo;
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id", $id, PDO::PARAM_STR);
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
        $query = "SELECT * FROM facturas where id=:id";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id", $id, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $this->setId($encontrado['id']);
                $this->setNombre($encontrado['nombre']);
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function actualizarFactura()
    {
        $query = "UPDATE facturas 
            SET nombre=:nombre, apellido=:apellido, correo=:correo, telefono=:telefono, 
                tipoCliente=:tipoCliente, tratamiento=:tratamiento, metodoPago=:metodoPago, 
                estilista=:estilista, totalPago=:totalPago, fechaCita=:fechaCita, horaCita=:horaCita 
            WHERE id=:id";
        try {
            self::getConexion();
            $id = $this->getId();

            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $correo = $this->getCorreo();
            $telefono = $this->getTelefono();
            $tipoCliente = $this->getTipoCliente();
            $tratamiento = $this->getTratamiento();
            $metodoPago = $this->getMetodoPago();
            $estilista = $this->getEstilista();
            $totalPago = $this->getTotalPago();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":tipoCliente", $tipoCliente, PDO::PARAM_STR);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR);
            $resultado->bindParam(":metodoPago", $metodoPago, PDO::PARAM_STR);
            $resultado->bindParam(":estilista", $estilista, PDO::PARAM_STR);
            $resultado->bindParam(":totalPago", $totalPago, PDO::PARAM_STR);
            $resultado->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultado->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);
            $resultado->bindParam(":id", $id, PDO::PARAM_INT);

            self::$cnx->beginTransaction(); //desactiva el autocommit
            $resultado->execute();
            self::$cnx->commit(); //realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function verificarExistenciaEmail()
    {
        $query = "SELECT id, nombre, telefono FROM facturas WHERE nombre=:nombre AND apellido=:apellido";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $nombre= $this->getNombre();
            $apellido= $this->getApellido();
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            $encontrado = false;
            $arr = array();
            foreach ($resultado->fetchAll() as $reg) {
                $arr[] = $reg['id'];
                $arr[] = $reg['correo'];
                $arr[] = $reg['nombre'];
                $arr[] = $reg['telefono'];
            }
            return $arr;
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
    /*=====  End of Metodos de la Clase  ======*/
}
