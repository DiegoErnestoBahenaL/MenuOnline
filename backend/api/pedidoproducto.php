<?php

    header("Content-Type: application/json");
    include_once ("../classes/ClassPedidoProducto.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'POST':
            
             
            $_POST = json_decode (file_get_contents('php://input'), true);
            $pedidoProducto = new PedidoProducto ($_POST['numeroDePedido'], $_POST['idProducto'], $_POST['numeroDeProductos'], $_POST['comentario']);
            $conexion = new Conexion ($_POST['restaurante']);
            $pedidoProducto->insertarPedidoProducto($conexion);
       
        break;
      
        

    }



?>