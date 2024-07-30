<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$UserId = $data['UserId'];
$AgentId= $data['AgentId'];

$sql="delete from userprojectdetails where UserId='$UserId' and AgentId='$AgentId';";
$result = $conn->query($sql);

if(!$result){
    echo json_encode(["status"=>"error"]); 
}

else{
    echo json_encode(["status"=>"success"]);
}
// var_dump($response);





