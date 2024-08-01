<?php
include ('../../database/dbconnect.php');

$data=json_decode(file_get_contents("php://input"),true);
$UserId = $data["UserId"];
$AgentId = $data["AgentId"];
$projectId = $data["projectId"];

$sql="INSERT INTO `userprojectdetails` (`SlNo`, `Status`, `UserId`, `AgentId`, `ProjectId`) VALUES (NULL, 'softlock', '$UserId', '$AgentId', '$projectId');";
$result = $conn->query($sql);

$sql="Select * from `project` where `ProjectId`='$projectId';";
$result1 = $conn->query($sql);
$data=$result1->fetch_assoc();
$projectname=$data['ProjectName'];

$sql="Select * from `users` where `UserId`='$AgentId';";
$result1 = $conn->query($sql);
$data=$result1->fetch_assoc();
$agentname=$data['UserName'];

if($result){
    echo json_encode([
        "status"=> "success",
        "projectname"=>$projectname,
        "agentname"=>$agentname
    ]);
}
else{
    echo json_encode(["status"=> "error","message"=> $conn->error]);
}

$conn->close();