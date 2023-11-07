<?php
require_once '../config/Conexion.php';

class Cita extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $IdCita;
    private $IdCliente;
    private $cedulaEmpleado;
    private $tratamiento;
    private $fechaCita;
    private $horaCita;

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

    public function setIdCita($IdCita)
    {
        $this->IdCita = $IdCita;
    }

    public function getIdCita()
    {
        return $this->IdCita;
    }

    public function setIdCliente($IdCliente)
    {
        $this->IdCliente = $IdCliente;
    }

    public function getIdCliente()
    {
        return $this->IdCliente;
    }

    public function setCedulaEmpleado($cedulaEmpleado)
    {
        $this->cedulaEmpleado = $cedulaEmpleado;
    }

    public function getCedulaEmpleado()
    {
        return $this->cedulaEmpleado;
    }

    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;
    }

    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    public function setFechaCita($fechaCita)
    {
        $this->fechaCita = $fechaCita;
    }

    public function getFechaCita()
    {
        return $this->fechaCita;
    }

    public function setHoraCita($horaCita)
    {
        $this->horaCita = $horaCita;
    }

    public function getHoraCita()
    {
        return $this->horaCita;
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


    public function listarCitas()
    {
        $query = "SELECT * FROM cita";
        $arr = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $cita = new Cita();
                $cita->setIdCita($encontrado['IdCita']);
                $cita->setIdCliente($encontrado['IdCliente']);
                $cita->setCedulaEmpleado($encontrado['cedulaEmpleado']);
                $cita->setTratamiento($encontrado['tratamiento']);
                $cita->setFechaCita($encontrado['fechaCita']);
                $cita->setHoraCita($encontrado['horaCita']);
                $arr[] = $cita;
            }

            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }




    public function crearCita()
    {
        $query = "INSERT INTO `cita` (`IdCliente`, `cedulaEmpleado`, `tratamiento`, `fechaCita`, `horaCita`) 
              VALUES (:IdCliente, :cedulaEmpleado, :tratamiento, :fechaCita, :horaCita)";

        try {
            self::getConexion();

            $IdCliente = $this->getIdCliente();
            $cedulaEmpleado = $this->getCedulaEmpleado();
            $tratamiento = $this->getTratamiento();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();

            // Prepara la sentencia SQL
            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
            $resultado->bindParam(":cedulaEmpleado", $cedulaEmpleado, PDO::PARAM_INT);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR); // Corrección aquí
            $resultado->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultado->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);

            // Ejecuta la sentencia SQL para insertar la cita
            $resultado->execute();

            // Cierra la conexión a la base de datos
            self::desconectar();
        } catch (PDOException $Exception) {
            // En caso de un error, cierra la conexión y devuelve un mensaje de error
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function verificarExistenciaCita()
    {
        $query = "SELECT IdCita FROM cita WHERE IdCita = :IdCita";

        try {
            self::getConexion();
            $IdCita = $this->getIdCita();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
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
        $query = "INSERT INTO `cita` (`IdCliente`, `cedulaEmpleado`, `tratamiento`, `fechaCita`, `horaCita`)
            VALUES (:IdCliente, :cedulaEmpleado, :tratamiento, :fechaCita, :horaCita)";

        try {
            self::getConexion();

            $IdCliente = $this->getIdCliente();
            $cedulaEmpleado = $this->getCedulaEmpleado();
            $tratamiento = $this->getTratamiento();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
            $resultado->bindParam(":cedulaEmpleado", $cedulaEmpleado, PDO::PARAM_STR);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR);
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

    public function actualizarCita()
    {
        $query = "UPDATE cita 
            SET IdCliente = :IdCliente, cedulaEmpleado = :cedulaEmpleado, tratamiento = :tratamiento,
                fechaCita = :fechaCita, horaCita = :horaCita
            WHERE IdCita = :IdCita";

        try {
            self::getConexion();

            $IdCliente = $this->getIdCliente();
            $cedulaEmpleado = $this->getCedulaEmpleado();
            $tratamiento = $this->getTratamiento();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
            $resultado->bindParam(":cedulaEmpleado", $cedulaEmpleado, PDO::PARAM_STR);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR);
            $resultado->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultado->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);
            $resultado->bindParam(":IdCita", $this->getIdCita(), PDO::PARAM_INT);

            self::$cnx->beginTransaction(); // Desactiva el autocommit
            $resultado->execute();
            self::$cnx->commit(); // Realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public static function obtenerCitaPorIdCita($IdCita)
    {
        $query = "SELECT * FROM cita WHERE IdCita = :IdCita";
        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);

            $stmt->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $stmt->execute();

            $cita = $stmt->fetch(PDO::FETCH_ASSOC);

            self::desconectar();

            return $cita;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function eliminarCita($IdCita)
    {
        $query = "DELETE FROM cita WHERE IdCita = :IdCita";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
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
