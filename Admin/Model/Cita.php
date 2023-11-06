<?php
require_once 'Conexion.php';

class Cita extends Conexion
{
    private $IdCita;
    private $cedulaCliente;
    private $cedulaEmpleado;
    private $tratamiento;
    private $fechaCita;
    private $horaCita;

    public function getIdCita()
    {
        return $this->IdCita; 
    }

    public function setCedulaCliente($cedulaCliente)
    {
        $this->cedulaCliente = $cedulaCliente;
    }

    public function getCedulaCliente()
    {
        return $this->cedulaCliente;
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

    public function crearCita()
    {
        $query = "INSERT INTO `cita` (`cedulaCliente`, `cedulaEmpleado`, `tratamiento`, `fechaCita`, `horaCita`) VALUES (:cedulaCliente, :cedulaEmpleado, :tratamiento, :fechaCita, :horaCita)";

        try {
            self::getConexion();

            $cedulaCliente = $this->getCedulaCliente();
            $cedulaEmpleado = $this->getCedulaEmpleado();
            $tratamiento = $this->getTratamiento();
            $fechaCita = $this->getFechaCita();
            $horaCita = $this->getHoraCita();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":cedulaCliente", $cedulaCliente, PDO::PARAM_INT);
            $resultado->bindParam(":cedulaEmpleado", $cedulaEmpleado, PDO::PARAM_INT);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR);
            $resultado->bindParam(":fechaCita", $fechaCita, PDO::PARAM_STR);
            $resultado->bindParam(":horaCita", $horaCita, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();

            return "Cita creada con éxito";
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}

<script>
$(document).ready(function() {
    $(".eliminar-button").click(function() {
        var fila = $(this).closest("tr"); // Obtén la fila más cercana al botón

        // Obtén el ID del registro a eliminar desde el atributo de datos
        var id = $(this).data("id");

        // Realiza una solicitud AJAX al servidor para eliminar el registro
        $.ajax({
            type: "POST",
            url: "eliminar.php",
            data: { id: id },
            success: function(response) {
                // Verifica si la eliminación fue exitosa (puedes ajustar el formato de respuesta en "eliminar.php")
                if (response === "exito") {
                    // Elimina la fila de la tabla
                    fila.remove();
                } else {
                    alert("Error al eliminar el registro.");
                }
            },
            error: function() {
                alert("Error en la solicitud AJAX.");
            }
        });
    });
});
</script>


?>