<?php

    class Pedido {

    
         
     
        private $numeroDePedido;
        
        private $comentario;
        private $propina;
        private $atencion;
        private $fechaFin;
      

        //Propiedades basadas en los campos de BD
        private $idComensal;
        private $idMesa;
        private $idMedioDePago;
        private $montoTotal;
        private $idEstadoPedido;
        private $fechaInicio;

       public function __construct($idMesa, $idComensal){

            $this->idComensal = $idComensal;
            $this->idMesa = $idMesa;
            $this->idMedioDePago = 3;
            $this->montoTotal = 0.00;
            $this->idEstadoPedido = 1;
            $this->fechaInicio = date( "Y-m-d H:i:s", time () -18000);

 
         

       }

        public function insertarPedido ($objConexion) {


            



             $conexion = $objConexion->conexionRestaurante();

             $query = "insert into pedido (fechaInicio, idEstadoPedido, montoTotal, idMedioDePago, idMesa, idComensal) 
             values ('$this->fechaInicio', $this->idEstadoPedido, $this->montoTotal, $this->idMedioDePago, $this->idMesa, $this->idComensal)";
            
             $res = mysqli_query($conexion, $query);

             mysqli_close($conexion);



            $message = array (
                "query"=>$res,
                "fechaInicio"=>$this->fechaInicio,
                "idEstadoPedido"=>$this->idEstadoPedido,
                "montoTotal"=>$this->montoTotal,
                "idMedioDePago"=>$this->idMedioDePago,
                "idMesa"=>$this->idMesa,
                "idComensal"=>$this->idComensal                   
        
              
            );
            
                $jsonContent = json_encode($message);
                echo $jsonContent; 
        }



    }
?>