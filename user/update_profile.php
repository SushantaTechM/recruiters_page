<?php
include 'fetch_data.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $highestQualification = $_POST['highestQualification'];
    $experience = $_POST['experience'];
    $about = $_POST['about'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $primarySkill = $_POST['primarySkill'];
    $secondarySkills = isset($_POST['secondarySkills']) ? $_POST['secondarySkills'] : '';

    //Handle image upload
    $image = null;
    if(!empty($_FILES['image']['name'])){
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }

    //Handle resume upload
    $resume =null;
    if(!empty($_FILES['resume']['name'])){
        $resume = addslashes(file_get_contents($_FILES['resume']['tmp_name']));
    }

    //Update user details
    $sql = "UPDATE userdetails
    SET FirstName = '$firstName', LastName = '$lastName', Age = $age,Location = $location,  HighestQualification = '$highestQualification', Experience= '$experience',About = '$about', Gender = '$gender'";
    if($image){
        $sql .=", Image='$image'"; 
    }
    if($resume){
        $sql .= ", Resume = '$resume'";
    }
    $sql .= " WHERE UserId = $userId";

    $sqlUser = "UPDATE users
    SET Phone= '$phone'
    WHERE UserId = $userId";

    if($conn->query($sql) === TRUE && $conn->query($sqlUser) === TRUE){
        $sqlDeleteSkills = "DELETE FROM userskilldetails WHERE UserId = $userId";
        $conn->query($sqlDeleteSkills);

        //Insert Primary Skill
        if($primarySkill){
            $sqlInsertPrimary = "INSERT INTO userskilldetails (UserId, SkillId, SkillType) VALUES ($userId, $primarySkill, 'Primary')";
            $conn->query($sqlInsertPrimary);
        }

        //Insert secondary Skills
        if(!empty($secondarySkills)){
            $skillIds = explode(",", $secondarySkills);
            foreach($skillIds as $skillId){
                if(!empty($skillId)){
                    $sqlInsertSecondary = "INSERT INTO userskilldetails (UserId, SkillId, SkillType) VALUES($userId, $skillId, 'Secondary')";
                    $conn->query($sqlInsertSecondary);
                }
            }
        }
        echo "Profile updated successfully";
    }else{
        echo "Error updating profile: ". $conn->error;
    }
    $conn->close();

    //Redirect to index.php after updating the profile
    header("Location: landing.php");
    exit();

}else{
    echo "Invalid request method.";
    $conn->close();
}
?>