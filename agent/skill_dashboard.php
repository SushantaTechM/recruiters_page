<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if ( !isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])  )  {
    header('location:../index.php');
    exit;
}
include ("../database/dbconnect.php");
 
$sql1 = "SELECT `SkillId`, `SkillName` FROM `skillmaster`";
$outcome1 = mysqli_query($conn, $sql1);
 
?>
<?php

  if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $cid = "SELECT * FROM `projectskilldetails` WHERE `projectskilldetails`.`skill`=$id";
    $res4 = mysqli_query($conn, $cid);
 
   
 
    if($res4->num_rows>0){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">

          There are some projects assigned with this skill so you can not delete this skill.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

    }else{
      $query = "DELETE FROM `skillmaster` where `skillmaster`.`skillId` = '$id'";
      $result = mysqli_query($conn, $query);
      if (!$result) {
          die(mysqli_error($conn));
        }else{
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

         Your Skill Deleted Succesfully.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        }
    }
 
    // $result = mysqli_query($conn, $query);
    // if ($res4->num_rows > 0) {
    //   $message = "There are some users assigned to this project, so you can not delete it!";
    //   echo "<script type='text/javascript'>alert('$message');</script>";
    // } else {
    //   if (!$result) {
    //     die(mysqli_error($conn));
    //   }
   
  }
 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $editSkillName = $_POST['editSkillName'];
        $id = $_POST['editSkillId'];
        $desc = $_POST['editdescription'];
      $cid = "SELECT * FROM `projectskilldetails` WHERE `projectskilldetails`.`skill`=$id";
      $res4 = mysqli_query($conn, $cid);
      if($res4->num_rows>0){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">

            There are some projects assigned with this skill so you can not edit this skill.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

      }else{
 
      if (isset($_POST["update"])) {
 
        $editSkillName = $_POST['editSkillName'];
        $editSkillId = $_POST['editSkillId'];
        $editdescription=$_POST['editdescription'];

        //Check if the new skill name already exists or not
        $checkSkillName = "SELECT * FROM `skillmaster` WHERE `SkillName`='$editSkillName'";

        $res7 = mysqli_query($conn, $checkSkillName);
        if($res7->num_rows>0){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">

          The skill name already exists so you can not add the same skill.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        }else{
 
            $SQL = "UPDATE `skillmaster` SET `SkillName` = '$editSkillName', `SkillDescription`='$editdescription' WHERE `skillmaster`.`SkillId` = '$editSkillId'";
            $result = mysqli_query($conn, $SQL);
            if ($result) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

                    Your Skill Updated Succesfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';

            } else {
              echo mysqli_error($conn);
            }
          }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/project.css">
  <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
  <!-- <link rel="stylesheet" href="styles/dashboard.css"> -->
  <title>Project</title>
</head>
 
<body style="background-image: url('../images/p (1).jpg'); background-size: cover; color: white; font-size : 20px;">


  
<!------------------ Navbar  --------------->
<?php  include('navbar.php') ?>


  
 
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="  
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    color: white;
    border-radius: 10px;
    padding: 30px 40px; font-weight: 500;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:red; width: 80px; padding: 5px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="skill_dashboard.php" class="" method="post">
          
            <div class="form-group">
              <label for="editSkillId">SkillId</label>
 
              <input id='editSkillId' name='editSkillId' value='<?php $id ?>' readonly>
 
            </div>
           
 
            <div class="form-group">
             
              <label for="editSkillName">SkillName</label>
              <input name="editSkillName" class="form-control" id="editSkillName" rows="3"
                placeholder="please update skill..."></input>
            </div>
            <div class="form-group">
             
             <label for="editdescription">Skill Description</label>
             <input name="editdescription" class="form-control" id="editdescription" rows="3"
               placeholder="please update description..."></input>
           </div>
            <button type="submit" class="btn btn-primary" name="update" style="border-radius:none; padding: 5px;">Update Skill</button>
          </form>
        </div>
 
      </div>
    </div>
  </div>

  <h1 style="text-align:center;">Skill Details</h1>

  <div class="container">
    <hr style="margin-bottom: 2rem;">
 
    <div class="projectContainer">
      <table class="table " id="myTable">
        <thead>
          <tr>
 
            <th scope="col">Skill Id</th>
            <th scope="col">Skill Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
 
        <b>
          <?php
          $sql = "SELECT `SkillId`, `SkillName`,`SkillDescription` FROM `skillmaster`";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                  <td>" . $row['SkillId'] . "</td>
                  <td>" . $row['SkillName'] . "</td>

                  <td>" . $row['SkillDescription']. "</td>

                 
                  <td>
                  <button class='edit btn btn-primary' id='edit-" . $row['SkillId'] . "'><i class='bx bxs-edit'></i></button>
                  
                  <button class='delete btn btn-danger' id='" . $row['SkillId'] . "'><i class='bx bxs-trash-alt'></i></button>
                  </td>
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
 
 <img src="" alt="" srcset="">
 
 
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
        // console.log(e);
        tr = e.target.parentNode.parentNode.parentNode;
        // console.log(tr);
        SkillId = tr.getElementsByTagName("td")[0].innerText;
        SkillName = tr.getElementsByTagName("td")[1].innerText;
        SkillDescription = tr.getElementsByTagName("td")[2].innerText;

        editSkillName.value = SkillName;
        editSkillId.value = SkillId;
        editdescription.value = SkillDescription;
        $('#myModal').modal('toggle')
      })
    })
 
    deletes = document.getElementsByClassName("delete");
    // console.log(deletes);
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        const id = e.target.id;
        // console.log(id);
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
has context menu