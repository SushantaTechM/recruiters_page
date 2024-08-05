<?php
    // include "partials/_registration_header.php";
    $conn = mysqli_connect('localhost','root','','recruitmentpage');
    if (!$conn) {
        die("Something went wrong!");
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
    <title>Project</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/navbar.css">
</head>
<style>
    /* body {
        background-image: url('images/p (1).jpg');
        background-size: cover;
        background-repeat: no-repeat;  
    } */
    .table{
        color: white;
        border: 2px solid white;
        box-shadow:  1px 1px #0acad8;
        margin: auto;
        width: 50%;
        margin-top: 5%;
        backdrop-filter: blur(20px);
        box-shadow: 3px 3px 3px 3px skyblue;
        font-size: 25px;
        margin-bottom: 5%;
    }
    .modal-content{
        background-color: transparent;
        border: 2px solid white;
        color: white;
        backdrop-filter: blur(20px);
        font-size: 20px;
    }
    .form-group input{
        background-color: transparent;
        border: 2px solid white;
        border-radius: 15px;
        color: white;
    }
    h1 {
        color: white;
        font-weight: 600;
        font-size: 40px;
        text-align:center;
        text-shadow:4px 4px grey;
    }
</style>
<body>

    <!-- ----------------- Navbar --------------- -->

    <div class="navbar" style="padding-bottom: 100px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button class="tab ">Home</button></a>
            <!-- <a href=""><button class="tab">Project</button></a> -->
            <div class="project-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleProjectDropdown()">Project</button>
                <div id="project-dropdown-content" class="dropdown-menu">
                    <a href="project.php">Create Project</a>
                    <a href="project.php">Dashboard</a>
                </div>
            </div>
            <a href="search.php"><button class="tab">Search</button></a>
            <div class="skill-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleSkillDropdown()">Skills</button>
                <div id="dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Skills</a>
                    <a href="skill_dashboard.php">Dashboard</a>
                </div>
            </div>
            <div class="location-dropdown">
                <button class="dashboard-dropbtn tab active" onclick="toggleLocationDropdown()">Location</button>
                <div id="location-dropdown-content" class="dropdown-menu">
                    <a href="add_location.php">Create Location</a>
                    <a href="view_location.php">Dashboard</a>
                </div>
            </div>
            <div class="customer-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleCustomerDropdown()">Customer</button>
                <div id="customer-dropdown-content" class="dropdown-menu">
                    <a href="customer_creation.php">Create Customer</a>
                    <a href="customer_view.php">Dashboard</a>
                </div>
            </div>
        </div>
        <div class="user-menu" onclick="toggleDropdown()">
            <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
                <a href="agent_logout.php" id="log-out">Log Out</a>
            </div>
        </div>
    </div>

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
                            <label for="editLocationId">Location Id</label>
                            <input id="editLocationId" name="editLocationId" value='<?php $id ?>' readonly>
                        </div>
                        <div class="form-group">
                            <label for="editLocationName">Location Name</label>
                            <input name="editLocationName" class="form-control" id="editLocationName" placeholder="Location Name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Edit php code --------------- -->

    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST["update"])) {
                $editLocationId = $_POST['editLocationId'];
                $editLocationName = $_POST["editLocationName"];
                
                // $query1 = "SELECT `LocationName` FROM `locationmaster` WHERE `LocationId` = '$editLocationId'";
                // $result1 = mysqli_query($conn,$query1);
                // $row = mysqli_fetch_assoc($result1);
                // $editLocationName = $row['editLocationName'];

                $sql = "UPDATE `locationmaster` SET `LocationName` = '$editLocationName' where `LocationId` = '$editLocationId'";
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

    <!-- ----------------------------- Table -------------------------------- -->

    <h1>Location Details</h1>
    <table class="table" id="my-table">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Location Id</th>
                <th>Location Name</th>
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
                                <td>" .$row['LocationId']. "</td>
                                <td>" .$row['LocationName']. "</td>
                                <td>
                                <button class='edit btn btn-success' id='".$row['LocationId']."'>Edit</button>    
                                <button class='delete btn btn-danger' id='".$row['LocationId']."'>Delete</button></td>
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
                tr = e.target.parentNode.parentNode;
                console.log(tr);
                LocationId = tr.getElementsByTagName("td")[1].innerText;
                LocationName = tr.getElementsByTagName("td")[2].innerText;

                editLocationId.value = LocationId;
                editLocationName.value = LocationName;
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