<?php
  // se crea la clase ConectionDB basado en los ejercicios realizados en el oci_new_cursor
  // en esta clase se crean los metodos para inciar conexion y realizar acciones en la base de datos.

  /**
   * Clase ConectionDB
   */
  class ConectionDB
  {
    // Atriutos de la clase
    private $host;
    private $user;
    private $pass;
    private $DataBase;
    private $conexion;

    function __construct($host,$user,$pass){
      // se inicializan los atributos en el metodo constructor de la clase
      $this -> host = $host;
      $this -> user = $user;
      $this -> pass = $pass;
    }

    function InitConection($DataBase){
      $this -> conexion = new mysqli($this->host,$this->user,$this->pass,$DataBase);
      if ($this->conexion->connect_error) {
        // si la conexion al servidor o a la base de datos reportan alguna falla o anamalia se envia codigo de error
        return "Error:" . $this->conexion->connect_error;
      }else {
        // La conexion es exitosa
        return "Conexion OK";
      }
    }

    function getConexion() {
      // Este metodo se utiliza para validar el estado de la conexion
  		return $this -> conexion;
  	}

    function ejecutarQuery($query) {
      // Funcion para ejecutar las consultas a la base de datos
  		return $this -> conexion -> query($query);
  	}

    function cerrarConexion(){
      // Se cierra la conexion establecida en la funcion init conection
      $this -> conexion -> close();
    }

    function insertInfoDB($tabla,$data){
      //DEclaracion de la sentencia para agregar informacion en la tabla recibida por parametro
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      // se crea la sentencia para la estructura de las columnas que se agregara informacion
  		foreach ($data as $key => $value) {
  			$sql .= $key;
  			if ($i < count($data)) {
  				$sql .= ', ';
  			} else
  				$sql .= ')';
  			$i++;
  		}
      // se agrega a la sentencia datos que se agregara a las columnas mencionadas anteriormente
  		$sql .= ' VALUES (';
  		$i = 1;
  		foreach ($data as $key => $value) {
  			$sql .= "'" . $value . "'";
  			if ($i < count($data)) {
  				$sql .= ', ';
  			} else
  				$sql .= ');';
  			$i++;
  		}
  		return $this -> ejecutarQuery($sql);
    }

    function actualizarRegistro($tabla, $data, $condicion) {
      // creaciòn de la sentencia para actuaizar datos en la base de datos
      $sql = 'UPDATE ' . $tabla . ' SET ';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key . '="' . $value. '"';
        if ($i < sizeof($data)) {
          $sql .= ', ';
        } else
          $sql .= ' WHERE ' . $condicion . ';';
        $i++;
      }
      return $this -> ejecutarQuery($sql);
    }

    function DeleteData($tabla, $condicion) {
      // Sentencia para eliminacion de informacion en la tabla recibida
  		$sql = 'DELETE FROM ' . $tabla . ' WHERE ' . $condicion . ';';
  		return $this -> ejecutarQuery($sql);
  	}

    function queryDB($tablas,$campos,$condicion =""){
      // Sentencia para realizar consultas en la db
      $sql = "SELECT ";
  		$a = array_keys($campos);
  		$ultima_key = end($a);
  		foreach ($campos as $key => $value) {
  			$sql .= $value;
  			if ($key != $ultima_key) {
  				$sql .= ", ";
  			} else
  				$sql .= " FROM ";
  		}
  		$b = array_keys($tablas);
  		$ultima_key = end($b);
  		foreach ($tablas as $key => $value) {
  			$sql .= $value;
  			if ($key != $ultima_key) {
  				$sql .= ", ";
  			} else
  				$sql .= " ";
  		}
  		if ($condicion == "") {
  			$sql .= ";";
  		} else {
  			$sql .= ' WHERE ' . $condicion . ";";
  		}
  		return $this -> ejecutarQuery($sql);
    }

  }

?>
