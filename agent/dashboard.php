<?php
 
if(!isset($_SESSION)){
    // Start Session it is not started yet
    session_start();
}
// session_start();
if (!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin'] != true) {
    header('location:../index.php');
    exit;
}
 
 
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Portal</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/modal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/notification.css">
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/project.css">
 
</head>
 
<!-- <body>
 
    <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab'>SoftLock data</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab'>Confirmed data</button>
    </div>
 
    <div class="dashboard-tab-content">
        <div class="dashboard-softlock-content" id="dashboard-softlock-content"></div>
        <div class="dashboard-confirm-content"></div>
    </div>
 
    <div class="modal" id="user-modal">
            <div class="modal-content">
                <span class="close-btn"
                    onclick="document.getElementById('user-modal').style.display='none'">&times;</span>
                <div class="head">
                    <img id="modal-image" height="200px" width="200px" src="" alt="user-image" />
                    <span class="about">
                        <p id="modal-name"></p>
                        <p id="modal-about"></p>
                    </span>
                </div>
                <div class="details">
                    <span>
                        <p id="modal-email"></p>
                        <p id="modal-qualification"></p>
                        <p id="modal-skill"></p>
                    </span>
                    <span id="left">
                        <p id="modal-gender"></p>
                        <p id="modal-age"></p>
                        <p id="modal-location"></p>
                    </span>
                </div>
                <a href="#" id="modal-resume" download><button>Download Resume</button>
                </a>
            </div>
        </div>
 
    <script src="script/dashboard.js"></script>
 
</body> -->
<body>
<div class="navbar" style="padding-bottom: 100px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button class="tab active">Home</button></a>
            <!-- <a href=""><button class="tab">Project</button></a> -->
            <div class="project-dropdown">
                <button class="dashboard-dropbtn tab " onclick="toggleProjectDropdown()">Project</button>
                <div id="project-dropdown-content" class="dropdown-menu">
                    <a href="project.php">Create Project</a>
                    <a href="project_dashboard.php">Dashboard</a>
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
                <button class="dashboard-dropbtn tab" onclick="toggleLocationDropdown()">Location</button>
                <div id="location-dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Location</a>
                    <a href="skill_dashboard.php">Dashboard</a>
                </div>
            </div>
            <div class="customer-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleCustomerDropdown()">Customer</button>
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
 
    <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab'><a href="project_status.php">Project Status</a></button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab'><a href="associate.php">Associates</a></button>
    </div>
 
     <!-- <div class="dashboard-tab-content">
        <div class="dashboard-softlock-content" id="dashboard-softlock-content"></div>
        <div class="dashboard-confirm-content"></div> -->
 
 
        <div class="modal" id="user-modal">
            <div class="modal-content">
                <span class="close-btn"
                    onclick="document.getElementById('user-modal2').style.display='none'">&times;</span>
                <div class="head">
                    <img id="modal-image" height="100px" src="" alt="user-image" />
                    <span class="about">
                        <p id="modal-name"></p>
                        <p id="modal-about"></p>
                    </span>
                </div>
                <div class="details">
                    <span>
                        <p id="modal-email"></p>
                        <p id="modal-qualification"></p>
                        <p id="modal-skill"></p>
                    </span>
                    <span id="left">
                        <p id="modal-gender"></p>
                        <p id="modal-age"></p>
                        <p id="modal-location"></p>
                    </span>
                </div>
                <a href="#" id="modal-resume" download><button>Download Resume</button></a>
            </div>
        </div>
 
    </div>
     <!-- Modal -->
 
  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["update"])){
        $projectName = $_POST['projectName'];
        $setstatus = $_POST['setstatus'];
 
      $SQL = "UPDATE `project` SET `Status` = '$setstatus' WHERE `project`.`ProjectName` = '$projectName'";
      $result = mysqli_query($conn, $SQL);
    }
  }
 
  ?>
 
 
 <?php
if(!isset($_SESSION)){
  // Start Session it is not started yet
  session_start();
}
if(!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin']!=true)
{
  header('location:../index.php');
  exit;
}
include ("../database/dbconnect.php");
 
$sql1 = "SELECT * from `project`";
$outcome1 = mysqli_query($conn, $sql1);
 
$sql2 = "SELECT * from `locationmaster`";
$outcome2 = mysqli_query($conn, $sql2);
 
 
?>
 
 
 
 
 
  <!-- <div class="navbar">
    <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: red;">HireHub</span></div>
    <div class="nav-links">
      <a href="index.php"><button class="tab ">Dashboard</button></a>
      <a href="project.php"><button class="tab active">Project</button></a>
      <a href="search.php"><button class="tab">Search</button></a>
    </div>
    <div class="user-menu" onclick="toggleDropdown()">
      <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
      <div class="dropdown-menu" id="userDropdown">
        <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
        <a href="agent_logout.php" id="log-out">Log Out</a>
      </div>
    </div>
  </div> -->
  <!-- <div class="navbar">
  <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button  class="tab ">Dashboard</button></a>
            <a href="project.php"><button  class="tab active">Project</button></a>
            <a href="search.php"><button  class="tab">Search</button></a>
            <a href="search.php"><button class="tab">Customer</button></a>
            <a href="search.php"><button class="tab">Skill</button></a>
            <a href="search.php"><button class="tab">Location</button></a>
        </div>
        <div class="user-menu" onclick="toggleDropdown()">
            <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
                <a href="agent_logout.php" id="log-out">Log Out</a>
            </div>
        </div>
  </div> -->
 
  <!-- Modal -->
 
 
 
 
  <div class="container">
   
    
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
<!--  
    <script src="script/script.js"></script>
    <script src="script/modal.js"></script>
    <script src="script/dashboard.js"></script>
  sushanta -->
<!-- </body> -->
 
<!-- </html> -->
 
 
    <script src="script/script.js"></script>
    <script src="script/modal.js"></script>
    <script src="script/dashboard.js"></script>
</body>
</html>