<?php
include ('../../database/dbconnect.php');

$projectId = isset($_GET['projectId'])?$_GET['projectId']:'';

if($projectId){
    $sql="SELECT p.ProjectName,
     GROUP_CONCAT(DISTINCT sm.SkillName SEPARATOR ', ')AS SkillName,
     GROUP_CONCAT(DISTINCT CONCAT(ud.FirstName, ' ', ud.LastName) SEPARATOR ', ') AS Users 
     FROM 
     project p
     LEFT JOIN 
     userprojectdetails upd ON p.ProjectId = upd.ProjectId
     LEFT JOIN
     skillmaster sm ON sm.SkillId=upd.SkillId
     LEFT JOIN
     userdetails ud ON ud.UserId=upd.UserId
     WHERE
     p.ProjectId=?
     GROUP BY
     p.ProjectId;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    //Check if the project exists
    if($result->num_rows>0){
        $projectDetails = $result->fetch_assoc();
        echo json_encode($projectDetails);
    }else{
        echo json_encode(["error"=>"Project not found"]);
    }
    $stmt->close();
}else{
    echo json_encode(["error"=>"Project Id not provided"]);
}

?>