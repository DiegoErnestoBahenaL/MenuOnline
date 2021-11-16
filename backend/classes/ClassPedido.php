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

       //retorna el monto total del pedido del comensal
       public static function mostrarMontoDelComensal ($idComensal, $objConexion){

            $conexion = $objConexion->conexionRestaurante();

            $query = "SELECT * FROM Pedido WHERE idComensal = $idComensal";

            $res = mysqli_query($conexion, $query);

            while ($row = $res->fetch_array()){

                $pedido = array (

                    'montoTotal'=>$row['montoTotal']

                );
                
            }

            $jsonContent = json_encode ($pedido);
            echo $jsonContent;
       }

        public function insertarPedido ($objConexion) {

            

            $conexion = $objConexion->conexionRestaurante();

            //Query para verificar los pedidos que haya en esa mesa
            $queryVerificar = "select * from Pedido where idMesa = $this->idMesa 
            and idComensal = $this->idComensal and idEstadoPedido!=5";


            $resVerificar = mysqli_query($conexion, $queryVerificar) or die ("No se ejecutó la queryVerificar");

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
        
        /**
         * Recibe: el objeto para realizar la conexion, el id del medio de pago,
         *          la propina y el id del comensal
         * Función: Actualiza los campos correspondientes con una consulta.
         * Retorna: El estado de la operación (200 = ok, 500 = error)
         */
        public static function solicitarPago ($objConexion, $idMedioDePago, $propina, $idComensal){

            $conexion = $objConexion->conexionRestaurante();

            $query = "UPDATE Pedido SET idMedioDePago = $idMedioDePago, propina = $propina, idEstadoPedido = 6 WHERE idComensal = $idComensal";
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
        /**
         * Recibe: el objeto para realizar la conexion, el comentario y la 
         *          escala de atencion
         * Función: Actualiza los campos correspondientes con una consulta.
         * Retorna: El estado de la operación (200 = ok, 500 = error)
         */
        public static function evaluarServicio ($objConexion, $comentario, $atencion, $idComensal){

            $conexion = $objConexion->conexionRestaurante();

            $query = "UPDATE Pedido SET comentario = '$comentario', atencion = $atencion WHERE idComensal = $idComensal";

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

         /**
         * Recibe: el objeto para realizar la conexion, 
         *         id del comensal que va a dividir su producto o productos,
         *         el arreglo con los id's de los comensales seleccionados,
         *         el total de los productos o producto a dividir,
         *           
         *         
         * Función: Realiza la gestión necesaria para dividir los productos entre 
         *          los comensales
         * Retorna: El estado de la operación (200 = ok, 500 = error)
         */

        public static function dividirProductos ($objConexion, $idComensal, $comensalesSeleccionados, $totalProductos){

            $numeroDeComensalesSeleccionados = count($comensalesSeleccionados);

            $conexion = $objConexion->conexionRestaurante();

            $aumentarCantidad = $totalProductos /($numeroDeComensalesSeleccionados + 1);

            $cantidadARestar = $aumentarCantidad * ($numeroDeComensalesSeleccionados);

            $queryRestarMonto = "UPDATE Pedido SET montoTotal = montoTotal - $cantidadARestar WHERE idComensal=$idComensal";

            $resRestarMonto = mysqli_query($conexion, $queryRestarMonto);

            for ($i=0; $i <$numeroDeComensalesSeleccionados ; $i++) { 
                
                $idEspecifico = $comensalesSeleccionados[$i];

                $queryAumentarMonto = "UPDATE Pedido SET montoTotal = montoTotal + $aumentarCantidad 
                WHERE idComensal=$idEspecifico";

                $resAumentarMonto = mysqli_query($conexion, $queryAumentarMonto) or die ("No se ejecutó la consulta, el id fue". $idEspecifico );
            }
            
            if($resRestarMonto && $resAumentarMonto){
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