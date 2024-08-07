<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);

$searchTerm = $data['searchTerm'];
$location = $data['location'];
$skill = $data['skill'];
$experience = $data['experience'];

$query = "SELECT ud.UserId,ud.FirstName, ud.LastName, ud.Experience, upd.Status,lm.LocationName,sm.SkillName,sm.SkillId,u.UserName, p.ProjectName,upd.AgentId
from userdetails ud 
left join userprojectdetails upd on upd.UserId=ud.UserId
left join users u on upd.AgentId=u.UserId
join locationmaster lm on ud.Location=lm.LocationId
left join userskilldetails usd on usd.UserId=ud.UserId
join skillmaster sm on usd.SkillId=sm.SkillId
left join project p on p.ProjectId=upd.ProjectId 
where usd.SkillType='Primary' AND 1=1";

if (!empty($searchTerm)) {
    $query .= " AND (ud.FirstName LIKE '%$searchTerm%' OR ud.LastName LIKE '%$searchTerm%' OR sm.SkillName LIKE '%$searchTerm%')";
}

if (!empty($location)) {
    $query .= " AND lm.LocationName='$location'";
}

if (!empty($skill)) {
    $query .= " AND sm.SkillName LIKE '%$skill%'";
}

if (!empty($experience)) {
    $query .= " AND ud.Experience between $experience";
    // $expRange=$_POST[$experience];
    // switch($expRange){
    //     case "0 AND 3":
    //         $query.= " AND ud.Experience between 0 AND 3";
    //     case "3 AND 6":
    //         $query.= " AND ud.Experience between 3 AND 6";
    //     case "6 AND 9":
    //         $query.= " AND ud.Experience between 6 AND 9";
    //     case "10 AND 20":
    //         $query.= " AND ud.Experience between 10 AND 20";
    //         break;
    //     default:
    //         echo "Invalid Selection";
    //         exit();
    // }
}
// $query .= "Limit 3";
$result = $conn->query($query);

$response = [];
while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}
// var_dump($response);

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();

