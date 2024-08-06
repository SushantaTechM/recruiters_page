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

    $status=$_POST['editStatus'];



    $SQL = "UPDATE `Project` SET `CustomerId` = '$editcustid',`StartDate` = '$editStart',`EndDate` = '$editEnd',`Location`='$locationid6',`ProjectName`='$editProjectName',`VerticalId`=$verticalId,`IBUId`=$ibulId,`status`='$status' WHERE `Project`.`ProjectId` = '$editProjectId'";
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

  <!-- <link rel="stylesheet" href="styles/navbar.css"> -->

  <title>Project</title>
</head>
<style>
  .tbl{
    width: 60%;
  }
</style>

<body>
  
  <!------------------------ Navbar  ------------->
  <?php  include('navbar.php') ?>
  
  <!------------------------- Modal ---------------->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color:transparent;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
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
                placeholder="please add description..."></input>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Project</button>
          </form>
        </div>

      </div>
    </div>
  </div>


<h1 style="text-align:center; text-shadow: 2px 2px grey;">Project Details</h1>
<div class="projectContainer">
      <table class="table tbl" id="myTable">
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
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
          <?php

          $sql="SELECT p.ProjectID, p.ProjectName, c.CustomerName, p.StartDate, p.EndDate, l.LocationName, v.Vertical, i.IBUname, p.status FROM project p JOIN customermaster c ON p.CustomerId=c.CustomerId JOIN verticalmaster v ON p.VerticalId=v.id JOIN locationmaster l ON p.Location=l.LocationId JOIN ibumaster i ON p.IBUId=i.id";
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
                  <td>" . $row['status'] . "</td>
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
        //console.log("edit",);
        tr = e.target.parentNode.parentNode;
        // console.log(tr);
        ProjectId = tr.getElementsByTagName("td")[0].innerText;
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
        id = e.target.id.substr();
        // console.log(id);
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
