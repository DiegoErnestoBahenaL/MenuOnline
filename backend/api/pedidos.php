<?php

    header("Content-Type: application/json");
    include_once ("../classes/ClassPedido.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){
        
        case 'GET':

            if (isset($_GET['idComensal'])){
                
                 
                $conexion = new Conexion ($_GET['restaurante']);
                Pedido::mostrarMontoDelComensal($_GET['idComensal'], $conexion);
            
            }
            break;
        case 'POST':
            
            //Un comensal nuevo ingresa al restaurante
            $_POST = json_decode (file_get_contents('php://input'), true);
            $pedido = new Pedido ($_POST['idMesa'], $_POST['idComensal'], $_POST['montoTotal']);
            $conexion = new Conexion ($_POST['restaurante']);
            $pedido->insertarPedido($conexion);


           


        break;
        
         case 'PUT':

            //se actualiza el monto y el estadodepedido del pedido del comensal
            if (isset($_GET['numeroDePedido']) && isset($_GET['montoTotal'])){


                $conexion = new Conexion ($_GET['restaurante']);
                Pedido::actualizarMontoTotal($_GET['numeroDePedido'],$_GET['montoTotal'], $conexion);
             }

            $_POST = json_decode (file_get_contents('php://input'), true);

             if (isset($_POST['comensalesSeleccionados'])){
                $conexion = new Conexion($_POST['restaurante']);
                Pedido::dividirProductos($conexion, $_POST['idComensal'], $_POST['comensalesSeleccionados'], $_POST['totalProductos']);
             }

             if (isset($_POST['atencion'])){
                $conexion = new Conexion($_POST['restaurante']);
                Pedido::evaluarServicio($conexion, $_POST['comentario'], $_POST['atencion'], $_POST['idComensal']);
             }
            
            if (isset($_POST['idComensal']) && isset($_POST['idMedioDePago'])){
                $conexion = new Conexion($_POST['restaurante']);
                Pedido::solicitarPago($conexion, $_POST['idMedioDePago'], $_POST['propina'], $_POST['idComensal']);
             }


        break;
        
        




    }



?>