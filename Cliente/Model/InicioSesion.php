<?php
require_once '../config/Conexion.php';

class InicioSesion extends Conexion
{
    private $nombre;
    private $correo;
    private $contrasena;

    public function __construct( $nombre, $correo, $contrasena)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }



    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function verificarInicioSesion($correo, $contrasena)
    {
        $query = "SELECT * FROM usuarios WHERE correo = :correo AND contrasena = :contrasena";

        try {
            $resultado = $this->cnx->prepare($query);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $resultado->execute();

            if ($resultado->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            throw new Exception($error);
        }
    }

    public function iniciarSesion($correo, $contrasena)
    {
        if ($this->verificarInicioSesion($correo, $contrasena)) {
            header("Location: https://twitter.com/home");
            echo '<script>alert("Credenciales incorrectas. Por favor, verifica tus datos.");</script>';
            exit; 
        } else {
            header("Location: https://twitter.com/home");
            echo '<script>alert("Credenciales incorrectas. Por favor, verifica tus datos.");</script>';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        try {
            $iniciarController = new Iniciar(); 
            $iniciarController->iniciarSesion($correo, $contrasena);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
