<?php
include ('../../database/dbconnect.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$locations = [];
$skills = [];
$experiences = [];

// Fetch unique locations
$result = $conn->query("SELECT DISTINCT locationName FROM locationmaster");
while ($row = $result->fetch_assoc()) {
    $locations[] = $row['locationName'];
}

// Fetch unique skills
$result = $conn->query("SELECT DISTINCT skillName FROM skillmaster");
while ($row = $result->fetch_assoc()) {
    $skills = array_merge($skills, explode(',', $row['skillName']));
}
$skills = array_unique($skills);

// Fetch unique experiences
$result = $conn->query("SELECT DISTINCT Experience FROM userdetails");
while ($row = $result->fetch_assoc()) {
    $experiences[] = $row['Experience'];
}

$response = [
    'locations' => $locations,
    'skills' => $skills,
    'experiences' => $experiences
];

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();

