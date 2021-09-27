<?php

    header("Content-Type: application/json");

    include_once ('../classes/ClassConexion.php');
    include_once ('../classes/ClassProducto.php');

    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            
            if (isset($_GET['restaurante'])) {
                
                $conexion = new Conexion($_GET['restaurante']);
                Producto::obtenerProductos($conexion);

            }
        
        
        break;


    }
   

?>