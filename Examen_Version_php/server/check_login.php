<?php
 session_start();

  require ('ConexionDataBase.php');

  $pass = $_POST['password'];
  $response['conexion'] = "";
  // validacion del email y verificacion de password vacio
  if (($email = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) && !empty($pass)){
    // si la condicion se cumple se inicia la conexion al servidor mediante las clase ConectionDB.
    $conection = new ConectionDB('localhost','root','');
    $response['conexion'] = $conection -> InitConection('agenda');
    if ($response['conexion'] == 'Conexion OK') {
      // se valida que la comunicacion se realizo de manera correcta y se procede a validar los datos ingresados en los campos usuario y password_verify
      // se realiza a consulta de la tabla usuario en todos los campos que el email sea igual al parametro de ingreso.
      $dataResult = $conection -> queryDB(['Usuarios'],['*'],'email="' .$email.'"');
      if ($dataResult -> num_rows != 0) {
        while ($fila = $dataResult -> fetch_assoc()) {
          // Se recorre el arreglo de respuesta y se asocia en la variable $fila
          $hashpass = $fila['pass'];
          $user = $fila;
        }
        if (password_verify($pass, $hashpass)) {
          // Se valida que la contraseña copincida con el hash guardado en la base de datos
          $_SESSION['isLogin'] = true;
          $_SESSION['userloged'] = $user;
          $response['msg'] = 'Conexion OK';
        } else
          $response['msg'] = 'Contraseña incorrecta';
      }else
        $response['msg'] = "El usuario no existe en la base de datos";
    }else
      $response['msg']= "Error en la conexion a la base de datos";
    $conection ->cerrarConexion();
  }else
    $response['msg'] = "Los datos ingresados no coinciden con la informacion en la base de datos";

  echo json_encode($response);

?>
