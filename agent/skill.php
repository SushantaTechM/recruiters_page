<?php


if (!isset($_SESSION)) {
  // Start Session it is not started yet
  session_start();
}
if (!isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])) {
  header('location:../index.php');
  exit;
}


$showAlert = false;
$conn = new mysqli("localhost", "root", "", "recruitmentpage");
if ($conn->connect_error) {
  die("connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $addSkill = $_POST["skillName"];
  $skillDescription = $_POST["skillDescription"];

  $checkSkillName = "SELECT * FROM `skillmaster` WHERE `SkillName`='$addSkill'";
  $res7 = mysqli_query($conn, $checkSkillName);
  if ($res7->num_rows > 0) {
    header("Location: skill.php?success=false");
    exit();
  } else {
    $query = "INSERT INTO `skillmaster`( `SkillName`, `SkillDescription`) VALUES ('$addSkill','$skillDescription')";
    $result = mysqli_query($conn, $query);


    if ($result) {
      header("Location: skill.php?success=true");
      exit();
    } else {
      echo mysqli_error($conn);
    }

  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Recruitment Portal</title>

  <!------------------ Bootstrap CSS -------------->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- --------- Datatables CSS ----------------- -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

  <!-- -------------  My CSS  ------------------------->

  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/notification.css">



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="script/script.js"></script>

  <title>Skill</title>
</head>
<style>
  .btn {
    /* display: block; */
    margin: 30px 5px;
    width: fit-content;
    font-size: 20px;
    border: 2px solid black;
    padding: 12px 30px;
    border-radius: 10px;
    text-decoration: none;
    background: linear-gradient(to right, rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
    color: white;
    cursor: pointer;
  }

  .rset {
    margin: -125px;
    padding: 10px 30px;
  }
</style>


<body>

  <!---------------- Navbar  -----------==-->

  <?php include('navbar.php') ?>

  <!-- ---------------Notification -------------->
  <?php
  if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<script>showNotification("Skill Added Successfully!");</script>';
  } elseif (isset($_GET['success']) && $_GET['success'] == 'false') {
    echo '<script>showNotification("Skill Already Exists!","error");</script>';
  }
  ?>

  <!-- -------------Container-----------  -->

  <div class="container" style="width: 40%; margin-top: 7%; background:transparent; border: 2px solid black; backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2); color: white; border-radius: 10px; padding: 30px 40px;">

    <h2 style="text-align:center; color:black; font-weight:700;"> Create Skill</h2>

    <form action="skill.php" class="" method="post">
      <div style="margin-top:8%;">
        <label for="skillName" style="font-size:20px; color:black; margin-left:3.5%;">Skill: </label>
        <input type="text" name="skillName" id="skillName" maxlength="30" placeholder="Enter Skill"
          style="max-width: 500px; width:59%; background-color: transparent;border: 2px solid black; color:black;padding:0.2rem; text-align:center;margin-left:90px;border-radius:10px;"
          required>
      </div>
      <div style="margin-top:6%;">
        <label for="SkillDescription" style="font-size:20px; color:black;margin-left:3.5%;">Description: </label>
        <textarea name="skillDescription" id="skillDescription" maxlength="500" placeholder="Enter Description"
          style="max-width: 400px; width:60%;background-color: transparent;border: 2px solid black; color:black;padding:0.2rem; text-align:center; margin-left:30px; border-radius:10px; "
          required></textarea>
      </div>

      <button type="submit" class="btn btn-primary"
        style="margin: 25px 160px; font-size: 20px; border: 2px solid black; padding: 10px 25px; border-radius: 10px; text-decoration: none; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); color: white; cursor: pointer;">Create</button>
      <button type="reset" class="login-btn btn rset">Reset</button>


    </form>

  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="script/script.js"></script>
</body>

</html>