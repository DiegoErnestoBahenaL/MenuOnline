<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daltys' Menu Online</title>

    <link rel="shortcut icon" href="img/DaltysLogo.png">

    <!-- Normalize -->

    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">

    <!-- Fuentes de Google -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@300&display=swap" rel="stylesheet">

    <!-- Hoja de estilos CSS-->

    <link rel="preload" href="css/styles.css" as="style">
    <link rel="stylesheet" href="css/styles.css">


</head>
<body class="pedido">
  
    <?php
          
         
        $nombreRestaurante = $_GET['restaurante'];
        $idComensal = $_GET['idComensal'];
        $mesa = $_GET['mesa'];
            
        print  '<input type="hidden" id="restaurante" value="'.$nombreRestaurante.'" >';
        print '<input type="hidden" id="idComensal" value="'.$idComensal.'" >';    
        print '<input type="hidden" id="mesa" value="'.$mesa.'" >';                  
                                 
    ?>
      
        
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <h1 class="pedidoHeader">Pedido</h1>
    
    <div class="productosPedidos" id="productosPedidos">
            
        <script  src="JS/controllerProductosPedidos.js" ></script>     

    </div>
    <div class="areaBotonesPedido">

        <button type="button" id="botonRegresarProductos" class="botonRegresarProductos" onclick="regresarAProductos()" >Regresar a Productos</button>

        <button type="button" id="botonConfirmar" class="botonConfirmar" onclick="confirmarPedido()">Confirmar pedido</button>

        <script src="JS/controllerNavegacionPedido.js"></script>

    </div>
     
    
</body>
</html>