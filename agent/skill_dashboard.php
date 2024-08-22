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

$sql1 = "SELECT `SkillId`, `SkillName` FROM `skillmaster`";
$outcome1 = mysqli_query($conn, $sql1);

?>
<?php

if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  // var_dump($id);
  $cid = "SELECT * FROM `projectskilldetails` WHERE `projectskilldetails`.`skill`=$id";
  $res4 = mysqli_query($conn, $cid);

  if ($res4->num_rows > 0) {
    header("Location: skill_dashboard.php?delete_success=false");
    exit();

  } else {
    $query = "DELETE FROM `skillmaster` where `skillmaster`.`skillId` = '$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
      die(mysqli_error($conn));
    } else {
        header("Location: skill_dashboard.php?delete_success=true");
        exit();

    }
  }
}


if (isset($_POST["update"])) {

  $editSkillName = $_POST['editSkillName'];
  $editSkillId = $_POST['editSkillId'];
  $editdescription = $_POST['editdescription'];

  $SQL = "UPDATE `skillmaster` SET `SkillName` = '$editSkillName', `SkillDescription`='$editdescription' WHERE `skillmaster`.`SkillId` = '$editSkillId'";
  $result = mysqli_query($conn, $SQL);
  if ($result) {
    header("Location: skill_dashboard.php?success=true");
    exit();

  } else {
    echo mysqli_error($conn);
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
  <link rel="stylesheet" href="styles/notification.css">
  <title>Project</title>

  <script src="script/script.js"></script>
</head>

<body>
  <style>
    .modal-body .form-group input {
      background: transparent;
      color: white;
    }
  </style>
  <!------------------ Navbar  --------------->
  <?php include('navbar.php') ?>


  <!-- ---------------Notification -------------->
  <?php
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<script>showNotification("Skill Edited Successfully!");</script>';
    }
    elseif (isset($_GET['delete_success']) && $_GET['delete_success'] == 'false') {
        echo '<script>showNotification("Skill is assigned, You cannot delete it!","error");</script>';
    }
    elseif (isset($_GET['delete_success']) && $_GET['delete_success'] == 'true') {
      echo '<script>showNotification("Skill deleted successfully!");</script>';
    }
    ?>
    <!-- ------------- Modal --------------- -->

  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"
        style="background: transparent; backdrop-filter: blur(20px); color: white; padding: 30px 40px; font-weight: 500;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="color:red; width: 80px; padding: 5px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="skill_dashboard.php" class="" method="post">

            <div class="form-group">
              <input type='hidden' id='editSkillId' name='editSkillId' value='<?php $id ?>' readonly
                style="padding:5px; border:1px solid white; border-radius:10px;">


            </div>


            <div class="form-group">

              <label for="editSkillName">Skill Name</label>
              <input name="editSkillName" class="form-control" id="editSkillName" rows="3"
                placeholder="please update skill..." readonly></input>
            </div>
            <div class="form-group">

              <label for="editdescription">Skill Description</label>
              <input name="editdescription" class="form-control" id="editdescription" rows="3"
                placeholder="please update description..."></input>
            </div>
            <div>
              <button type="submit" class="btn btn-primary" name="update"
                style="border-radius:5px; padding:5px 10px;">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <h1 style="text-align:center; margin-top:3%; font-weight:bold;">Skill Details</h1>

  <div class="container">
    <div class="projectContainer">
      <table class="table " id="myTable" style="border:2px solid black; color:black;">
        <thead>
          <tr>

            <th scope="col">Sl No.</th>

            <th scope="col">Skill Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $sql = "SELECT `SkillId`, `SkillName`,`SkillDescription` FROM `skillmaster`";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                  <td>" . $no . "</td>
                 
                  <td>" . $row['SkillName'] . "</td>

                  <td>" . $row['SkillDescription'] . "</td>
                  <input type='hidden' id='SkillId' value=" . $row['SkillId'] . ">

                 
                  <td>
                  <button class='edit btn' id='edit-" . $row['SkillId'] . "'><i class='bx bxs-edit'></i></button>
                  
                  <button class='delete btn' id='" . $row['SkillId'] . "'><i class='bx bxs-trash-alt'></i></button>
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
        SkillId = tr.getElementsByTagName("input")[0].value;

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
        let target = e.target;

        // Check if the clicked element is the icon inside the button
        if (target.tagName === 'I' && target.parentElement.classList.contains('delete')) {
          target = target.parentElement; // Set target to the parent button
        }

        // Check if the target is the button with the class 'delete'
        if (target.classList.contains('delete')) {
          id = target.id;
          console.log(id);
        }
        if (confirm('Are you sure to delete')) {
          window.location = "skill_dashboard.php?delete=" + id;
        }
        else {
          console.log('no');
        }

      });
    });
  </script>

  <!-- sushanta -->
</body>

</html>