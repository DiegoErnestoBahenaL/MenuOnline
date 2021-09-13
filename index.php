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


</head>




<body>
    <header>
        <div class="encabezado">
               <h1>Menú Online</h1>
        </div>
     
    </header>
    <section class="logoRestaurante">

        <?php
            $nombreRestaurante = $_GET["restaurante"];
            print "<img class="."logoRestaurante__imagen"." src="."img/".$nombreRestaurante.".png"." alt="."Logo"." >";
        ?>
        
        <div class="logoRestaurante__texto"> 
            <h2>¡Te damos la Bienvenida!</h2>
        </div>
        


    </section>

    <form class="formulario" action="" >
        <fieldset>
            <legend> Ingresa tu información</legend>
            <div class="inputs">
                <div class="inputs__campo">
                    <label>Nombre</label>
                    <input class="inputs__campo"  type="text" >
                </div>
                <div class="inputs__campo">
                    <label>Numero de Mesa</label>
                    <input class="inputs__campo" type="number" >
                </div>
                <div >
                    <input class="inputs__enviar" type="submit" placeholder="Enviar">
                </div>

            
            </div>
            
        </fieldset>
        

    </form>

    <footer>

        <div class="footer">
            <p>Proporcionado por DALTY's Food</p>
        </div>

    </footer>
    
</body>
</html>