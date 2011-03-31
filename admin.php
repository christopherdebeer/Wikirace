<html>
		<head>
				<style type="text/css">
						html, body {
								margin:0;
								padding:10px;
								background-color:#000;
								color:#fff;
								font-family:monospace;
						}
				</style>
		</head>
		<body>


				<?php
				if (isset($_COOKIE["wikirace"]) && $_COOKIE["wikirace"] != "") {
						$user = $_COOKIE["wikirace"];
				} else {
						$user = "Guest";
				}

				echo "Current user cookie: " . $user . "<br /><br />";

				include 'inc/sql-config.php';
				include 'inc/sql-opendb.php';

				// Set users scores appropriately
				$count = 0;

				$search = mysql_query("SELECT COUNT(id) FROM users");
				$sarray = mysql_fetch_array($search);
				$total_records = $sarray[0];

				echo "Total registered users: " . $total_records;

				$search2 = mysql_query("SELECT COUNT(id) FROM games");
				$sarray = mysql_fetch_array($search2);
				$total_records2 = $sarray[0];

				echo "<br/>Total games played: " . $total_records2;

				$search2 = mysql_query("SELECT COUNT(id) FROM games WHERE steps = '0'");
				$sarray = mysql_fetch_array($search2);
				$total_records2 = $sarray[0];

				echo "<br/>Current number of OPEN games: " . $total_records2;

				include 'inc/sql-closedb.php';




				echo "<br /><br />Users: <br />";
				echo "<table>";
				include 'inc/sql-config.php';
				include 'inc/sql-opendb.php';

				// Set users scores appropriately
				$count = 0;

				$query = "SELECT * FROM users ORDER BY id DESC";
				$res = mysql_query($query,$conn);


						while($row = mysql_fetch_array($res)){
								$count+= 1;
								$user = $row['username'];
								//echo $user;
								$games = (int)$row['games'];
								$steps = (int)$row['steps'];
								echo "<tr><td>".$user."</td><td>" . $games. "/" . $steps . "</td></tr>";
						}

				include 'inc/sql-closedb.php';
				echo "</table>";

				echo "<br /><br />Games: <br />";
				echo "<table>";
				include 'inc/sql-config.php';
				include 'inc/sql-opendb.php';

				// Set users scores appropriately
				$count = 0;

				$query = "SELECT * FROM games ORDER BY id DESC";
				$res = mysql_query($query,$conn);


						while($row = mysql_fetch_array($res)){
								$count+= 1;
								$user = $row['user'];
								//echo $user;
								$start = $row['start'];
								$end = $row['end'];
								$path = $row['path'];
								$steps = (int)$row['steps'];
								$time = (int)$row['time'];
								if ($path != "" && $path != "forfeit") {$path = "Completed";}
								elseif ($path == "forfeit" ){ $path = "XXXXXXXXX";}
								elseif ($path == "" ){ $path = "---------";}
								echo "<tr><td>$user</td><td width='40%'>FROM: $start</td><td>TO: $end</td><td>Status: $path</td><td>Time: $time</td><td>Steps: $steps</td></tr>";
						}

				include 'inc/sql-closedb.php';
				echo "</table>";


				?>





		</body>
</html>
