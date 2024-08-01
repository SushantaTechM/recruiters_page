<?php
if(!isset($_SESSION)){
  // Start Session it is not started yet
  session_start();
}
if(!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin']!=true)
{
  header('location:../index.php');
  exit;
}
include ("../database/dbconnect.php");

$sql1 = "SELECT * from `customermaster`";
$outcome1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * from `locationmaster`";
$outcome2 = mysqli_query($conn, $sql2);

$skill_query = "SELECT * FROM `skillmaster`";
$skill_outcome = mysqli_query($conn,$skill_query);

$vertical_query = "SELECT * FROM `verticalmaster`";
$vertical_outcome = mysqli_query($conn,$vertical_query);

$IBU_query = "SELECT * FROM `IBUmaster`";
$IBU_outcome = mysqli_query($conn,$IBU_query);



?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/project.css">
  <link rel="stylesheet" href="styles/navbar.css">

  <title>Project</title>
</head>

<body>
  <!-- <div class="navbar">
    <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: red;">HireHub</span></div>
    <div class="nav-links">
      <a href="index.php"><button class="tab ">Dashboard</button></a>
      <a href="project.php"><button class="tab active">Project</button></a>
      <a href="search.php"><button class="tab">Search</button></a>
    </div>
    <div class="user-menu" onclick="toggleDropdown()">
      <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
      <div class="dropdown-menu" id="userDropdown">
        <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
        <a href="agent_logout.php" id="log-out">Log Out</a>
      </div>
    </div>
  </div> -->
  <div class="navbar">
  <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button  class="tab ">Dashboard</button></a>
            <a href="project.php"><button  class="tab active">Project</button></a>
            <a href="search.php"><button  class="tab">Search</button></a>
            <a href="search.php"><button class="tab">Customer</button></a>
            <a href="search.php"><button class="tab">Skill</button></a>
            <a href="search.php"><button class="tab">Location</button></a>
        </div>
        <div class="user-menu" onclick="toggleDropdown()">
            <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
                <a href="agent_logout.php" id="log-out">Log Out</a>
            </div>
        </div>
  </div>

  <!-- Modal -->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="Project.php" class="" method="post">
            <!-- <div class="form-group">
              <label for="editTitle">ProjectId</label>
              <input name="editTitle" type="editTitle" class="form-control" name="editTitle" id="editTitle" aria-describedby="emailHelp"
                placeholder="Enter Project Name">
            </div> -->
            <input type="hidden" name="editProjectId" id="editProjectId">
            <div class="form-group">
              <label for="editCustomerId">Customer</label>
              <!-- <input name="editCustomerId" type="editTitle" class="form-control" name="editCustomerId" id="editCustomerId" aria-describedby="emailHelp"
                placeholder="Enter Customer Id"> -->
              <select name="editCustomerId" id="editCustomerId">
                <option value="" disabled selected hidden>Please select CustomerId</option>
                <?php
                $sql3 = "SELECT * from `customermaster`";
                $outcome3 = mysqli_query($conn, $sql3);
                while ($row = mysqli_fetch_assoc($outcome3)) {
                  //start......
                  $Customer = $row['CustomerName'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="editStart">Start Date</label>
              <input name="editStart" type="date" class="form-control" id="editStart" aria-describedby="emailHelp"
                placeholder="Enter Project Name">
            </div>
            <div class="form-group">
              <label for="editEnd">End Date</label>
              <input name="editEnd" type="date" class="form-control" id="editEnd" aria-describedby="emailHelp"
                placeholder="Enter Project Name">
            </div>
            <div class="form-group">
              <label for="editLocationId">Location</label>
              <!-- <input name="editLocationId" type="editTitle" class="form-control" name="editLocationId" id="editLocationId" aria-describedby="emailHelp"
                placeholder="Enter Location Id"> -->
              <select name="editLocationId" id="editLocationId">
                <option value="" disabled selected hidden>Please select Location</option>
                <?php
                $sql4 = "SELECT * from `locationmaster`";
                $outcome4 = mysqli_query($conn, $sql4);
                while ($row = mysqli_fetch_assoc($outcome4)) {
                  $Customer = $row['LocationName'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="editProjectName">ProjectName</label>
              <input name="editProjectName" class="form-control" id="editProjectName" rows="3"
                placeholder="please add description..."></input>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Note</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php
  if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $cid = "SELECT * FROM `UserProjectDetails` where `UserProjectDetails`.`ProjectId` = '$id'";
    $res4 = mysqli_query($conn, $cid);

    $query = "DELETE FROM `Project` WHERE `Project`.`ProjectId` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($res4->num_rows > 0) {
      $message = "There are some users assigned to this project, so you can not delete it!";
      echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
      if (!$result) {
        die(mysqli_error($conn));
      }
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Project Deleted Succesfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
  }
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["update"])) {
      $editCustomerId = $_POST["editCustomerId"];
      $query7 = "SELECT * FROM `CustomerMaster` WHERE `CustomerName` LIKE '$editCustomerId'";
      $result7 = mysqli_query($conn, $query7);
      $row7 = mysqli_fetch_assoc($result7);
      $editcustid = $row7['CustomerId'];

      $editStart = $_POST["editStart"];
      $editEnd = $_POST["editEnd"];

      $editLocationId = $_POST['editLocationId'];
      $query6 = "SELECT * FROM `LocationMaster` WHERE `LocationName` LIKE '$editLocationId'";
      $result6 = mysqli_query($conn, $query6);
      $row6 = mysqli_fetch_assoc($result6);
      $locationid6 = $row6['LocationId'];

      $editProjectName = $_POST['editProjectName'];
      $editProjectId = $_POST['editProjectId'];
      // echo $editTitle,$editDescription,$editSno;
  
      $SQL = "UPDATE `Project` SET `CustomerId` = '$editcustid',`StartDate` = '$editStart',`EndDate` = '$editEnd',`Location`='$locationid6',`ProjectName`='$editProjectName' WHERE `Project`.`ProjectId` = '$editProjectId'";
      $result = mysqli_query($conn, $SQL);
      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Your Project Updated Succesfully.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
      } else {
        echo mysqli_error($conn);
      }
    } else {
      $customerid = $_POST['customerid'];
      $query8 = "SELECT * FROM `CustomerMaster` WHERE `CustomerName` LIKE '$customerid'";
      $result8 = mysqli_query($conn, $query8);
      $row8 = mysqli_fetch_assoc($result8);
      $custid = $row8['CustomerId'];

      $location = $_POST['title2'];

      $verticalid = $_POST['Vertical'];

      $IBUid = $_POST['IBU'];



      //.....................
      // $locationid="SELECT `LocationId` FROM `LocationMaster` where `LocationName` like '$location'";
      // $res5=mysqli_query($conn,$locationid);
      // $row5=mysqli_fetch_assoc($res5);
      // $location5=$row['LocationId'];
      //...............
      $query5 = "SELECT * FROM `LocationMaster` WHERE `LocationName` LIKE '$location'";
      // $query6 = "SELECT * FROM `verticalmaster` WHERE `Vertical` LIKE '$vertical'";
      // $query7 = "SELECT * FROM `IBUmaster` WHERE `IBUname` LIKE '$IBUmaster'";
      
      $result5 = mysqli_query($conn, $query5);
      $row5 = mysqli_fetch_assoc($result5);

      // $result6 = mysqli_query($conn, $query6);
      // $row6 = mysqli_fetch_assoc($result6);

      // $result7 = mysqli_query($conn, $query7);
      // $row7 = mysqli_fetch_assoc($result7);


      $locationid = $row5['LocationId'];

      // $verticalid = $row6['id'];

      // $IBUid = $row7['id'];


      $Startdate = $_POST['title4'];
      $Enddate = $_POST['title5'];
      $projectname = $_POST['title'];
      $skillname = $_POST['title3'];
      $requiredHeadcount = $_POST['headcount'];

      // $project_query = "SELECT `ProjectId` FROM `project` WHERE `ProjectName` LIKE '$projectname'";
      // $project_result = mysqli_query($conn,$project_query);
      // $project_row = mysqli_fetch_assoc($project_result);
      // $projectid = $project_row['ProjectId'];
      // echo "Project id" . $projectid . "<br>";

      // $skill_id
      $skill_query2 = "SELECT `SkillId` from `skillmaster` WHERE `SkillName` LIKE '$skillname'";
      $skill_result = mysqli_query($conn, $skill_query2);
      $skill_row = mysqli_fetch_assoc($skill_result);
      $skillid = $skill_row['SkillId'];
      // echo "Skill id" . $skillid . "<br>";

      $query = "INSERT INTO `Project` (`CustomerId`,`StartDate`,`EndDate`,`Location`,`VerticalId`,`IBUId`,`ProjectName`) VALUE ('$custid','$Startdate','$Enddate','$locationid','$verticalid','$IBUid','$projectname')";
      // var_dump($query);
      $result = mysqli_query($conn, $query);

      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Your Project added succesfully.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
      } else {
        echo mysqli_error($conn);
      }

      $project_query = "SELECT `ProjectId` FROM `project` WHERE `ProjectName` LIKE '$projectname'";
      $project_result = mysqli_query($conn,$project_query);
      $project_row = mysqli_fetch_assoc($project_result);
      $projectid = $project_row['ProjectId'];
      // echo "Project id" . $projectid . "<br>";

      $query2 = "INSERT INTO `projectskilldetails` (`project`, `skill`, `required_headcount`) VALUES ('$projectid', '$skillid', '$requiredHeadcount')";

      // var_dump($query2);
      $result2 = mysqli_query($conn, $query2);

      if (!$result2) {
        echo mysqli_error($conn);
        
      }
    }


  }

  ?>
  <div class="container">
    
    <form action="Project.php" class="" method="post" style="margin-top: 35px;">
      <div class="form-group">
        <label for="title">Project Name</label>
        <input name="title" type="title" class="form-control" id="title" aria-describedby="emailHelp"
          placeholder="Enter Project Name">
      </div>
      <div class="form-group">
        <label for="customerid">Customer</label>
        <select name="customerid" id="customerid">
          <option value="" disabled selected hidden>Please select Customer</option>
          <?php
          while ($row = mysqli_fetch_assoc($outcome1)) {
            $Customer = $row['CustomerName'];
            echo "<option value='$Customer'>$Customer</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="title4">Start Date</label>
        <input name="title4" type="date" class="form-control" id="title4" aria-describedby="emailHelp"
          placeholder="Enter Starting Date">
      </div>
      <div class="form-group">
        <label for="title5">End Date</label>
        <input name="title5" type="date" class="form-control" id="title5" aria-describedby="emailHelp"
          placeholder="Enter Ending Date">
      </div>
      <div class="form-group">
        <label for="title2">Location</label>
        <select name="title2" id="title2">
          <option value="" disabled selected hidden>Please select Location</option>
          <?php
          while ($row = mysqli_fetch_assoc($outcome2)) {
            $Customer = $row['LocationName'];
            echo "<option value='$Customer'>$Customer</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="Vertical">Vertical Name</label>
        <select name="Vertical" id="Vertical">
          <option value="" disabled selected hidden>Please select Vertical Name</option>
          <?php
          while ($row = mysqli_fetch_assoc($vertical_outcome)) {
            $Customer = $row['id'];
            $vertiical_name=$row['Vertical'];
            echo "<option value='$Customer'>$vertiical_name</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="IBU">IBU Head</label>
        <select name="IBU" id="IBU">
          <option value="" disabled selected hidden>Please select IBU head</option>
          <?php
          while ($row = mysqli_fetch_assoc($IBU_outcome)) {
            $Customer = $row['id'];
            $IBU_name=$row['IBUname'];
            echo "<option value='$Customer'>$IBU_name</option>";
          }
          ?>
        </select>
      </div>
      
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

      <!-- <div class="form-group">
        <label for="title3">Skill</label>
        <select name="title3" id="title3" multiple>
          <option value="" disabled selected hidden>Please select your skill</option> -->
          <?php
          // while ($row = mysqli_fetch_assoc($skill_outcome)) {
          //   $skilll = $row['SkillName'];
          //   echo "<option value='$skilll'>$skilll</option>";
          //   // echo $row;
          // }
          ?>
        <!-- </select> -->
      <!-- </div> -->
      <div class="form-group">
          <label for="skills">Skills</label>
          <select name="skills[]" id="skills" multiple>
              <option value="" disabled hidden>Please select your skills</option>
              <?php
              while ($row = mysqli_fetch_assoc($skill_outcome)) {
                  $skillName = $row['SkillName'];
                  $skillID = $row['SkillID']; // Assuming there's a SkillID in your database
                  echo "<option value='$skillID'>$skillName</option>";
              }
              ?>
          </select>
      </div>

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $projectid = $_POST['projectid']; // Assuming you have this in your form
          $skills = $_POST['skills'];
          $headcounts = $_POST['headcount'];
      
          // Check if the arrays have the same length
          if (count($skills) === count($headcounts)) {
              foreach ($skills as $index => $skillid) {
                  $requiredHeadcount = $headcounts[$index];
                  $query2 = "INSERT INTO `projectskilldetails` (`project`, `skill`, `required_headcount`) VALUES ('$projectid', '$skillid', '$requiredHeadcount')";
      
                  if (mysqli_query($conn, $query2)) {
                      echo "New record created successfully for skill ID: $skillid";
                  } else {
                      echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
                  }
              }
          } else {
              echo "Error: Skills and headcounts must have the same number of items.";
          }
      }

      ?>

      <div class="form-group">
          <label for="headcount">Required Headcount for each skill</label>
          <input type="number" name="headcount[]" id="headcount" multiple>
      </div>

      <button type="submit">Submit</button>
 
      <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
      <script>
          new MultiSelectTag('title3')  // id
      </script>
      
<div id="headcount-fields">

</div>
      <!-- <div class="form-group">
        <label for="title">Required Headcount</label>
        <input name="headcount" type="title" class="form-control" id="title" aria-describedby="emailHelp"
          placeholder="Enter Required Headcount">
      </div> -->

      <button type="submit" class="btn btn-primary">Add Project</button>
    </form>
    <hr style="margin-bottom: 2rem;">

    <div class="projectContainer">
      <table class="table " id="myTable">
        <thead>
          <tr>

            <th scope="col">ProjectId</th>
            <th scope="col">Project</th>
            <th scope="col">Customer</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Location</th>
            <th scope="col">Vertical</th>
            <th scope="col">IBU</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <b>
          <?php
          // $sql = "SELECT * FROM `Project` p,`LocationMaster` l,`CustomerMaster` c, `verticalmaster` v, `IBUmaster` i WHERE p.CustomerId=c.CustomerId, p.Location=l.LocationId", ;
          $sql="SELECT p.ProjectID, p.ProjectName, c.CustomerName, p.StartDate, p.EndDate, l.LocationName, v.Vertical, i.IBUname FROM project p JOIN customermaster c ON p.CustomerId=c.CustomerId JOIN verticalmaster v ON p.VerticalId=v.id JOIN locationmaster l ON p.Location=l.LocationId JOIN ibumaster i ON p.IBUId=i.id";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                  <td>" . $row['ProjectID'] . "</td>
                  <td>" . $row['ProjectName'] . "</td>
                  <td>" . $row['CustomerName'] . "</td>
                  <td>" . $row['StartDate'] . "</td>
                  <td>" . $row['EndDate'] . "</td>
                  <td>" . $row['LocationName'] . "</td>
                  <td>" . $row['Vertical'] . "</td>
                  <td>" . $row['IBUname'] . "</td>
                  <td>
                  <button class='edit btn btn-primary'>Edit</button>
                  <button class='delete btn btn-danger' id='" . $row['ProjectID'] . "'>Delete</button></td>
                </tr>";
            }
          } else {
            echo "0 results";
          }
          ?>

          </tbody>
      </table>
    </div>
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
  <script>
    let table = new DataTable('#myTable');
  </script>
  <script>
    edits = document.getElementsByClassName("edit");
    // console.log(edits);
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        // console.log(tr);
        ProjectId = tr.getElementsByTagName("td")[0].innerText;
        ProjectName = tr.getElementsByTagName("td")[1].innerText;
        CustomerId = tr.getElementsByTagName("td")[2].innerText;
        StartDate = tr.getElementsByTagName("td")[3].innerText;
        EndDate = tr.getElementsByTagName("td")[4].innerText;
        Location = tr.getElementsByTagName("td")[5].innerText;
        
        
       

        // console.log(title,description,sno);
        editCustomerId.value = CustomerId;
        editLocationId.value = Location;
        editStart.value = StartDate;
        editEnd.value = EndDate;
        editProjectName.value = ProjectName;
        editProjectId.value = ProjectId;
        $('#myModal').modal('toggle')
      })
    })
    deletes = document.getElementsByClassName("delete");
    // console.log(edits);
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        id = e.target.id.substr();
        // console.log(id);
        if (confirm('Are you sure to delete')) {
          window.location = "Project.php?delete=" + id;
        }
        else {
          console.log('no');
        }

      })
    })

    document.getElementById('title').addEventListener('change', function() {
    const selectedSkills = Array.from(this.selectedOptions).map(option => option.value);
    const headcountFieldsDiv = document.getElementById('headcount-fields');
    
    // Clear any existing headcount fields
    headcountFieldsDiv.innerHTML = '';

    selectedSkills.forEach(skill => {
        const label = document.createElement('label');
        label.innerHTML = `Headcount for ${skill}: `;
        const input = document.createElement('input');
        input.type = 'number';
        input.name = `headcount[${skill}]`;
        input.required = true;
        headcountFieldsDiv.appendChild(label);
        headcountFieldsDiv.appendChild(input);
        headcountFieldsDiv.appendChild(document.createElement('br'));
    });
});
  </script>


  <script src="script/script.js"></script>
  <!-- sushanta -->
</body>

</html>