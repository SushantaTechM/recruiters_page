<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if ( !isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])  )  {
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
    <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
    <link rel="stylesheet" href="styles/notification.css">
</head>

<body>
    <!-- ----------------- Navbar --------------- -->

    <?php  include('navbar.php') ?>

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
    <div class="smallModal" id="project-softlock-modal">
        <div class="smallModal-content">
            <span class="close-btn"
                onclick="document.getElementById('project-softlock-modal').style.display='none'">&times;</span>
            <h2>Select Project</h2>
            <select class="smallModalDropdown" id="softlockprojectDropdown"></select>
            <select class="smallModalDropdown" id="softlockSkillDropdown"></select>
            <div class="form-group">
                <label for="employeeStartDate">Start Date</label>
                <input name="employeeStartDate" type="date" class="form-control" id="employeeStartDate"
                    aria-describedby="emailHelp" placeholder="Enter Starting Date">
            </div>
            <div class="form-group">
                <label for="employeeEndDate">End Date</label>
                <input name="employeeEndDate" type="date" class="form-control" id="employeeEndDate"
                    aria-describedby="emailHelp" placeholder="Enter Ending Date">
            </div>

            <button id="softlock-project-button">Softlock</button>
        </div>
    </div>
    <div class="smallModal" id="project-confirm-modal">
        <div class="smallModal-content">
            <span class="close-btn"
                onclick="document.getElementById('project-confirm-modal').style.display='none'">&times;</span>
            <h2>Select Project</h2>
            <select class="smallModalDropdown" id="confirmprojectDropdown"></select>
            <select class="smallModalDropdown" id="confirmSkillDropdown"></select>
            <div class="form-group">
                <label for="employeeStartDate">Start Date</label>
                <input name="employeeStartDate" type="date" class="form-control" id="employeeStartDateConfirm"
                    aria-describedby="emailHelp" placeholder="Enter Starting Date">
            </div>
            <div class="form-group">
                <label for="employeeEndDate">End Date</label>
                <input name="employeeEndDate" type="date" class="form-control" id="employeeEndDateConfirm"
                    aria-describedby="emailHelp" placeholder="Enter Ending Date">
            </div>


            <button id="confirm-project-button">Confirm</button>
        </div>
    </div>

    <script src="script/search.js"></script>
    <script src="script/script.js"></script>

</body>

</html>