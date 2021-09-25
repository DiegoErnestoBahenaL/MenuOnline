<?php
    header("Content-Type: application/json");
    include_once ("../classes/ClassComensal.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'POST':
            echo ("Un comensal nuevo se registra: ");
            break;
        
        case 'GET':
            
            echo ("Informacion del comensal: ");

            break;
        
        case 'PUT':

            echo ("El comensal ha terminado de pagar todo: ");

        break;    
    }


?>