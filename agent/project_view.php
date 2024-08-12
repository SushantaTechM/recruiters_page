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

$sql1 = "SELECT * from `customermaster`";
$outcome1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * from `locationmaster`";
$outcome2 = mysqli_query($conn, $sql2);

$skill_query = "SELECT * FROM `skillmaster`";
$skill_outcome = mysqli_query($conn,$skill_query);

$vertical_query = "SELECT * FROM `verticalmaster`";
$vertical_outcome = mysqli_query($conn,$vertical_query);

$IBU_query = "SELECT * FROM `IBUmaster`";
$IBU_outcome = mysqli_query($conn,$IBU_query);


    $skill_query = "SELECT * FROM `skillmaster`";
    $skill_outcome = mysqli_query($conn,$skill_query);
    
    $skillOptions = "";
    while ($row = mysqli_fetch_assoc($skill_outcome)) {
    $Customer = $row['SkillName'];
   
    $skillid = $row['SkillId'];
    $skillOptions .= "<option value='$skillid'>$Customer</option>";
    }
    if (isset($_GET["projectid"])&& isset($_GET["skillid"])) {
      $projectId = $_GET["projectid"];
      $skillid = $_GET["skillid"];
      
     $query1="SELECT * FROM `projectskilldetails` WHERE `Project`='$projectId' and `skill`='$skillid' and `fullfill_headcount`='0'";
     $result1 = mysqli_query($conn, $query1);
      if($result1->num_rows > 0){
      $query = "DELETE FROM `projectskilldetails` WHERE `Projectskilldetails`.`Project` = '$projectId' and `Projectskilldetails`.`skill`='$skillid' and `Projectskilldetails`.`fullfill_headcount`='0'";
  
      $result = mysqli_query($conn, $query);
  
      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Skill Deleted Succesfully.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
      }
    }
    else{
      
          $message = "There are some users assigned to this Skill, so you can not delete it!";
          echo "<script type='text/javascript'>alert('$message');</script>";
       
    }
  }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (isset($_POST["update"])) {
          // $id = $_GET["edit"];
          // echo $id;
        $editProjectName = $_POST["editProjectName"];
        $query7 = "SELECT * FROM `project` WHERE `ProjectName` LIKE '$editProjectName'";
        $result7 = mysqli_query($conn, $query7);
        $row7 = mysqli_fetch_assoc($result7);
        $editcustid = $row7['ProjectId'];
  
      
          $skillid_old=$_POST['skillid_old'];
          
         $editSkillName1 = $_POST['editSkillName'];
        $editSkillName = $_POST['editSkillName'];
        $query6 = "SELECT * FROM `skillMaster` WHERE `SkillName` LIKE '$editSkillName'";
        $result6 = mysqli_query($conn, $query6);
        $row6 = mysqli_fetch_assoc($result6);
        $Skillid = $row6['SkillId'];
  
        $RequiredHeadcount = $_POST['editRequiredHeadcount'];
        $FullfillHeadcount = $_POST['editFullfillHeadcount'];
      
        $editProjectId = $_POST['editProjectId'];
       
          $check1="SELECT skill from `projectskilldetails` where `Project`='$editProjectId' and `skill`='$Skillid'";
          $project_result11 = mysqli_query($conn,$check1);
          if($project_result11->num_rows > 0){
              $message = "Skill already exist!";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
              $SQL = "UPDATE `Projectskilldetails` SET `Skill` = '$Skillid',`required_headcount`='$RequiredHeadcount',`fullfill_headcount`= '$FullfillHeadcount' WHERE `Projectskilldetails`.`Project` = '$editProjectId'and `Projectskilldetails`.`skill`='$skillid_old'";
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
  }


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/project.css">
  <!-- <link rel="stylesheet" href="styles/modal.css"> -->
  <!-- <link rel="stylesheet" href="styles/navbar.css"> -->

  <title>Project</title>
</head>

<body>

  <!------------------------ Navbar  ------------->
  <?php  include('navbar.php') ?>


    <div class="add_skill">
        <form action="project_view.php" method="post">
            <div class="form-group">
                <label for="ProjectName">Project Name</label>
                <select name="ProjectName" id="ProjectName">
                    <option value="" disabled selected hidden>Please select Project</option>
                    <?php
                    $sql10 = "SELECT * from `project`";
                    $outcome10 = mysqli_query($conn, $sql10);
                    while ($row = mysqli_fetch_assoc($outcome10)) {
                        $Customer = $row['ProjectName'];
                        $projectid= $row['ProjectId'];
                        echo "<option value='$projectid'>$Customer</option>";
                    }
                    ?>
                </select>
            </div>
            
            <style>
    .form-group {
      margin-bottom: 15px;
    }
    .skill-entry {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }
    .skill-entry select, .skill-entry input {
      margin-right: 10px;
      background: transparent;
    color: white;
    padding: 0.2rem 0.3rem;
    border: 2px solid skyblue;
    }
    .skill-entry button {
      margin-left: 10px;
    }
  </style>
      <div id="skillsContainer">
      <div class="form-group skill-entry">
        <label for="title3">Skill</label>&emsp;
        <select name="title3[]" class="skill-select" id="skill">
          <option value="" disabled selected hidden id="skill">Please select Skill</option>
          <?php echo $skillOptions; ?>
        </select>&emsp;&emsp;&emsp;
        <label for="headcount">Required Headcount</label>&emsp;
        <input type="number" name="headcount[]" class="headcount-input" min="1" placeholder="Enter headcount" id="skill">
        <button type="button" class="remove-skill-btn">Remove</button>
      </div> 
    </div>
    <button type="button" id="addSkillBtn">+</button><br><br>
    <button type="submit" id="updateSkillBtn" name="updateSkillBtn" style="color: #fff;background-color: #007bff;border-color: #007bff;border-radius: .25rem;width: 80px;height: 40px;">Map Skill</button><br><br>
    <?php
    $skill_query = "SELECT * FROM `skillmaster`";
    $skill_outcome = mysqli_query($conn,$skill_query);
    
    $skillOptions = "";
    while ($row = mysqli_fetch_assoc($skill_outcome)) {
    $Customer = $row['SkillName'];
   
    $skillid = $row['SkillId'];
    $skillOptions .= "<option value='$skillid'>$Customer</option>";
    }
    ?>

           
    </form>
    </div>

<?php


    if (isset($_POST["updateSkillBtn"])) {
        $projectid = $_POST['ProjectName'];
        $skills = $_POST['title3'];
        $headcounts = $_POST['headcount'];
    for ($x = 0; $x < count($skills); $x++) {
        $check="SELECT skill FROM `projectskilldetails` WHERE `project`='$projectid' and `skill`='$skills[$x]'";
        $project_result4 = mysqli_query($conn,$check);
        if($project_result4->num_rows > 0){
            $message = "Skill already exist!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            
            break;
        }
        else{
            $project_query2="INSERT INTO `projectskilldetails` (`project`, `skill`, `required_headcount`,`fullfill_headcount`) VALUES ('$projectid', '$skills[$x]' ,'$headcounts[$x]','0')";
            $project_result2 = mysqli_query($conn,$project_query2);
        }
    }
 
    // for ($x = 0; $x < count($skills); $x++) {
    //     $project_query2="INSERT INTO `projectskilldetails` (`project`, `skill`, `required_headcount`,`fullfill_headcount`) VALUES ('$projectid', '$skills[$x]' ,'$headcounts[$x]','0')";
    //     $project_result2 = mysqli_query($conn,$project_query2);
    // }
}
// else{
//     echo mysqli_error($_POST);
// }



?>
  <!-- Modal -->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: transparent;border: 2px solid white;color: white;backdrop-filter: blur(20px);font-size: 20px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="project_view.php" class="" method="post">
         
            <input type="hidden" name="editProjectId" id="editProjectId">
            <input type="hidden"  name="skillid_old" id="skillid_old" >
            <!-- <input type="hidden" name="editSkillName" id="editSkillName"> -->
            <div class="form-group">
              <label for="editProjectName" >Project Name</label>
                <input name="editProjectName" type="text" class="form-control" id="editProjectName" aria-describedby="emailHelp" readonly>
            </div>

           
            <div class="form-group">
              <label for="editSkillName">Skill</label>
              
             
              <select name="editSkillName" id="editSkillName">
                <option value="" disabled selected hidden>Please select Skill</option>
                <?php
                $sql4 = "SELECT * from `skillmaster`";
                $outcome4 = mysqli_query($conn, $sql4);
                while ($row = mysqli_fetch_assoc($outcome4)) {
                  $Customer = $row['SkillName'];
                  echo "<option value='$Customer'>$Customer</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="editRequiredHeadcount">RequiredHeadcount</label>
              <input name="editRequiredHeadcount" class="form-control" id="editRequiredHeadcount" rows="3"
                placeholder="please add description..."></input>
            </div>
            <div class="form-group">
              <label for="editFullfillHeadcount">FullfillHeadcount</label>
              <input name="editFullfillHeadcount" class="form-control" id="editFullfillHeadcount" rows="3"
                placeholder="please add description..."></input>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
          </form>
        </div>

      </div>
    </div>
  </div>




<div class="projectContainer">
      <table class="table " id="myTable">
        <thead>
          <tr>
        
            <th scope="col">ProjectId</th>
            <th scope="col">Project</th>
            <th scope="col">SkillName</th>
            <th scope="col">RequiredHeadcount</th>
            <th scope="col">fullfill_headcount</th>
          
            
            <th scope="col">Action</th>
          </tr>
        </thead>

        <b>
          <?php
         
          $sql="SELECT p.ProjectId,p.ProjectName,s.Skillname,s.SkillId,psd.required_headcount,psd.fullfill_headcount ,psd.skill FROM projectskilldetails psd JOIN project p ON psd.project=p.ProjectId JOIN skillmaster s ON psd.skill=s.SkillId";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $no = 0;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $no++;
              echo "<tr>
                  <td>" . $row['ProjectId'] . "</td>
                  <td>" . $row['ProjectName'] . "</td>
                  <td>" . $row['Skillname'] . "</td>
                  <td>" . $row['required_headcount'] . "</td>
                  <td>" . $row['fullfill_headcount'] . "</td>
                  <input type='hidden' id='skillid' value=" . $row['SkillId'] . ">
                  <td>
                  <button class='edit btn btn-primary' id='" . $row['SkillId'] . "'>Edit</button>
                  <button class='delete btn btn-danger'  id='skillid=" . $row['SkillId'] . "projectId=" . $row['ProjectId'] . "'>Delete</button></td>
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
  <script>
    edits = document.getElementsByClassName("edit");
    // console.log(edits);
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        // console.log(tr);
        ProjectId = tr.getElementsByTagName("td")[0].innerText;
        ProjectName = tr.getElementsByTagName("td")[1].innerText;
        SkillName=tr.getElementsByTagName("td")[2].innerText;
        RequiredHeadcount=tr.getElementsByTagName("td")[3].innerText;
        // CustomerId = tr.getElementsByTagName("td")[2].innerText;
        // StartDate = tr.getElementsByTagName("td")[3].innerText;
        // EndDate = tr.getElementsByTagName("td")[4].innerText;
        FullfillHeadcount = tr.getElementsByTagName("td")[4].innerText;
        
        
       
        skillid=tr.getElementsByTagName("input")[0].value;
        // console.log(skillid);
        // console.log(title,description,sno);
        editSkillName.value = SkillName;
        editRequiredHeadcount.value = RequiredHeadcount;
        editFullfillHeadcount.value = FullfillHeadcount;
        skillid_old.value=skillid;
        editProjectName.value = ProjectName;
        editProjectId.value = ProjectId;
        $('#myModal').modal('toggle')
      })
    })
    deletes = document.getElementsByClassName("delete");
    // console.log(edits);
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        id = e.target.id.substr();
        console.log(id);
        // const id='skillid=1projectid=1';
        const regex=/skillid=(\d+)projectid=(\d+)/i;
        const match=id.match(regex);
        // console.log(match)
        if(match){
            var skillid=match[1];
            var projectid=match[2];
            console.log(skillid,projectid)
        }
        if (confirm('Are you sure to delete')) {
            window.location = "project_view.php?projectid=" + projectid +"&skillid="+skillid;
        }
        else {
          console.log('no');
        }

      })
    })
  </script>
  <script src="script/script.js"></script>
  <script>
    const skillOptions = `<?php echo $skillOptions; ?>`;

    document.getElementById('addSkillBtn').addEventListener('click', function() {
      const skillEntryTemplate = `
        <div class="form-group skill-entry">
          <label for="title3">Skill</label>&emsp;
          <select name="title3[]" class="skill-select" id="skill">
            <option value="" disabled selected hidden>Please select Skill</option>
            ${skillOptions}
          </select>&emsp;&emsp;&emsp;
          <label for="headcount">Required Headcount</label>&emsp;
          <input type="number" name="headcount[]" class="headcount-input" min="1" placeholder="Enter headcount">
          <button type="button" class="remove-skill-btn">Remove</button>
        </div>
      `;

      const skillsContainer = document.getElementById('skillsContainer');
      skillsContainer.insertAdjacentHTML('beforeend', skillEntryTemplate);
    });

    document.getElementById('skillsContainer').addEventListener('click', function(event) {
      if (event.target.classList.contains('remove-skill-btn')) {
        event.target.parentElement.remove();
      }
    });
  </script>
  <!-- sushanta -->
</body>

</html>
