<?php
include ('../../database/dbconnect.php');


if(isset($_POST['verticalId'])){
    $verticalId = $_POST['verticalId'];
    $sql = "SELECT * FROM ibumaster WHERE verticalid = '$verticalId'";

    $result = mysqli_query($conn, $sql);

    $ibus = array();
    while($row = mysqli_fetch_assoc($result)){
        $ibus[] = $row;
    }
    echo json_encode($ibus);
}
else{
    echo json_encode(["error" => "Vertical Id not provided"]);
}
?>