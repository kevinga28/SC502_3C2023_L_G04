<?php
require_once '../Model/Cliente.php';
switch ($_GET["op"]) {

    case 'listaTabla':
        $cliente = new Cliente();
        $clientes = $cliente->listarClientes();
        // Prepara los datos para DataTables
        $data = array();
        foreach ($clientes as $reg) {
            $data[] = array(
                "0" => $reg->getIdCliente(),
                "1" =>  $reg->getCorreo(),
                "2" =>  $reg->getNombre(),
                "3" =>  $reg->getApellido(),
                "4" => $reg->getTelefono(),
                "5" =>  $reg->getProvincia(),

                // Agrega otros campos según tus necesidades
            );
        }
        $resultados = array(
            "sEcho" => 1, ##informacion para datatables
            "iTotalRecords" => count($data), ## total de registros al datatable
            "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;

    case 'insertar':
        // Asegúrate de recibir y validar todos los datos necesarios
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        if (strlen($contrasena) < 8) {
            echo 'La contraseña debe tener al menos 8 caracteres.';
            exit;
        }
        $contrasena = hash('SHA256', $contrasena);

        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        if (strlen($telefono) != 8) {
            echo 'El teléfono debe tener exactamente 8 dígitos.';
            exit;
        }
        $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";


        $cliente = new Cliente();

        // Configura los atributos del objeto Cliente
        $cliente->setCorreo($correo);
        $cliente->setTelefono($telefono);
        $encontrado = $cliente->verificarExistenciaCliente();
        if ($encontrado == false) {
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setContrasena($contrasena);
            $cliente->setTelefono($telefono);
            $cliente->setTipoCliente($tipoCliente);
            $cliente->setProvincia($provincia);
            $cliente->setDistrito($distrito);
            $cliente->setCanton($canton);
            $cliente->setOtros($otros);
            $cliente->guardarEnDb();

            
            if ($cliente->verificarExistenciaCliente()) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
        break;

    case 'verificar_existencia_cliente':
        $IdCliente = isset($_POST["IdCliente"]) ? trim($_POST["IdCliente"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $cliente->setCorreo($correo);
        $cliente->setIdCliente($IdCliente);
        $encontrado = $cliente->verificarExistenciaCliente();
        echo $encontrado ? 1 : 0;
        break;



    case 'editar':
        $IdCliente = isset($_POST["IdCliente"]) ? trim($_POST["IdCliente"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        if (strlen($telefono) != 8) {
            echo 'El teléfono debe tener exactamente 8 dígitos.';
            exit;
        }
        $tipoCliente = isset($_POST["tipoCliente"]) ? trim($_POST["tipoCliente"]) : "";
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";

        $cliente = new Cliente();
        $cliente->setTelefono($telefono);
        $encontrado = $cliente->verificarExistenciaCliente();

        if ($encontrado == false) {
            $cliente->setIdCliente($IdCliente);
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setTelefono($telefono);
            $cliente->setTipoCliente($tipoCliente);
            $cliente->setProvincia($provincia);
            $cliente->setDistrito($distrito);
            $cliente->setCanton($canton);
            $cliente->setOtros($otros);

            if ($cliente->actualizarCliente()) {
                echo 1; //exito en la actualizacion
            } else {
                echo 2;  //Error al guardar en la base de datos
            }
        } else {
            echo 3; 
        }
        break;

    case 'obtener':
        if (isset($_GET['IdCliente'])) {
            $IdCliente = isset($_GET['IdCliente']) ? intval($_GET['IdCliente']) : null;
            $cliente = Cliente::obtenerClientePorIdCliente($IdCliente);

            if ($cliente) {
                echo json_encode($cliente);
            } else {
                echo json_encode(["error" => "No se encontró el cliente"]);
            }
        } else {
            echo json_encode(["error" => "IdCliente del cliente no proporcionada"]);
        }
        break;

    case 'eliminar':
        if (isset($_POST['id'])) {
            $IdCliente = intval($_POST['id']);
            $cliente = new cliente();
            $cliente->setIdCliente($IdCliente);

            $resultado = $cliente->eliminarcliente();

            if ($resultado === 1) {
                echo json_encode(["success" => "cliente eliminado"]);
            } else {
                echo json_encode(["error" => "No se pudo eliminar el cliente"]);
            }
        } else {
            echo json_encode(["error" => "Id del cliente no proporcionado"]);
        }
        break;

    case 'cargarCliente':
        $clienteModel = new Cliente();
        $clientes = $clienteModel->obtenerCliente();
        echo json_encode($clientes);
        break;

    case 'editarCliente':
        $IdCliente = isset($_POST["IdCliente"]) ? trim($_POST["IdCliente"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : "";
        if (strlen($contrasena) < 8) {
            echo 'La contraseña debe tener al menos 8 caracteres.';
            exit;
        }
        $contrasena = hash('SHA256', $contrasena);
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        if (strlen($telefono) != 8) {
            echo 'El teléfono debe tener exactamente 8 dígitos.';
            exit;
        }
        $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : "";
        $distrito = isset($_POST["distrito"]) ? trim($_POST["distrito"]) : "";
        $canton = isset($_POST["canton"]) ? trim($_POST["canton"]) : "";
        $otros = isset($_POST["otros"]) ? trim($_POST["otros"]) : "";

        $cliente = new Cliente();
        $encontrado = $cliente->verificarExistenciaCliente();

        if ($encontrado == false) {
            $cliente->setIdCliente($IdCliente);
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setContrasena($contrasena);
            $cliente->setTelefono($telefono);
            $cliente->setProvincia($provincia);
            $cliente->setDistrito($distrito);
            $cliente->setCanton($canton);
            $cliente->setOtros($otros);

            if ($cliente->actualizarClienteVC()) {
                echo 1; //exito en la actualizacion
            } else {
                echo 2;  //Error al guardar en la base de datos
            }
        } else {
            echo 3; //Este valor se muestra si el cliente no existe
        }
        break;
}
