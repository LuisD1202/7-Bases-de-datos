<?php
session_start();

require ('conectorBD.php');

$pass = $_POST['password'];
$response['conexion'] = 'Sin conexión';

if (($email = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) && !empty($pass)) {
	$con = new ConectorBD('localhost', 'root', '');
	$response['conexion'] = $con -> initConexion('agenda');
	if ($response['conexion'] == 'OK') {
		$resultado = $con -> consultar(['Usuarios'], ['*'], 'email="' . $email . '"');
		if ($resultado -> num_rows != 0) {
			while ($fila = $resultado -> fetch_assoc()) {
				$hashpass = $fila['pass'];
				$userResult = $fila;
			}
			if (password_verify($pass, $hashpass)) {
				$_SESSION['isLogin'] = true;
				$_SESSION['userLogin'] = $userResult;
				$response['msg'] = 'OK';
			} else
				$response['msg'] = 'Contraseña incorrecta';
		} else
			$response['msg'] = 'El usuario no existe ';
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
	$con -> cerrarConexion();
} else
	$response['msg'] = 'Datos incorrectos';

echo json_encode($response);
?>