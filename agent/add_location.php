<?php
//hello
if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if (!isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
if (isset($_POST["add"])) {
    $locationName = $_POST["locationName"];
    $locationState = $_POST["locationState"];
    $locationHeadName = $_POST["locationHeadName"];
    $locationHeadEmail = $_POST["locationHeadEmail"];
    $locationHeadMobile = $_POST["locationHeadMobile"];


    $conn = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
    if (!$conn) {
        echo "Something went wrong!";
    } else {
        $query = "INSERT INTO locationmaster (`LocationName`,`LocationState`,`LocationHeadName`,`LocationHeadEmail`,`LocationHeadMobile`) VALUES ('$locationName','$locationState','$locationHeadName','$locationHeadEmail','$locationHeadMobile');";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Location Added Successfully!');</script>";
        } else {
            echo "<script>alert('Same name location exists already!');</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="styles/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        background-image: url('../images/gradient.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
    .login-box h1 {
        color: black;
        font-weight: 600;
        font-size: 40px;
        text-align: center;
        margin: 2rem 0;
        /* text-shadow:4px 4px grey; */
    }

    .input-box input {
        color: black;
        font-weight: 200;
        font-size: 15px;
        /* text-align: center; */

        border: 2px solid black;
        /* border-radius: 10px; */
        width: 50%;
        padding: 0.5rem;
        margin-bottom: 12px;
    }

    .btn {
        display: block;
        margin: 30px 5px;
        width: fit-content;
        font-size: 20px;
        border: 2px solid black;
        padding: 12px 30px;
        border-radius: 10px;
        text-decoration: none;
        background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
        color: white;
        cursor: pointer;
    }


    .wrapper {
        border: 2px solid black;
        border-radius: 10px;
        margin: auto;
        width: 40%;
        padding: 1rem;
        margin-top: 2%;
        backdrop-filter: blur(20px);
        margin-bottom: 10%;
    }

    label {
        color: black;
        font-size: 20px;
        margin-left: 20px;
    }

    .input-box input {
        border-radius: 10px;
        background-color: transparent;
    }
</style>

<body>
    <!-- ----------------- Navbar --------------- -->

    <?php include('navbar.php') ?>

    <!-- ------------- Form --------------- -->

    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <h1>Create Location</h1>
            <form method="post" action="add_location.php">
                <div class="input-box">
                    <label for="locationName">Location &nbsp;</label>
                    <input type="text" name="locationName" id="locationName" placeholder="Enter Location" required style="margin-left:78px">

                </div>
                <div class="input-box">
                    <label for="locationState">State &nbsp;</label>
                    <input type="text" name="locationState" id="locationState" placeholder="Enter State" required style="margin-left:107px">

                </div>
                <div class="input-box">
                    <label for="locationHeadName">Head Name &nbsp;</label>
                    <input type="text" name="locationHeadName" id="locationHeadName" placeholder="Enter Head Name" style="margin-left:47px"
                        required>

                </div>
                <div class="input-box">
                    <label for="locationHeadEmail">Head Email &nbsp;</label>
                    <input type="text" name="locationHeadEmail" id="locationHeadEmail" placeholder="Enter Head Email" style="margin-left:51px"
                        required>

                </div>
                <div class="input-box">
                    <label for="locationHeadMobile">Mobile Number &nbsp;</label>
                    <input type="text" name="locationHeadMobile" style="margin-left:20px"  placeholder="Enter Mobile Number" id="locationHeadMobile" required>

                </div>
                <div class="button-container" style="display:flex; margin-left: 130px">
                    <button type="submit" name="add" class="login-btn btn">Create</button>
                    <button type="reset" class="login-btn btn">Reset</button>
                </div>
            </form>
        </div>
    </div>



    <script src="script/script.js"></script>
</body>

</html>