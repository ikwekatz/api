<?php
include_once('../config/database.php');
include_once('../classes/student.php');
// including headers
header("Access-Control-Allow-Origin:*"); //Allow only the same origin
header("Content-type: application/json; charset: UTF-8"); // data getting inside request
header("Access-Control-Allow-Method: POST"); // Allow Method type 


// create object for db connection
$db=new Database(); 

$connect=$db->connect();

// creating student now

$std= new Student($connect);

if($_SERVER['REQUEST_METHOD']=="POST"){
   $param=json_decode(file_get_contents("php://input"));
   if(!empty($param->id)){
      $std->id=$param->id;
      $std_data=$std->get_single_std();
      if(!empty($std_data)){
      http_response_code(200);
        echo json_encode(array(
            "status"=>1,
            "data"=>$std_data
        ));
        }else{
          http_response_code(404);
          echo json_encode(array(
            "status"=>0,
            "Message"=>"Student with the id ". $std->id." not found"
        ));
      }
}
}else{

    http_response_code(403);// 
        echo json_encode(array(
        "status"=>0,
        "message"=>"Access Denied"
        ));  
}

?>
