<?php
include "partials/_login_header.php";
//Anjali
include "database/config.php";
if (isset($_POST["Login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    // $type = $_POST["type"];

    $connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
    if (!$connection) {
        echo "Something went wrong";
    }
    $sql = "SELECT Type,UserId FROM `Users` WHERE Email LIKE '$email' AND Password = '$password'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if ($result) {

        session_start();

        $_SESSION['UserId'] = $row['UserId'];
        $type = $row['Type'];
        // $_SESSION['type'] = $row['Type'];
        
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
            // header("location: agent/dashboard.php");
            header("location: agent/dashboard.php");
        } else {
            echo "Invalid user type";
        }
    } else {
        echo "Invalid username or password";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="styles/login_index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>


<body>
    
    
    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <form action="index.php" method="post">
                <h1> Login</h1>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email Id" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <input type="hidden" id="type" name="type">
                <div class="remeber-forgot">

                    <a href="reset_password_user.php" class="forgot-password"> Forgot password ?</a>
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

    <script src="scripts/script.js"></script>
</body>

</html>