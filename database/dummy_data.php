<?php
include('dbconnect.php');
// Insert Dummy Data
$sql="INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'New York');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'London');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'Amsterdam');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'Paris');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'Madrid');

      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'PHP');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'Java');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'Python');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'JavaScript');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'NodeJs');

      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'John Doe',1);
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'Michael Paul',2);
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'Jonathan Jobs',3);

      INSERT INTO `verticalmaster` (`id`, `Vertical`) VALUES (NULL, 'XDS');
      INSERT INTO `verticalmaster` (`id`, `Vertical`) VALUES (NULL, 'BFSI');
      INSERT INTO `verticalmaster` (`id`, `Vertical`) VALUES (NULL, 'UTILITY');

      INSERT INTO `ibumaster` (`id`, `verticalid`, `IBUname`, `owner`, `status`) VALUES (NULL, '1', 'XDS-4001', 'Shawshank Tamotia', 'Open');
      INSERT INTO `ibumaster` (`id`, `verticalid`, `IBUname`, `owner`, `status`) VALUES (NULL, '1', 'XDS-4002', 'Shawshank Tamotia', 'Open');
      INSERT INTO `ibumaster` (`id`, `verticalid`, `IBUname`, `owner`, `status`) VALUES (NULL, '1', 'XDS-4003', 'Shawshank Tamotia', 'Open');

      INSERT INTO `project` (`ProjectId`, `CustomerId`, `StartDate`, `EndDate`, `Location`, `ProjectName`, `VerticalId`, `IBUId`, `status`) VALUES (NULL, '1', '2024-07-15', '2024-08-31', '1', 'Born', '1', '1', '');
      INSERT INTO `project` (`ProjectId`, `CustomerId`, `StartDate`, `EndDate`, `Location`, `ProjectName`, `VerticalId`, `IBUId`, `status`) VALUES (NULL, '2', '2024-07-15', '2024-08-31', '2', 'SBI-Banking', '2', '2', '');
      INSERT INTO `project` (`ProjectId`, `CustomerId`, `StartDate`, `EndDate`, `Location`, `ProjectName`, `VerticalId`, `IBUId`, `status`) VALUES (NULL, '3', '2024-07-15', '2024-08-31', '3', 'Redbull', '3', '3', '');

      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '2', '1', '20', '');
      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '2', '2', '10', '');
      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '2', '3', '15', '');

    ";
if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();