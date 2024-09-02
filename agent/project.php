<?php
if (!isset($_SESSION)) {
  // Start Session it is not started yet
  session_start();
}
if (!isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])) {
  header('location:../index.php');
  exit;
}
include("../database/dbconnect.php");


$skill_query = "SELECT * FROM `skillmaster`";
$skill_outcome = mysqli_query($conn, $skill_query);

$skillOptions = "";
while ($row = mysqli_fetch_assoc($skill_outcome)) {
  $Customer = $row['SkillName'];
  $skillid = $row['SkillId'];
  $skillOptions .= "<option value='$skillid'>$Customer</option>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $customerid = $_POST['customerid'];
  $query8 = "SELECT * FROM `CustomerMaster` WHERE `CustomerName` LIKE '$customerid'";
  $result8 = mysqli_query($conn, $query8);
  $row8 = mysqli_fetch_assoc($result8);
  $custid = $row8['CustomerId'];

  $location = $_POST['title2'];
  $query5 = "SELECT * FROM `LocationMaster` WHERE `LocationName` LIKE '$location'";
  $result5 = mysqli_query($conn, $query5);
  $row5 = mysqli_fetch_assoc($result5);
  $locationid = $row5['LocationId'];

  $verticalid = $_POST['editVerticalId'];

  $IBUid = $_POST['editIBUId'];

  $Startdate = $_POST['title4'];
  $Enddate = $_POST['title5'];
  $projectname = $_POST['title'];
  $skillname = $_POST['title3'];
  $requiredHeadcount = $_POST['headcount'];
  $status = 'active';


  $query = "INSERT INTO `Project` (`CustomerId`,`StartDate`,`EndDate`,`Location`,`VerticalId`,`IBUId`,`ProjectName`,`status`) VALUE ('$custid','$Startdate','$Enddate','$locationid','$verticalid','$IBUid','$projectname','$status')";
  // var_dump($query);
  try {
    $result = mysqli_query($conn, $query);

    $project_query = "SELECT `ProjectId` FROM `project` WHERE `ProjectName` LIKE '$projectname'";
    $project_result = mysqli_query($conn, $project_query);
    $project_row = mysqli_fetch_assoc($project_result);
    $projectid = $project_row['ProjectId'];

    $skills = $_POST['title3'];
    $headcounts = $_POST['headcount'];

    for ($x = 0; $x < count($skills); $x++) {
      $project_query2 = "INSERT INTO `projectskilldetails` (`project`, `skill`, `required_headcount`,`fullfill_headcount`) VALUES ('$projectid', '$skills[$x]' ,'$headcounts[$x]','0')";
      $project_result2 = mysqli_query($conn, $project_query2);
    }

    if ($result) {
      header("Location: project.php?success=true");
      exit();
    }
  } catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
      header("Location: project.php?error=duplicate");
      exit();
    } else {
      // Handle other types of errors
      header("Location: project.php?error=unknown");
      exit();
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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

  <!------------------- My CSS  ----------------->
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/project.css">
  <link rel="stylesheet" href="styles/notification.css">

  <!-- --------------- My JavaScript ------------>
  <script src="script/script.js"></script>

  <title>Project</title>
  <style>
    .container {
      width: 70%;
    }

    .form-group {
      margin-bottom: 15px;
      padding: 6px;
    }

    .form-group select {
      border-radius: 10px;
      height: 2rem;
    }

    /* .container{
      width: 60%;

    } */
    .form {
      margin-left: 90px;
    }

    .skill-entry {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .skill-entry select,
    .skill-entry input {
      margin-right: 10px;
      background: black;
      color: black;
      padding: 0.2rem 0.3rem;
      border: 2px solid black;
      border-radius: 10px;
      height: 40px;
    }

    .skill-entry button {
      margin-left: 10px;
    }

    .form-group input {
      background: transparent;
      /* color: white; */
      border: 2px solid black;
      border-radius: 10px;
    }

    .form-group label {
      color: black;
    }

    .form-group select {
      background: transparent;
    }

    .container form {
      border: 2px solid black;
      margin: 5%;
    }
  </style>
</head>

<body>


  <!-- ----------------- Navbar --------------- -->
  <?php include('navbar.php') ?>

  <!-- ---------------Notification -------------->
  <?php
  if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<script>showNotification("Your Project created succesfully.!");</script>';
  } elseif (isset($_GET['error']) && $_GET['error'] == 'duplicate') {
    echo '<script>showNotification("Project Name Already Exists!","error");</script>';
  }
  elseif (isset($_GET['error']) && $_GET['error'] == 'unknown') {
    echo '<script>showNotification("Unknown error occurred!","error");</script>';
  }
  ?>
  <!-- ------------- Form --------------- -->
  <div class="container">
    <form action="Project.php" class="form" method="post">
      <h1 style="text-align:center; color:black; font-weight:bold;">Create Project</h1>
      <div class="form-group">
        <label for="title">Project Name</label>
        <input name="title" type="title" class="form-control" id="title" aria-describedby="emailHelp"
          placeholder="Enter Project Name" style="width:300px;">
      </div>
      <div class="form-group">
        <label for="customerid">Customer</label>
        <select name="customerid" id="customerid" style="width:318px;">
          <option value="" disabled selected hidden>Select Customer</option>
          <?php
          $sql1 = "SELECT * from `customermaster`";
          $outcome1 = mysqli_query($conn, $sql1);
          while ($row = mysqli_fetch_assoc($outcome1)) {
            $Customer = $row['CustomerName'];
            echo "<option value='$Customer'>$Customer</option>";
          }
          ?>
        </select>
      </div>
      <br>
      <div class="form-group">
        <label for="title4">Start Date</label>
        <input style="background: transparent; color: black; width:200px;" name="title4" type="date"
          class="form-control" id="title4" aria-describedby="emailHelp" placeholder="Enter Starting Date">
      </div>
      <div class="form-group">
        <label for="title5">End Date</label>
        <input style="background-color: transparent; color: black; width:200px;" name="title5" type="date"
          class="form-control" id="title5" aria-describedby="emailHelp" placeholder="Enter Ending Date">
      </div>
      <div class="form-group">
        <label for="title2">Location</label>
        <select name="title2" id="title2" style="width:199px; height:40px;">
          <option value="" disabled selected hidden>Select Location</option>
          <?php
          $sql2 = "SELECT * from `locationmaster`";
          $outcome2 = mysqli_query($conn, $sql2);
          while ($row = mysqli_fetch_assoc($outcome2)) {
            $Customer = $row['LocationName'];
            echo "<option value='$Customer'>$Customer</option>";
          }
          ?>
        </select>
      </div>
      <br>
      <div class="form-group">
      <label for="editVerticalId">Vertical</label>
              <select name="editVerticalId" id="editVerticalId" onchange="fetchIBUs()" style="width:290px; height:40px;"> 
                <option value="" disabled selected hidden>Please select Vertical</option> 
                <?php
                $sql5 = "SELECT * from `verticalmaster`";
                $vertical_outcome = mysqli_query($conn, $sql5);
                while ($row = mysqli_fetch_assoc($vertical_outcome)) {
                  $VerticalId = $row['id'];
                  $Vertical = $row['Vertical'];
                  echo "<option value='$VerticalId'>$Vertical</option>";
                }
                ?>
              </select>
      </div>
      <div class="form-group">
      <label for="editIBUId">IBU</label>
              <select name="editIBUId" id="editIBUId" style="width:314px; height:40px;">
                <option value="" disabled selected hidden>Please select IBU</option>
                
              </select>
      </div>

      <div id="skillsContainer">
        <div class="form-group skill-entry">
          <label for="title3">Skill</label>&emsp;
          <select name="title3[]" class="skill-select" id="skill" style="width:220px; height:40px;">
            <option value="" disabled selected hidden id="skill">Select Skill</option>
            <?php echo $skillOptions; ?>
          </select>&emsp;&emsp;&emsp;
          <label for="headcount">Required Headcount</label>&emsp;
          <input type="number" name="headcount[]" class="headcount-input" min="1" placeholder="Enter headcount"
            id="skill" style="height:40px;">
          <button type="button" id="addSkillBtn">+</button><br><br>
        </div>
      </div>


      <button type="submit" class="btn btn-primary">Add Project</button>
    </form>
    <hr style="margin-bottom: 2rem;">


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


    <script>
      const skillOptions = `<?php echo $skillOptions; ?>`;

      document.getElementById('addSkillBtn').addEventListener('click', function () {
        const skillEntryTemplate = `
        <div class="form-group skill-entry">
          <label for="title3">Skill</label>&emsp;
          <select name="title3[]" class="skill-select">
            <option value="" disabled selected hidden>Please select Skill</option>
            ${skillOptions}
          </select>&emsp;&emsp;&emsp;
          <label for="headcount">Required Headcount</label>&emsp;
          <input type="number" name="headcount[]" class="headcount-input" min="1" placeholder="Enter headcount">
          <button type="button" class="remove-skill-btn">-</button>
        </div>
      `;

        const skillsContainer = document.getElementById('skillsContainer');
        skillsContainer.insertAdjacentHTML('beforeend', skillEntryTemplate);
      });

      document.getElementById('skillsContainer').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-skill-btn')) {
          event.target.parentElement.remove();
        }
      });

      function fetchIBUs(){
      var verticalId = document.getElementById('editVerticalId').value;
      var ibuSelect = document.getElementById('editIBUId');

      //Clear previous options
      ibuSelect.innerHTML = '<option value="" disabled selected hidden>Please select IBU</option>';

      if(verticalId){
        //create an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch/fetch_ibumaster.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function(){
          if(xhr.readyState === 4 && xhr.status === 200){
            var response = JSON.parse(xhr.responseText);
            response.forEach(function(ibu){
              var option = document.createElement('option');
              option.value = ibu.id;
              option.text = ibu.IBUname;
              ibuSelect.appendChild(option);
            });
          }
        };
        xhr.send('verticalId=' + verticalId);
      }

    }
    </script>

  </div> <!-- sushanta -->
</body>

</html>