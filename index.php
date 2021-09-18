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

    <script src="JS/jquery-3.6.0.min.js"></script>

</head>




<body>
    <header>
        <div class="encabezado">
               <h1>Menú Online</h1>
        </div>
     
    </header>
    <section class="logoRestaurante">

        <?php
            error_reporting(E_ERROR | E_PARSE);
            $nombreRestaurante = $_GET['restaurante'];
        
            if (isset($_GET['restaurante']))
            { 
                $restaurante = $_GET['restaurante'];
                
                include ("../apiLogin/daltysConexion.php");
                $conn = connectDaltys();
            
            
                $query = "select imagen from Restaurante where idRestaurante=$restaurante";
               

                $resultado = mysqli_query($conn, $query) or die ("Algo fallo");

                while ($fila=mysqli_fetch_array($resultado)){
                 
                    $imagen = $fila['imagen'];
                }

                print '<img class="logoRestaurante__imagen" src="data:image/jpeg;base64,'. base64_encode($imagen) .'"/>'; 

            }
            else 
            {
                print "<img class="."logoRestaurante__imagen"." src="."img/DaltysLogo.png"." alt="."Logo"." >";

            }
        ?>
        
        <div class="logoRestaurante__texto"> 
            <h2>¡Te damos la Bienvenida!</h2>
        </div>
        


    </section>

    <form id="formAJAX" action="list.php"  method="POST">
       
        <div class="formulario">

        
            <fieldset>
                <legend> Ingresa tu información</legend>
                <div class="inputs">
                    <div class="inputs__campo">
                        <label>Nombre</label>
                        <input id="nombre" name="nombre" class="inputs__campo"  type="text" required >
                    </div>
                    <div class="inputs__campo">
                        <label>Numero de Mesa</label>
                        <input id="mesa" name="mesa" class="inputs__campo" type="number" required>
                    </div>
                    <div >

                        <input type="submit" class="inputs__enviar" placehoder="Enviar">
                     </div>

                
                </div>
                
            </fieldset>
        </div>

    </form>

    <footer>

        <div class="footer">
            <p>Proporcionado por DALTY's Food</p>
        </div>

    </footer>
    
</body>
</html>
<script>


</script>