<?php

    class PedidoProducto {

        private $numeroDePedido;
        private $idProducto;
        private $numeroDeProductos;
        private $comentario;

        function __construct ($numeroDePedido, $idProducto, $numeroDeProductos, $comentario){
            $this->numeroDePedido = $numeroDePedido;
            $this->idProducto = $idProducto;
            $this->numeroDeProductos = $numeroDeProductos;
            $this->comentario = $comentario;
        }


        //Recibe: objeto para establecer conexion
        //Función: inserta una nueva row en la tabla Pedido_Producto
        //Retorna: El estado de la operación

        public function insertarPedidoProducto ($objConexion){

            $conexion = $objConexion->conexionRestaurante();

            $query = "insert into Pedido_Producto (numeroDePedido, idProducto, numeroDeProductos, comentario) values ($this->numeroDePedido, $this->idProducto, $this->numeroDeProductos, '$this->comentario')";

            $res = mysqli_query($conexion, $query) or die ("no se ejectuo la consulta");

            if ($res){
                $codigo = 200;
            }
            else{
                $codigo = 500;
            }

            $response = array (

                'message'=>$codigo

            );

            $jsonContent = json_encode($response);
            echo $jsonContent;

        }

        
    }


?>