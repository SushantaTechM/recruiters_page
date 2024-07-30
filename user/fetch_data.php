<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recruitmentpage";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("connection failed: ". $conn->connect_error);
}

//Fetch skills for dropdowns
function getSkills($conn){
    $sql = "SELECT SkillId, SkillName FROM skillmaster";
    $result = $conn->query($sql);
    $skills = [];
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $skills[] = $row; 
        }
    }
    return $skills;
}

// Fetch locations for dropdowns
function getLocations($conn){
    $sql = "SELECT LocationId, LocationName FROM locationmaster";
    $result = $conn->query($sql);
    $locations = [];
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $locations[] = $row;
        }
    }
    return $locations;
}
?>