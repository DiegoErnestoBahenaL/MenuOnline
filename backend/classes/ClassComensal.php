<?php

    class Comensal {

       //Propiedades basadas en los campos de BD
        private $nombre;
        private $idMesa;
        private $estaActivo;

        public function __construct($nombre, $idMesa){

            $this->nombre = $nombre;
            $this->idMesa = $idMesa;

            //estaActivo se inicializa en 1 ya que indica que ese comensal esta activo

            $this->estaActivo = 1;

        }

        //getters y setters

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
         * Get the value of idMesa
         */ 
        public function getIdMesa()
        {
                return $this->idMesa;
        }

        /**
         * Set the value of idMesa
         *
         * @return  self
         */ 
        public function setIdMesa($idMesa)
        {
                $this->idMesa = $idMesa;

                return $this;
        }

        /**
         * Get the value of estaActivo
         */ 
        public function getEstaActivo()
        {
                return $this->estaActivo;
        }

        /**
         * Set the value of estaActivo
         *
         * @return  self
         */ 
        public function setEstaActivo($estaActivo)
        {
                $this->estaActivo = $estaActivo;

                return $this;
        }
    
        
        public function insertarComensal (){



        }

        public function mostrarComensal (){


        }

        /**
         * Cambia el estado de estaActivo
         */
        public function actualizarEstadoComensal (){


        }
    
    
    
    }


?>