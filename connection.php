<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "league_of_legends";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
$db = mysqli_select_db($conn,"league_of_legends");

if(isset($_POST['create-button'])){

//echo "Hello Create";
mysqli_query($conn,"CREATE TABLE `tourny_detials` (
  `T_ID` varchar(45) NOT NULL,
  `T_Name` varchar(45) NOT NULL,
  `Winning_Prize` varchar(45) DEFAULT NULL,
  `No_of_Teams` varchar(45) NOT NULL,
  `MVP` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`T_ID`),
  UNIQUE KEY `T_Name_UNIQUE` (`T_Name`),
  FULLTEXT KEY `T_Name` (`T_Name`) /*!80000 INVISIBLE */
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");


mysqli_query($conn,"CREATE TABLE `matches` (
  `Match_ID` varchar(45) NOT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Team_1` varchar(45) DEFAULT NULL,
  `Team_2` varchar(45) DEFAULT NULL,
  `Tourny_Detials_T_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Match_ID`),
  KEY `fk_Matches_Tourny_Detials1_idx` (`Tourny_Detials_T_ID`),
  CONSTRAINT `fk_Matches_Tourny_Detials1` FOREIGN KEY (`Tourny_Detials_T_ID`) REFERENCES `tourny_detials` (`T_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `match_overview` (
  `Gold_Advantage` int(11) DEFAULT NULL,
  `Total_Kills_T` int(11) DEFAULT NULL,
  `Total_Assists_T` int(11) DEFAULT NULL,
  `Matches_Match_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Matches_Match_ID`),
  KEY `fk_Match_Overview_Matches1_idx` (`Matches_Match_ID`),
  CONSTRAINT `fk_Match_Overview_Matches1` FOREIGN KEY (`Matches_Match_ID`) REFERENCES `matches` (`Match_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");


mysqli_query($conn,"CREATE TABLE `teams` (
  `Team_ID` varchar(45) NOT NULL,
  `No_Of_Players` int(11) DEFAULT NULL,
  `Team_Name` varchar(45) NOT NULL,
  `No_Of_Matches` int(11) DEFAULT NULL,
  `Matches_Match_ID` varchar(45) NOT NULL,
  `Matches_Match_ID1` varchar(45) NOT NULL,
  PRIMARY KEY (`Team_ID`,`Matches_Match_ID`),
  KEY `fk_Teams_Matches1_idx` (`Matches_Match_ID1`),
  FULLTEXT KEY `Team_Name` (`Team_Name`),
  CONSTRAINT `fk_Teams_Matches1` FOREIGN KEY (`Matches_Match_ID1`) REFERENCES `matches` (`Match_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `sponsor_details` (
  `Sponsor_Name` varchar(45) NOT NULL,
  `Contract_Date` varchar(45) DEFAULT NULL,
  `Teams_Team_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Sponsor_Name`,`Teams_Team_ID`),
  KEY `fk_Sponsor_Details_Teams1_idx` (`Teams_Team_ID`),
  CONSTRAINT `fk_Sponsor_Details_Teams1` FOREIGN KEY (`Teams_Team_ID`) REFERENCES `teams` (`Team_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `player_details` (
  `P_ID` varchar(45) NOT NULL,
  `Player_Name` varchar(45) DEFAULT NULL,
  `No_Of_Champions` int(11) DEFAULT NULL,
  `Role` varchar(45) NOT NULL,
  `Real_Name` varchar(45) DEFAULT NULL,
  `Teams_Team_ID` varchar(45) NOT NULL,
  `Teams_Matches_Match_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`P_ID`),
  UNIQUE KEY `Player_Name_UNIQUE` (`Player_Name`) /*!80000 INVISIBLE */,
  KEY `Player_Name` (`Player_Name`),
  KEY `fk_Player_Details_Teams1_idx` (`Teams_Team_ID`,`Teams_Matches_Match_ID`),
  CONSTRAINT `fk_Player_Details_Teams1` FOREIGN KEY (`Teams_Team_ID`, `Teams_Matches_Match_ID`) REFERENCES `teams` (`Team_ID`, `Matches_Match_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `overall_player_state` (
  `Player_Kills` int(11) NOT NULL,
  `Player_Death` int(11) NOT NULL,
  `Player_Assist` int(11) DEFAULT NULL,
  `Wards` int(11) DEFAULT NULL,
  `CS_Per_Min` varchar(45) DEFAULT NULL,
  `Gold_Per_Min` varchar(45) DEFAULT NULL,
  `Player_Details_P_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Player_Details_P_ID`),
  KEY `fk_Overall_Player_State_Player_Details1_idx` (`Player_Details_P_ID`),
  CONSTRAINT `fk_Overall_Player_State_Player_Details1` FOREIGN KEY (`Player_Details_P_ID`) REFERENCES `player_details` (`P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `champions` (
  `Champion_ID` int(11) NOT NULL,
  `Champion_Name` varchar(45) DEFAULT NULL,
  `Items` varchar(45) DEFAULT NULL,
  `Player_Details_P_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Champion_ID`,`Player_Details_P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `mages` (
  `Mage_Name` varchar(45) NOT NULL,
  `Skills` varchar(45) DEFAULT NULL,
  `Champions_Champion_ID` int(11) NOT NULL,
  `Champions_Player_Details_P_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Champions_Champion_ID`,`Champions_Player_Details_P_ID`),
  CONSTRAINT `fk_Mages_Champions1` FOREIGN KEY (`Champions_Champion_ID`, `Champions_Player_Details_P_ID`) REFERENCES `champions` (`Champion_ID`, `Player_Details_P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `non-mages` (
  `Non-Mage_Name` varchar(45) DEFAULT NULL,
  `Skills` varchar(45) DEFAULT NULL,
  `Champions_Champion_ID` int(11) NOT NULL,
  `Champions_Player_Details_P_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Champions_Champion_ID`,`Champions_Player_Details_P_ID`),
  CONSTRAINT `fk_Non-Mages_Champions1` FOREIGN KEY (`Champions_Champion_ID`, `Champions_Player_Details_P_ID`) REFERENCES `champions` (`Champion_ID`, `Player_Details_P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `champion_stats` (
  `CS_ID` varchar(45) NOT NULL,
  `kills` int(11) DEFAULT NULL,
  `Deaths` int(11) DEFAULT NULL,
  `Assits` int(11) DEFAULT NULL,
  `Damage_Per_Min` varchar(45) DEFAULT NULL,
  `Mages_Champions_Champion_ID` int(11) NOT NULL,
  `Mages_Champions_Player_Details_P_ID` varchar(45) NOT NULL,
  `Non-Mages_Champions_Champion_ID` int(11) NOT NULL,
  `Non-Mages_Champions_Player_Details_P_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`CS_ID`,`Mages_Champions_Champion_ID`,`Mages_Champions_Player_Details_P_ID`,`Non-Mages_Champions_Champion_ID`,`Non-Mages_Champions_Player_Details_P_ID`),
  KEY `fk_Champion_Stats_Mages1_idx` (`Mages_Champions_Champion_ID`,`Mages_Champions_Player_Details_P_ID`),
  KEY `fk_Champion_Stats_Non-Mages1_idx` (`Non-Mages_Champions_Champion_ID`,`Non-Mages_Champions_Player_Details_P_ID`),
  CONSTRAINT `fk_Champion_Stats_Mages1` FOREIGN KEY (`Mages_Champions_Champion_ID`, `Mages_Champions_Player_Details_P_ID`) REFERENCES `mages` (`Champions_Champion_ID`, `Champions_Player_Details_P_ID`),
  CONSTRAINT `fk_Champion_Stats_Non-Mages1` FOREIGN KEY (`Non-Mages_Champions_Champion_ID`, `Non-Mages_Champions_Player_Details_P_ID`) REFERENCES `non-mages` (`Champions_Champion_ID`, `Champions_Player_Details_P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");

mysqli_query($conn,"CREATE TABLE `champions_has_player_details` (
  `Champions_Champion_ID` int(11) NOT NULL,
  `Champions_Player_Details_P_ID` varchar(45) NOT NULL,
  `Player_Details_P_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`Champions_Champion_ID`,`Champions_Player_Details_P_ID`,`Player_Details_P_ID`),
  KEY `fk_Champions_has_Player_Details_Player_Details1_idx` (`Player_Details_P_ID`),
  KEY `fk_Champions_has_Player_Details_Champions1_idx` (`Champions_Champion_ID`,`Champions_Player_Details_P_ID`),
  CONSTRAINT `fk_Champions_has_Player_Details_Champions1` FOREIGN KEY (`Champions_Champion_ID`, `Champions_Player_Details_P_ID`) REFERENCES `champions` (`Champion_ID`, `Player_Details_P_ID`),
  CONSTRAINT `fk_Champions_has_Player_Details_Player_Details1` FOREIGN KEY (`Player_Details_P_ID`) REFERENCES `player_details` (`P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");
echo " Tables Created ";
}
if(isset($_POST['insert-button'])){

echo "Hello Insert";
/********* tourny_detials ************************/
mysqli_query($conn,"INSERT INTO `tourny_detials` (`T_ID`, `T_Name`, `Winning_Prize`, `No_of_Teams`, `MVP`)
VALUES ('L101', 'LCS', '5000000', '12', 'Doublelift');");

mysqli_query($conn,"INSERT INTO `tourny_detials`
 (`T_ID`, `T_Name`, `Winning_Prize`, `No_of_Teams`, `MVP`) VALUES ('L201', 'LEC', '4000000', '12', 'Perkz');");

 mysqli_query($conn,"INSERT INTO `tourny_detials`
 (`T_ID`, `T_Name`, `Winning_Prize`, `No_of_Teams`, `MVP`) VALUES ('L303', 'LCK', '2700000', '10', 'Faker');");

 mysqli_query($conn,"INSERT INTO `tourny_detials`
 (`T_ID`, `T_Name`, `Winning_Prize`, `No_of_Teams`, `MVP`) VALUES ('L401', 'LPL', '3200000', '10', 'DoinB');");
/********* tourny_detials ************************/


/********* Matches ************************/
mysqli_query($conn,"INSERT INTO `matches`
 (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`) VALUES ('M101', '09/06/2019', 'TL', 'TSM', 'L101');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
  VALUES ('M102', '09/07/2019', 'GG', 'CLG', 'L101');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
   VALUES ('M103', '09/08/2019', 'FQ', 'CG', 'L101');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
    VALUES ('M104', '09/09/2019', 'EF', '100T', 'L101');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
VALUES ('M201', '09/06/2019', 'G2', 'FNC', 'L201');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
VALUES ('M202', '09/07/2019', 'SPY', 'S04', 'L201');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
VALUES ('M203', '09/08/2019', 'RGE', 'VIT', 'L201');");

mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
 VALUES ('M204', '09/13/2019', 'OG', 'EE', 'L201');");

 mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
  VALUES ('M205', '09/14/2019', 'SK', 'MIF', 'L201');");

  mysqli_query($conn,"INSERT INTO `matches` (`Match_ID`, `Date`, `Team_1`, `Team_2`, `Tourny_Detials_T_ID`)
  VALUES ('M302', '09/12/2019', 'SKT', 'GRF', 'L301');");


/********* Teams ************************/
mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
 VALUES ('TU101', '10', 'G2', '20', 'M201', 'M201');");

 mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
  VALUES ('TU102', '7', 'SKT', '20', 'M301', 'M301');");


  mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
   VALUES ('TN101', '10', 'TL', '22', 'M101', 'M101');");

   mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
    VALUES ('TN102', '8', 'TSM', '24', 'M101', 'M101');");


    mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
    VALUES ('TU303', '10', 'SPY', '20', 'M202', 'M202');");

    mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
    VALUES ('TN103', '8', 'CLG', '18', 'M102', 'M102');");

    mysqli_query($conn,"INSERT INTO `teams` (`Team_ID`, `No_Of_Players`, `Team_Name`, `No_Of_Matches`, `Matches_Match_ID`, `Matches_Match_ID1`)
     VALUES ('TL999', ‘12', ‘FPX', '32', 'M402', 'M402');");

/********** Teams ************************/


/********** Sponsor Details ************************/

 mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('Red Bull', '31/12/2020', 'TN101');");

  mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('StateFam', '31/12/2020', 'TN102');");

   mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('Facebook', '31/12/2020', 'TN102');");

   mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('OnePlus', '31/12/2020', 'TL999');");

   mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('Acer', '31/12/2019', 'TU303');");

   mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('Lenovo', '31/09/2021', 'TU101');");

   mysqli_query($conn,"INSERT INTO `sponsor_details` (`Sponsor_Name`, `Contract_Date`, `Teams_Team_ID`) VALUES ('Oracle', '30/11/2021', 'TU202');");



/********** Sponsor Details ************************/


/**************Player Details *********************/

mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
 VALUES ('101', 'Froggen', '30', 'Mid', 'Henrik', 'TN101', 'M101');");

 mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
 VALUES ('102', 'CAPS', '24', 'Mid', 'Rasmus ', 'TU101', 'M201');");

  mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
  VALUES ('103', 'Perkz', '32', 'ADC', 'UMA JAN', 'TU101', 'M201');");

  mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
   VALUES ('104', 'Rekkles', '8', 'ADC', 'Martin', 'TN102', 'M101');");

   mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
    VALUES ('105', 'TheShy', '24', 'TOP', 'Kang ', 'TL999', 'M402');");

    mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
    VALUES ('106', 'Impact', '20', 'TOP', 'Jung ', 'TN101', 'M101');");

    mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
    VALUES ('107', 'Jankos', '14', 'Jung', 'Jankowski', 'TU101', 'M201');");

    mysqli_query($conn,"INSERT INTO `player_details` (`P_ID`, `Player_Name`, `No_Of_Champions`, `Role`, `Real_Name`, `Teams_Team_ID`, `Teams_Matches_Match_ID`)
     VALUES ('108', 'Mikyx', '21', 'Sup', 'Mihael ', 'TU101', 'M201');");

/**************Player Details *********************/

/**************Overall_player_stat *********************/

mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
VALUES ('36', '5', '104', '398', '10', '65', '101');");

mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
 VALUES ('124', '20', '200', '420', '10', '62', '102');");

mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
 VALUES ('130', '32', '206', '345', '8', '60', '103');");

 mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
  VALUES ('98', '45', '234', '342', '8', '56', '104');");

mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
  VALUES ('135', '25', '203', '124', '11', '70', '105');");

mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
   VALUES ('77', '47', '270', '203', '9', '57', '106');");

  mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
    VALUES ('89', '62', '420', '420', '9', '61', '107');");

  mysqli_query($conn,"INSERT INTO `overall_player_state` (`Player_Kills`, `Player_Death`, `Player_Assist`, `Wards`, `CS_Per_Min`, `Gold_Per_Min`, `Player_Details_P_ID`)
     VALUES ('34', '80', '472', '540', '2', '41', '108');");

 /**************Overall_player_stat *********************/



/**************Champions *********************/
mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('701', 'Irelia', '6', '105');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('702', 'Ryze', '5', '102');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('703', 'Jax', '6', '106');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('704', 'Anivia', '6', '101');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('705', 'Lux', '5', '101');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('706', 'Karthus', '6', '101');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('707', 'Fiora', '5', '105');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('708', 'Kaisa', '5', '103');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('709', 'Pyke', '4', '102');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('710', 'Jayce', '4', '106');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('711', 'LeeSin', '3', '107');");

mysqli_query($conn,"INSERT INTO `champions` (`Champion_ID`, `Champion_Name`, `Items`, `Player_Details_P_ID`) VALUES ('712', 'Ahri', '4', '101');");
/**************Champions *********************/

/**************Mages *********************/
mysqli_query($conn,"INSERT INTO `mages` (`Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Ahri', '4', '712', '101');");

mysqli_query($conn,"INSERT INTO `mages` (`Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Anivia', '4', '704', '101');");

mysqli_query($conn,"INSERT INTO `mages` (`Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Lux', '4', '705', '101');");

mysqli_query($conn,"INSERT INTO `mages` (`Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Ryze', '4', '702', '102');");

mysqli_query($conn,"INSERT INTO `mages` (`Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Karthus', '4', '706', '101');");
/**************Mages *********************/

/**************Non-Mages *********************/
mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Irelia', '4', '701', '105');");

mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Jax', '4', '703', '106');");

mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Fiora', '4', '707', '105');");

mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('kaisa', '4', '708', '103');");

mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Pyke', '4', '709', '102');");

mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Jayce', '4', '710', '106');");

mysqli_query($conn,"INSERT INTO `non-mages` (`Non-Mage_Name`, `Skills`, `Champions_Champion_ID`, `Champions_Player_Details_P_ID`) VALUES ('Leesin', '4', '711', '107');");
/**************Non-Mages *********************/


/**************Champion_Stats *********************/

mysqli_query($conn,"INSERT INTO `champion_stats` (`CS_ID`, `kills`, `Deaths`, `Assits`, `Damage_Per_Min`, `Non-Mages_Champions_Champion_ID`) VALUES ('C701', '14', '5', '28', '620', '701');");

mysqli_query($conn,"INSERT INTO `champion_stats` (`CS_ID`, `kills`, `Deaths`, `Assits`, `Damage_Per_Min`, `Mages_Champions_Champion_ID`) VALUES ('C702', '23', '4', '13', '850', '702');");

mysqli_query($conn,"INSERT INTO `champion_stats` (`CS_ID`, `kills`, `Deaths`, `Assits`, `Damage_Per_Min`, `Non-Mages_Champions_Champion_ID`) VALUES ('C703', '16', '8', '7', '500', '703');");
/**************Champion_Stats *********************/


/**************match_overview *********************/
mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('4000', '32', '56', 'M101');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('2400', '54', '87', 'M102');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('3000', '52', '89', 'M201');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('1200', '99', '134', 'M401');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('4567', '55', '85', 'M301');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('6644', '45', '84', 'M303');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('5754', '67', '98', 'M304');");

mysqli_query($conn,"INSERT INTO `match_overview` (`Gold_Advantage`, `Total_Kills_T`, `Total_Assists_T`, `Matches_Match_ID`) VALUES ('3568', '75', '98', 'M203');");


/**************match_overview *********************/

// mysqli_query($conn,"DROP TABLE champion_stats");
echo "Data Inserted";
}



//echo "Table Created";
 ?>
