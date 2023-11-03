<?php
require_once '../config/Conexion.php';

class Cliente extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $cedula;
    private $nombre;
    private $apellido;
    private $genero;
    private $correo;
    private $contrasena;
    private $telefono;
    private $tipoCliente;
    private $provincia;
    private $distrito;
    private $canton;
    private $otros;

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


    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function getCedula()
    {
        return $this->cedula;
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

    public function setTipoCliente($tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;
    }

    public function getTipoCliente()
    {
        return $this->tipoCliente;
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
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }


    public function listarClientes()
    {
        $query = "SELECT * FROM cliente";
        $arr = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $cliente = new Cliente();
                $cliente->setCedula($encontrado['cedula']);
                $cliente->setNombre($encontrado['nombre']);
                $cliente->setApellido($encontrado['apellido']);
                $cliente->setGenero($encontrado['genero']);
                $cliente->setCorreo($encontrado['correo']);
                $cliente->setContrasena($encontrado['contrasena']);
                $cliente->setTelefono($encontrado['telefono']);
                $cliente->setTipoCliente($encontrado['tipoCliente']);
                $cliente->setProvincia($encontrado['provincia']);
                $cliente->setDistrito($encontrado['distrito']);
                $cliente->setCanton($encontrado['canton']);
                $cliente->setOtros($encontrado['otros']);
                $arr[] = $cliente;
            }

            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function verificarExistenciaCliente()
    {
        $query = "SELECT cedula, correo FROM cliente WHERE cedula=:cedula OR correo=:correo";

        try {
            self::getConexion();
            $cedula = $this->getCedula();
            $correo = $this->getCorreo();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
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
        $query = "INSERT INTO `cliente` (`cedula`, `nombre`, `apellido`, `genero`, `correo`, `contrasena`, `telefono`, `tipoCliente`, `provincia`, `distrito`, `canton`, `otros`)
            VALUES (:cedula, :nombre, :apellido, :genero, :correo, :contrasena, :telefono, :tipoCliente, :provincia, :distrito, :canton, :otros)";

        try {
            self::getConexion();
            $cedula = $this->getCedula();
            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $genero = $this->getGenero();
            $correo = $this->getCorreo();
            $contrasena = $this->getContrasena();
            $telefono = $this->getTelefono();
            $tipoCliente = $this->getTipoCliente();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":genero", $genero, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":tipoCliente", $tipoCliente, PDO::PARAM_BOOL);
            $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
            $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
            $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
            $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);

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
        $query = "SELECT * FROM cliente WHERE correo=:correo";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetch();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }


    public function llenarCampos($cedula)
    {
        $query = "SELECT * FROM cliente WHERE cedula = :cedula";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $this->setCedula($encontrado['cedula']);
                $this->setNombre($encontrado['nombre']);
                $this->setApellido($encontrado['apellido']);
                $this->setGenero($encontrado['genero']);
                $this->setCorreo($encontrado['correo']);
                $this->setContrasena($encontrado['contrasena']);
                $this->setTelefono($encontrado['telefono']);
                $this->setTipoCliente($encontrado['tipoCliente']);
                $this->setProvincia($encontrado['provincia']);
                $this->setDistrito($encontrado['distrito']);
                $this->setCanton($encontrado['canton']);
                $this->setOtros($encontrado['otros']);
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }



    public function actualizarCliente()
{
    $query = "UPDATE cliente 
        SET cedula = :nueva_cedula, nombre = :nombre, apellido = :apellido, correo = :correo, telefono = :telefono, 
            tipoCliente = :tipoCliente, genero = :genero, provincia = :provincia, 
            distrito = :distrito, canton = :canton, otros = :otros 
        WHERE cedula = :cedula";

    try {
        self::getConexion();

        $nueva_cedula = $this->getCedula(); // Nueva cédula
        $nombre = $this->getNombre();
        $apellido = $this->getApellido();
        $correo = $this->getCorreo();
        $telefono = $this->getTelefono();
        $tipoCliente = $this->getTipoCliente();
        $genero = $this->getGenero();
        $provincia = $this->getProvincia();
        $distrito = $this->getDistrito();
        $canton = $this->getCanton();
        $otros = $this->getOtros();

        $resultado = self::$cnx->prepare($query);

        $resultado->bindParam(":nueva_cedula", $nueva_cedula, PDO::PARAM_INT); // Nueva cédula
        $resultado->bindParam(":cedula", $nueva_cedula, PDO::PARAM_INT); // Sobrescribe la cédula existente
        $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
        $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
        $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $resultado->bindParam(":tipoCliente", $tipoCliente, PDO::PARAM_BOOL);
        $resultado->bindParam(":genero", $genero, PDO::PARAM_STR);
        $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
        $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
        $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
        $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);

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

    public static function obtenerClientePorCedula($cedula)
    {
        $query = "SELECT * FROM cliente WHERE cedula = :cedula";
        try {
            // Conecta a la base de datos
            self::getConexion();

            // Prepara la consulta
            $stmt = self::$cnx->prepare($query);

            // Asigna el valor de la cédula y ejecuta la consulta
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_INT);
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
    /*=====  End of Metodos de la Clase  ======*/
}
