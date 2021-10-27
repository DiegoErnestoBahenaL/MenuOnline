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
<body class="menu">
    <h1>Productos</h1>
      <?php
          
         
            $nombreRestaurante = $_GET['restaurante'];
            $idComensal = $_GET['idComensal'];
            print  '<input type="hidden" id="restaurante" value="'.$nombreRestaurante.'" >';
            print '<input type="hidden" id="idComensal" value="'.$idComensal.'" >';                   
                                 
        ?>
      
        
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        
        
       
        
        <div class="barraBusqueda">

            <input class="barraBusquedaTexto"  type="search" id="barraBusquedaTexto" placeholder="Busca el platillo">
            <button class="barraBusquedaBoton" id="barraBusquedaBoton">Buscar</button>
            <script type="module" src="JS/controllerBusqueda.js"></script>

        </div>

         <div class="componenteSelector" id="componenteSelector">
            
            <script type="module" src="JS/controllerCategorias.js" ></script>
            
            <button type="button" class="pedido" id="pedido" onclick="irAPedido()" >Ir a pedido</button>
            
            <script src="JS/controllerIrAPedido.js"></script>

        </div>
        
        <div class="listaProductos" id="listaProductos">
            <script type="module"  src="JS/controllerProductos.js" ></script>
             
           

        </div>
    
     

</body>
</html>