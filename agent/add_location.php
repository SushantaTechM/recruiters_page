<?php
if (isset($_POST["add"])) {
    $location = $_POST["location"];

    $conn = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
    if (!$conn) {
        echo "Something went wrong!";
    } else {
        $query = "INSERT INTO locationmaster (`LocationName`) VALUES ('$location');";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Location Added Successfully!');</script>";
        } else {
            echo "Not added!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/navbar.css">
</head>
<style>
    /* body {
        background-image: url('images/p (1).jpg');
        background-size: cover;
        background-repeat: no-repeat;
    } */
    .login-box h1 {
        color: white;
        font-weight: 600;
        font-size: 40px;
        text-align: center;
    }

    .input-box input {
        color: white;
        font-weight: 200;
        font-size: 30px;
        text-align: center;
        background-color: transparent;
        border: 2px solid skyblue;
        border-radius: 20px;
        width: 70%;
        padding: 1.2rem;
    }

    .input-box {
        text-align: center;
    }

    .btn {
        display: block;
        margin: 50px auto;
        width: fit-content;
        font-size: 20px;
        border: 1px solid #0fe9e9;
        padding: 14px 50px;
        border-radius: 50px;
        text-decoration: none;
        color: rgb(0, 0, 0);
        transition: transform 0.5s;
        cursor: pointer;
    }

    .btn:hover {
        background: #0acad8;
    }

    .wrapper {
        border: 2px solid white;
        box-shadow: 1px 1px #0acad8;
        margin: auto;
        width: 50%;
        margin-top: 10%;
        backdrop-filter: blur(20px);
    }
</style>

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
            <a href="search.php"><button class="tab">Employee</button></a>
            <div class="skill-dropdown">
                <button class="dashboard-dropbtn tab" onclick="toggleSkillDropdown()">Skill</button>
                <div id="dropdown-content" class="dropdown-menu">
                    <a href="skill.php">Create Skills</a>
                    <a href="skill_dashboard.php">Search Skill</a>
                </div>
            </div>
            <div class="location-dropdown">
                <button class="dashboard-dropbtn tab active" onclick="toggleLocationDropdown()">Location</button>
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

    <!-- ------------- Form --------------- -->

    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <h1>Add Location</h1>
            <form method="post" action="add_location.php">
                <div class="input-box">
                    <input type="text" name="location" placeholder="Location" required>
                    <i class='bx bxs-user'></i>
                </div>
                <button type="submit" name="add" class="login-btn btn">Add</button>
            </form>
        </div>
    </div>

    <script src="script/script.js"></script>
</body>

</html>