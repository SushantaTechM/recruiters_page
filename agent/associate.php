<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
// session_start();
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
        .dashboard-main-tabs{
            padding-bottom: 0.5rem;
            margin-left: 2rem;
            margin-top: 2rem;
            font-size: 15px;
            margin-top: 2rem;
            font-size: 15px;
        }
        .dashboard-main-tabs button{
            font-weight: bold;
            font-size: 15px;
            color: white;
            background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
            border: 2px solid black;
            border-radius: 5px;
            padding: 7px 12px;
            cursor: pointer;
            font-size: 15px;
            color: white;
            background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
            border: 2px solid black;
            border-radius: 5px;
            padding: 7px 12px;
            cursor: pointer;
        }
        .dashboard-tabs{
            margin-left: 2rem;
        }
        .dashboard-tabs button{
            font-weight: bold;
            font-size: 18px;
            color: white;
            background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
            border: 2px solid black;
            border-radius: 5px;
            padding: 7px 12px;
            cursor: pointer;
            color: white;
            background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219));
            border: 2px solid black;
            border-radius: 5px;
            padding: 7px 12px;
            cursor: pointer;
        }
        button.currently_set{
            border: 3px solid #267d60;
        }
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
    </style>
</head>

<body style="background:url('../images/gradient.jpg') no-repeat; background-position:center; background-size: cover;">
<body style="background:url('../images/gradient.jpg') no-repeat; background-position:center; background-size: cover;">
    <!-- ----------------- Navbar --------------- -->
    <?php include('navbar.php') ?>
    
    <div class="dashboard-main-tabs">
        <a href="dashboard.php"><button class='';>Project</button></a>
        <a href="associate.php"><button class='currently_set';>Associates</button></a>
    </div>
    <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab' style="color:white; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border:2px solid black;  font-size: 15px; padding: 7px 15px;">SoftLock data</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab' style="color:white; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border:2px solid black;  font-size: 15px; padding: 7px 15px;">Confirmed data</button>
        <button name='dataset' value='Available Data' class='dashboard-available-tab' style="color:white; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border:2px solid black; font-size: 15px; padding: 7px 15px;">Available data</button>
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab' style="color:white; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border:2px solid black;  font-size: 15px; padding: 7px 15px;">SoftLock data</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab' style="color:white; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border:2px solid black;  font-size: 15px; padding: 7px 15px;">Confirmed data</button>
        <button name='dataset' value='Available Data' class='dashboard-available-tab' style="color:white; background: linear-gradient(to right,rgb(83, 73, 219), rgb(148, 95, 141), rgb(51, 62, 219)); border:2px solid black; font-size: 15px; padding: 7px 15px;">Available data</button>
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