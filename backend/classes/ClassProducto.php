<?php

    class Producto {

        private $idProducto;
        private $nombre;
        private $precio;
        private $descripcion;
        private $codigo;
        private $imagen;
        private $idCategoriaDeProducto;
                       

        public function __construct($idProducto, $nombre, $precio, $descripcion, $codigo, $imagen, $idCategoriaDeProducto){

            $this->idProducto = $idProducto;
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->descripcion = $descripcion;
            $this->codigo = $codigo;
            $this->imagen = $imagen;
            $this->idCategoriaDeProducto = $idCategoriaDeProducto;
        }


        public static function obtenerProductos($objConexion){
                
                $imagenConvertida;
            $conexion = $objConexion->conexionRestaurante();

            $query = "select idProducto, nombre, precio, descripcion, imagen from producto WHERE estaActivo = 1";
            
            $res = mysqli_query($conexion, $query);

            while ($row = $res->fetch_array()){

                $productos [] = array (

                    'idProducto'=>$row['idProducto'],
                    'nombre'=>$row['nombre'],
                    'precio'=>$row['precio'],
                    'descripcion'=>$row['descripcion'],
                    'imagen'=> base64_encode($row['imagen'])
                
                
                );


            }
            $jsonContent = json_encode ($productos);
            echo $jsonContent;
        }


        /**
         * Get the value of idProducto
         */ 
        public function getIdProducto()
        {
                return $this->idProducto;
        }

        /**
         * Set the value of idProducto
         *
         * @return  self
         */ 
        public function setIdProducto($idProducto)
        {
                $this->idProducto = $idProducto;

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

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of codigo
         */ 
        public function getCodigo()
        {
                return $this->codigo;
        }

        /**
         * Set the value of codigo
         *
         * @return  self
         */ 
        public function setCodigo($codigo)
        {
                $this->codigo = $codigo;

                return $this;
        }

        /**
         * Get the value of idCategoriaDeProducto
         */ 
        public function getIdCategoriaDeProducto()
        {
                return $this->idCategoriaDeProducto;
        }

        /**
         * Set the value of idCategoriaDeProducto
         *
         * @return  self
         */ 
        public function setIdCategoriaDeProducto($idCategoriaDeProducto)
        {
                $this->idCategoriaDeProducto = $idCategoriaDeProducto;

                return $this;
        }
    }


?>