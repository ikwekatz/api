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
    $data=json_decode(file_get_contents("php://input"));
    if(!empty($data->fname) && !empty($data->fname)&& !empty($data->lname) && !empty($data->email) && !empty($data->phone)){
    // inserting data;
    $std->fname=$data->fname;
    $std->lname=$data->lname;
    $std->email=$data->email;
    $std->phone=$data->phone;
    try {
        if ($std->create_data()) {
        http_response_code(200);//
        echo json_encode(array(
        "status"=>1,
        "message"=>"Student has been created Successfull"
        ));   
        } else {
            echo "Failed to insert data.";
        }
    } catch (Exception $e) {
        http_response_code(400);// 
        $sms = $e->getMessage();
        echo json_encode(array(
        "status"=>0,
        "message"=> $sms
        ));  
        
    }

    }else{

        http_response_code(400);// 
        echo json_encode(array(
        "status"=>0,
        "message"=>"All fields are Required"
        ));  
}
    
}else{

        http_response_code(403);// 
        echo json_encode(array(
        "status"=>0,
        "message"=>"Access Denied"
        ));  
}

?>
