<?php
include ('../../database/dbconnect.php');

$data=json_decode(file_get_contents("php://input"),true);
$UserId = $data["UserId"];
$AgentId = $data["AgentId"];
$projectId = $data["projectId"];

$sql="INSERT INTO `userprojectdetails` (`SlNo`, `Status`, `UserId`, `AgentId`, `ProjectId`) VALUES (NULL, 'softlock', '$UserId', '$AgentId', '$projectId');";
// var_dump($sql);
$result = $conn->query($sql);

if($result){
    echo json_encode(["status"=> "success"]);
}
else{
    echo json_encode(["status"=> "error","message"=> $conn->error]);
}

$conn->close();