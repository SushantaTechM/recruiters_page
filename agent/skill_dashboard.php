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

$sql1 = "SELECT `SkillId`, `SkillName` FROM `skillmaster`";
$outcome1 = mysqli_query($conn, $sql1);

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
  <link rel="stylesheet" href="styles/dashboard.css">
  <title>Project</title>
</head>

<body style="background-image: url('../images/p (1).jpg'); background-size: cover; color: white; font-size : 20px;">
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
            <a href="dashboard.php"><button  style="color: white;"  class="tab active">Dashboard</button></a>
            <a href="project.php"><button style="color: white;" class="tab">Project</button></a>
            <a href="search.php"><button style="color: white;" class="tab">Search</button></a>
            <div class="skill-dropdown">
                <button class="dropbtn tab" onclick="toggleSkillDropdown()">Skills</button>
                <div id="dropdown-content" class="dropdown-content">
                    <a href="skill.php">Create Skills</a>
                    <a href="skill_dashboard.php">Dashboard</a>
            </div>
    </div>
        </div>
        <div class="user-menu" onclick="toggleDropdown()">
            <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
                <a href="#" id="log-out">Log Out</a>
            </div>
        </div>
    </div>


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
          <form action="skill_dashboard.php" class="" method="post">
            <!-- <div class="form-group">
              <label for="editTitle">ProjectId</label>
              <input name="editTitle" type="editTitle" class="form-control" name="editTitle" id="editTitle" aria-describedby="emailHelp"
                placeholder="Enter Project Name">
            </div> -->
            <input type="hidden" name="editSkillId" id="editSkillId">

            <div class="form-group">
              <label for="editSkillName">ProjectName</label>
              <input name="editSkillName" class="form-control" id="editSkillName" rows="3"
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
    $cid = "SELECT * FROM `skillmaster` where `skillmaster`.`skillId` = '$id'";
    $res4 = mysqli_query($conn, $cid);

    $query = "DELETE FROM `skillmaster` where `skillmaster`.`skillId` = '$id'";
    $result = mysqli_query($conn, $query);

    if(!$result){
      die(mysqli_error($conn));
    }
    // $result = mysqli_query($conn, $query);
    // if ($res4->num_rows > 0) {
    //   $message = "There are some users assigned to this project, so you can not delete it!";
    //   echo "<script type='text/javascript'>alert('$message');</script>";
    // } else {
    //   if (!$result) {
    //     die(mysqli_error($conn));
    //   }
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Skill Deleted Succesfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
      if (isset($_POST["update"])) {

        $editSkillName = $_POST['editSkillName'];
        $editSkillId = $_POST['editSkillId'];

        $SQL = "UPDATE `skillmaster` SET `SkillName` = '$editSkillName' WHERE `skillmaster`.`SkillId` = '$editSkillId'";
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
      }
    }
    
  
  ?>
 
  <div class="container">
    <hr style="margin-bottom: 2rem;">

    <div class="projectContainer">
      <table class="table " id="myTable">
        <thead>
          <tr>

            <th scope="col">Skill Id</th>
            <th scope="col">Skill Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <b>
          <?php
          $sql = "SELECT `SkillId`, `SkillName` FROM `skillmaster`";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                  <td>" . $row['SkillId'] . "</td>
                  <td>" . $row['SkillName'] . "</td>
                  
                  <td>
                  <button class='edit btn btn-primary' id='edit-".$row['SkillId']. "'>Edit</button>
                  <button class='delete btn btn-danger' id='" . $row['SkillId'] . "'>Delete</button></td>
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
        SkillId = tr.getElementsByTagName("td")[0].innerText;
        SkillName = tr.getElementsByTagName("td")[1].innerText;

        // console.log(title,description,sno);
        editSkillName.value = SkillName;
        editSkillId.value = SkillId;
        $('#myModal').modal('toggle')
      })
    })
       
    deletes = document.getElementsByClassName("delete");
    console.log(deletes);
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        const id = e.target.id;
        console.log(id);
        if (confirm('Are you sure to delete')) {
          window.location = "skill_dashboard.php?delete=" + id;
        }
        else {
          console.log('no');
        }

      });
    });
  </script>
  <script src="script/script.js"></script>
  <!-- sushanta -->
</body>

</html>