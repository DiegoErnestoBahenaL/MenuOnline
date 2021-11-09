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
            $this->fechaInicio = date( "Y-m-d H:i:s", time () -21600);

 
         

       }

        public function insertarPedido ($objConexion) {

            

            $conexion = $objConexion->conexionRestaurante();

            //Query para verificar los pedidos que haya en esa mesa
            $queryVerificar = "select * from Pedido where idMesa = $this->idMesa 
            and idComensal = $this->idComensal and idEstadoPedido!=5";


            $resVerificar = mysqli_query($conexion, $queryVerificar);

            $rowsConsulta = mysqli_num_rows ($resVerificar);

            if ($rowsConsulta !== 0){

                $queryObtenerPedido = "SELECT numeroDePedido, idEstadoPedido FROM Pedido WHERE idMesa = $this->idMesa ORDER BY numeroDePedido DESC LIMIT 1";


                $resNumeroDePedido = mysqli_query($conexion, $queryObtenerPedido);


                while ($rowPedido = $resNumeroDePedido->fetch_array()){

                    $pedido = array (
    
                        'numeroDePedido'=>$rowPedido['numeroDePedido'],
                        'idEstadoPedido'=>$rowPedido['idEstadoPedido']
    
                    );
                    
                }

                mysqli_close($conexion);

                $error = array (
                    'message'=>400 ,
                    "numeroDePedido"=>$pedido['numeroDePedido'],
                    'idEstadoPedido'=>$pedido['idEstadoPedido']
                );

                $jsonContent = json_encode($error);
                echo $jsonContent;

            }
            else {

                $query = "insert into Pedido (fechaInicio, idEstadoPedido, montoTotal, idMedioDePago, idMesa, idComensal) 
                values ('$this->fechaInicio', $this->idEstadoPedido, $this->montoTotal, $this->idMedioDePago, $this->idMesa, $this->idComensal)";
            
                $res = mysqli_query($conexion, $query);
                
                $queryObtenerPedido = "SELECT numeroDePedido FROM Pedido WHERE idMesa = $this->idMesa ORDER BY numeroDePedido DESC LIMIT 1";


                $resNumeroDePedido = mysqli_query($conexion, $queryObtenerPedido);


                while ($rowPedido = $resNumeroDePedido->fetch_array()){

                    $pedido = array (
    
                        'numeroDePedido'=>$rowPedido['numeroDePedido']
    
                    );
                    
                }


                mysqli_close($conexion);



                $message = array (
                    "query"=>$res,
                    "message"=>200,
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

        public static function actualizarMontoTotal($numeroDePedido, $montoTotal, $objConexion){

            $conexion = $objConexion->conexionRestaurante();

            $query =  "UPDATE Pedido set montoTotal = $montoTotal, idEstadoPedido = 1 where numeroDePedido = $numeroDePedido"; 

            $res = mysqli_query($conexion, $query);

            

            if($res){
                $codigo = 200;
            }
            else {
                $codigo = 500;
            }

            $message = array (

                'message'=>$codigo
            );

            $jsonContent = json_encode($message);
            echo $jsonContent;

            mysqli_close($conexion);
        }

    }
?>