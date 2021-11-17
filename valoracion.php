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
      <script>
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, "", window.location.href);
            };
    </script>
    <?php

        if (isset($_GET['close'])){
            session_start();
            unset($_SESSION['PASSWORD']);
            session_destroy();

            print  '<input type="hidden" id="close" value="1" >';
        }
          
         
        $nombreRestaurante = $_GET['restaurante'];
        $idComensal = $_GET['idComensal'];
        $mesa = $_GET['mesa'];
            
        print  '<input type="hidden" id="restaurante" value="'.$nombreRestaurante.'" >';
        print '<input type="hidden" id="idComensal" value="'.$idComensal.'" >';    
        print '<input type="hidden" id="mesa" value="'.$mesa.'" >';                  
                                 
                                 
    ?>
      
     <script type='text/javascript'>
        var cerrarVentana = document.getElementById("close").value;
        if (cerrarVentana == 1){
           alert ("Ya puedes cerrar esta ventana");
        }
     </script> 
        
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <h1 class="headerValoracion">Evaluar servicio</h1>
    <div class="areaEstrellas">
    
        <div class="stars" value="1" id="atencion">
            <span class="star">&nbsp;</span>
            <span class="star">&nbsp;</span>
            <span class="star">&nbsp;</span>
            <span class="star">&nbsp;</span>
            <span class="star">&nbsp;</span>
        </div>
        
        <script src="JS/controllerEstrellas.js"></script>
    </div>
 
    <div class="contenedorComentario">
        <h3 class="tituloComentario">Comentarios</h3>
        <textarea placeholder="Cuéntanos tu experiencia" rows="4" cols="50" id="comentario" class="comentario"></textarea>

    </div>
    <div class="botonesValoracion">
        <button type="button" class="boton__confirmar" id="botonConfirmar" onclick="enviarValoracion()">Enviar valoración y salir</button>
        <button type="button" class="boton__pagar" id="botonConfirmar" onclick="regresarAProductos()">Regresar a productos</button>
        
        <script src="JS/controllerValoracion.js"></script>
    </div>
 
</body>
</html>