<?php
include('../../database/dbconnect.php');

$projectId = isset($_GET['projectId']) ? $_GET['projectId'] : '';

if ($projectId) {
    $sql = "SELECT p.ProjectId, p.ProjectName, sm.SkillName, GROUP_CONCAT(CONCAT(ud.FirstName, ' ', ud.LastName) SEPARATOR ', ') AS Users FROM project p JOIN projectskilldetails psd ON p.ProjectId = psd.project JOIN skillmaster sm ON sm.SkillId = psd.skill LEFT JOIN userprojectdetails upd ON p.ProjectId = upd.ProjectId AND sm.SkillId = upd.SkillId LEFT JOIN userdetails ud ON ud.UserId = upd.UserId WHERE p.ProjectId ='$projectId' GROUP BY p.ProjectName, sm.SkillName";


    $result = $conn->query($sql);
    $response = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "Project not found"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Project Id not provided"]);
}

?>