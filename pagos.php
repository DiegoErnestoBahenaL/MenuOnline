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

    <h1 class="pedidoHeader">Pagos</h1>
    
   <div class="botonesPagos">

        <button type="button" class="boton__dividir" id="botonDividir" onclick="dividirProductos()">Dividir Productos</button>
        <button type="button" class="boton__pagar" id="botonMiCuenta" onclick="mostrarProductosPedidos()"> Pagar mi cuenta</button>
       
        <script src="JS/controllerNavegacionPago.js"></script>
    </div>
   
    <div class="areaPago" id="areaPago">  
        
        
        <div class="productosDelComensal" id="productosDelComensal" style="visibility: hidden;">
            <h3 class="pedidoHeader">Productos Pedidos</h3>
        </div>
        
    </div>
   
    <div class="botonesPagar" id="botonesPagar">
           <!-- <select id="metodoDePago" class="metodoDePago botonesPago" required>
                <option selected="true" value="0" disabled>Selecciona un método de pago</option>    
                <option value="1">Efectivo</option>
                <option value="2">Débito/Crédito</option>
            </select>

            <input type="number" id="propina" class="propina botonesPago" placeholder="Propina">

            <button type="button" class="boton__confirmar botonesPago" id="botonConfirmar" onclick="confirmarPago()">Confirmar Pago</button>
            -->
            
            <script src="JS/controllerNavegacionPago.js"></script> 

    </div> 

    <div class="botonesDividir" id="botonesDividir" >
        <div class="comensalesEnMesa" id="comensalesEnMesa">

        </div>

        <!-- <button type="button" class="boton__confirmar" id="botonConfirmar" onclick="confirmarDividirProductos()">Confirmar División</button> -->

        <script src="JS/controllerNavegacionPago.js"></script>


    </div>


</body>
</html>