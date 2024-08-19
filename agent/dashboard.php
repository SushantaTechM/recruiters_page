<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
if ( !isset($_SESSION['agentLogin']) && !isset($_SESSION['adminLogin'])  )  {
    header('location:../index.php');
    exit;
}

include ("../database/dbconnect.php");


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
  <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/project.css">
  <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/modal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/notification.css">
    <link rel="stylesheet" href="styles/dashboard.css">

</head>
<style>
  .dashboard-tabs{
    margin-left: 2rem;
    margin-bottom: 0.5rem;
    /* text-align: center; */
  }
  .dashboard-tabs button{
    font-size: 18px;
    color: skyblue;
    background-color: transparent;
    border: 2px solid skyblue;
    border-radius: 20px;
    padding: 3px 12px;
  }
  .dashboard-tabs a{
    color: white;
    text-decoration: none;
  }
  button.currently_set{
    /* border: 3px solid #a382af; */
    color: white;
    background: skyblue;
    font-weight: bold;
  }

</style>

<body>

  <!-- ----------------- Navbar --------------- -->
   
  <?php  include('navbar.php') ?>

  <div class="dashboard-tabs">
        <a href="dashboard.php" ><button style="color: white;background:skyblue;font-weight:bold;">Project</button></a>
        <a href="associate.php" ><button>Associates</button></a>
    </div>
  
  <!--------------- Modal -------------------->
  

  <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab'>Active Project</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab'>Closed Project</button>
        
    </div>

    <div class="dashboard-tab-content">
        <div class="dashboard-softlock-content" id="dashboard-softlock-content"></div>

        <!------------------- Modal  --------------------->
        <div class="modal" id="user-modal">
            <div class="modal-content">
                <span class="close-btn"
                    onclick="document.getElementById('user-modal2').style.display='none'">&times;</span>
                <div class="head">
                    <!-- <img id="modal-image" height="100px" src="" alt="user-image" /> -->
                    <span class="about">
                        <p id="modal-name"></p>
                        
                    </span>
                </div>
                <div class="details">
                    <span>
                        <p id="modal-email"></p>
                       
                    </span>
                    <span id="left">
                        <p id="modal-gender"></p>
                        
                    </span>
                </div>
                
            </div>
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
  

  <script src="script/script.js"></script>
  
  <!-- <script src="script/project_modal.js"></script> -->
  <script src="script/project_type.js"></script>
    <script src="script/modal.js"></script>
    <!-- <script src="script/dashboard.js"></script> -->
</body>

</html>