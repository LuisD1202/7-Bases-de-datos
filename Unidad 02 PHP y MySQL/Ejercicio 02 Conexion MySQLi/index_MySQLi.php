<?php
try {
    $conexion = new mysqli('localhost','NextU','NextU','prueba');
    if($mysqli->connect_errno){
      echo "Error de coneccion " .$mysqli->connect_error;
    }
    $mysqli->close();
?>
