<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$AgentId = $data['AgentId'];

$sql="SELECT p.ProjectId,p.ProjectName FROM project p WHERE p.status = 'active' GROUP BY p.ProjectName;";


$result = $conn->query($sql);
// var_dump($result);

if($result){
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
            // echo $response;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else {
        echo json_encode(["status"=>"nodata"]);
    }
}
else{
    echo json_encode(["status"=>"error"]); 
}



