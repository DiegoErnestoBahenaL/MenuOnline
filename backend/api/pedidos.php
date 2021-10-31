<?php

    header("Content-Type: application/json");
    include_once ("../classes/ClassPedido.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'POST':
            
            //Se registra un nuevo pedido por comensal la primera vez que 
            //pide productos
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
            


        break;
        
        
        




    }



?>