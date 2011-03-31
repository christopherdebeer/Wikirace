<?php


$datesalt = "christophredebeer.com" . date("Y-m-d H");
$checksum = $_POST['secret'];

if ($checksum != md5($datesalt)) {
		echo "authfail";
		exit;
}

$user = $_POST['user'];
$start = $_POST['start'];
$goal = $_POST['goal'];

$steps = 0;
$path = "";

$time = date("Y-m-d H:i:s");

include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

// create a new game

$sql="INSERT INTO games VALUES('','".mysql_real_escape_string($user)."','".mysql_real_escape_string($start)."','".mysql_real_escape_string($goal)."','".mysql_real_escape_string($path)."','".mysql_real_escape_string($steps)."','','".mysql_real_escape_string($time)."')";
if (!mysql_query($sql,$conn))  {  die('Error: ' . mysql_error());  }
$gameid=mysql_insert_id();

echo $gameid;

include 'inc/sql-closedb.php';
?>