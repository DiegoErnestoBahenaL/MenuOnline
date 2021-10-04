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
        
            print  '<input type="hidden" id="restaurante" value="'.$nombreRestaurante.'" >';
                               
                                 
        ?>
      

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        
        
        <div class="componenteSelector">
            
             <script src="JS/controllerCategorias.js" ></script>
            
        </div>
        
        
        <div class="listaProductos">
            <script src="JS/controllerProductos.js" ></script>
        </div>
        
     
        
          
        
        

</body>


</html>