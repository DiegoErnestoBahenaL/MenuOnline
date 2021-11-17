 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dalty's Menu Online</title>


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

    <!-- Jquery -->

    

</head>




<body>
    <div class="wrapper">

    
        <header>
            <div class="encabezado">
                <h1>Menú Online</h1>
            </div>
        
        </header>

        <div class="contenido">
        <section class="logoRestaurante">

            <?php
                session_start();
                
                error_reporting(E_ERROR | E_PARSE);
                $nombreRestaurante = $_GET['restaurante'];
            
                if (isset($_GET['restaurante']))
                { 
                    $restaurante = $_GET['restaurante'];
                    global $nombre;
                    include ("../apiLogin/daltysConexion.php");
                    $conn = connectDaltys();
                
                
                    $query = "select r.imagen, u.nombreUsuario, u.contrasena from Usuario u 
                    inner join Cliente c on u.idCliente = c.idCliente
                    INNER JOIN Restaurante r on r.idRestaurante = c.idRestaurante where u.idUsuario = $restaurante";
                

                    $resultado = mysqli_query($conn, $query) or die ("Algo fallo");

                    while ($fila=mysqli_fetch_array($resultado)){
                    
                        $imagen = $fila['imagen'];
                        $nombre = $fila['nombreUsuario'];
                        $password = $fila['contrasena'];
                     
                    }


                    $_SESSION['PASSWORD'] = $password;

                   

                    print '<img class="logoRestaurante__imagen" src="data:image/jpeg;base64,'. base64_encode($imagen) .'"/>'; 
                    mysqli_close($conn);

                    
               
                ?>    
            <div class="logoRestaurante__texto">
                <h2>¡Te damos la Bienvenida!</h2>
            </div>
            


            </section>
          
             <div id="formAJAX">
            
                <div class="formulario">

                
                    <fieldset>
                        <legend> Ingresa tu información</legend>
                        <div class="inputs">
                            <div class="inputs__campo">
                                <label>Nombre</label>
                                <input id="nombre" class="inputs__campo"  type="text" required >
                            </div>
                            <div class="inputs__campo">
                                <label>Numero de Mesa</label>
                                <input id="idMesa" class="inputs__campo" type="number" required>
                            </div>
                            <div >
                                <?php
                                    print  '<input type="hidden" id="restaurante" name="restaurante" value="'.$nombre.'" >';
                                ?>
                                 
                            <button id="btn-enviar" type="button" onclick="enviar()" class="inputs__enviar">Enviar</button>
                            </div>

                        
                        </div>
                        
                    </fieldset>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="JS/controllerComensal.js"></script>

               
               
               
               <?php } else 
                {
                    print "<img class="."logoRestaurante__imagen"." src="."img/DaltysLogo.png"." alt="."Logo"." >";

                }
            ?>
           
        <footer>

            <div class="container">
                <p>Proporcionado por DALTY's Food</p>
            </div>

        </footer>


    </div>
</body>
</html>
<script>


</script>