<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style2.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="wrapper">
    <nav class="row">
      <ul class="header-panel">
        <li><a href="/DB/">First</a></li>
        <li><a href="/DB/2nd.php">Second</a></li>
        <li><a href="/DB/3rd.php">Third</a></li>
          </ul>
    </nav>
    <div class="lul">

    </div>
  </div>
  </body>
</html>

<?php
require 'connection.php';
//echo "Hello";

if(isset($_POST['query1-submit'])){

  $gold = $_POST['gold'];
  $gold = (int)$gold;
  //echo "Hi";
  //echo $gold;

  // $sql = "SELECT Matches_Match_ID from match_overview where
  // Gold_Advantage >?";
  // $stmt  = mysqli_stmt_init($conn);
  // if(!mysqli_stmt_prepare($stmt,$sql)){
  //   header("Location: /index.php?sql-error");
  //   exit();
  // }
  // else {
  //   mysqli_stmt_bind_param($stmt,"s",$gold);
  // }


  $sql = "SELECT * from match_overview where
   Gold_Advantage > '$gold'";
  $result = mysqli_query($conn,$sql);
  $resultchk = mysqli_num_rows($result);
  $count1 = 0;

  if($resultchk >0){

    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          echo "<td>".$row['Matches_Match_ID']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }
}


/********** Query 2 *******************/
if(isset($_POST['query2-submit'])){

  $date = $_POST['date'];
  //echo $date;

  $sql2 = "SELECT * from matches where
   Date = '$date'";
  $result2 = mysqli_query($conn,$sql2);
  //$resultchk2 = mysqli_num_rows($result2);
  $count1 = 0;

  if(mysqli_num_rows($result2) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result2)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['Team_1']."</td>"."<td>".$row['Team_2']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }
}




/******************** Query 3 *************************/

if(isset($_POST['query3-submit'])){

  $CS = $_POST['CS'];
  //echo $CS;

  $sql3 = "SELECT CS_Per_Min, Count(*) from overall_player_state where
  CS_Per_Min = '10';";
  $result3 = mysqli_query($conn,$sql3);
  //$resultchk2 = mysqli_num_rows($result2);
  $count1 = 0;


  if(mysqli_num_rows($result3) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result3)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['CS_Per_Min']."</td>"."<td>".$row['Count(*)']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }
}

/******************** Query 4 *************************/
  if(isset($_POST['query4-submit'])){

    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    //echo $c1;
    //echo $c2;

    $sql3 = "SELECT *  from player_details where
    No_Of_Champions between '$c1' and '$c2';";
    $result3 = mysqli_query($conn,$sql3);
    //$resultchk2 = mysqli_num_rows($result2);
    $count1 = 0;


    if(mysqli_num_rows($result3) >0){
      //echo "Hello2";
      echo "<table border =1>";
        while($row = mysqli_fetch_assoc($result3)){
          $count1++;
          if($count1 == 1)
          {
            echo "<tr>".PHP_EOL;
          }
            //echo "Hello";
            echo "<td>".$row['Player_Name']."</td>";
            //."<td>".$row['Count(*)']."</td>";
            $count1 = 0;
        }
      echo "</table>";
    }
}
/******************** Query 5 *************************/
if(isset($_POST['query5-submit'])){

  $c1 = $_POST['player'];
  //$c2 = $_POST['c2'];
  //echo $c1;
  //echo $c2;


  $sql5 = "SELECT Team_Name,Sponsor_Name from teams
  inner join sponsor_details on Team_ID = Teams_Team_ID and
   No_Of_Players = '$c1'";
  $result5 = mysqli_query($conn,$sql5);
  //$resultchk2 = mysqli_num_rows($result2);
  $count1 = 0;


  if(mysqli_num_rows($result5) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result5)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['Team_Name']."</td>"."<td>".$row['Sponsor_Name']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }
}


/******************** Query 6 *************************/
if(isset($_POST['query6-submit'])){

  $kills = $_POST['kills'];
  //$c2 = $_POST['c2'];
  //echo $c1;
  //echo $c2;
  //echo $kills;


  $sql6 = "SELECT Player_Name,Role from player_details
  inner join overall_player_state on P_ID = Player_Details_P_ID
  and Player_Kills > '$kills'";
  $result6 = mysqli_query($conn,$sql6);
  //$resultchk2 = mysqli_num_rows($result2);
  $count1 = 0;


  if(mysqli_num_rows($result6) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result6)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['Player_Name']."</td>"."<td>".$row['Role']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }

}

if(isset($_POST['query7-submit'])){

  $player = $_POST['player'];
  //$c2 = $_POST['c2'];
  //echo $c1;
  //echo $c2;
  //echo $player;


  $sql7 = "SELECT Team_Name,Sponsor_Name from teams
  inner join sponsor_details on Team_ID = Teams_Team_ID
  and No_Of_Players = '$player'";
  $result7 = mysqli_query($conn,$sql7);
  //$resultchk2 = mysqli_num_rows($result2);
  $count1 = 0;


  if(mysqli_num_rows($result7) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result7)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['Team_Name']."</td>"."<td>".$row['Sponsor_Name']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }

}
if(isset($_POST['query8-submit'])){

  $skills = $_POST['skills'];
//echo $skills;
  $sql8 = "SELECT Player_Name,Count(*) from player_details
  inner join mages on P_ID = Champions_Player_Details_P_ID group by Champions_Player_Details_P_ID";
  //having skills ='$skills'";
  $result8 = mysqli_query($conn,$sql8);
  //$resultchk2 = mysqli_num_rows($result);
  $count1 = 0;


  if(mysqli_num_rows($result8) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result8)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['Player_Name']."</td>"."<td>".$row['Count(*)']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }
}

if(isset($_POST['query9-submit'])){

  $champ = $_POST['champ'];

  //echo $champ;

  $sql9 = "SELECT sum(Player_Kills), CS_Per_Min, Wards from overall_player_state
  group by CS_Per_Min having wards = '$champ' order by Wards";
  $result9 = mysqli_query($conn,$sql9);
  //$resultchk2 = mysqli_num_rows($result);
  $count1 = 0;


  if(mysqli_num_rows($result9) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result9)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['sum(Player_Kills)']."</td>"."<td>".$row['CS_Per_Min']."</td>".
          "<td>".$row['Wards']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }

}

if(isset($_POST['query10-submit'])){

  $tid= $_POST['tid'];

  //echo $tid;


  $sql10 = "SELECT T_Name,Match_ID,Team_Name from tourny_detials,matches,teams
  where Matches_Match_ID = Match_ID and Tourny_Detials_T_ID = T_ID and Date = '$tid'";
  $result10 = mysqli_query($conn,$sql10);
  //$resultchk2 = mysqli_num_rows($result);
  $count1 = 0;


  if(mysqli_num_rows($result10) >0){
    //echo "Hello2";
    echo "<table border =1>";
      while($row = mysqli_fetch_assoc($result10)){
        $count1++;
        if($count1 == 1)
        {
          echo "<tr>".PHP_EOL;
        }
          //echo "Hello";
          echo "<td>".$row['T_Name']."</td>"."<td>".$row['Match_ID']."</td>".
          "<td>".$row['Team_Name']."</td>";
          $count1 = 0;
      }
    echo "</table>";
  }

}
 ?>
