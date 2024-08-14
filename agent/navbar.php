<?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$totalurl = basename($actual_link);
$parsedUrl = parse_url($totalurl, PHP_URL_PATH);
$filename = basename($parsedUrl);
// var_dump($filename);

?>
<link rel="stylesheet" href="styles/navbar.css">
<div class="navbar" style="padding-bottom: 30px;">
    <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
    <div class="nav-links">
        <a href="dashboard.php"><button class="tab <?= ($filename == 'dashboard.php') ? 'active' : '' ?>">Home</button></a>
        <div class="project-dropdown">
            <button
                class="dashboard-dropbtn tab <?php
                echo ($filename == 'project.php' || $filename == 'project_dashboard.php' || $filename == 'project_view.php') ? 'active' : ''; ?>"
                onclick="toggleProjectDropdown()">Project</button>
            <div id="project-dropdown-content" class="dropdown-menu">
                <a href="project.php">Create </a>
                <a href="project_dashboard.php">Search </a>
                <a href="project_view.php">Skill mapping </a>
            </div>
        </div>
        <a href="search.php"><button class="tab <?= ($filename == 'search.php') ? 'active' : '' ?>">Employee</button></a>
        <div class="skill-dropdown">
            <button
                class="dashboard-dropbtn tab <?php
                echo ($filename == 'skill.php' || $filename == 'skill_dashboard.php') ? 'active' : ''; ?>"
                onclick="toggleSkillDropdown()">Skill</button>
            <div id="dropdown-content" class="dropdown-menu">
                <a href="skill.php">Create </a>
                <a href="skill_dashboard.php">Search </a>
            </div>
        </div>
        <div class="location-dropdown">
            <button
                class="dashboard-dropbtn tab <?php
                echo ($filename == 'add_location.php' || $filename == 'view_location.php') ? 'active' : ''; ?>"
                onclick="toggleLocationDropdown()">Location</button>
            <div id="location-dropdown-content" class="dropdown-menu">
                <a href="add_location.php">Create </a>
                <a href="view_location.php">Search </a>
            </div>
        </div>
        <div class="customer-dropdown">
            <button
                class="dashboard-dropbtn tab <?php
                echo ($filename == 'customer_creation.php' || $filename == 'customer_view.php') ? 'active' : ''; ?> "
                onclick="toggleCustomerDropdown()">Customer</button>
            <div id="customer-dropdown-content" class="dropdown-menu">
                <a href="customer_creation.php">Create </a>
                <a href="customer_view.php">Search </a>
            </div>
        </div>
        <?php
        if (!isset($_SESSION)) {
            // Start Session it is not started yet
            session_start();
        }
        // var_dump($_SESSION);
        if (isset($_SESSION['adminLogin'])) {

            echo '<a href="admin.php"><button class="tab ' . ($filename == 'admin.php' ? 'active' : '') . '">User</button></a>';
        }

        ?>

    </div>
    <div class="user-menu" onclick="toggleDropdown()">
        <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
        <div class="dropdown-menu" id="userDropdown" style="margin-left: -120px;">
            <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
            <a href="agent_logout.php" id="log-out">Log Out</a>
        </div>
    </div>
</div>