<?php

$showAlert = false;
$showError = false;

if (isset($_POST["login"])) {

    $user_name = $_POST["Username"];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $mobile = $_POST['mobile_no'];
    $type = $_POST['type'];


    $connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');

    if (!$connection) {
        echo "Something went wrong";

    } else {
        if ($password == $c_password) {
            $query = "INSERT INTO `users`(`Username`, `Email`, `Password`, `Phone`, `Type`)";
            $query .= "VALUES ('$user_name','$email','$password','$mobile','$type')";

            $result = mysqli_query($connection, $query);
            if ($result) {
                $showAlert = true;
            } else {
                if (substr($connection->error, 0, 10) == 'Duplicate ') {
                    echo "<h1 id='popup'class='popup'>User already exists !</h1>";
                } else {
                    echo $connection->error;
                }
            }
        } else {
            echo "<h1  id='popup' class='popup'>Password not matched !</h1>";
            $showError = true;
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <!-- <link rel="stylesheet" href="styles/style.css"> -->
    <link rel="stylesheet" href="styles/user_registration.css">
</head>
<?php include "partials/_registration_header.php"; ?>

<body>

    <div class="container">
        <?php
        if ($showAlert) {
            echo "<h1 class='popup1'>Account created successfully !</h1>";
        }
        ?>
        <div class="wrapper">
            <div id="user-login-box" class="login-box">
                <h1>Registration</h1>
                <form method="post" onsubmit="return validateEmail()">
                    <div class="input-box">
                        <input type="text" name="Username" id="Username" maxlength="30" placeholder="Enter Your Name"
                            required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" id="email" maxlength="50" placeholder="Enter Email Id"
                            required>
                        <i class='bx bx-envelope'></i>
                    </div>
                    <div class="input-box">
                        <input type="phone" name="mobile_no" placeholder="Mobile No.:" maxlength="13" required>
                        <i class='bx bxs-phone'></i>
                    </div>
                    <input type="hidden" name="type" value="User">
                    <div class="input-box">
                        <input type="password" name="password" id="password" minlength="6" maxlength="25"
                            placeholder="Enter Password" required>
                        <i class='bx bxs-lock'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="c_password" id="c_password" minlength="6" maxlength="25"
                            placeholder="Confirm Password" required>
                        <i class='bx bxs-lock'></i>
                    </div>
                    <p id="error-message" style="color: red;"></p>
                    <button type="submit" name="login" class="login-btn btn">REGISTER NOW</button>

                </form>
                <script>
                    var password = document.getElementById("password");
                    var confirmPassword = document.getElementById("c_password");


                    function checkPasswordMatch() {
                        var errorMessage = document.getElementById("error-message");

                        if (password.value !== confirmPassword.value) {
                            errorMessage.textContent = "Passwords do not match!";
                            return false;
                        }
                        errorMessage.textContent = "";
                        return true;
                    }

                    confirmPassword.addEventListener('input', checkPasswordMatch);

                    //hiding notification
                    document.addEventListener('DOMContentLoaded', function () {
                        setTimeout(function () {
                            var popups1 = document.querySelectorAll('.popup1');
                            popups1.forEach(function (popup1) {
                                popup1.remove();
                            });
                            var popups = document.querySelectorAll('.popup');
                            popups.forEach(function (popup) {
                                popup.remove();
                            });
                        }, 3000); // 3000 milliseconds = 3 seconds
                    });


                    //validating email id
                    function validateEmail() {
                        const emailInput = document.getElementById('email');
                        const email = emailInput.value;
                        const domain = '@techmahindra.com';

                        if (!email.endsWith(domain)) {
                            alert('Email must end with @techmahindra.com');
                            return false; // Prevent form submission
                        }
                        return true; // Allow form submission
                    }
                </script>
            </div>
        </div>
    </div>
</body>