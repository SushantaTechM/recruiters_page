<?php
include ('../../database/dbconnect.php');


$sql="Select * from project;";
$result = $conn->query($sql);

$project=[];
while($row=$result->fetch_assoc()){
    $project[]=$row;
}

header('Content-Type: application/json');
echo json_encode(['projects'=>$project]);

$conn->close();