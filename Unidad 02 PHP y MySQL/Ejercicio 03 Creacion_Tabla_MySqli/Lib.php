<?php
  /**
   * CLASE DE CREACION Y CONEXION
   */
  class ConnectorDB
  {
    private $host = "localhost";
    private $user = "NextU";
    private $pass = "NextU";
    private $Conexion;

    function initConetion($nombre_DB){
      // code...
      $this->Conexion = new mysqli($this->host,$this->user,$this->pass,$nombre_DB);
      if($this->Conexion->connect_error){
        echo "Error de coneccion " .$this->Conexion->connect_error;
      }else {
        return "OK";
      }
    }
    function getNewTableQuery($nombre_tbl,$campos){
      $sql = 'CREATE TABLE '.$nombre_tbl.'(';
      $length_array = count($campos);
      $i=1;
      foreach ($campos as $key => $value) {
        $sql .=$key.' '.$value;
        if ($i != $length_array) {
          $sql.=', ';
        }else {
          $sql .= ');';
        }
        $i++;
      }
      return $sql;
    }
    function ejecutarQuery($query){
      return $this->Conexion->query($query);
    }
    function cerrarConexion(){
      $this->Conexion->close();
    }
    function newRestriction($table,$restriction){
      $sql = 'ALTER TABLE '.$table. ' ' .$restriction;
      if ($this->ejecutarQuery($sql)) {
          return true;
        }else {
          return false;
        }
    }
    function newRelation($From_table,$To_Table,$From_Field,$To_Field){
      $sql = 'ALTER TABLE '.$From_table. ' ADD FOREIGN KEY ('.$From_Field.') REFERENCES '.$To_Table. '('.$To_Field.'); ';
      echo "Sentencia Query ".$sql;
      if ($this->ejecutarQuery($sql)) {
          return true;
        }else {
          return false;
        }
    }
    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i =1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i <count($data)) {
          $sql.=', ';
        }else {
          $sql .= ')';
        }
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= "'".$value."'";
        if ($i <count($data)) {
          $sql.=', ';
        }else {
          $sql .= ');';
        }
        $i++;
      }
      echo "Sentencia: ".$sql;
      return $this->ejecutarQuery($sql);
    }
    function getConection(){
      return $this->Conexion;
    }
    function actualizarRegistro($tabla,$data,$condicion){
      $sql= 'UPDATE '.$tabla.' SET ';
      $i=1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i<sizeof($data)) {
          $sql .= ', ';
        }else {
          $sql .= 'WHERE '.$condicion.';';
        }
        $i++;
      }
      echo "Sentencia Actualizacion datos ".$sql;
      return $this->ejecutarQuery($sql);
    }
    function EliminarRegistro($tabla,$condicion){
      $sql = 'DELETE FROM '.$tabla.' WHERE '.$condicion.";";
      return $this->ejecutarQuery($sql);


    }

    function ConsultaDB($tabla,$campo,$condicion=""){
      $sql = "SELECT ";
      $a = array_keys($campo);
      $ultima_key = end($a);
      foreach ($campo as $key => $value) {
        $sql .= $value;
        if ($key != $ultima_key) {
          $sql.=", ";
        }else {
          $sql .=" FROM ";
        }
      }
      $b = array_keys($tabla);
      $ultima_key = end($b);
      foreach ($tabla as $key => $value) {
        $sql .= $value;
        if ($key != $ultima_key) {
          $sql.=", ";
        }else {
          $sql .=" ";
        }
      }
      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      echo "Sentencia de consulta ".$sql;
      return $this->ejecutarQuery($sql);
    }
  }

?>
