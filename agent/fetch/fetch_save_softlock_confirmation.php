<?php
include ('../../database/dbconnect.php');

$data=json_decode(file_get_contents("php://input"),true);
$UserId = $data["UserId"];
$AgentId = $data["AgentId"];
$projectname = $data["projectname"];
$projectskill = $data["projectskill"];

$sql="Update userprojectdetails set status='confirm' where AgentId='$AgentId' and UserId='$UserId';";
$result = $conn->query($sql);

$sql="select ProjectId from project where projectname= '$projectname';";
// var_dump($sql);
$result = $conn->query($sql);
$data1=$result->fetch_assoc();
$projectId=$data1['ProjectId'];

$sql="select fullfill_headcount from projectskilldetails where project='$projectId' and skill='$projectskill';";
// var_dump($sql);
$result = $conn->query($sql);
$data1=$result->fetch_assoc();
$fullfill_headcount=(int)$data1['fullfill_headcount']+1;


$sql="Update projectskilldetails set fullfill_headcount='$fullfill_headcount' where project='$projectId' and skill='$projectskill';";
// var_dump($sql);
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