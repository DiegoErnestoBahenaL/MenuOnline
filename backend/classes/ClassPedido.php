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

       public function __construct($idMesa, $idComensal, $montoTotal){

            $this->idComensal = $idComensal;
            $this->idMesa = $idMesa;
            $this->idMedioDePago = 3;
            $this->montoTotal = $montoTotal;
            $this->idEstadoPedido = 1;
            $this->fechaInicio = date( "Y-m-d H:i:s", time () -18000);

 
         

       }

        public function insertarPedido ($objConexion) {

            

            $conexion = $objConexion->conexionRestaurante();

            //Query para verificar los pedidos que haya en esa mesa
            $queryVerificar = "select * from pedido where idMesa = $this->idMesa and idEstadoPedido!=5";


            $resVerificar = mysqli_query($conexion, $queryVerificar);

            $rowsConsulta = mysqli_num_rows ($resVerificar);

            if ($rowsConsulta !== 0){

                $queryObtenerPedido = "SELECT numeroDePedido FROM pedido WHERE idMesa = $this->idMesa ORDER BY numeroDePedido DESC LIMIT 1";


                $resNumeroDePedido = mysqli_query($conexion, $queryObtenerPedido);


                while ($rowPedido = $resNumeroDePedido->fetch_array()){

                    $pedido = array (
    
                        'numeroDePedido'=>$rowPedido['numeroDePedido']
    
                    );
                    
                }

                mysqli_close($conexion);

                $error = array (
                    'message'=>400 ,
                    "numeroDePedido"=>$pedido['numeroDePedido']
                );

                $jsonContent = json_encode($error);
                echo $jsonContent;

            }
            else {

                $query = "insert into pedido (fechaInicio, idEstadoPedido, montoTotal, idMedioDePago, idMesa, idComensal) 
                values ('$this->fechaInicio', $this->idEstadoPedido, $this->montoTotal, $this->idMedioDePago, $this->idMesa, $this->idComensal)";
            
                $res = mysqli_query($conexion, $query);
                
                $queryObtenerPedido = "SELECT numeroDePedido FROM pedido WHERE idMesa = $this->idMesa ORDER BY numeroDePedido DESC LIMIT 1";


                $resNumeroDePedido = mysqli_query($conexion, $queryObtenerPedido);


                while ($rowPedido = $resNumeroDePedido->fetch_array()){

                    $pedido = array (
    
                        'numeroDePedido'=>$rowPedido['numeroDePedido']
    
                    );
                    
                }


                mysqli_close($conexion);



                $message = array (
                    "query"=>$res,
                    "numeroDePedido"=>$pedido['numeroDePedido'],
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



    }
?>