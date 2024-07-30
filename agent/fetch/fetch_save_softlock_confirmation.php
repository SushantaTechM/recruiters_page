<?php
include ('../../database/dbconnect.php');

$data=json_decode(file_get_contents("php://input"),true);
$UserId = $data["UserId"];
$AgentId = $data["AgentId"];

$sql="Update userprojectdetails set status='confirm' where AgentId='$AgentId' and UserId='$UserId';";
$result = $conn->query($sql);

// $sql="delete from userprojectdetails where UserId='$UserId' and status='softlock';";
// $result = $conn->query($sql);


if($result){
    echo json_encode(["status"=> "success"]);
}
else{
    echo json_encode(["status"=> "error","message"=> $conn->error]);
}

$conn->close();