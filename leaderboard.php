<?php
if (isset($_COOKIE["wikirace"]) && $_COOKIE["wikirace"] != "") {
		$user = $_COOKIE["wikirace"];
} else {
		$user = "Guest";
}
include("inc/header.php");
?>
<div id="wikirace">
		<div class="header">
				<p>Scores are shown as "Games/Steps" and as "Points" for more info on how these are calculated see the <a href="/#rules">Rules</a> section or the <a href="/#scoring">Scoring and Ranking</a> section on the main page.</p>
				<p>&nbsp;</p>
		</div>
				<div class="board fullwidth">
			<h3>WikiRace Overall Leaderboard</h3>
			<p>This is the leaderboard of top users, ranked by Score on WikiRace.</p>
			<p></p>
			<p></p>
		<?php



				// scoreboard = array of "user" => "score"


				include 'inc/sql-config.php';
				include 'inc/sql-opendb.php';

				$count = 0;

				$query = "SELECT * FROM users ;";
				$res = mysql_query($query,$conn);

						while($row = mysql_fetch_array($res)){
								if ($row['username'] != "Guest") {
										$username = $row['username'];
										$scoreboard[$username] = 0;
								}
						}
				include 'inc/sql-closedb.php';



				// for each user
				foreach ( $scoreboard as $username=>$score ){

						//echo "<br/><br/>For User: $username";

						// work out score
						$overallscore = 0;

						// for each game do:

						include 'inc/sql-config.php';
						include 'inc/sql-opendb.php';

						$count = 0;

						$query = "SELECT * FROM games WHERE user = '".$username."' ;";
						$res = mysql_query($query,$conn);

								while($row = mysql_fetch_array($res)){
												$steps = (int)$row['steps'];
												$time = (int)$row['time'];
												if ($time >0) {
														if ($time > 1801) {$time = 1800;}
														$maxscore = 4000;

														$gamescore = $maxscore - (100 * $steps) - $time;
														//echo "<br/>game: $gamescore";
														$overallscore += $gamescore;
												}
								}
						include 'inc/sql-closedb.php';

						$scoreboard[$username] = $overallscore;
						//echo "<br/>Overall: $overallscore <br/<br/>";

				}

				arsort($scoreboard);
				//print_r($scoreboard);

				$count = 0;
				echo "<ol class='overall fullwidth' >";
				foreach ($scoreboard as $username=>$score) {
						$count +=1;
						echo "<li><span class='counter'>".$count.".</span><span class='username'><a href='/profile.php?user=$username	'>".$username."</a></span> <span class='score'>" . $score . "</span></li>";
				}
				echo "</ol>";

		?>
				</div>


		<div class="board">
			<h3>WikiRace Ratio Leaderboard</h3>
			<p>This is the leaderboard of top users, ranked by ratio ie: games vs steps, on WikiRace.</p>
			<p></p>
			<p></p>
			<ol class="overall">
					<?
					include 'inc/sql-config.php';
					include 'inc/sql-opendb.php';

					// Set users scores appropriately
					$count = 0;

					$query = "SELECT * FROM users ORDER BY games / steps DESC";
					$res = mysql_query($query,$conn);


							while($row = mysql_fetch_array($res)){
								if ($row['username'] != "Guest") {
									$count+= 1;
									$user = $row['username'];
									//echo $user;
									$games = (int)$row['games'];
									$steps = (int)$row['steps'];
									echo "<li><span class='counter'>".$count.".</span><span class='username'><a href='/profile.php?user=$user'>".$user."</a></span> <span class='score'>" . $games. "/" . $steps . "</span></li>";
								}
							}

					include 'inc/sql-closedb.php';


					?>
			</ol>
		</div>
				<div class="board">
			<h3>WikiRace Most-played Leaderboard</h3>
			<p>This is the leaderboard of top users, ranked by Number of races on WikiRace.</p>
			<p></p>
			<p></p>
			<ol class="overall">
					<?
					include 'inc/sql-config.php';
					include 'inc/sql-opendb.php';

					// Set users scores appropriately
					$count = 0;

					$query = "SELECT * FROM users ORDER BY games DESC";
					$res = mysql_query($query,$conn);


							while($row = mysql_fetch_array($res)){
									if ($row['username'] != "Guest") {
										$count+= 1;
										$user = $row['username'];
										//echo $user;
										$games = (int)$row['games'];
										$steps = (int)$row['steps'];
										echo "<li><span class='counter'>".$count.".</span><span class='username'><a href='/profile.php?user=$user'>".$user."</a></span> <span class='score'>" . $games. "</span></li>";
									}
							}

					include 'inc/sql-closedb.php';


					?>
			</ol>
		</div>

</div>
<?php
if ($_GET['debug'] == "1") {
		echo "<script type='text/javascript' src='/js/leaderboard.js'></script>";
}
?>
<?
include("inc/footer.php");
?>