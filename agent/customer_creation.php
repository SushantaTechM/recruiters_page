<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if ( !isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])  )  {
    header('location:../index.php');
    exit;
}


$showAlert = false;


$connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');

$sql2 = "SELECT * from `locationmaster`";
$outcome2 = mysqli_query($connection, $sql2);



if (isset($_POST["btn"])) {

    $Customer_name = $_POST["Customername"];

    $location = $_POST['location'];

    $Customer_email = $_POST["Customeremail"];

    $Customer_phone = $_POST["Customerphone"];


    if (!$connection) {
        echo "Something went wrong";
    } else {
        $query6 = "SELECT * FROM `LocationMaster` WHERE `LocationName` LIKE '$location'";
        $result6 = mysqli_query($connection, $query6);
        $row6 = mysqli_fetch_assoc($result6);
        $locationid = $row6['LocationId'];
        $sql3 = "INSERT INTO `customermaster`(`CustomerName`, `CustomerLocation`, `Email`, `Phone_no`) VALUES ('$Customer_name','$locationid','$Customer_email','$Customer_phone')";
        $result7 = mysqli_query($connection, $sql3);
        if ($result7) {
            $showAlert = true;
        } else {
            echo "Customer already exists in database";
        }
    }

    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

            <strong>Success!</strong> Customer is created succesfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>';

        // echo "<a href='/recruiters_page/agent/dashboard.php'>back</a>";
    }




}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>

    <!-- <link rel="stylesheet" href="styles/navbar.css"> -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        // .js-example-basic-single declare this class into your select box
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>
    <style>
        .select2-container--default .select2-selection--single{
            background: transparent;
            border-radius: 5px;
            color: black;
            border: 2px solid black;
        }
    </style>
    <!-- add -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" href="styles/index.css">

</head>
<style>
  .btn {
        /* display: block; */
        margin: 30px 120px;
        width: fit-content;
        font-size: 20px;
        border: 2px solid black;
        padding: 10px 30px;
        border-radius: 10px;
        text-decoration: none;
        background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
        color: white;
        cursor: pointer;
    }
    .rset{
      margin: -90px;
      padding: 10px 30px; 
    }
</style>


<body style="background:url('../images/gradient.jpg') no-repeat; background-position:center; background-size: cover;">
    <!-- ----------------- Navbar --------------- -->

    <?php  include('navbar.php') ?>

    <!-------------------- Content ----------------->
    <div class="container"
        style="width: 40%; border: 2px solid black; border-radius: 10px; padding: 30px 40px; margin-top:5%;">
        <h2 style="text-align:center; font-weight:bold; margin:5%;">Create Customer</h2>
        <form action="customer_creation.php" class="" method="post">
            <div style="margin-top:12%;">
                <label for="Customername" style="font-size:20px; margin-left:55px;">Name: </label>
                <input type="text" name="Customername" id="Customername" maxlength="30" placeholder="Enter Name"
                    style="max-width: 300px; width:51%; background:transparent; border-radius:5px; color:black; border: 2px solid black; padding: 3px; margin-left:20px;" required>
            </div>


            <div style="margin-top:6%;">
                <label for="location" style="font-size:20px; color:black; margin-left:55px;">Location: </label>

                <select name="location" id="location" class="js-example-basic-single"
                    style="width:50%; padding: 5px; border: 2px solid black; margin-left:20px;">
                    <option value="" disabled selected hidden>Select Location</option>

                    <?php
                    while ($row = mysqli_fetch_assoc($outcome2)) {
                        $location = $row['LocationName'];
                        echo "<option class='location_options' value='$location'>$location</option>";

                    }
                    ?>
                </select>
            </div>


            <div style="margin-top:6%;">
                <label for="Customeremail" style="font-size:20px; margin-left:55px;">Email: </label>
                <input type="text" name="Customeremail" id="Customeremail" maxlength="30" placeholder="Enter Email"
                    style="max-width: 300px; width:51%; background:transparent; border-radius:5px; color:black; border: 2px solid black; padding: 3px; margin-left:20px;" required>
            </div>

            <div style="margin-top:6%;">
                <label for="Customerphone" style="font-size:20px; margin-left:55px;">Phone: </label>
                <input type="text" name="Customerphone" id="Customerphone" maxlength="30" placeholder="Enter Phone No"
                    style="max-width: 300px; width:51%; background:transparent; border-radius:5px; color:black; border: 2px solid black; padding: 3px; margin-left:12px;" required>
            </div>

            <button type='submit' id='btn' name='btn' class="btn btn-primary">Create</button>
            <button type="reset" class="login-btn btn rset">Reset</button>  
        </form>
        <script src="script/script.js"></script>
    </div>
</body>

</html>
