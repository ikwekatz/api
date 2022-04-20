<?php
include_once('../config/database.php');
include_once('../classes/student.php');
// including headers
header("Access-Control-Allow-Origin:*"); //Allow only the same origin
header("Content-type: application/json; charset: UTF-8"); // data getting inside request
header("Access-Control-Allow-Method: GET"); // Allow Method type


// create object for db connection
$db=new Database();

$connect=$db->connect();

// creating student now

$std= new Student($connect);

if($_SERVER['REQUEST_METHOD']=="GET"){

    $std_id=isset($_GET['id'])?($_GET['id']):"";
    if(!empty($std_id)){
        $std->id=$std_id;
        if($std->delite_std()){
            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "message"=>"Student with id ".$std->id." Successful Deleted"
            ));
        }else{
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message"=>"Failed to delete student with id ".$std->id
            ));
        }

    }else{
        http_response_code(404);
        echo json_encode(array(
            "status"=>0,
            "message"=>"All data required"
        ));
    }

}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=>"Access Denied"
    ));

}

