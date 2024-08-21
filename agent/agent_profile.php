<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if (!isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])) {
    header('location:../index.php');
    exit;
}

include "../database/dbconnect.php";


$UserId = $_COOKIE['AgentId'];
$search_query = "SELECT * FROM `users` WHERE `UserId` LIKE '$UserId';";
$result = mysqli_query($conn, $search_query);
$row = $result->fetch_assoc();



//                       Update agent profile code starts

if (isset($_POST['update'])) {
    print_r($_POST);
    $user_name = $_POST['user_name'];
    // $last_name = $_POST['agent_last_name'];
    $email = $_POST['agent_email'];
    $phone = $_POST['agent_phone'];
    // $organisation = $_POST['agent_organisation'];


    $update_query = "UPDATE `users` SET `UserName` = '$user_name', `Phone` = '$phone' WHERE `Email` = '$email'";


    $result = mysqli_query($conn, $update_query);

    if (!$result) {
        die("Unable to run update query " . mysqli_error($conn));
    } else {
        header("Refresh:0");
        // echo "Updated";
    }
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Portal</title>
    <link type="image/png" sizes="96x96" rel="icon" href=".../icons8-hamburger-96.png">
    <link rel="stylesheet" href="styles/agent_profile.css">

</head>

<body style="background-image: url('../images/Gradient.jpg'); background-size: cover;  color: black; font-size : 20px;">
    <div style=" background:linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));" class="navbar">
        <div class="navbar-brand"><span style="color: white;">Tech <br> <span style="color: cyan;">HireHub</span></div>
        <div class="dropdown">
            <button style="background: transparent;" class="dropbtn">
                <img src="../images/hamburger_icon.png" alt="Menu">
            </button>
            <div class="dropdown-content" style="right:0px;">
                <a href="index.php">Dashboard</a>
                <a href="agent_logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div style="background: transparent; color:white; border: 2px solid black; backdrop-filter: blur(80px);" class="profile-container">
        <div class="profile-header" style="color:black">
            <div class="profile-icon">👤</div>
            <div class="profile-title">Hi, <?php echo $row['UserName'] ?></div>
        </div>
        <form class="profile-form" action="agent_profile.php" method="post">

            <div class="form-group">
                <label for="user_name" style="color:black">Full name:</label>
                <input style="background: transparent; color:black;" name="user_name" type="text" id="user_name" value=<?php echo $row['UserName'];  ?> readonly>
                <button type="button" class="edit-btn" onclick="toggleEdit('user_name')">✏️</button>
            </div>

            <div class="form-group-email">
                <label for="email" style="color:black">Email ID:</label>
                <input style="background: transparent; color:black; left: -20px; position:relative" name="agent_email" type="email" id="email" value=<?php echo $row['Email'];  ?> readonly>
            </div>

            <div class="form-group">
                <label for="phone" style="color:black">Phone no:</label>
                <input style="background: transparent; color:black;" name="agent_phone" type="tel" id="phone" value=<?php echo $row['Phone'];  ?> readonly>
                <button type="button" class="edit-btn" onclick="toggleEdit('phone')">✏️</button>
            </div>


            <div class="center-div">
                <input style="background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border-radius: 10px; border:2px solid black" type="submit" name="update" value="Update" class="update-btn" id="agent-profile-update-btn">
            </div>

        </form>
    </div>

    <script src="script/agent_profile.js"></script>
</body>

</html>

<?php


?>