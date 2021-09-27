<?php

    header("Content-Type: application/json");
    include_once ("../classes/ClassCategoriaDeProducto.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
        
           
            $conexion = new Conexion ($_GET['restaurante']);
            CategoriaDeProducto::mostrarCategorias($conexion);
            
        break;
    }


?>