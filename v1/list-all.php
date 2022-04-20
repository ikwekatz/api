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
    $data=$std->get_all_std();
    if(count($data)>0){
        $stdnt['records']=array();
        foreach($data as $row){
            array_push($stdnt['records'], array(
                "No."=>$row['id'],
                "First name"=>$row['fname'],
                "Last name"=>$row['lname'],
                "Email"=>$row['email'],
                "Phone"=>$row['mobile'],
                "Status"=>$row['status'],
                "Created At"=>date("Y-m-d", strtotime($row['created_at']))
            ));
        }
        http_response_code(200);
        echo json_encode(array(
            "status"=>1,
            "data"=>$stdnt['records']
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
