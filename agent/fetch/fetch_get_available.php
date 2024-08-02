<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$AgentId = $data['AgentId'];

$sql="SELECT u.UserId,ud.FirstName, ud.LastName, ud.Email, u.Phone ,
GROUP_CONCAT(DISTINCT CASE WHEN usd.SkillType = 'Primary' THEN sm.SkillName ELSE NULL END) AS PrimarySkill,
GROUP_CONCAT(DISTINCT CASE WHEN usd.SkillType ='Secondary' THEN sm.SkillName ELSE NULL END) AS SecondarySkills
FROM `userdetails` ud 
join `users` u on ud.UserId=u.UserId
LEFT JOIN userprojectdetails upd ON ud.UserId = upd.UserId  
LEFT JOIN `userskilldetails` usd ON ud.UserId = usd.UserId
LEFT JOIN `skillmaster` sm ON usd.SkillId = sm.SkillId
WHERE upd.UserId IS NULL
AND u.Type='User';";

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

// var_dump($response);

?>



