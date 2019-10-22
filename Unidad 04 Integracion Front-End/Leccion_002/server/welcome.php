<?php
  session_start();
  require('conector.php');


  if(isset($_SESSION['username'])) {
    $con = new conexionDB ('localhost','NextU','NextU');
    if ($con->initConexion('transporte_db')=='OK') {
      $resultado = $con->consultar(['usuarios'],['nombre','id'], "WHERE email = '".$_SESSION['username']."'");
      $fila = $resultado->fetch_assoc();
      $response ['nombre'] = $fila['nombre'];

      $resultado = $con->getViajesUser($fila['id']);
      $i=0;
      while($fila = $resultado->fetch_assoc()){
        $response['infoViajes'][$i]['ciudad_origen'] = $fila['ciudad_origen'];
        $response['infoViajes'][$i]['ciudad_destino'] = $fila['ciudad_destino'];
        $response['infoViajes'][$i]['placa'] = $fila['placa'];
        $response['infoViajes'][$i]['fabricante'] = $fila['fabricante'];
        $response['infoViajes'][$i]['referencia'] = $fila['referencia'];
        $response['infoViajes'][$i]['fecha_salida'] = $fila['fecha_salida'];
        $response['infoViajes'][$i]['fecha_llegada'] = $fila['fecha_llegada'];
        $response['infoViajes'][$i]['hora_salida'] = $fila['hora_salida'];
        $response['infoViajes'][$i]['hora_llegada'] = $fila['hora_llegada'];
        $i++;
      }
      $response['msg'] = "OK";
    }else {
      $response['msg'] = "No se pudo conectar a la base de datos";
    }
  }else {
    $response['msg'] = "no se ha iniciado session";
    //$response['msg'] = $_SESSION;
  }
  echo json_encode($response);
?>
