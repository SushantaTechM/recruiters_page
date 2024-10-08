<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
// session_start();
if (!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin'] != true) {
    header('location:../indexCopy.php');
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
    <link rel="stylesheet" href="styles/associate.css">


    <style>

        .modal-content{
            background-color: black;
            border: 3px solid skyblue;
            border-radius: 10px;
        }
        .details span p{
            padding: 0.8rem;
            font-size: 20px;
            font-weight: 500;
        }
        .head img{
            margin: 1rem;
        }
        .about p{
            margin-top: 1.5rem;
            font-size: 20px;
            font-weight: 600;
        }
    </style
</head>

<body>
    <!-- ----------------- Navbar --------------- -->

    <div class="navbar" style="padding-bottom: 100px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button class="tab active">Home</button></a>
            <div class="project-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleProjectDropdown()">Project</button>
                <div id="project-dropdown-content" class="dropdown-menu">
                    <a href="project.php">Create Project</a>
                    <a href="project_dashboard.php">Search Project</a>
                </div>
            </div>
            <a href="search.php"><button class="tab">Employee</button></a>
            <div class="skill-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleSkillDropdown()">Skill</button>
                <div id="dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Skills</a>
                    <a href="skill_dashboard.php">Search Skill</a>
                </div>
            </div>
            <div class="location-dropdown">
                <button class="dashboard-dropbtn tab " onclick="toggleLocationDropdown()">Location</button>
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
    <div class="dashboard-main-tabs">
        <a href="dashboard.php"><button class=''>Project</button></a>
        <a href="associate.php"><button class='currently_set'>Associates</button></a>
    </div>
    <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab'>SoftLock data</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab'>Confirmed data</button>
        <button name='dataset' value='Available Data' class='dashboard-available-tab'>Available data</button>
    </div>

    <div class="dashboard-tab-content">
        <div class="dashboard-softlock-content" id="dashboard-softlock-content"></div>
    </div>
    <!------------------- Modal  --------------------->
    <div class="modal" id="user-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="document.getElementById('user-modal2').style.display='none'">&times;</span>
            <div class="head">
                <img id="modal-image" height="150px" width="150px" src="" alt="user-image" />
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


    <script src="script/script.js"></script>
    <script src="script/modal.js"></script>
    <script src="script/dashboard.js"></script>
</body>

</html>