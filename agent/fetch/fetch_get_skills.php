<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$projectid = $data['projectid'];


$sql="Select * from skillmaster sm join projectskilldetails psd on psd.skill=sm.SkillId where psd.project='$projectid';";

$result = $conn->query($sql);

$skill=[];
while($row=$result->fetch_assoc()){
    $skill[]=$row;
}

header('Content-Type: application/json');
echo json_encode(['skills'=>$skill]);

$conn->close();