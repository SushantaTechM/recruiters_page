<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if ( !isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])  )  {
    header('location:../index.php');
    exit;
}


    $conn = mysqli_connect('localhost','root','','recruitmentpage');
    if (!$conn) {
        die("Something went wrong!");
    }
?>

<!-- -------------- Edit php code --------------- -->
 
<?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST["update"])) {
                $editLocationId = $_POST['editLocationId'];
                $editLocationName = $_POST["editLocationName"];
                $editLocationState = $_POST["editLocationState"];
                $editLocationHeadName = $_POST["editLocationHeadName"];
                $editLocationHeadEmail = $_POST["editLocationHeadEmail"];
                $editLocationHeadMobile = $_POST["editLocationHeadMobile"];
               
                
                $sql = "UPDATE `locationmaster` SET `LocationName` = '$editLocationName',`LocationState` = '$editLocationState',`LocationHeadName` = '$editLocationHeadName',`LocationHeadEmail` = '$editLocationHeadEmail',`LocationHeadMobile` = '$editLocationHeadMobile' where `LocationId` = '$editLocationId'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Location Updated Succesfully!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                }
                else {
                    echo mysqli_error($conn);
                }
            }
        }
    ?>
 
    <!-- ------------------------- Delete php code --------------------------------- -->
 
    <?php
        if(isset($_GET["delete"])) {
            $id= $_GET["delete"];
            $cid="SELECT LocationName FROM `locationmaster` where `LocationId` = '$id'";
            $res4=mysqli_query($conn,$cid);
       
            $query="DELETE FROM `locationmaster` WHERE `LocationId` = '$id'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                $message="This location is assigned to somewhere, so you cannot delete it!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                // die(mysqli_error($conn));
            }
            else {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> Location Deleted Succesfully!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
            }
        }
    ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Location</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
    <title>Project</title>
</head>
<style>
    body {
        background-image: url('../images/gradient.jpg');
        background-size: cover;
        background-repeat: no-repeat;  
        background-position: center;
    }
    .table{
        color: black;
        border: 2px solid black;
        /* box-shadow:  1px 1px #0acad8; */
        margin: auto;
        width: 80%;
        margin-top: 5%;
        backdrop-filter: blur(20px);
        /* box-shadow: 3px 3px 3px 3px skyblue; */
        /* font-size: 25px; */
        margin-bottom: 5%;
    }
    .modal-content{
        background: transparent;
        /* border: 2px solid black; */
        color: white;
        backdrop-filter: blur(120px);
        font-size: 20px;
    }
    .form-group input{
        background-color: transparent;
        border: 2px solid white;
        border-radius: 10px;
        color: white;
    }
    h1 {
        color: black;
        font-weight: bold;
        text-align:center;
        margin-top: 3%;
        /* text-shadow:4px 4px grey; */
    }
</style>
<body>
    
    <!-- ----------------- Navbar --------------- -->
 
    <?php  include('navbar.php') ?>
 
    <!-- ----------- Modal -------------- -->
 
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="view_location.php" method="post">
                        <div class="form-group">
                            <!-- <label for="editLocationId">Loc Id</label> -->
                            <input type='hidden' id="editLocationId" name="editLocationId" value='' readonly>
                        </div>
                        <div class="form-group">
                            <label for="editLocationName">Loc Name</label>
                            <input name="editLocationName" class="form-control" id="editLocationName" style="background-color: transparent;"readonly>
                        </div>
                        <div class="form-group">
                            <label for="editLocationState">Loc State</label>
                            <input name="editLocationState" class="form-control" id="editLocationState" placeholder="Loc State">
                        </div>
                        <div class="form-group">
                            <label for="editLocationHeadName">Loc Head Name</label>
                            <input name="editLocationHeadName" class="form-control" id="editLocationHeadName" placeholder="LocEmail Head Name">
                        </div>
                        <div class="form-group">
                            <label for="editLocationHeadEmail">Loc Head Email</label>
                            <input name="editLocationHeadEmail" class="form-control" id="editLocationHeadEmail" placeholder="Loc Head Email">
                        </div>
                        <div class="form-group">
                            <label for="editLocationHeadMobile">Loc Head Mobile</label>
                            <input name="editLocationHeadMobile" class="form-control" id="editLocationHeadMobile" placeholder="Loc Head Mobile">
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
    <!-- ----------------------------- Table -------------------------------- -->
 
    <h1>Location Details</h1>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>Sl No.</th>
              
                <th>Loc Name</th>
                <th>Loc State</th>
                <th>Loc Head Name</th>
                <th>Loc Head Email</th>
                <th>Loc Head Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM locationmaster";
                $result = $conn->query($sql);
                if ($result->num_rows>0){
                    $no = 0;
                    while ($row = $result->fetch_assoc()) {
                        $no++;
                        echo "<tr>
                                <td>" .$no. "</td>
                                
                                <td>" .$row['LocationName']. "</td>
                                <td>" .$row['LocationState']. "</td>
                                <td>" .$row['LocationHeadName']. "</td>
                                <td>" .$row['LocationHeadEmail']. "</td>
                                <td>" .$row['LocationHeadMobile']. "</td>
                                 <input type='hidden' id='LocationId' value=" . $row['LocationId'] . ">
                                <td>
                                <button class='edit btn' id='".$row['LocationId']."'><i class='bx bx-edit-alt'></i></button>    
                                <button class='delete btn' id='".$row['LocationId']."'><i class='bx bxs-trash'></i></button></td>
                                </td>
                            </tr>";
                    }
                }
                else{
                    echo "0 results";
                }
            ?>
        </tbody>
    </table>
 
 
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
        // --------- Edit -------------
 
        edits = document.getElementsByClassName("edit");
        // console.log(edits);
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit",);
                tr = e.target.parentNode.parentNode.parentNode;
                console.log(tr);
                LocationId = tr.getElementsByTagName("input")[0].value;
                LocationName = tr.getElementsByTagName("td")[1].innerText;
                LocationState = tr.getElementsByTagName("td")[2].innerText;
                LocationHeadName = tr.getElementsByTagName("td")[3].innerText;
                LocationHeadEmail = tr.getElementsByTagName("td")[4].innerText;
                LocationHeadMobile = tr.getElementsByTagName("td")[5].innerText;
 
                editLocationId.value = LocationId;
                editLocationName.value = LocationName;
                editLocationState.value = LocationState;
                editLocationHeadName.value = LocationHeadName;
                editLocationHeadEmail.value = LocationHeadEmail;
                editLocationHeadMobile.value = LocationHeadMobile;
                $('#myModal').modal('toggle')
                // console.log(LocationId);
            })
        })
 
        // ----------------- Delete ----------------
 
        deletes = document.getElementsByClassName("delete");
        // console.log(edits);
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                id=e.target.id.substr();
                // console.log(id);
                if(confirm('Are you sure to delete it?')){
                    window.location="view_location.php?delete="+id;
                }
                else{
                    console.log('no');
                }
            })
        })
    </script>
    <script src="script/script.js"></script>
</body>
</html>