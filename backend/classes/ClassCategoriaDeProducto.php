<?php

    class CategoriaDeProducto {

        private $idCategoria;
        private $nombre;


        public function __construct($idCategoria, $nombre){

            $this->idCategoria = $idCategoria;
            $this->nombre = $nombre;

        }



        

        /**
         * Get the value of idCategoria
         */ 
        public function getIdCategoria()
        {
                return $this->idCategoria;
        }

        /**
         * Set the value of idCategoria
         *
         * @return  self
         */ 
        public function setIdCategoria($idCategoria)
        {
                $this->idCategoria = $idCategoria;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }
    
        
        public static function mostrarCategorias ($objConexion){

            $conexion = $objConexion->conexionRestaurante();

            $query = "select * from CategoriaDeProducto";

            $res = mysqli_query($conexion, $query);


            while ($row = $res->fetch_array()){

                $categorias [] = array (

                    'idCategoriaDeProducto'=>$row['idCategoriaDeProducto'],
                    'nombre'=>$row['nombre']

                );

            }

            $jsonContent = json_encode($categorias);
            echo $jsonContent; 

        }

        public static function mostrarCategoria ($objConexion, $idCategoriaDeProducto){

            $conexion = $objConexion->conexionRestaurante();

            $query = "select * from CategoriaDeProducto where idCategoriaDeProducto= $idCategoriaDeProducto";

            $res = mysqli_query ($conexion, $query);

            while ($row = $res->fetch_array()){
               
                $categoria = array (

                    'idCategoriaDeProducto'=>$row['idCategoriaDeProducto'],
                    'nombre'=>$row['nombre']

                );

            }
            $jsonContent =json_encode($categoria);
            echo $jsonContent;
        }
    
    
    }



?>