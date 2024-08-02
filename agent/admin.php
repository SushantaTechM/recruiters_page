<?php

if (!isset($_SESSION)) {
    // Start Session it is not started yet
    session_start();
}
// session_start();
if (!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin'] != true) {
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
    <script src="../script.js"></script>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/modal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <!-- <link rel="stylesheet" href="styles/project.css"> -->
    <!-- <link rel="stylesheet" href="styles/notification.css"> -->
    <link rel="stylesheet" href="styles/dashboard.css">
    <style>.modal-header {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem;
/ }

</style>
</head>

<body>

    <div class="navbar" style="padding-bottom: 100px;">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
        
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
            <div class="user">
            <a href="admin.php"><button class="dashboard-dropbtn tab">Users</button></a>
                
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
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="admin.php" class="" method="post">
            
            <input type="hidden" name="editUserId" id="editUserId">
            <div class="form-group">
            
              <label for="editType">Type</label>
           
              <select name="editType" id="editType">
                <option value="" disabled selected hidden>Please select Type</option>
                <option value="User">User</option>
                <option value="Agent">Agent</option>
                <option value="Admin">Admin</option>
              </select>
            </div>
            <div class="form-group">
              <label for="editVertical">Vertical</label>
              
              <select name="editVertical" id="editVertical"  required>
                <option value="" >Please select Vertical</option>
                <?php
                $sql4 = "SELECT * from `verticalmaster`";
                $outcome4 = mysqli_query($conn, $sql4);
                while ($row = mysqli_fetch_assoc($outcome4)) {
                  $Customer = $row['Vertical'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="editIBU">IBU</label>
              
              <select name="editIBU" id="editIBU">
                <option value="" disabled selected hidden>Please select IBU</option>
                <?php
                $sql4 = "SELECT * from `ibumaster`";
                $outcome4 = mysqli_query($conn, $sql4);
                while ($row = mysqli_fetch_assoc($outcome4)) {
                  $Customer = $row['IBUname'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>

           
            <button type="submit" class="btn btn-primary" name="update">Update Note</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["update"])) {
          $editType = $_POST["editType"];
        
    
          $editVertical = $_POST['editVertical'];
          $query6 = "SELECT * FROM `verticalmaster` WHERE `Vertical` LIKE '$editVertical'";
          $result6 = mysqli_query($conn, $query6);
          $row6 = mysqli_fetch_assoc($result6);
          $locationid6 = $row6['id'];

          $editIBU = $_POST['editIBU'];
          $query6 = "SELECT * FROM `ibumaster` WHERE `IBUname` LIKE '$editIBU'";
          $result6 = mysqli_query($conn, $query6);
          $row6 = mysqli_fetch_assoc($result6);
          $IBU = $row6['id'];
    
        //   $editProjectName = $_POST['editProjectName'];
          $editUserId = $_POST['editUserId'];
          // echo $editTitle,$editDescription,$editSno;
      
          $SQL = "UPDATE `users` SET `Type` = '$editType',`Vertical`='$locationid6',`IBU`='$IBU' WHERE `Users`.`UserId` = '$editUserId'";
          $result = mysqli_query($conn, $SQL);
          if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your Project Updated Succesfully.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
          } else {
            echo mysqli_error($conn);
          }
        }
    }













  ?>












    <div class="projectContainer">
      <table class="table " id="myTable">
        <thead>
          <tr>

            <th scope="col">UserId</th>
            <th scope="col">UserName</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Type</th>
            <th scope="col">Vertical</th>
            <th scope="col">IBU</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <b>
          <?php
          $sql = "SELECT u.UserId,u.UserName,u.Email,u.Phone,u.Type,v.Vertical,i.IBUname FROM `users` u LEFT JOIN `verticalmaster` v on u.Vertical=v.id LEFT join `ibumaster` i on u.IBU=i.id where (u.vertical is NULL or u.vertical is not NULL ) and (u.IBU is NULL or u.IBU is not NULL )";
          $result = $conn->query($sql);
          if ($result->num_rows > 0){
            $no = 0;
               
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              if($row['Vertical']==NULL and $row['IBUname']==NULL){
                
              
              echo "<tr>
                  <td>" . $row['UserId'] . "</td>
                  <td>" . $row['UserName'] . "</td>
                  <td>" . $row['Email'] . "</td>
                  <td>" . $row['Phone'] . "</td>
                  <td>" . $row['Type'] . "</td>
                  <td>" . null . "</td>
                  <td>" . null . "</td>
                  <td>
                  <button class='edit btn btn-primary'>Assign</button></td>
                  </tr>";
              } else{
                  
              echo "<tr>
              <td>" . $row['UserId'] . "</td>
              <td>" . $row['UserName'] . "</td>
              <td>" . $row['Email'] . "</td>
              <td>" . $row['Phone'] . "</td>
              <td>" . $row['Type'] . "</td>
              <td>" . $row['Vertical'] . "</td>
              <td>" . $row['IBUname'] . "</td>
              <td>
              <button class='edit btn btn-primary'>Assign</button></td>
              </tr>";
              }
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
 
  <script>
    edits = document.getElementsByClassName("edit");
    // console.log(edits);
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        // console.log(tr);
        UserId = tr.getElementsByTagName("td")[0].innerText;
        Type = tr.getElementsByTagName("td")[4].innerText;
        IBU = tr.getElementsByTagName("td")[6].innerText;
        Vertical= tr.getElementsByTagName("td")[5].innerText;
        console.log(Vertical);
        console.log(IBU)
        // Location = tr.getElementsByTagName("td")[5].innerText;
        
        
       

        // console.log(title,description,sno);
        editType.value = Type;
        editIBU.value = IBU;
        editVertical.value = Vertical;
        
        editUserId.value = UserId;
        $('#myModal').modal('toggle')
      })
    })
    </script>

   

    <script src="script/script.js"></script>
    <!-- <script src="script/modal.js"></script> -->
    <script src="script/dashboard.js"></script>
</body>

</html>