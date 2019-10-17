<?php
require("Lib.php");


$conexion = new ConnectorDB();

/*{ // Bloque creacrion de Tabla

$nombre_table = 'Usuarios';
$props ['id'] = 'INT';
$props ['nombre'] = 'VARCHAR(45)';
$props ['email'] = 'VARCHAR(20)';
$props ['telefono'] = 'VARCHAR(10)';


  if($conexion->initConetion('inventarios_db')=='OK'){
    $query = $conexion->getNewTableQuery($nombre_table,$props);
    echo "Query es: " . $query;
    if ($conexion->ejecutarQuery($query)) {
      echo "La creacion de la tabla ".$nombre_table." fue exitosa";
    }else {
      echo "Se produjo un error en la creacion de la tabla ".$nombre_table;
    }
    $conexion->cerrarConexion();
  }
  else{
    echo $conexion->initConetion();
  }
}*/

/*{ // Bloque creacion de restriccion
  if($conexion->initConetion('inventarios_db')=='OK')
  {
    if($conexion->newRestriction('Usuarios','ADD PRIMARY KEY (id)')){
      echo "La restriccion se creo correctamente";
    }else {
      echo "Erro en creacion de la restriccion";
    }
  }
}*/

/*{ // Bloque creacion de Relacion
  if($conexion->initConetion('inventarios_db')=='OK')
  {
    if($conexion->newRelation('usuarios','ciudades','fk_ciudad','id')){
      echo "La Relacion se creo correctamente";
    }else {
      echo "Erro en creacion de la relacion";
    }
  }
}*/

/*{ // Bloque para insertar datos

  $data ['email'] = "Carolcarol.com";
  $data ['fk_ciudad'] = 1;
  $data ['id'] = 1;
  $data ['nombre'] = "Carol";
  $data ['telefono'] = "321212121";

  if ($conexion->initConetion('inventarios_db')=='OK'){
    if ($conexion->insertData('usuarios',$data)) {
      echo "Se agrego la informacion correctamente";
    }else {
      echo "Error agregando la informacion";
    }
    $conexion->cerrarConexion();
  }else {
    echo "Error de conexion a a base de datos";
  }
}*/

/*{//Bloque Prepare sentencia SQL
  if ($conexion->initConetion('inventarios_db')=='OK'){
    $conn= $conexion->getConection();
    $insert = $conn->prepare('INSERT INTO usuarios (id,nombre,email,telefono,fk_ciudad) VALUES (?,?,?,?,?)');
    $insert->bind_param("isssi",$id,$nombre,$email,$telefono,$fk_ciudad);

    $id = 2;
    $nombre = "Luis D";
    $email = "LuisD@gmail.com";
    $telefono = "32121215";
    $fk_ciudad = 1;

    $insert->execute();

    $id = 3;
    $nombre = "Martin D";
    $email = "Martin@gmail.com";
    $telefono = "74185963";
    $fk_ciudad = 1;

    $insert->execute();
    echo "Se agregaron los datos correctamente";

    $conn->cerrarConexion();
  }else {
    echo "Error en la conexion";
  }
}*/

/*{//Bloque actualizacion de registros
  if ($conexion->initConetion('inventarios_db')=='OK'){
    $data['nombre'] = "'Jose Luis '";
    $data['telefono'] = "'9658745'";
    if($conexion->actualizarRegistro('usuarios',$data,'id=2')){
      echo "Se han actualizado los datos";
    }else {
      echo "Se produjo un error en la actualizacion de los datos";
    }
    $conexion->cerrarConexion();
  }else {
    echo "Se presento un error en la conexion a la base de datos";
  }
}*/

/*{//Bloque para eliminar los registros
  if ($conexion->initConetion('inventarios_db')=='OK'){

    if($conexion->EliminarRegistro('usuarios',"telefono LIKE '7%'")){
      echo "Se han Eliminado los datos con exito";
    }else {
      echo "Se produjo un error en la eliminacion de los datos";
    }
    $conexion->cerrarConexion();
  }else {
    echo "Se presento un error en la conexion a la base de datos";
  }
}*/

{//Bloque de consultas
  if ($conexion->initConetion('inventarios_db')=='OK'){
    if ($resultado = $conexion->ConsultaDB(['usuarios'],['*'])){
      while ($fila = $resultado->fetch_assoc()){
        echo $fila['id']." ".$fila['nombre']." ".$fila["email"]." ".$fila["telefono"]." ".$fila["fk_ciudad"]."</br>";
      }
    }else {
      echo "Error al realizar la consulta especificada";
    }
    $conexion->cerrarConexion();
  }else {
    echo "Erro conexioon base de datos";
  }
}
?>
