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
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Alert!</strong> The skill name already exists so you can not add the same skill.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    $query = "INSERT INTO `skillmaster`( `SkillName`, `SkillDescription`) VALUES ('$addSkill','$skillDescription')";
    $result = mysqli_query($conn, $query);
 
 
    if ($result) {
      $showAlert = true;
    } else {
      echo mysqli_error($conn);
    }
    if ($showAlert) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Skill is added succesfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
      // echo "<a href='/recruiters_page/agent/dashboard.php'>back</a>";
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
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="styles/dashboard.css"> -->
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
 
  <!-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->
  <!-- <script src="script/dashboard.js"></script> -->
 
 
  <title>Skill</title>
</head>
 
<body style="background:url('../images/gradient.jpg') no-repeat; background-position:center; background-size: cover;">
 
 
  <!---------------- Navbar  -----------==-->
 
  <?php include('navbar.php') ?>
 
  <div class="container" style="width: 40%; margin-top: 7%; background:transparent; border: 2px solid black; backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2); color: white; border-radius: 10px; padding: 30px 40px;">
 
    <h2 style="text-align:center; color:black; font-weight:700;"> Create Skill</h2>
 
    <form action="skill.php" class="" method="post">
      <div style="margin-top:8%;">
        <label for="skillName" style="font-size:20px; color:black; margin-left:3.5%;">Skill: </label>
        <input type="text" name="skillName" id="skillName" maxlength="30" placeholder="Enter Skill" style="max-width: 500px; width:60%; background: transparent;border: 2px solid black; color:black;padding:0.5rem; margin-left:91px;border-radius:10px;" required>
      </div>
      <div style="margin-top:6%;display:flex;">
        <label for="SkillDescription" style="font-size:20px; color:black;margin-left:3.5%; margin-bottom:0;">Description: </label>
        <textarea name="skillDescription" id="skillDescription" maxlength="500" placeholder="Enter Description" style="max-width: 400px; width:60%;background: transparent;border: 2px solid black; color:black;padding:0 0.5rem; margin-left:6%; border-radius:10px; " required></textarea>
      </div>
 
      <button type="submit" class="btn btn-primary" style="margin: 25px 160px; font-size: 20px; border: 2px solid black; padding: 10px 25px; border-radius: 10px; text-decoration: none; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); color: white; cursor: pointer;">Create</button>
 
 
    </form>
    <script src="script/script.js"></script>
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
 