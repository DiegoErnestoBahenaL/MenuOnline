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
<body class="productoBody">
  
      <?php
          
         
            $nombreRestaurante = $_GET['restaurante'];
            $idComensal = $_GET['idComensal'];
            $idProducto = $_GET['idProducto'];
            $nombre = $_GET['nombre']; 
            $precio = $_GET['precio'];
            $mesa = $_GET['mesa'];
            print  '<input type="hidden" id="mesa" value="'.$mesa.'" >';
            print  '<input type="hidden" id="restaurante" value="'.$nombreRestaurante.'" >';
            print '<input type="hidden" id="idComensal" value="'.$idComensal.'" >';    
            print '<input type="hidden" id="idProducto" value="'.$idProducto.'" >';    
            print '<input type="hidden" id="nombre" value="'.$nombre.'" >';    
            print '<input type="hidden" id="precio" value="'.$precio.'" >';                
                                 
        ?>
      
        
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        
        
    <div class="subBody">
            <div class="contenedorProducto" id="contenedorProducto">

                <script type="module" src="JS/controllerProducto.js"></script>


                
            </div>
            <div class="contenedorComentario">
                 <h3 class="tituloComentario">Comentarios</h3>
                <textarea placeholder="Escribe comentarios de preparación" rows="4" cols="50" id="comentario" class="comentario"></textarea>

            </div>
            <div class="areaBotones">
                
                 <div class="cantidadBotones" id="cantidadBotones">
                    <button type="button" id="botonMenos" onclick="disminuirArticulo()" >-</button>
                    <input class="inputCantidadProductos" id="inputCantidadProductos" type="number" value="1" size="2" disabled >
                    <button type="button" id="botonMas" onclick="agregarArticulo()">+</button>
                </div>
                <script src="JS/controllerAgregarProducto.js"></script>


                <button type="button" class="agregarProducto" onclick="guardarEnPedido()" id="agregarProducto">Agregar</button>
                <script src="JS/controllerGuardarEnPedido.js"></script>
            </div>
                
        </div>
    
     

</body>
</html>