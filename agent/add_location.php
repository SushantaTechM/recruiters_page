<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if ( !isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])  )  {
    header('location:../index.php');
    exit;
}
?>
<?php
    if (isset($_POST["add"])){
        $locationName = $_POST["locationName"];
        $locationState = $_POST["locationState"];
        $locationHeadName = $_POST["locationHeadName"];
        $locationHeadEmail = $_POST["locationHeadEmail"];
        $locationHeadMobile = $_POST["locationHeadMobile"];
 
 
        $conn = mysqli_connect('localhost','root','','recruitmentpage');
        if(!$conn){
            echo "Something went wrong!";
        }
        else{
            $query = "INSERT INTO locationmaster (`LocationName`,`LocationState`,`LocationHeadName`,`LocationHeadEmail`,`LocationHeadMobile`) VALUES ('$locationName','$locationState','$locationHeadName','$locationHeadEmail','$locationHeadMobile');";
            $result = mysqli_query($conn,$query);
            if ($result){
                echo "<script>alert('Location Added Successfully!');</script>";
            }
            else{
                echo "Not added!";
            }
        }
    }
    // $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // var_dump($actual_link);
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="styles/index.css">
    <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
</head>
<style>
    /* body {
        background-image: url('images/p (1).jpg');
        background-size: cover;
        background-repeat: no-repeat;
    } */
    .login-box h1 {
        color: white;
        font-weight: 600;
        font-size: 40px;
        text-align: center;
        margin: 2rem 0;
        /* text-shadow:4px 4px grey; */
 
    }
 
    .input-box input {
        color: white;
        font-weight: 200;
        font-size: 20px;
        /* text-align: center; */
       
        border: 2px solid white;
        /* border-radius: 10px; */
        width: 50%;
        padding:0.3rem;
        margin-bottom: 12px;
    }
    .input-box{
        /* text-align: center;   */
    }
 
    .btn {
        display: block;
        margin: 50px auto;
        width: fit-content;
        font-size: 20px;
        border:1px solid #0fe9e9;
        padding:14px 50px;
        border-radius:40px;
        text-decoration:none;
        background-color: transparent;
        color:white;
        cursor: pointer;
    }
 
 
    .wrapper{
        border: 2px solid skyblue;
        box-shadow:  1px 1px #0acad8;
        /* height: 450px; */
        margin: auto;
        width: 40%;
        padding: 1rem;
        margin-top: 2%;
        backdrop-filter: blur(20px);
    }
    label{
        color: white;
        font-size: 20px;
       
    }
    .input-box input{
        border-radius: 10px;
        background-color: transparent;

    }
</style>
 
<body>
    <!-- ----------------- Navbar --------------- -->
 
    <?php  include('navbar.php') ?>
 
    <!-- ------------- Form --------------- -->
 
    <div class="wrapper">
        <div id="user-login-box" class="login-box">
        <h1>Create Location</h1>
            <form method="post" action="add_location.php">
                <div class="input-box">
                    <label for="locationName">Loc Name  &nbsp;</label>
                    <input type="text" name="locationName" placeholder="Loc Name" id="locationName" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <label for="locationState">Loc State &nbsp;</label>
                    <input type="text" name="locationState" placeholder="Loc State" id="locationState" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <label for="locationHeadName">Loc Head Name &nbsp;</label>
                    <input type="text" name="locationHeadName" placeholder="Loc Head Name" id="locationHeadName" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <label for="locationHeadEmail">Loc Head Email &nbsp;</label>
                    <input type="text" name="locationHeadEmail" placeholder="Loc Head Email" id="locationHeadEmail" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <label for="locationHeadMobile">Loc Mobile Number &nbsp;</label>
                    <input type="text" name="locationHeadMobile" placeholder="Loc Head Mobile Number" id="locationHeadMobile" required>
                    <i class='bx bxs-user'></i>
                </div>
                <button type="submit" name="add" class="login-btn btn">Create</button>
            </form>
        </div>
    </div>  
 
 
 
    <script src="script/script.js"></script>
</body>
 
</html>