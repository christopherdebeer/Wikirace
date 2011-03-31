<?php


// check for games that have been going for more than an hour
// and close/forfeit them and amend user as such


include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

// get all games that have no end results

$query = "SELECT * FROM games WHERE steps='0';";
$res = mysql_query($query,$conn);
$closegames = array();

if (mysql_num_rows($res) > 0) {
		while($row = mysql_fetch_array($res)){

				$from_time = strtotime(date("Y-m-d H:i:s"));
				$to_time=strtotime($row['starttime']);

				// if the game is older than an hour

				if (round(abs($to_time - $from_time) / 60,2) > 60 ) {

						// add game id to list of games to close
						$closegames[] = $row['id'];
				}
		}
}

include 'inc/sql-closedb.php';

// close all games in the array


foreach ($closegames as $gameid) {

		include 'inc/sql-config.php';
		include 'inc/sql-opendb.php';

		// Set users scores appropriately

		$query = "SELECT * FROM games WHERE id='".$gameid."';";
		$res = mysql_query($query,$conn);

		if (mysql_num_rows($res) > 0) {
				while($row = mysql_fetch_array($res)){
						$user = $row['user'];
						$starttime = $row['starttime'];
				}
		}

		$totaltime = round(abs(date("Y-m-d H:i:s") - $start_time) / 60,2);

		// close the game as path = forfiet and steps=25 time=now
		mysql_query("UPDATE games SET path = 'forfeit' WHERE id = '".$gameid."'");
		mysql_query("UPDATE games SET steps = '25' WHERE id = '".$gameid."'");
		mysql_query("UPDATE games SET time = '1800' WHERE id = '".$gameid."'");



		$query = "SELECT * FROM users WHERE username='".$user."';";
		$res = mysql_query($query,$conn);

		if (mysql_num_rows($res) > 0) {
				while($row = mysql_fetch_array($res)){
						$games = $row['games'];
						$steps = $row['steps'];
				}
		}


		$games += 1;
		$steps += 25;


		mysql_query("UPDATE users SET games = '".$games."' WHERE username= '".$user."'");
		mysql_query("UPDATE users SET steps = '".$steps."' WHERE username= '".$user."'");

		include 'inc/sql-closedb.php';



}





?>