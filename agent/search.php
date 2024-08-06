<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
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
    <title>Search</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/notification.css">
</head>

<body>
    <!-- ----------------- Navbar --------------- -->

    <div class="navbar" style="padding-bottom: 100px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button class="tab">Home</button></a>
            <div class="project-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleProjectDropdown()">Project</button>
                <div id="project-dropdown-content" class="dropdown-menu">
                    <a href="project.php">Create Project</a>
                    <a href="project_dashboard.php">Search Project</a>
                </div>
            </div>
            <a href="search.php"><button class="tab active">Employee</button></a>
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

    <div class="tab-content active" id="search-content">
        <div class="search-container">
            <input type="text" id="search-bar" placeholder="Search..." onkeyup="filterResults()">
            <div class="filters">
                <select id="location-filter" onchange="filterResults()">
                    <option value="">Select Location</option>
                    <!-- Options will be dynamically populated -->
                </select>
                <select id="skill-filter" onchange="filterResults()">
                    <option value="">Select Skills</option>
                    <!-- Options will be dynamically populated -->
                </select>
                <select id="experience-filter" onchange="filterResults()">
                    <option value="">Select Experience</option>
                    <!-- Options will be dynamically populated -->
                </select>
            </div>
        </div>
        <div id="results"></div>
    </div>
    <div class="smallModal" id="project-softlock-modal" >
        <div class="smallModal-content" style="background-color: transparent;border-radius: 10px;border:2px solid skyblue;color:white;backdrop-filter: blur(120px)">
            <span class="close-btn"
                onclick="document.getElementById('project-softlock-modal').style.display='none'">&times;</span>
            <h2>Select Project</h2>
            <select class="smallModalDropdown" id="softlockprojectDropdown"  style="border-radius:10px; color:white; background-color:transparent " ></select>
            <select class="smallModalDropdown" id="softlockSkillDropdown"   style="border-radius:10px; color:white; background-color:transparent" ></select>
            <div class="form-group">
                <label for="employeeStartDate">Start Date</label>
                <input name="employeeStartDate" type="date" class="form-control" id="employeeStartDate"  style="border-radius:10px; color:white; background-color:transparent"  >
            </div>
            <div class="form-group">
                <label for="employeeEndDate">End Date</label>
                <input name="employeeEndDate" type="date" class="form-control" id="employeeEndDate"
                    aria-describedby="emailHelp" placeholder="Enter Ending Date"  style="border-radius:10px; color:white; background-color:transparent"  >
            </div>

            <button id="softlock-project-button">Softlock</button>
        </div>
    </div>



    <div class="smallModal" id="project-confirm-modal">
        <div class="smallModal-content" style="background-color: transparent;border-radius: 10px;border:2px solid skyblue;color:white;backdrop-filter: blur(120px)">
            <span class="close-btn"
                onclick="document.getElementById('project-confirm-modal').style.display='none'">&times;</span>
            <h2>Select Project</h2>
            <select class="smallModalDropdown" id="confirmprojectDropdown" style="border-radius:10px; color:white; background-color:transparent " ></select>
            <select class="smallModalDropdown" id="confirmSkillDropdown" style="border-radius:10px; color:white; background-color:transparent "  ></select>
            <div class="form-group">
                <label for="employeeStartDate">Start Date</label>
                <input name="employeeStartDate" type="date" class="form-control" id="employeeStartDateConfirm"
                    aria-describedby="emailHelp" placeholder="Enter Starting Date"  style="border-radius:10px; color:white; background-color:transparent">
            </div>
            <div class="form-group">
                <label for="employeeEndDate">End Date</label>
                <input name="employeeEndDate" type="date" class="form-control" id="employeeEndDateConfirm"
                    aria-describedby="emailHelp" placeholder="Enter Ending Date"  style="border-radius:10px; color:white; background-color:transparent">
            </div>


            <button id="confirm-project-button">Confirm</button>
        </div>
    </div>

    <script src="script/search.js"></script>
    <script src="script/script.js"></script>

</body>

</html>