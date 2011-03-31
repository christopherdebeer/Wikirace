<?php

$gameid = $_POST['gameid'];
$steps = (int)$_POST['steps'];
$path = $_POST['path'];
$time = date("Y-m-d H:i:s");



$path = str_replace("_"," ",$path);
//$gameid = 20;
//$steps = 2;
//$path = "cheated";


include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

// end an open new game

$query = "SELECT * FROM games WHERE id='".$gameid."';";
$res = mysql_query($query,$conn);

while($row = mysql_fetch_array($res)){
		$starttime = strtotime($row['starttime']);
		$user = $row['user'];
}


$endtime = strtotime($time);
$timetaken = round(abs($endtime - $starttime) ,2);

mysql_query("UPDATE games SET steps = '".$steps."' WHERE id = '".$gameid."'");
mysql_query("UPDATE games SET path = '".$path."' WHERE id = '".$gameid."'");
mysql_query("UPDATE games SET time = '".$timetaken."' WHERE id = '".$gameid."'");

include 'inc/sql-closedb.php';



include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

$query2 = "SELECT * FROM users WHERE username='".$user."';";
$res2 = mysql_query($query2,$conn);

if (mysql_num_rows($res2) > 0) {
		while($row2 = mysql_fetch_array($res2)){

				$usersteps = (int)$row2['steps'];
				$usergames = (int)$row2['games'];
		}
}

$usersteps = $usersteps + $steps;
$usergames = $usergames + 1;

mysql_query("UPDATE users SET games = '".$usergames."' WHERE username = '".$user."'");
mysql_query("UPDATE users SET steps = '".$usersteps."' WHERE username = '".$user."'");

echo$timetaken;

include 'inc/sql-closedb.php';
?>