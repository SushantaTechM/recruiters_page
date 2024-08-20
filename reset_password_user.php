<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<?php
include "partials/_registration_header.php";
include "database/dbconnect.php";
if (isset($_POST["verify"])) {

    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $sql = "SELECT `Phone` from `Users` where `Email`='$email'";
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    // var_dump($row);
    if ($result) {
        if ($phone == $row['Phone']) {
            $query = "UPDATE `Users` SET `Password`= '$password' WHERE `Email`='$email'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo "<h1 class='popup1'>Password Updated !</h1>";
            }

        } else {
            echo "<h1 class='popup1'>Wrong Credential !</h1>";
        }

    }

}
?>

<body style="background:url('images/gradient.jpg') no-repeat; background-position:center; background-size: cover;">
    <div class="container">
        <div class="wrapper">
            <div id="user-login-box" class="login-box">
                <h1>Reset Password</h1>
                <form method="post">
                    <div class="input-box">
                        <input type="text" name="email" placeholder="Email ID:" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="phone" name="phone" placeholder="Phone No.:" required>
                        <i class='bx bxs-phone'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="password" id="password" minlength="6" maxlength="10"
                            placeholder="Enter New Password">
                        <i class='bx bxs-lock'></i>
                    </div>
                    <button type="submit" name="verify" class="login-btn btn">VERIFY</button>

                </form>

            </div>
        </div>
    </div>
    <script>
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
    </script>
</body>
</html>