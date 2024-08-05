<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$projectid = $data['projectid'];

$sql="Select StartDate,EndDate from project where ProjectId='$projectid';";
$result = $conn->query($sql);

$row=$result->fetch_assoc();
$StartDate=$row['StartDate'];
$EndDate=$row['EndDate'];

header('Content-Type: application/json');
echo json_encode(['StartDate'=>$StartDate,
                    'EndDate'=>$EndDate]);

$conn->close();