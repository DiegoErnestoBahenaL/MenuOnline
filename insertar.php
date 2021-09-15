<?php

 $servername = "localhost";
$database = "u696248240_tibeApp";
$username = "u696248240_adminTibe";
$password = "!#remNu8";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    $nombre = $_POST['nombre'];

    $sql = "insert into cliente (id, nombre) values ( NULL, '$nombre')";
    echo mysqli_query($conn, $sql);
?>