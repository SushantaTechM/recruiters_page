<?php
session_start();
if(!isset($_SESSION['login']))
{
    header('location:../index.php');
    exit;
}
$conn = mysqli_connect("localhost","root","","recruitment_portal");
if($conn->connect_error){
    die ("connection failed: " . $conn->connect_error);
}
//retrieve user's resume data based on session email
$email = $_SESSION['email'];
$sql="SELECT Resume from user_data where Email='$email'";
$result = $conn->query($sql);

if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $resume_data = $row['Resume'];

    //set headers for download
    header("Content-Type: application/pdf"); // Assuming resumes are stored as PDFs
    header("Content-Disposition: attachment; filename='resume.pdf'");
    echo $resume_data;
}else{
    echo "Resume not found. <a href = 'landing.php'>Go Back </a>";
}
$conn->close();
?>