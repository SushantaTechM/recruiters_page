<?php
 
$showAlert = false;
$conn = new mysqli("localhost", "root", "", "recruitmentpage");
if($conn->connect_error){
    die("connection failed: ".$conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
 
  $addSkill=$_POST["skillName"];
  $skillDescription=$_POST["skillDescription"];
 
  $query = "INSERT INTO `skillmaster`( `SkillName`, `SkillDescription`) VALUES ('$addSkill','$skillDescription')";
  $result = mysqli_query($conn, $query);
 
  if ($result) {
    $showAlert=true;
  } else {
    echo mysqli_error($conn);
  }
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Skill is added succesfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
        // echo "<a href='/recruiters_page/agent/dashboard.php'>back</a>";
    }
 
}
 
?>
 
<!doctype html>
<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Recruitment Portal</title>
  <!-- Bootstrap CSS -->
   <!-- <link rel="stylesheet" href="styles/dashboard.css"> -->
   <link rel="stylesheet" href="styles/index.css">
   <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->
  <!-- <script src="script/dashboard.js"></script> -->
 
  <title>Skill</title>
</head>
 
<body>
  <!---------------- Navbar  -----------==-->
  <div class="navbar" style="padding-bottom: 30px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button class="tab ">Home</button></a>
            <div class="project-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleProjectDropdown()">Project</button>
                <div id="project-dropdown-content" class="dropdown-menu">
                    <a href="project.php">Create Project</a>
                    <a href="project.php">Search Project</a>
                </div>
            </div>
            <a href="search.php"><button class="tab">Search</button></a>
            <div class="skill-dropdown">
                <button class="dashboard-dropbtn tab active" onclick="toggleSkillDropdown()">Skills</button>
                <div id="dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Skill</a>
                    <a href="skill_dashboard.php">Search Skill</a>
                </div>
            </div>
            <div class="location-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleLocationDropdown()">Location</button>
                <div id="location-dropdown-content" class="dropdown-menu">
                    <a href="add_location.php">Create Location</a>
                    <a href="view_location.php">Search Location</a>
                </div>
            </div>
            <div class="customer-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleCustomerDropdown()">Customer</button>
                <div id="customer-dropdown-content" class="dropdown-menu">
                    <a href="customer_creation.php">Create Customer</a>
                    <a href="customer_view.php">Search Customer</a>
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
 
  <div class="container" style="width: 40%;
    height:60%;  
    background: transparent;
    border: 2px solid skyblue;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    color: white;
    border-radius: 10px;
    padding: 30px 40px;">
    <h2 style="text-align:center; text-shadow: 2px 2px grey"> Create Skill</h2>
            <form action="skill.php" class="" method="post">
                <div style="margin-top:12%;">
                <label for="skillName" style="font-size:20px">Skill: </label>
                <input type="text" name="skillName" id="skillName" maxlength="30" placeholder="Enter Skill" style="max-width: 500px; width:75%; background-color: transparent;border: 2px solid skyblue; color:white;padding:0.2rem; text-align:center" required>
                </div>
                <div style="margin-top:6%;">
                <label for="SkillDescription" style="font-size:20px">Description: </label>
                <textarea name="skillDescription" id="skillDescription" maxlength="500" placeholder="Enter Description" style="max-width: 400px; width:60%;background-color: transparent;border: 2px solid skyblue; color:white;padding:0.2rem; text-align:center" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10%; margin-left: 33%; width:30%; font-size:25px;border-radius:10px; border:2px solid skyblue;background-color:transparent">Create</button>
                
        </form>
        <script src="script/script.js"></script>
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
  <script src="script/script.js"></script>
</body>
 
</html>
