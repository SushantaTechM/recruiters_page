<?php
include "database/config.php";
$showAlert = false;
$showError = false;

if (isset($_POST["Login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
    if (!$connection) {
        echo "Something went wrong";
    }
    $sql = "SELECT Type,UserId FROM `Users` WHERE Email LIKE '$email' AND Password = '$password'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        session_start();

        $_SESSION['UserId'] = $row['UserId'];
        $type = $row['Type'];

        if ($type == 'Admin') {
            $_SESSION['adminLogin'] = true;
            $expiry = time() + (3600 * 24);
            setcookie("AgentId", $row['UserId'], $expiry);
            header("location: agent/admin.php");
        } else if ($type == 'User') {
            $_SESSION['login'] = true;
            $sqlid = "SELECT * FROM `userdetails` WHERE Email='$email'";
            $result1 = mysqli_query($connection, $sqlid);
            if ($result1->num_rows > 0) {
                header("location:user/landing.php");

            } else {
                header("location:user/fill_data.php");
            }

        } else if ($type == "Agent") {
            $_SESSION['agentLogin'] = true;
            $expiry = time() + (3600 * 24);
            setcookie("AgentId", $row['UserId'], $expiry);
            header("location: agent/dashboard.php");
        } else {
            $showError = true;
        }
    } else {
        $showError = true;
       
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <!-- <link rel="stylesheet" href="styles/login_index.css"> -->
    <link rel="stylesheet" href="styles/style2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>


<body >

    <?php include "partials/_registration_header.php"; 
    if($showError){
        echo "<h1 class='popup'>Wrong Credential !</h1>";
    }   
    ?>
    <div class="container">
        <div class="wrapper">
            <div id="user-login-box" class="login-box">
                <form action="index.php" method="post" onsubmit="return validateEmail()">
                    <h1> Login</h1>
                    <div class="input-box">
                        <input type="text" name="email" placeholder="Email Id" id='email' required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class='bx bxs-lock'></i>
                    </div>
                    <input type="hidden" id="type" name="type">
                    <div class="remeber-forgot">

                        <a href="reset_password_user.php" class="forgot-password"><strong>Forgot password ?</strong></a>
                    </div>
                    <button type="submit" class="btn" name="Login">Login</button>
                    <div class="register-link">
                        <p>Don't have an account ?
                            <a href="user_registration.php">Signup</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script>
        //hiding notification
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var popups1 = document.querySelectorAll('.popup1');
                popups1.forEach(function(popup1) {
                    popup1.remove();
                });
                var popups = document.querySelectorAll('.popup');
                popups.forEach(function(popup) {
                    popup.remove();
                });
            }, 3000); // 3000 milliseconds = 3 seconds
        });

        //validating techmahindra email id
        // function validateEmail() {
        //     const emailInput = document.getElementById('email');
        //     const email = emailInput.value;
        //     const domain = '@techmahindra.com';

        //     if (!email.endsWith(domain)) {
        //         alert('Email must end with @techmahindra.com');
        //         return false; // Prevent form submission
        //     }
        //     return true; // Allow form submission
        // }
    </script>
</body>

</html>