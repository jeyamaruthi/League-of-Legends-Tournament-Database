<?php
  include_once 'connection.php';

  mysqli_select_db($conn,"INSERT INTO `tourny_detials` (`T_ID`, `T_Name`, `Winning_Prize`, `No_of_Teams`, `MVP`)
  VALUES ('L101', 'LCS', '5000000', '12', 'Doublelift');");

  echo "Inserted";
 ?>
