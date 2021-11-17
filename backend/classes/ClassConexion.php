<?php

    session_start();


    class Conexion {

        private $servername;
        private $database;
        private $username;
        private $password;

        public function __construct($nombreBD){

            $this->servername = "localhost";
            $this->database = "u696248240_".$nombreBD;
            $this->username = "u696248240_".$nombreBD;
            $this->password = $_SESSION['PASSWORD']; //esta se saca de conuslta

        }

        
        public function conexionRestaurante (){

          // $conexion = mysqli_connect($this->servername, $this->username, $this->password, $this->database)
           //  or die ("No se encontró la Base de datos");
            
                     
            $conexion = mysqli_connect ("localhost", "u696248240_sushifactory", "Sushito123",   "u696248240_sushifactory")
            or die ("No se encontró la Base de datos");


            return $conexion;
        }
    
    }


?>