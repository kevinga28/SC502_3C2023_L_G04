<?php
require_once(__DIR__ . '/../config/conexion.php');


class Cliente extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
    protected static $cnx;
    private $IdCliente;
    private $nombre;
    private $apellido;
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

    public function setIdCliente($IdCliente)
    {
        $this->IdCliente = $IdCliente;
    }

    public function getIdCliente()
    {
        return $this->IdCliente;
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
                $cliente->setIdCliente($encontrado['IdCliente']);
                $cliente->setNombre($encontrado['nombre']);
                $cliente->setApellido($encontrado['apellido']);
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
        $query = "SELECT 1 FROM cliente WHERE telefono=:telefono OR correo=:correo LIMIT 1";

        try {
            self::getConexion();
            $telefono = $this->getTelefono();
            $correo = $this->getCorreo();

            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->execute();

            $existeCliente = $stmt->fetch(PDO::FETCH_ASSOC);

            self::desconectar();

            return ($existeCliente !== false); // Devuelve true si se encontró al menos un cliente
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function guardarEnDb()
    {
        $query = "INSERT INTO cliente ( `nombre`, `apellido`,  `correo`, `contrasena`, `telefono`, `tipoCliente`, `provincia`, `distrito`, `canton`, `otros`)
            VALUES ( :nombre, :apellido, :correo, :contrasena, :telefono, :tipoCliente, :provincia, :distrito, :canton, :otros)";

        try {
            self::getConexion();

            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $correo = $this->getCorreo();
            $contrasena = $this->getContrasena();
            $telefono = $this->getTelefono();
            $tipoCliente = $this->getTipoCliente();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":tipoCliente", $tipoCliente, PDO::PARAM_BOOL);
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
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }


    public function actualizarCliente()
    {
        $query = "UPDATE cliente 
                    SET nombre = :nombre, apellido = :apellido, telefono = :telefono, 
                        tipoCliente = :tipoCliente, provincia = :provincia, 
                        distrito = :distrito, canton = :canton, otros = :otros 
                    WHERE IdCliente = :IdCliente";

        try {
            self::getConexion();

            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $telefono = $this->getTelefono();
            $tipoCliente = $this->getTipoCliente();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();
            $IdCliente = $this->getIdCliente();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":tipoCliente", $tipoCliente, PDO::PARAM_BOOL);
            $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
            $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
            $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
            $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);
            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);

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

    public function actualizarClienteVC()
    {
        $query = "UPDATE cliente 
                    SET nombre = :nombre, apellido = :apellido, telefono = :telefono, 
                        contrasena = :contrasena, provincia = :provincia, 
                        distrito = :distrito, canton = :canton, otros = :otros 
                    WHERE IdCliente = :IdCliente";

        try {
            self::getConexion();

            $nombre = $this->getNombre();
            $apellido = $this->getApellido();
            $telefono = $this->getTelefono();
            $contrasena = $this->getContrasena();
            $provincia = $this->getProvincia();
            $distrito = $this->getDistrito();
            $canton = $this->getCanton();
            $otros = $this->getOtros();
            $IdCliente = $this->getIdCliente();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->bindParam(":provincia", $provincia, PDO::PARAM_STR);
            $resultado->bindParam(":distrito", $distrito, PDO::PARAM_STR);
            $resultado->bindParam(":canton", $canton, PDO::PARAM_STR);
            $resultado->bindParam(":otros", $otros, PDO::PARAM_STR);
            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);

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

    public static function obtenerClientePorIdCliente($IdCliente)
    {
        $query = "SELECT * FROM cliente WHERE IdCliente = :IdCliente";
        try {
            // Conecta a la base de datos
            self::getConexion();

            // Prepara la consulta
            $stmt = self::$cnx->prepare($query);

            // Asigna el valor de la cédula y ejecuta la consulta
            $stmt->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
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

    public function eliminarcliente()
    {
        $query = "DELETE FROM cliente WHERE IdCliente = :IdCliente";

        try {
            self::getConexion();
            $IdCliente = $this->getIdCliente();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            return $resultado->rowCount(); // Devuelve el número de filas afectadas (debe ser 1 si se eliminó correctamente).
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function obtenerCliente()
    {
        $query = "SELECT IdCliente, nombre, apellido, correo FROM cliente";

        $clientes = array();

        try {
            self::getConexion();
            $resultado = self::$cnx->query($query);

            while ($cliente = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $clientes[] = $cliente;
            }

            self::desconectar();

            return $clientes;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function actualizarContrasenaCliente()
    {
        $query = "UPDATE cliente 
                    SET contrasena = :contrasena 
                    WHERE IdCliente = :IdCliente";

        try {
            self::getConexion();

            $contrasena = $this->getContrasena();
            $IdCliente = $this->getIdCliente();


            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->bindParam(":IdCliente", $IdCliente, PDO::PARAM_STR);


            self::$cnx->beginTransaction(); // Desactiva el autocommit

            $resultado->execute();
            self::$cnx->commit(); // Realiza el commit y vuelve al modo autocommit



            if ($resultado->rowCount() > 0) {
                return true;
            } else {
                return false;
            }



            self::desconectar();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}
