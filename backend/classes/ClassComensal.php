<?php
    
    
    class Comensal {

       //Propiedades basadas en los campos de BD
        private $idComensal;
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
    
           /**
         * Get the value of restaurante
         */ 
        public function getRestaurante()
        {
                return $this->restaurante;
        }

        /**
         * Set the value of restaurante
         *
         * @return  self
         */ 
        public function setRestaurante($restaurante)
        {
                $this->restaurante = $restaurante;

                return $this;
        }
        
        
        /**
         * ejecuta la query correspondiente para insertar un nuevo comensal
         */
        public function insertarComensal ($objConexion){

            
             $conexion = $objConexion->conexionRestaurante();

            
            $queryVerificar = "select * from Comensal where idMesa=$this->idMesa and estaActivo = 1 and nombre = '$this->nombre'";
            
            
            $res = mysqli_query($conexion, $queryVerificar );
            $rows = mysqli_num_rows($res);
            if (mysqli_num_rows($res) !== 0){
            
                
                 
                   
            
    


               $error = array (

                    
                    'nombre'=>$this->nombre,
                    'mesa' => $this->idMesa,
                    'estaActivo'=>$this->estaActivo,
                    'query'=>$res,
                    'rows'=>$rows,
                    'contenidoQuery'=>$queryVerificar
                );
                
                $jsonContent = json_encode($error);
                echo $jsonContent; 
               
             
            
                
                
            } 
            else{ 
                 $queryInsertar = "insert into Comensal (nombre, idMesa, estaActivo) 
                    values ('$this->nombre', $this->idMesa, $this->estaActivo)";
    
                    $res = mysqli_query($conexion, $queryInsertar);


                    $queryObtenerIdComensal = "SELECT idComensal FROM Comensal ORDER BY idComensal DESC LIMIT 1";
                    
                    
                    $resIdComensal = mysqli_query($conexion, $queryObtenerIdComensal);


                    while ($rowID = $resIdComensal->fetch_array()){

                        $idComensal = array (
        
                            'idComensal'=>$rowID['idComensal']
        
                        );
                        
                    }

                    mysqli_close($conexion);
    
                    $message = array (

                    
                    'nombre'=>$this->nombre,
                    'mesa' => $this->idMesa,
                    'estaActivo'=>$this->estaActivo,
                    'query'=>$res,
                    'rows'=>$rows,
                    'idComensal'=>$idComensal['idComensal']
                );
                
                    $jsonContent = json_encode($message);
                    echo $jsonContent;  
            }
            

        }

         /**
         * muestra el comensal segun la id dada
         */

        public static function mostrarComensal ($idComensal, $objConexion){
           
            $conexion = $objConexion->conexionRestaurante();

            $query = "select * from Comensal where idComensal=$idComensal";

            $res = mysqli_query($conexion, $query);

           

            while ($row = $res->fetch_array()){

                $comensal = array (

                    'idComensal'=>$row['idComensal'],
                    'nombre'=>$row['nombre'],
                    'idMesa'=>$row['idMesa'],
                    'estaActivo'=>$row['estaActivo']

                );
                
            }
            $jsonContent = json_encode($comensal);            

            mysqli_close($conexion);

            echo $jsonContent;

        }

        public static function comensalesEnMesa ($idMesa, $objConexion){

            $conexion = $objConexion->conexionRestaurante();

            $query = "select idComensal, nombre from Comensal where idMesa=$idMesa and estaActivo = 1";

            $res = mysqli_query($conexion, $query);

            
            while ($row = $res->fetch_array()){

                $comensales [] = array (

                    'idComensal'=>$row['idComensal'],
                    'nombre'=>$row['nombre']
                );
                
            }

           $jsonContent = json_encode($comensales);
           echo $jsonContent; 

        }



        /**
         * Cambia el estado de estaActivo
         */
        public function actualizarEstadoComensal ($idComensal, $objConexion){
            
            $conexion = $objConexion->conexionRestaurante();

            $query = "update Comensal set estaActivo=0 where idComensal = $idComensal";

            $res = mysqli_query($conexion, $query);

            mysqli_close($conexion);

        }
    
    
    

     

        /**
         * Get the value of idComensal
         */ 
        public function getIdComensal()
        {
                return $this->idComensal;
        }

        /**
         * Set the value of idComensal
         *
         * @return  self
         */ 
        public function setIdComensal($idComensal)
        {
                $this->idComensal = $idComensal;

                return $this;
        }
    }


?>