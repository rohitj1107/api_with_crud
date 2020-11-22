<?php

class Database {
  private $hostname;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  function connect(){
    $this->hostname = 'localhost';
    $this->username = 'root';
    $this->password = '';
    $this->dbname = 'rest_api';

    $this->conn = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);

    if ($this->conn->connect_errno) {
      print_r($this->conn->cnnect_error);
      exit;
    } else {
      return $this->conn;
    }
  }
}

// $db = new Database;
// $db->connect();

?>
