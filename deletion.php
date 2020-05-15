<?php
require 'connection.php';

//$sql3 = "DROP TABLE champion_stats";
//mysqli_query($conn, $sql3);

$sql12 = "DROP TABLE champions_has_player_details";
mysqli_query($conn, $sql12);

if(isset($_POST['delete-button'])){

  // sql to delete a record
$sql = "DROP TABLE match_overview";
mysqli_query($conn, $sql);

$sql2 = "DROP TABLE champions";
mysqli_query($conn, $sql2);

$sql3 = "DROP TABLE champion_stats";
mysqli_query($conn, $sql3);

$sql4 = "DROP TABLE mages";
mysqli_query($conn, $sql4);

$sql5 = "DROP TABLE Matches";
mysqli_query($conn, $sql5);

$sql6 = "DROP TABLE non-Mages";
mysqli_query($conn, $sql6);

$sql7 = "DROP TABLE overall_player_state";
mysqli_query($conn, $sql7);

$sql8 = "DROP TABLE player_details";
mysqli_query($conn, $sql8);

$sql9 = "DROP TABLE sponsor_details";
mysqli_query($conn, $sql9);

$sql10 = "DROP TABLE teams";
mysqli_query($conn, $sql10);

$sql11 = "DROP TABLE tourny_detials";
mysqli_query($conn, $sql11);

$sql12 = "DROP TABLE champions_has_player_details";
mysqli_query($conn, $sql12);


echo "Table Deleted";
}
?>
