<?php
if (!isset($_SESSION)) {
  // Start Session it is not started yet
  session_start();
}
if (!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin'] != true) {
  header('location:../index.php');
  exit;
}
include("../database/dbconnect.php");

$sql1 = "SELECT * from `project`";
$outcome1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * from `locationmaster`";
$outcome2 = mysqli_query($conn, $sql2);


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!------------------ Bootstrap CSS -------------->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- --------- Datatables CSS ----------------- -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

  <!-- -------------  My CSS  ------------------------->
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/project.css">
  <link rel="stylesheet" href="styles/navbar.css">

  <title>Project</title>
</head>

<body>
  <!-- ----------------- Navbar --------------- -->

  <?php include('navbar.php') ?>

  <!-- Modal -->

  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["update"])) {
      $projectName = $_POST['projectName'];
      $setstatus = $_POST['setstatus'];

      $SQL = "UPDATE `project` SET `Status` = '$setstatus' WHERE `project`.`ProjectName` = '$projectName'";
      $result = mysqli_query($conn, $SQL);
    }
  }

  ?>


  <div class="container">

    <form action="Project_status.php" class="" method="post" style="margin-top: 35px;">

      <div class="form-group">
        <label for="projectName">Select Project</label>
        <select name="projectName" id="projectName">
          <option value="" disabled selected hidden>Please select Project</option>
          <?php
          while ($row = mysqli_fetch_assoc($outcome1)) {
            $Customer = $row['ProjectName'];
            echo "<option value='$Customer'>$Customer</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="setstatus">Status</label>
        <select name="setstatus" id="setstatus">
          <option value="" disabled selected hidden>Please select Project</option>
          <option value="open">Open</option>
          <option value="closed">Closed</option>


        </select>
      </div>

      <button type="submit" class="btn btn-primary" name="update">Change Status</button>
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
            <th scope="col">Status</th>

          </tr>
        </thead>

        <b>
          <?php
          $sql = "SELECT * FROM `Project` p,`LocationMaster` l,`CustomerMaster` c WHERE p.CustomerId=c.CustomerId and p.Location=l.LocationId";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                  <td>" . $row['ProjectId'] . "</td>
                  <td>" . $row['ProjectName'] . "</td>
                  <td>" . $row['CustomerName'] . "</td>
                  <td>" . $row['StartDate'] . "</td>
                  <td>" . $row['EndDate'] . "</td>
                  <td>" . $row['LocationName'] . "</td>
                  <td>" . $row['status'] . "</td>

                  
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

  <script src="script/script.js"></script>
  <!-- sushanta -->
</body>

</html>