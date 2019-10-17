<?php
require("acces.php");
$conexion = new mysqli($host,$user,$pass);

    if($conexion->connect_error){
      echo "Error de coneccion " .$mysqli->connect_error;
    }

    $sql = 'CREATE DATABASE ventas_db';
    if ($conexion->query($sql)== TRUE) {
      echo "Se creo la base de datos";
    }else {
      echo "Se presento un eeror en la creacion " .$conexion->error;
    }
?>
