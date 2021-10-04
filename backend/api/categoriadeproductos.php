<?php

    header("Content-Type: application/json");
    include_once ("../classes/ClassCategoriaDeProducto.php");
    include_once ("../classes/ClassConexion.php");

    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
        
           
            if (isset($_GET['idCategoriaDeProducto'])){

                
                $conexion = new Conexion ($_GET['restaurante']);
                CategoriaDeProducto::mostrarCategoria($conexion, $_GET['idCategoriaDeProducto']);
            
            }
            
            if (isset($_GET['restaurante']) &&  !(isset($_GET['idCategoriaDeProducto']))) {


                $conexion = new Conexion ($_GET['restaurante']);
                CategoriaDeProducto::mostrarCategorias($conexion);


            }   
            
           
            


        break;
    }


?>