<?php

    function conexionRestaurante ($nombreBD){
        
       
        $servername = "localhost";
        $database = "u696248240_".$nombreBD;
        $username = "u696248240_".$nombreBD;
        $password = "u696248240_".$nombreBD."Daltys.com";
      
        $conexion = mysqli_connect($servername, $username, $password, $database)
        or die ("No se encontró la Base de datos");

        if(isset($conexion)) 
        {
            echo "Conexion establecida con ". $nombreBD;
        }

        return $conexion;
    }

?>