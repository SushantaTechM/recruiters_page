<?php

if (!isset($_SESSION)) {
  // Start Session it is not started yet
  session_start();
}
if (!isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])) {
  header('location:../index.php');
  exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
if (!$conn) {
  echo "error";
}

$sql4 = "SELECT * from `locationmaster`";
$location_outcome = mysqli_query($conn, $sql4);
?>
<?php
if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  $cid = "SELECT * FROM `Project` where `Project`.`CustomerId` = '$id' ;";
  $res4 = mysqli_query($conn, $cid);

  // $query = "DELETE FROM `customermaster` WHERE `customermaster`.`CustomerId` = '$id'";
  // $result = mysqli_query($conn, $query);
  if ($res4->num_rows > 0) {
    header("Location: customer_view.php?delete=false");
    exit();
  } else {
    $query = "DELETE FROM `customermaster` WHERE `customermaster`.`CustomerId` = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die(mysqli_error($conn));
    } else {
      // header("Location: customer_view.php?delete=true");
      // exit();
    }
  }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST["update"])) {
    $editCustomerId = $_POST["editCustomerId"];



    $editCustomerName = $_POST['editCustomerName'];
    $editLocationName = $_POST['editLocationName'];
    $editCustomerEmail = $_POST['editCustomerEmail'];
    $editCustomerPhone = $_POST['editCustomerPhone'];
    $query6 = "SELECT * FROM `LocationMaster` WHERE `LocationName` LIKE '$editLocationName'";
    $result6 = mysqli_query($conn, $query6);
    $row6 = mysqli_fetch_assoc($result6);
    $locationid6 = $row6['LocationId'];

    // var_dump($editCustomerId, $editCustomerName, $locationid6, $editCustomerEmail, $editCustomerPhone);

    $SQL = "UPDATE `customermaster` SET `CustomerName`='$editCustomerName',`CustomerLocation`='$locationid6', `Email`='$editCustomerEmail', `Phone_no`='$editCustomerPhone' WHERE CustomerId='$editCustomerId'";
    $result = mysqli_query($conn, $SQL);
    // print_r($result);
    if ($result) {
      header("Location: customer_view.php?update=true");
      exit();
    } else {
      echo mysqli_error($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Customer View</title>

  <!------------------ Bootstrap CSS -------------->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- --------- Datatables CSS ----------------- -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

  <!-- -------------  My CSS  ------------------------->
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/notification.css">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="styles/navbar.css"> -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
  <script>
    // .js-example-basic-single declare this class into your select box
    // $(document).ready(function () {
    //   $('.js-example-basic-single').select2();
    // });
  </script>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <style>
    .wrapper {
      border: 2px solid black;
      /* box-shadow: 1px 1px #0acad8; */
      /* height: 450px; */
      margin: auto;
      width: 40%;
      padding: 1rem;
      margin-top: 2%;
      backdrop-filter: blur(20px);
    }
  </style>
  <script src="script/script.js"></script>

</head>

<body>

  <!------------------ Modal  ------------------>
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="background: transparent;">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: transparent;backdrop-filter: blur(120px);color: white;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style='color:white;'>Edit</h5>
          <button type="button" class="close" data-dismiss="modal" style='color:white;' aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="customer_view.php" class="" method="post">
            <div class="form-group">
              <!-- <label for="editCustomerId">Customer</label> -->


              <input type='hidden' id='editCustomerId'
                style="background-color: transparent;border-radius: 10px;border:2px solid white;color:white"
                name='editCustomerId' value='<?php $id ?>' readonly>



            </div>

            <div class="form-group">
              <label for="editCustomerName">Customer Name</label>

              <input name="editCustomerName"
                style="background-color: transparent;border-radius: 10px;border:2px solid white;color:white" type="text"
                class="form-control" id="editCustomerName" aria-describedby="emailHelp"
                placeholder="Enter Customer Name">
            </div>

            <div class="form-group">
              <label for="editLocationName">Location</label>
              <select name="editLocationName" id="editLocationName" class="js-example-basic-single"
                style="background:transparent; color:white; border:1px solid white; padding:0.5rem; border-radius:10px;">
                <option value="" disabled selected hidden>Please select Location</option>
                <?php
                while ($row = mysqli_fetch_assoc($location_outcome)) {

                  $location = $row['LocationName'];
                  echo "<option value='$location' style='background:black;'>$location</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="editCustomerEmail">Email</label>

              <input name="editCustomerEmail"
                style="background-color: transparent;border-radius: 10px;border:2px solid white;color:white" type="text"
                class="form-control" id="editCustomerEmail" aria-describedby="emailHelp"
                placeholder="Enter Customer Email">
            </div>

            <div class="form-group">
              <label for="editCustomerPhone">Phone No</label>

              <input name="editCustomerPhone"
                style="background-color: transparent;border-radius: 10px;border:2px solid white;color:white" type="text"
                class="form-control" id="editCustomerPhone" aria-describedby="emailHelp"
                placeholder="Enter Customer Phone No">
            </div>


            <button type="submit" class="btn btn-primary" name="update">Update </button>
          </form>
        </div>

      </div>
    </div>

  </div>



  <!-- ----------------- Navbar --------------- -->

  <?php include('navbar.php') ?>

  <!-- ---------------Notification -------------->
  <?php
  if (isset($_GET['update']) && $_GET['update'] == 'true') {
    echo '<script>showNotification("Customer Updated Succesfully!");</script>';
  }elseif (isset($_GET['delete']) && $_GET['delete'] == 'false') {
    echo '<script>showNotification("Customer is associated with project, you cannot delete it!","error");</script>';
  } 
  elseif (isset($_GET['delete'])) {
    echo '<script>showNotification("Customer deleted Succesfully!");</script>';
  }
  ?>
  <div>
    <h1 style="text-align:center; margin-top:3%; font-weight:bold;">Customer Details</h1>
    <table id="example" class="display wrapper" style=>
      <thead>
        <tr>
          <th>Sl No.</th>
          <th>Customer Name</th>
          <th>Location</th>
          <th>Email</th>
          <th>Phone No</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <b>
          <?php
          $sql = "SELECT cm.CustomerId, cm.CustomerName,l.LocationName, cm.Email, cm.Phone_no  FROM customermaster cm, locationmaster l where cm.CustomerLocation=l.LocationId";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                    <td>" . $no . "</td>
                    <td>" . $row['CustomerName'] . "</td>
                    <td>" . $row['LocationName'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Phone_no'] . "</td>
                    <input type='hidden' id='CustomerId' value=" . $row['CustomerId'] . ">
                    <td>
                    <button class='edit btn'  id='" . $row['CustomerId'] . "'><i class='bx bx-edit-alt'></i></button>
                    <button class='delete btn' id='" . $row['CustomerId'] . "'><i class='bx bxs-trash'></i></button></td>
                        
                    
                    </tr>";
            }
          } else {
            echo "0 results";
          }
          ?>
      </tbody>
    </table>


    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
      let table = new DataTable('#example');
    </script>

    <script>
      edits = document.getElementsByClassName("edit");
      // console.log(edits);
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit",);
          tr = e.target.parentNode.parentNode.parentNode;
          // console.log(tr);
          CustomerId = tr.getElementsByTagName("input")[0].value;
          CustomerName = tr.getElementsByTagName("td")[1].innerText;
          LocationName = tr.getElementsByTagName("td")[2].innerText;
          CustomerEmail = tr.getElementsByTagName("td")[3].innerText;
          CustomerPhone = tr.getElementsByTagName("td")[4].innerText;

          editCustomerId.value = CustomerId;
          editCustomerName.value = CustomerName;
          editLocationName.value = LocationName;
          editCustomerEmail.value = CustomerEmail;
          editCustomerPhone.value = CustomerPhone;

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
            window.location = "customer_view.php?delete=" + id;
          }
          else {
            console.log('no');
          }

        })
      })
    </script>
  </div>
  <script>
    // .js-example-basic-single declare this class into your select box
    // $(document).ready(function () {
    //   $('.js-example-basic-single').select2();
    // });
  </script>
  <script src="script/script.js"></script>
</body>


</html>