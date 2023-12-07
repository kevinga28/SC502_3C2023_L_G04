<?php
require_once '../config/Conexion.php';

class Empleado extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $conn;
    private $cedula;
    private $imagen;
    private $nombre;
    private $apellido;
    private $genero;
    private $correo;
    private $contrasena;
    private $telefono;
    private $rol;
    private $provincia;
    private $distrito;
    private $canton;
    private $otros;


    public function __construct()
    {
        // Constructor vacío
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    }

    public function getDistrito()
    {
        return $this->distrito;
    }

    public function setCanton($canton)
    {
        $this->canton = $canton;
    }

    public function getCanton()
    {
        return $this->canton;
    }

    public function setOtros($otros)
    {
        $this->otros = $otros;
    }

    public function getOtros()
    {
        return $this->otros;
    }


    /*=====  End of Encapsuladores de la Clase  ======*/

    /*=============================================
	=            Metodos de la Clase              =
	=============================================*/
    public static function getConexion()
    {
        self::$conn = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$conn = null;
    }


    public function listarEmpleados()
    {
        $query = "SELECT * FROM empleado";
        $arr = array();

        try {
            self::getConexion();
            $resultado = self::$conn->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $item) {
                $empleado = new Empleado();
                $empleado->setCedula($item['cedula']);
                $empleado->setImagen($item['imagen']);
                $empleado->setNombre($item['nombre']);
                $empleado->setApellido($item['apellido']);
                $empleado->setGenero($item['genero']);
                $empleado->setCorreo($item['correo']);
                $empleado->setContrasena($item['contrasena']);
                $empleado->setTelefono($item['telefono']);
                $empleado->setRol($item['rol']);
                $empleado->setProvincia($item['provincia']);
                $empleado->setDistrito($item['distrito']);
                $empleado->setCanton($item['canton']);
                $empleado->setOtros($item['otros']);
                $arr[] = $empleado;
            }

            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function verificarExistenciaEmpleado()
    {
        $query = "SELECT * FROM empleado WHERE cedula=:cedula OR correo=:correo";

        try {
            self::getConexion();
            $resultado = self::$conn->prepare($query);
            $cedula = $this->getCedula();
            $correo = $this->getCorreo();
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();

            $encontrado = false;
            foreach ($resultado->fetchAll() as $item) {
                $encontrado = true;
            }
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }


    public function insertar()
    {
        $query = "INSERT INTO `empleado` (`cedula`, `imagen`, `nombre`, `apellido`,`genero`, `correo`, `contrasena`, `telefono`, `rol`, `provincia`, `distrito`, `canton`, `otros`)
                VALUES (:cedula, :imagen, :nombre, :apellido, :genero, :correo, :contrasena, :telefono, :rol, :provincia, :distrito, :canton, :otros)";

        try {
            self::getConexion();
            $cedula = $this->getCedula();
            $imagen = $this->getImagen();
            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $genero = $this->getGenero();
            $correo = $this->getCorreo();
            $contrasena = $this->getContrasena();
            $telefono = $this->getTelefono();
            $rol = $this->getRol();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();

            $resultado = self::$conn->prepare($query);

            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":imagen", $imagen, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":genero", $genero, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":rol", $rol, PDO::PARAM_STR);
            $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
            $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
            $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
            $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);

            $resultado->execute();

            if ($resultado->rowCount() > 0) {

                return true;
            } else {

                return false;
            }

            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }
    }


    public function actualizarEmpleado()
    {
        $query = "UPDATE empleado 
                  SET nombre = :nombre, apellido = :apellido, telefono = :telefono, 
                      rol = :rol, provincia = :provincia,
                      distrito = :distrito, canton = :canton, otros = :otros
                  WHERE cedula = :cedula";

        try {
            self::getConexion();
            $cedula = $this->getCedula();
            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $telefono = $this->getTelefono();
            $rol = $this->getRol();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();

            $resultado = self::$conn->prepare($query);

            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":rol", $rol, PDO::PARAM_STR);
            $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
            $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
            $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
            $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);

            self::$conn->beginTransaction(); // Desactiva el autocommit

            $resultado->execute();
            self::$conn->commit(); // Realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$conn->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
    public static function obtenerEmpleadoPorCedula($cedula)
    {
        $query = "SELECT * FROM empleado WHERE cedula = :cedula";
        try {
            // Conecta a la base de datos
            self::getConexion();

            // Prepara la consulta
            $stmt = self::$conn->prepare($query);

            // Asigna el valor de la cédula y ejecuta la consulta
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $stmt->execute();

            // Obtiene los resultados y los devuelve como un arreglo asociativo
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cierra la conexión a la base de datos
            self::desconectar();

            return $empleado;
        } catch (PDOException $e) {
            // Manejo de errores, por ejemplo, loguear el error
            return null;
        }
    }

    public function eliminarEmpleado($cedula)
    {
        try {
            self::getConexion();

            self::$conn->beginTransaction();

            $queryDeleteRelacionados = "DELETE FROM horarios WHERE EmpleadoCedula = :cedula";
            $stmtDeleteRelacionados = self::$conn->prepare($queryDeleteRelacionados);
            $stmtDeleteRelacionados->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $stmtDeleteRelacionados->execute();

            $queryEliminarEmpleado = "DELETE FROM empleado WHERE cedula = :cedula";
            $stmtEliminarEmpleado = self::$conn->prepare($queryEliminarEmpleado);
            $stmtEliminarEmpleado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $stmtEliminarEmpleado->execute();

            self::$conn->commit();

            self::desconectar();

            $numFilasEliminadas = $stmtDeleteRelacionados->rowCount() + $stmtEliminarEmpleado->rowCount();

            return $numFilasEliminadas;
        } catch (PDOException $e) {

            self::$conn->rollBack();
            self::desconectar();
            return 0;
        }
    }

    public function obtenerEstilistas()
    {
        $query = "SELECT cedula, nombre, apellido FROM empleado WHERE rol = 'Estilista'";

        $estilistas = array();

        try {
            self::getConexion();
            $resultado = self::$conn->query($query);

            while ($estilista = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $estilistas[] = $estilista;
            }

            self::desconectar();

            return $estilistas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
    public function login()
    {
        $dbEmpleadoData = $this->obtenerEmpleadoPorCedula($this->getCedula());

        // Verifica si se encontró un empleado y la contraseña es válida
        if ($dbEmpleadoData && $this->getContrasena() == $dbEmpleadoData['contrasena']) {
            $_SESSION['cedula'] = $dbEmpleadoData['cedula'];
            $_SESSION['rol'] = $dbEmpleadoData['rol']; // Almacena el rol en la sesión
            return true;
        } else {
            return false;
        }
    }
}
