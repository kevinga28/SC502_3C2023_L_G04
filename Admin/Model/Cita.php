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
    private $fechaCita;
    private $horaCita;

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


    public function setPagoTotal($pagoTotal)
    {
        $this->pagoTotal = $pagoTotal;
    }

    public function getPagoTotal()
    {
        return $this->pagoTotal;
    }

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
        $query = "SELECT
        c.*,
        cl.nombre AS nombreCliente,
        cl.apellido AS apellidoCliente,
        e.nombre AS nombreEmpleado,
        e.apellido AS apellidoEmpleado,
        GROUP_CONCAT(t.nombre SEPARATOR ', ') AS tratamientos
    FROM cita c
    INNER JOIN cliente cl ON c.IdCliente = cl.IdCliente
    INNER JOIN empleado e ON c.cedulaEmpleado = e.cedula
    INNER JOIN cita_tratamiento ct ON c.IdCita = ct.IdCita
    INNER JOIN tratamiento t ON ct.IdTratamiento = t.IdTratamiento
    GROUP BY c.IdCita";

        $citas = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll(PDO::FETCH_ASSOC) as $encontrado) {
                $cita = array(
                    'IdCita' => $encontrado['IdCita'],
                    'IdCliente' => $encontrado['IdCliente'],
                    'NombreCliente' => $encontrado['nombreCliente'],
                    'ApellidoCliente' => $encontrado['apellidoCliente'],
                    'CedulaEmpleado' => $encontrado['cedulaEmpleado'],
                    'Tratamientos' => $encontrado['tratamientos'],
                    'FechaCita' => $encontrado['fechaCita'],
                    'HoraCita' => $encontrado['horaCita'],
                );
                $citas[] = $cita;
            }

            return $citas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }
    public function obtenerDatosClientePorId($idCliente)
    {
        $query = "SELECT nombre, apellido, correo FROM cliente WHERE IdCliente = :idCliente";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            $encontrado = $resultado->fetch(PDO::FETCH_ASSOC);
            if ($encontrado) {
                return $encontrado; // Devuelve un arreglo con nombre, apellido y correo del cliente
            } else {
                return null; // No se encontró el cliente
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function crearCitaSinTratamientos()
    {
        try {
            self::getConexion();

            $IdCliente = $this->getIdCliente();
            $cedulaEmpleado = $this->getCedulaEmpleado();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();
            $pagoTotal = $this->getPagoTotal();

            $queryCita = "INSERT INTO `cita` (`IdCliente`, `cedulaEmpleado`, `fechaCita`, `horaCita`,  `pagoTotal`) 
                      VALUES (:IdCliente, :cedulaEmpleado, :fechaCita, :horaCita, :pagoTotal)";
            $resultadoCita = self::$cnx->prepare($queryCita);
            $resultadoCita->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
            $resultadoCita->bindParam(":cedulaEmpleado", $cedulaEmpleado, PDO::PARAM_INT);
            $resultadoCita->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultadoCita->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);
            $resultadoCita->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);
            $resultadoCita->execute();

            $idCita = self::$cnx->lastInsertId();

            self::desconectar();

            return $idCita;
        } catch (PDOException $Exception) {
            self::desconectar();
            throw $Exception;
        }
    }

    public function agregarTratamientoACita($idCita, $idTratamiento)
    {
        try {
            self::getConexion();

            // Verifica si existen registros en la tabla cita con el ID proporcionado
            $consultaCita = "SELECT COUNT(*) FROM `cita` WHERE `IdCita` = :IdCita";
            $resultadoCita = self::$cnx->prepare($consultaCita);
            $resultadoCita->bindParam(":IdCita", $idCita, PDO::PARAM_INT);
            $resultadoCita->execute();
            $existeCita = $resultadoCita->fetchColumn();

            // Verifica si existen registros en la tabla tratamiento con el ID proporcionado
            $consultaTratamiento = "SELECT COUNT(*) FROM `tratamiento` WHERE `IdTratamiento` = :IdTratamiento";
            $resultadoTratamiento = self::$cnx->prepare($consultaTratamiento);
            $resultadoTratamiento->bindParam(":IdTratamiento", $idTratamiento, PDO::PARAM_INT);
            $resultadoTratamiento->execute();
            $existeTratamiento = $resultadoTratamiento->fetchColumn();

            if ($existeCita && $existeTratamiento) {
                // Ambos IDs son válidos, procede a la inserción
                $queryTratamiento = "INSERT INTO `cita_tratamiento` (`IdCita`, `IdTratamiento`) 
                        VALUES (:IdCita, :IdTratamiento)";
                $resultadoTratamiento = self::$cnx->prepare($queryTratamiento);
                $resultadoTratamiento->bindParam(":IdCita", $idCita, PDO::PARAM_INT);
                $resultadoTratamiento->bindParam(":IdTratamiento", $idTratamiento, PDO::PARAM_INT);
                $resultadoTratamiento->execute();

                // Cierra la conexión a la base de datos
                self::desconectar();
            } else {
                echo "Error: El ID de cita o tratamiento no existe.";
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
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

    public function actualizarCita()
    {
        $query = "UPDATE cita 
        SET IdCliente = :IdCliente, cedulaEmpleado = :cedulaEmpleado, 
            fechaCita = :fechaCita, horaCita = :horaCita,  pagoTotal = :pagoTotal 
        WHERE IdCita = :IdCita";

        try {
            self::getConexion();

            $IdCliente = $this->getIdCliente();
            $cedulaEmpleado = $this->getCedulaEmpleado();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();
            $pagoTotal = $this->getPagoTotal();
            $IdCita = $this->getIdCita();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
            $resultado->bindParam(":cedulaEmpleado", $cedulaEmpleado, PDO::PARAM_INT);
            $resultado->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultado->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);
            $resultado->bindParam(":pagoTotal", $pagoTotal, PDO::PARAM_STR);
            $resultado->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);


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


    public function eliminarTratamientos($idCita)
    {
        try {
            self::getConexion();

            // Elimina los registros de cita_tratamiento asociados a esta cita
            $queryEliminar = "DELETE FROM cita_tratamiento WHERE IdCita = :IdCita";
            $stmtEliminar = self::$cnx->prepare($queryEliminar);
            $stmtEliminar->bindParam(":IdCita", $idCita, PDO::PARAM_INT); // Utiliza el parámetro $idCita en lugar de $this->getIdCita()
            $stmtEliminar->execute();

            // Cierra la conexión a la base de datos
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }

    public static function obtenerCitaPorIdCita($IdCita)
    {
        $query = "SELECT c.*,
        cl.nombre AS nombreCliente,
        cl.apellido AS apellidoCliente,
        cl.correo AS correoCliente,
        e.nombre AS nombreEmpleado,
        e.apellido AS apellidoEmpleado,
        GROUP_CONCAT(CONCAT(t.nombre, ' (₡', t.precio, ')') SEPARATOR ', ') AS tratamientos,
        c.pagoTotal
    FROM cita c
    INNER JOIN cliente cl ON c.IdCliente = cl.IdCliente
    INNER JOIN empleado e ON c.cedulaEmpleado = e.cedula
    INNER JOIN cita_tratamiento ct ON c.IdCita = ct.IdCita
    INNER JOIN tratamiento t ON ct.IdTratamiento = t.IdTratamiento
    WHERE c.IdCita = :IdCita
    GROUP BY c.IdCita";

        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);

            $stmt->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $stmt->execute();

            // Utiliza fetch para obtener una fila de resultados
            $cita = $stmt->fetch(PDO::FETCH_ASSOC);

            self::desconectar();

            return $cita;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function eliminarCita($IdCita)
    {
        try {
            self::getConexion();

            // Iniciar una transacción
            self::$cnx->beginTransaction();

            // 1. Eliminar registros relacionados (por ejemplo, registros de facturación)
            $queryDeleteRelacionados = "DELETE FROM cita_tratamiento WHERE IdCita = :IdCita";
            $stmtDeleteRelacionados = self::$cnx->prepare($queryDeleteRelacionados);
            $stmtDeleteRelacionados->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $stmtDeleteRelacionados->execute();

            // 2. Eliminar la cita principal
            $queryEliminarCita = "DELETE FROM cita WHERE IdCita = :IdCita";
            $stmtEliminarCita = self::$cnx->prepare($queryEliminarCita);
            $stmtEliminarCita->bindParam(":IdCita", $IdCita, PDO::PARAM_INT);
            $stmtEliminarCita->execute();

            // Confirmar la transacción si no hubo errores
            self::$cnx->commit();

            self::desconectar();

            // Verificar el número de filas afectadas
            $numFilasEliminadas = $stmtDeleteRelacionados->rowCount() + $stmtEliminarCita->rowCount();

            return $numFilasEliminadas; // Devuelve el número de filas eliminadas
        } catch (PDOException $e) {
            // En caso de error, deshacer la transacción
            self::$cnx->rollBack();
            self::desconectar();
            return 0; // Error
        }
    }

    public function obtenerCitas()
    {
        $query = "SELECT c.*,
            cl.nombre AS nombreCliente,
            cl.apellido AS apellidoCliente,
            cl.correo AS correoCliente,
            e.nombre AS nombreEmpleado,
            e.apellido AS apellidoEmpleado,
            GROUP_CONCAT(CONCAT(t.nombre, ' (₡', t.precio, ')') SEPARATOR ', ') AS tratamientos
        FROM cita c
        INNER JOIN cliente cl ON c.IdCliente = cl.IdCliente
        INNER JOIN empleado e ON c.cedulaEmpleado = e.cedula
        INNER JOIN cita_tratamiento ct ON c.IdCita = ct.IdCita
        INNER JOIN tratamiento t ON ct.IdTratamiento = t.IdTratamiento
        GROUP BY c.IdCita";

        try {
            self::getConexion();
            $resultado = self::$cnx->query($query);

            $citas = $resultado->fetchAll(PDO::FETCH_ASSOC);

            self::desconectar();

            return $citas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function obtenerHorariosDisponibles($cedulaEmpleado, $diaSemana)
    {
        $query = "SELECT horaInicio, horaFin FROM horarios WHERE empleadoCedula = :cedulaEmpleado AND diaSemana = :dia";
        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(':cedulaEmpleado', $cedulaEmpleado, PDO::PARAM_INT);
            $stmt->bindParam(':dia', $diaSemana, PDO::PARAM_INT);
            $stmt->execute();

            $horariosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            self::desconectar();

            return $horariosDisponibles;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function obtenerCitasCalendarioAdmin($rol)
    {
        // Verificar si el usuario logueado es un admin
        if ($rol === 'Admin') {
            // Si es admin, traer todas las citas
            $query = "SELECT 
            CONCAT(cl.nombre, ' ', cl.apellido) AS title,
            cl.correo AS correoCliente,
            CONCAT(e.nombre, ' ', e.apellido) as nombreEmpleado,
            CONCAT(c.fechaCita, ' ', c.horaCita) AS start,
            CONCAT(c.fechaCita, ' ', c.horaFin) AS end,
            GROUP_CONCAT(CONCAT(t.nombre, ' (₡', t.precio, ')') SEPARATOR ', ') AS tratamientos
        FROM 
            cita c
            INNER JOIN cliente cl ON c.IdCliente = cl.IdCliente
            INNER JOIN empleado e ON c.cedulaEmpleado = e.cedula
            LEFT JOIN cita_tratamiento ct ON c.IdCita = ct.IdCita
            LEFT JOIN tratamiento t ON ct.IdTratamiento = t.IdTratamiento
        GROUP BY 
            c.IdCita";
        }

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);

            // Si no es admin, bindear el parámetro :idEmpleado


            $stmt->execute();

            $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            self::desconectar();

            return $citas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }



    public function obtenerCitasCalendarioEstilista($cedula,$rol)
    {
        // Verificar si el usuario logueado es un admin
        if ($rol === 'Estilista') {
            // Si es admin, traer todas las citas
            $query = "SELECT 
            CONCAT(cl.nombre, ' ', cl.apellido) AS title,
            cl.correo AS correoCliente,
            CONCAT(e.nombre, ' ', e.apellido) as nombreEmpleado,
            CONCAT(c.fechaCita, ' ', c.horaCita) AS start
            GROUP_CONCAT(CONCAT(t.nombre, ' (₡', t.precio, ')') SEPARATOR ', ') AS tratamientos
        FROM 
            cita c
            INNER JOIN cliente cl ON c.IdCliente = cl.IdCliente
            INNER JOIN empleado e ON c.cedulaEmpleado = e.cedula
            LEFT JOIN cita_tratamiento ct ON c.IdCita = ct.IdCita
            LEFT JOIN tratamiento t ON ct.IdTratamiento = t.IdTratamiento
        WHERE 
            e.cedula = :cedula
        GROUP BY 
            c.IdCita";
        }

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);

            // Si no es admin, bindear el parámetro :idEmpleado


            $stmt->execute();

            $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            self::desconectar();

            return $citas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }



}
