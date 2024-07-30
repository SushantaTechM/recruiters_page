<?php
include ('../../database/dbconnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$AgentId = $data['AgentId'];

$sql="SELECT u.UserId,ud.FirstName, ud.LastName, ud.Email, u.Phone, p.ProjectName FROM `userdetails` ud 
join `users` u on ud.UserId=u.UserId 
join `userprojectdetails` upd on upd.UserId=u.UserId 
join `project` p on p.ProjectId=upd.ProjectId
where upd.AgentId='$AgentId' and upd.status='confirm';";

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





