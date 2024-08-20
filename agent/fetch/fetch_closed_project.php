<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$AgentId = $data['AgentId'];


$sql="SELECT p.ProjectId, p.ProjectName, GROUP_CONCAT(DISTINCT sm.SkillName SEPARATOR ', ')AS SkillNames, GROUP_CONCAT(DISTINCT CONCAT(ud.FirstName, ' ', ud.LastName) SEPARATOR ', ') AS Users FROM project p JOIN skillmaster sm ON sm.SkillId=sm.SkillId LEFT JOIN userprojectdetails upd ON p.ProjectId = upd.ProjectId AND sm.SkillId=upd.SkillId LEFT JOIN userdetails ud ON ud.UserId=upd.UserId WHERE p.status='closed' GROUP BY p.ProjectId,p.ProjectName ;";

$result = $conn->query($sql);

if($result){
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else {
        echo json_encode(["status"=>"nodata"]);
    }
}else{
    echo json_encode(["status"=>"error"]); 
}



