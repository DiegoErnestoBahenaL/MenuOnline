<?php
    header("Content-Type: application/json");
    include_once ("../classes/ClassComensal.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'POST':
            
            //Un comensal nuevo ingresa al restaurante
            $_POST = json_decode (file_get_contents('php://input'), true);
            $comensal = new Comensal ($_POST['nombre'], $_POST['idMesa']);
            $conexion = new Conexion ($_POST['restaurante']);
            $comensal->insertarComensal($conexion);

            $res ["mensaje"] = "Comensal insertado: ".json_encode($_POST);
            echo json_encode($res);


            break;
        
        case 'GET':
            //
            if (isset($_GET['idComensal'])){
                
                 
                $conexion = new Conexion ($_GET['restaurante']);
                Comensal::mostrarComensal($_GET['idComensal'], $conexion);
            
            }
            //Obtiene todos los usuarios en una mesa activos
            if (isset($_GET['idMesa'])){

                 
                $conexion = new Conexion ($_GET['restaurante']);
                Comensal::comensalesEnMesa($_GET['idMesa'], $conexion);

            }
            
            break;
        
        case 'PUT':
            //El comensal terminó de pagar todo
            if (isset($_GET['idComensal'])){
                
               
                $conexion = new Conexion ($_GET['restaurante']);
                Comensal::actualizarEstadoComensal($_GET['idComensal'], $conexion);
            
            }
            

        break;    
    }


?>