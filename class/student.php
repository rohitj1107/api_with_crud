<?php
class Student{
  public $name;
  public $email;
  public $number;
  public $id;

  private $conn;
  private $table_name;


  public function __construct($db){
    $this->conn = $db;
    $this->table_name = 'tbl_student';
  }

  public function create(){
    $query = "INSERT INTO ". $this->table_name ." SET name = ?, email = ?, mobile = ?";

    $obj = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->mobile = htmlspecialchars(strip_tags($this->mobile));

    $obj->bind_param("sss",$this->name,$this->email,$this->mobile);

    if ($obj->execute()) {
        return true;
    }
    return false;
  }

  function get_all_data(){
    $query = "SELECT * FROM ". $this->table_name;
    $std_obj = $this->conn->prepare($query);
    $std_obj->execute();
    return $std_obj->get_result();
  }

  function get_single_student(){
    $sql = "SELECT * FROM ".$this->table_name." WHERE id = ? ";
    $obj = $this->conn->prepare($sql);
    $obj->bind_param("i",$this->id);
    $obj->execute();
    $data = $obj->get_result();
    return $data->fetch_assoc();
  }

  function student_update(){
    $sql = "UPDATE ".$this->table_name." SET name = ? , email = ? , mobile = ? WHERE id = ?";
    $obj = $this->conn->prepare($sql);
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->mobile = htmlspecialchars(strip_tags($this->mobile));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $obj->bind_param("sssi",$this->name,$this->email,$this->mobile,$this->id);
    if ($obj->execute()) {
      return true;
    }
    return false;
  }

  function student_delete(){
    $sql = "DELETE from " .$this->table_name." WHERE id = ? ";
    $obj = $this->conn->prepare($sql);
    $this->id = htmlspecialchars(strip_tags($this->id));
    $obj->bind_param("i",$this->id);
    if ($obj->execute()) {
      return true;
    }
    return false;
  }
}

?>
