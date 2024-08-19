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
$conn = new mysqli("localhost", "root", "", "recruitmentpage");
if($conn->connect_error){
    die("connection failed: ".$conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
 
  $addSkill=$_POST["skillName"];
  $skillDescription=$_POST["skillDescription"];

  $checkSkillName = "SELECT * FROM `skillmaster` WHERE `SkillName`='$addSkill'";
  $res7 = mysqli_query($conn, $checkSkillName);
  if($res7->num_rows>0){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Alert!</strong> The skill name already exists so you can not add the same skill.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }else{
    $query = "INSERT INTO `skillmaster`( `SkillName`, `SkillDescription`) VALUES ('$addSkill','$skillDescription')";
    $result = mysqli_query($conn, $query);

 
  if ($result) {
    $showAlert=true;
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
   <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <!-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->
  <!-- <script src="script/dashboard.js"></script> -->

 
  <title>Skill</title>
</head>
 
<body>


  <!---------------- Navbar  -----------==-->

  <?php  include('navbar.php') ?>
 
  <div class="container" style="width: 40%;
    background: transparent;
    border: 2px solid skyblue;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    color: white;
    border-radius: 10px;
    padding: 30px 40px;">

    <h2 style="text-align:center; text-shadow: 2px 2px grey"> Create Skill</h2>

            <form action="skill.php" class="" method="post">
                <div style="margin-top:12%;">
                <label for="skillName" style="font-size:20px">Skill: </label>
                <input type="text" name="skillName" id="skillName" maxlength="30" placeholder="Enter Skill" style="max-width: 500px; width:75%; background-color: transparent;border: 2px solid skyblue; color:white;padding:0.2rem; text-align:center" required>
                </div>
                <div style="margin-top:6%;">
                <label for="SkillDescription" style="font-size:20px">Description: </label>
                <textarea name="skillDescription" id="skillDescription" maxlength="500" placeholder="Enter Description" style="max-width: 400px; width:60%;background-color: transparent;border: 2px solid skyblue; color:white;padding:0.2rem; text-align:center" required></textarea>
                </div>
                <div style="display:flex;margin-left:90px;">
                  <button type="submit" class="btn btn-primary" style="margin: 0px 4px; width:30%; font-size:25px;border-radius:10px; border:2px solid skyblue;background-color:transparent">Create</button>
                  <input class="login-btn btn" type="reset" value="Reset" style="color:white;margin: 0px 4px; width:30%; font-size:25px;border-radius:10px; border:2px solid skyblue;background-color:transparent">

                </div>
                

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
