<?php
include ('../../database/dbconnect.php');

$data=json_decode(file_get_contents("php://input"),true);
$UserId = $data["UserId"];
$AgentId = $data["AgentId"];
$projectId = $data["projectId"];

$sql="INSERT INTO `userprojectdetails` (`SlNo`, `Status`, `UserId`, `AgentId`, `ProjectId`) VALUES (NULL, 'confirm','$UserId', '$AgentId', '$projectId');";
$result = $conn->query($sql);
if(!$result){
    echo json_encode(["status"=> "error","message"=> $conn->error]);
}

$sql="Delete from `userprojectdetails` where AgentId='$AgentId' And UserId='$UserId' And status='softlock'";
$result = $conn->query($sql);
if($result){
    echo json_encode(["status"=> "success"]);
}
else{
    echo json_encode(["status"=> "error","message"=> $conn->error]);
}

$conn->close();