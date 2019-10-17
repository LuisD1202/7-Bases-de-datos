<?php
try {
    $conexion = new PDO('mysql:host=localhost;dbname=prueba','NextU','NextU');
    echo "Conexion Exitosa";
} catch (PDOException $e) {
  print "Error: " .$e->getMessage()."<br>";
  die();
}

?>
