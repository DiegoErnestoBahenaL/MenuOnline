<?php

    header("Content-Type: application/json");
    include_once ("../classes/ClassPedido.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'POST':
            
            //Un comensal nuevo ingresa al restaurante
            $_POST = json_decode (file_get_contents('php://input'), true);
            $pedido = new Pedido ($_POST['idMesa'], $_POST['idComensal']);
            $conexion = new Conexion ($_POST['restaurante']);
            $pedido->insertarPedido($conexion);


           


        break;
        
        
        




    }



?>