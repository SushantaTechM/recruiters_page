<?php
include ('../../database/dbconnect.php');

$data=json_decode(file_get_contents("php://input"),true);
$UserId = $data["UserId"];
$AgentId = $data["AgentId"];
$projectId = $data["projectId"];
$skillId = $data["skillId"];
$startDate = $data["startDate"];
$endDate = $data["endDate"];


$sql="INSERT INTO `userprojectdetails` (`SlNo`, `Status`, `UserId`, `AgentId`, `ProjectId`,`SkillId`,`StartDate`,`EndDate`) VALUES (NULL, 'softlock', '$UserId', '$AgentId', '$projectId','$skillId','$startDate','$endDate');";

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
        "agentname"=>$agentname,
        "skillId"=>$skillId

    ]);
}
else{
    echo json_encode(["status"=> "error","message"=> $conn->error]);
}

$conn->close();