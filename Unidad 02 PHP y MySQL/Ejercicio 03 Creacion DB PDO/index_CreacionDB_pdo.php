<?php
require("acces.php");
try {
    $conexion = new PDO('mysql:host='.$host.";",$user,$pass);
    $sql = 'CREATE DATABASE inventarios_db';
    $conexion->exec($sql);
    echo "Se creo la base de datos";
    }
    catch(PDOException $e) {
      print "Error: " .$e->getMessage()."<br>";
      die();
    }
?>
