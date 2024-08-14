<?php
include ('dbconnect.php');
// Insert Dummy Data
$sql = "INSERT INTO `locationmaster` (`LocationId`, `LocationName`,`LocationState`,`LocationHeadName`,       
      `LocationHeadEmail`, `LocationHeadMobile`) VALUES (NULL, 'Madrid', 'Spain', 'Fiorentino Perez','perez@gmail.com', '9830329921');

      INSERT INTO `locationmaster` (`LocationId`, `LocationName`, `LocationState`, `LocationHeadName`, `LocationHeadEmail`, `LocationHeadMobile`) VALUES (NULL, 'New York', 'United States', 'Christian Pulisic', 'pulisic@gmail.com', '9830329921');

      INSERT INTO `locationmaster` (`LocationId`, `LocationName`, `LocationState`, `LocationHeadName`, `LocationHeadEmail`, `LocationHeadMobile`) VALUES (NULL, 'London', 'England', 'Declan Rice', 'rice@gmail.com', '9830329921');

      INSERT INTO `locationmaster` (`LocationId`, `LocationName`, `LocationState`, `LocationHeadName`, `LocationHeadEmail`, `LocationHeadMobile`) VALUES (NULL, 'Amsterdam', 'Netherlands', 'Virgil Van Djik', 'virgil@gmail.com', '9830329921');

      INSERT INTO `locationmaster` (`LocationId`, `LocationName`, `LocationState`, `LocationHeadName`, `LocationHeadEmail`, `LocationHeadMobile`) VALUES (NULL, 'Paris', 'France', 'Kylian Mbappe', 'mbappe@gmail.com', '9830329921');
      

      INSERT INTO `skillmaster` (`SkillId`, `SkillName`,`SkillDescription`) VALUES (NULL, 'PHP',
      'php 8.3 required');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`,`SkillDescription`) VALUES (NULL, 'Java',
      'jdk 22 required');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`,`SkillDescription`) VALUES (NULL, 'Python',
      'python 3.4 required');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`,`SkillDescription`) VALUES (NULL, 'JavaScript',
      'javascript es7 required');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`,`SkillDescription`) VALUES (NULL, 'NodeJs',
      'nodejs 21 required');


      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'John Doe',1);
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'Michael Paul',2);
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'Jonathan Jobs',3);


      INSERT INTO `verticalmaster` (`id`, `Vertical`) VALUES (NULL, 'XDS');
      INSERT INTO `verticalmaster` (`id`, `Vertical`) VALUES (NULL, 'BFSI');
      INSERT INTO `verticalmaster` (`id`, `Vertical`) VALUES (NULL, 'UTILITY');


      INSERT INTO `ibumaster` (`id`, `verticalid`, `IBUname`, `owner`, `status`) VALUES (NULL, '1', 'XDS-4001', 'Shawshank Tamotia', 'Open');
      INSERT INTO `ibumaster` (`id`, `verticalid`, `IBUname`, `owner`, `status`) VALUES (NULL, '1', 'XDS-4002', 'Shawshank Tamotia', 'Open');
      INSERT INTO `ibumaster` (`id`, `verticalid`, `IBUname`, `owner`, `status`) VALUES (NULL, '1', 'XDS-4003', 'Shawshank Tamotia', 'Open');


      INSERT INTO `project` (`ProjectId`, `CustomerId`, `StartDate`, `EndDate`, `Location`, `ProjectName`, `VerticalId`, `IBUId`, `status`) VALUES (NULL, '1', '2024-07-15', '2024-08-31', '1', 'Born', '1', '1', 'active');
      INSERT INTO `project` (`ProjectId`, `CustomerId`, `StartDate`, `EndDate`, `Location`, `ProjectName`, `VerticalId`, `IBUId`, `status`) VALUES (NULL, '2', '2024-07-15', '2024-08-31', '2', 'SBI-Banking', '2', '2', 'active');
      INSERT INTO `project` (`ProjectId`, `CustomerId`, `StartDate`, `EndDate`, `Location`, `ProjectName`, `VerticalId`, `IBUId`, `status`) VALUES (NULL, '3', '2024-07-15', '2024-08-31', '3', 'Redbull', '3', '3', 'closed');


      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '2', '1', '20', '0');
      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '2', '2', '10', '0');
      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '2', '3', '15', '0');
      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '1', '4', '20', '0');
      INSERT INTO `projectskilldetails` (`slno`, `project`, `skill`, `required_headcount`, `fullfill_headcount`) VALUES (NULL, '1', '5', '10', '0');
      

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'agent', '12345678', 'Agent', 'agent@gmail.com', '1234567890', '1', '1');

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'admin', '12345678', 'Admin', 'admin@gmail.com', '1234567890', '', '');

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'Riju Dasgupta', '12345678', 'User', 'riju@gmail.com', '1234567890', '', '');

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'Santanu Nayak', '12345678', 'User', 'santanu@gmail.com', '1234567890', '', '');

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'Soumita Maity', '12345678', 'User', 'soumita@gmail.com', '1234567890', '', '');

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'Harsh Harshit', '12345678', 'User', 'harsh@gmail.com', '1234567890', '', '');

      INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Type`, `Email`, `Phone`, `VerticalId`, `IBUId`) VALUES (NULL, 'Anjali Kumari', '12345678', 'User', 'anjali@gmail.com', '1234567890', '', '');



      INSERT INTO `userdetails` (`SlNo`, `UserId`, `FirstName`, `LastName`, `Age`, `Location`, `Email`, `HighestQualification`, `Experience`, `About`, `Gender`) VALUES (NULL, '3', 'Riju', 'Dasgupta', '23', '1', 'riju@gmail.com', 'B. Tech', '1yr', 'Hii, I am Riju ', 'M');

      INSERT INTO `userdetails` (`SlNo`, `UserId`, `FirstName`, `LastName`, `Age`, `Location`, `Email`, `HighestQualification`, `Experience`, `About`, `Gender`) VALUES (NULL, '4', 'Santanu', 'Nayak', '23', '2', 'santanu@gmail.com', 'B. Tech', '1yr', 'Hii, I am Santanu ', 'M');

      INSERT INTO `userdetails` (`SlNo`, `UserId`, `FirstName`, `LastName`, `Age`, `Location`, `Email`, `HighestQualification`, `Experience`, `About`, `Gender`) VALUES (NULL, '5', 'Soumita', 'Maity', '22', '3', 'soumita@gmail.com', 'B. Tech', '1yr', 'Hii, I am Soumita ', 'F');

      INSERT INTO `userdetails` (`SlNo`, `UserId`, `FirstName`, `LastName`, `Age`, `Location`, `Email`, `HighestQualification`, `Experience`, `About`, `Gender`) VALUES (NULL, '6', 'Harsh', 'Harshit', '23', '4', 'harsh@gmail.com', 'B. Tech', '2yr', 'Hii, I am Harsh ', 'M');

      INSERT INTO `userdetails` (`SlNo`, `UserId`, `FirstName`, `LastName`, `Age`, `Location`, `Email`, `HighestQualification`, `Experience`, `About`, `Gender`) VALUES (NULL, '7', 'Anjali', 'Kumari', '22', '5', 'anjali@gmail.com', 'B. Tech', '4yr', 'Hii, I am Anjali ', 'F');



      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '3', '1', 'Primary');
      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '3', '2', 'Secondary');
      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '3', '3', 'Secondary');
      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '4', '2', 'Primary');
      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '5', '3', 'Primary');
      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '6', '4', 'Primary');
      INSERT INTO `userskilldetails` (`SlNo`, `UserId`, `SkillId`, `SkillType`) VALUES (NULL, '7', '5', 'Primary');


    ";
if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();