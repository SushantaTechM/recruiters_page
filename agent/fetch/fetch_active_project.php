<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$AgentId = $data['AgentId'];

$sql="SELECT p.ProjectId,p.ProjectName,sm.SkillName,GROUP_CONCAT(CONCAT(ud.FirstName, ' ', ud.LastName) SEPARATOR ', ') AS Users FROM project p JOIN userprojectdetails upd ON p.ProjectId = upd.ProjectId JOIN skillmaster sm ON sm.SkillId = upd.SkillId JOIN userdetails ud ON ud.UserId = upd.UserId WHERE p.status = 'active' GROUP BY p.ProjectName, sm.SkillName;";

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
}
else{
    echo json_encode(["status"=>"error"]); 
}



