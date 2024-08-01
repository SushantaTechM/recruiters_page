<?php

$showAlert = false;


$connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');

$sql2 = "SELECT * from `locationmaster`";
$outcome2 = mysqli_query($connection, $sql2);



if (isset($_POST["btn"])) {

    $Customer_name = $_POST["Customername"];
    $location=$_POST['location'];
 

    if (!$connection) {
        echo "Something went wrong";
    } 
        else {
            $query6 = "SELECT * FROM `LocationMaster` WHERE `LocationName` LIKE '$location'";
            $result6 = mysqli_query($connection, $query6);
            $row6 = mysqli_fetch_assoc($result6);
            $locationid = $row6['LocationId'];
            $sql3="INSERT INTO `customermaster`(`CustomerName`, `CustomerLocation`) VALUES ('$Customer_name','$locationid')";
            $result7=mysqli_query($connection,$sql3);
            if($result7){
                $showAlert=true;
            }
            else{
                echo"Customer already exists in database";
            }
        }

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Customer is created succesfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>';
                // echo "<a href='/recruiters_page/agent/dashboard.php'>back</a>";
            }
    
   

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
    <link rel="stylesheet" href="/recruiters_page/agent/styles/dashboard.css">
    <!-- <link rel="stylesheet" href="styles/dashboard.css"> -->
    <link rel="stylesheet" href="styles/customer_creation.css">
    <script src="script/dashboard.js"></script>
    <link rel="stylesheet" href="styles/navbar.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
// .js-example-basic-single declare this class into your select box
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<!-- add -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/index.css">
  
</head>
<body>
<div class="navbar" style="padding-bottom: 100px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button class="tab ">Home</button></a>
            <a href="project.php"><button class="tab">Project</button></a>
            <a href="search.php"><button class="tab">Search</button></a>
            <div class="skill-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleSkillDropdown()">Skills</button>
                <div id="dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Skills</a>
                    <a href="skill_dashboard.php">Dashboard</a>
                </div>
            </div>
            <div class="location-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleLocationDropdown()">Location</button>
                <div id="location-dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Location</a>
                    <a href="skill_dashboard.php">Dashboard</a>
                </div>
            </div>
            <div class="customer-dropdown">
                <button class="dashboard-dropbtn tab tab active" onclick="toggleCustomerDropdown()">Customer</button>
                <div id="customer-dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Customer</a>
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
<div class="container" style="width: 40%;
    height:50%;  
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    color: white;
    border-radius: 10px;
    padding: 30px 40px;">
    <h2 style="text-align:center; font-weight:bold;">Create Customer</h2>
            <form action="customer_creation.php" class="" method="post">
                <div style="margin-top:12%;">
                <label for="Name" style="font-size:20px">Name: </label>
                <input type="text" name="Customername" id="Customername" maxlength="30" placeholder="Enter Name" style="max-width: 500px; width:60%;" required>
                </div>
                
                    
                        <div style="margin-top:6%;">
                        <label for="location" style="font-size:20px">Location: </label>
                   
                        <select name="location" id="location" class="js-example-basic-single" style="width:50%; margin-left:35px;">
                            <option value="" disabled selected hidden>Select Location</option>
                           
                            <?php
                            while ($row = mysqli_fetch_assoc($outcome2)) {
                                $location = $row['LocationName'];
                                echo "<option value='$location'>$location</option>";
                
                            }
                        ?>
                </select>
                </div>
                
                <button type='submit' id='btn' name='btn' class="btn btn-primary" style="margin-top:10%; margin-left: 33%; width:30%; font-size:15px;">Create</button>
        </form>
</div>
</body>
</html>





       
   
        


