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


if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  $cid = "SELECT * FROM `UserProjectDetails` where `UserProjectDetails`.`ProjectId` = '$id'";
  $res4 = mysqli_query($conn, $cid);

  $query = "DELETE FROM `Project` WHERE `Project`.`ProjectId` = '$id'";
  $result = mysqli_query($conn, $query);

  if ($res4->num_rows > 0) {
    header("Location: project_dashboard.php?user_exists=true");
    exit();
  } else {
    if (!$result) {
      // die(mysqli_error($conn));
      header("Location: project_dashboard.php?skill_exists=true");
      exit();

    } else {
      header("Location: project_dashboard.php?delete_success=true");
      exit();
    }
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

    $editVerticalId = $_POST["editVerticalId"];
    $query6 = "SELECT * FROM `verticalmaster` WHERE `Vertical` LIKE '$editVerticalId'";
    $result6 = mysqli_query($conn, $query6);
    $row6 = mysqli_fetch_assoc($result6);
    $verticalId = $row6['id'];


    $editIBUId = $_POST["editIBUId"];
    $query6 = "SELECT * FROM `ibumaster` WHERE `IBUname` LIKE '$editIBUId'";
    $result6 = mysqli_query($conn, $query6);
    $row6 = mysqli_fetch_assoc($result6);
    $ibulId = $row6['id'];

    $status = $_POST['editStatus'];



    $SQL = "UPDATE `Project` SET `CustomerId` = '$editcustid',`StartDate` = '$editStart',`EndDate` = '$editEnd',`Location`='$locationid6',`ProjectName`='$editProjectName',`VerticalId`=$verticalId,`IBUId`=$ibulId,`status`='$status' WHERE `Project`.`ProjectId` = '$editProjectId'";
    $result = mysqli_query($conn, $SQL);
    if ($result) {
      header("Location: project_dashboard.php?success=true");
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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/project.css">
  <link rel="stylesheet" href="styles/notification.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="styles/navbar.css"> -->


  <script src="script/script.js"></script>

  <title>Project</title>
</head>
<style>
  .tbl {
    width: 60%;
  }

  .modal-content {
    border: 2px solid white;
    backdrop-filter: blur(100px);
    border-radius: 10px;
  }

  .modal h5 {
    color: white;
  }

  .modal input {
    background: transparent;
    color: white;
    border: 2px solid white;
    color-scheme: dark;
  }

  .modal select {
    background: transparent;
    color: white;
    border: 2px solid white;
    padding: 5px;
  }

  .modal select option {
    background: black;
  }

  .modal-body form {
    border: none;
  }
</style>

<body>

  <!------------------------ Navbar  ------------->
  <?php include('navbar.php') ?>

  <!-- ---------------Notification -------------->
  <?php
  if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<script>showNotification("Project Edited Successfully!");</script>';
  } elseif (isset($_GET['user_exists']) && $_GET['user_exists'] == 'true') {
    echo '<script>showNotification("Please release the users assigned to this project!","error");</script>';
  } elseif (isset($_GET['skill_exists']) && $_GET['skill_exists'] == 'true') {
    echo '<script>showNotification("Please release the skills mapped to this project!","error");</script>';
  } elseif (isset($_GET['delete_success']) && $_GET['delete_success'] == 'true') {
    echo '<script>showNotification("Project Deleted Successfully!");</script>';
  }
  ?>

  <!------------------------- Modal ---------------->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color:transparent;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white; opacity: 1;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post">
            <input type="hidden" name="editProjectId" id="editProjectId">
            <div class="form-group">
              <label for="editCustomerId">Customer</label>
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
              <label for="editVerticalId">Vertical</label>
              <select name="editVerticalId" id="editVerticalId">
                <option value="" disabled selected hidden>Please select Vertical</option>
                <?php
                $sql5 = "SELECT * from `verticalmaster`";
                $vertical_outcome = mysqli_query($conn, $sql5);
                while ($row = mysqli_fetch_assoc($vertical_outcome)) {
                  $Customer = $row['Vertical'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="editIBUId">IBU</label>
              <select name="editIBUId" id="editIBUId">
                <option value="" disabled selected hidden>Please select IBU</option>
                <?php
                $sql6 = "SELECT * from `IBUmaster`";
                $IBU_outcome = mysqli_query($conn, $sql6);
                while ($row = mysqli_fetch_assoc($IBU_outcome)) {
                  $Customer = $row['IBUname'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="editStatus">Status</label>
              <select name="editStatus" id="editStatus">
                <option value="" disabled selected hidden>Please select Status</option>
                <option value="active">active</option>
                <option value="closed">closed</option>
              </select>
            </div>


            <div class="form-group">
              <label for="editProjectName">ProjectName</label>
              <input name="editProjectName" class="form-control" id="editProjectName" rows="3"
                placeholder="please add description..." style="background: transparent;" readonly></input>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Project</button>
          </form>
        </div>

      </div>
    </div>
  </div>



  <h1 style="text-align:center; text-shadow: 2px 2px grey; margin-top:3%;">Project Details</h1>
  <div class="projectContainer">
    <table class="table tbl" id="myTable" style="color:black; border:2px solid black;">
      <thead>
        <tr>

          <th scope="col">Sl No.</th>
          <th scope="col">Project</th>
          <th scope="col">Customer</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Location</th>
          <th scope="col">Vertical</th>
          <th scope="col">IBU</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <?php

      $sql = "SELECT p.ProjectID, p.ProjectName, c.CustomerName, p.StartDate, p.EndDate, l.LocationName, v.Vertical, i.IBUname, p.status FROM project p JOIN customermaster c ON p.CustomerId=c.CustomerId JOIN verticalmaster v ON p.VerticalId=v.id JOIN locationmaster l ON p.Location=l.LocationId JOIN ibumaster i ON p.IBUId=i.id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $no = 0;
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $no++;
          if ($row['status'] == 'active') {
            echo "<tr>
                    <td>" . $no . "</td>

                    <td>" . $row['ProjectName'] . "</td>
                    <td>" . $row['CustomerName'] . "</td>
                    <td>" . $row['StartDate'] . "</td>
                    <td>" . $row['EndDate'] . "</td>
                    <td>" . $row['LocationName'] . "</td>
                    <td>" . $row['Vertical'] . "</td>
                    <td>" . $row['IBUname'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <input type='hidden' id='ProjectID' value=" . $row['ProjectID'] . ">
                    <td>
                    <button class='edit btn'><i class='bx bx-edit-alt'></i></button>
                    <button class='delete btn'  id='" . $row['ProjectID'] . "' disabled><i class='bx bxs-trash'></i></button></td>
                  </tr>";
          } else {
            echo "<tr>
                    <td>" . $no . "</td>

                    <td>" . $row['ProjectName'] . "</td>
                    <td>" . $row['CustomerName'] . "</td>
                    <td>" . $row['StartDate'] . "</td>
                    <td>" . $row['EndDate'] . "</td>
                    <td>" . $row['LocationName'] . "</td>
                    <td>" . $row['Vertical'] . "</td>
                    <td>" . $row['IBUname'] . "</td>
                    <td>" . $row['status'] . "</td>
                     <input type='hidden' id='ProjectID' value=" . $row['ProjectID'] . ">
                    <td>
                    <button class='edit btn'><i class='bx bx-edit-alt'></i></button>
                    <button class='delete btn'  id='" . $row['ProjectID'] . "'><i class='bx bxs-trash'></i></button></td>
                  </tr>";
          }
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
        //console.log("edit",);
        tr = e.target.parentNode.parentNode.parentNode;
        // console.log(tr);
        ProjectId = tr.getElementsByTagName("input")[0].value;
        ProjectName = tr.getElementsByTagName("td")[1].innerText;
        CustomerId = tr.getElementsByTagName("td")[2].innerText;
        StartDate = tr.getElementsByTagName("td")[3].innerText;
        EndDate = tr.getElementsByTagName("td")[4].innerText;
        Location = tr.getElementsByTagName("td")[5].innerText;
        Vertical = tr.getElementsByTagName("td")[6].innerText;
        Ibu = tr.getElementsByTagName("td")[7].innerText;
        Status = tr.getElementsByTagName("td")[8].innerText;


        editCustomerId.value = CustomerId;
        editLocationId.value = Location;
        editStart.value = StartDate;
        editEnd.value = EndDate;
        editProjectName.value = ProjectName;
        editProjectId.value = ProjectId;
        editVerticalId.value = Vertical;
        editIBUId.value = Ibu;
        editStatus.value = Status;
        // console.log(editStatus,Status);
        $('#myModal').modal('toggle')
      })
    })
    deletes = document.getElementsByClassName("delete");
    // console.log(edits);
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
          window.location = "project_dashboard.php?delete=" + id;
        }
        else {
          console.log('no');
        }

      })
    })
  </script>
  <script src="script/script.js"></script>
  <!-- sushanta -->
</body>

</html>