<?php
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
// $showAlert = false;
// $showError = false;
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
        try {
            $result = mysqli_query($conn, $query);
            if ($result) {
                header("Location: add_location.php?success=true");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
                header("Location: add_location.php?error=duplicate");
                exit();
            } else {
                // Handle other types of errors
                header("Location: add_location.php?error=unknown");
                exit();
            }
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
    <link rel="stylesheet" href="styles/notification.css">
    <link rel="stylesheet" href="styles/individual_css/add_location.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <script src="script/script.js"></script>
</head>


<body>
    <!-- ----------------- Navbar --------------- -->

    <?php include('navbar.php') ?>

    <!-- ---------------Notification -------------->
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<script>showNotification("Location Added Successfully!");</script>';
    }
    elseif (isset($_GET['error']) && $_GET['error'] == 'duplicate') {
        echo '<script>showNotification("Location Already Exists!","error");</script>';
    }
    elseif (isset($_GET['error']) && $_GET['error'] == 'unknown') {
        echo '<script>showNotification("Unknown Error occurred!","error");</script>';
    }
    ?>
    <!-- ------------- Form --------------- -->

    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <h1>Create Location</h1>
            <form method="post" action="add_location.php">
                <div class="input-box">
                    <label for="locationName">Name &nbsp;</label>
                    <input type="text" name="locationName" placeholder="Enter Name" id="locationName" required
                        style="margin-left:100px">

                </div>
                <div class="input-box">
                    <label for="locationState">State &nbsp;</label>
                    <input type="text" name="locationState" id="locationState" placeholder="Enter State name" required
                        style="margin-left:107px">

                </div>
                <div class="input-box">
                    <label for="locationHeadName">Head Name &nbsp;</label>
                    <input type="text" name="locationHeadName" id="locationHeadName" style="margin-left:47px"
                        placeholder="Enter Head Name" required>

                </div>
                <div class="input-box">
                    <label for="locationHeadEmail">Head Email &nbsp;</label>
                    <input type="email" name="locationHeadEmail" id="locationHeadEmail" style="margin-left:51px"
                        placeholder="Enter Email Id" required>

                </div>
                <div class="input-box">
                    <label for="locationHeadMobile">Mobile Number &nbsp;</label>
                    <input type="text" name="locationHeadMobile" style="margin-left:20px"
                        placeholder="Enter Mobile Number" id="locationHeadMobile" required>

                </div>
                <div class="button-container" style="display:flex; margin-left: 130px">
                    <button type="submit" name="add" class="login-btn btn">Create</button>
                    <button type="reset" class="login-btn btn">Reset</button>
                </div>
            </form>
        </div>
    </div>



    
</body>

</html>