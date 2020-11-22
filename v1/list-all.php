<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

include_once("../config/database.php");
include_once("../class/student.php");

$db = new Database;
$connection = $db->connect();

$student = new Student($connection);
if ($_SERVER['REQUEST_METHOD'] === "GET") {

  $data = $student->get_all_data();
  
  if ($data->num_rows > 0) {
    $studenta["records"] = array();
    while ($row = $data->fetch_assoc()) {
      array_push($studenta["records"],array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "mobile" => $row['mobile']
      ));
    }
    http_response_code(200);
    echo json_encode(array('status'=>1,'message'=>$studenta));
  }

} else {
  http_response_code(503);
  echo json_encode(array('status'=>0,'message'=>'Access Denied'));
}
?>
