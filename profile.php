<?php

if (isset($_COOKIE["wikirace"]) && $_COOKIE["wikirace"] != "") {
		$user = $_COOKIE["wikirace"];
} else {
		$user = "Guest";
}

$userprofile = "Guest";
if (isset($_GET['user'])) {
		$userprofile = $_GET['user'];
}

include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

$query = "SELECT * FROM users WHERE username='".$userprofile."';";
$res = mysql_query($query,$conn);

if (!mysql_num_rows($res) > 0) {
		include 'inc/sql-closedb.php';
		header("Location: http://wikirace.christopherdebeer.com/");
		exit;
} else {
		while($row = mysql_fetch_array($res)){
				$usersteps = $row['steps'];
				$usergames = $row['games'];
		}
}
include 'inc/sql-closedb.php';


include("inc/header.php");
?>
<div id="wikirace">

				<h2>Profile of user: <?php echo $userprofile; ?></h2>
				<p><?php echo $userprofile; ?> has played a total of <strong><?php echo $usergames; ?></strong> games and taken <strong><?php echo $usersteps; ?></strong> steps to do them.</p>
				<ul class="gameslist">
					<?
					include 'inc/sql-config.php';
					include 'inc/sql-opendb.php';

					// Set users scores appropriately
					$count = 0;

					$query = "SELECT * FROM games WHERE user = '".$userprofile."'ORDER BY id ASC";
					$res = mysql_query($query,$conn);


							while($row = mysql_fetch_array($res)){
									$count+= 1;
									$start = $row['start'];
									$end = $row['end'];
									$time = round(((int)$row['time']) / 60, 2);
									$patharray = explode("###",$row['path']);
									if ($patharray[0] == "") { unset($patharray[0]);}
									$path = implode(" -> ",$patharray);
									$steps = $row['steps'];
									if ($row['path'] == "") {
										echo "<li>$count. From <strong>$start</strong> to <strong>$end</strong>. Game is either still in progress or has been abandoned.</li>";
									} else if ($row['path'] == "forfeit") {
										echo "<li>$count. From <strong>$start</strong> to <strong>$end</strong>. Game was forfeited, set to (time: 1hr &amp; steps:25)</li>";
									} else {
										$arraycount = 0;
										echo "<li>$count. From <strong>$start</strong> to <strong>$end</strong>, <br/>in <strong>$time minutes</strong>, <br/>and took <strong>$steps steps</strong><br/>The path taken:<br/><br/>";

										//$yuml = "<img src='http://yuml.me/diagram/nofunky;dir:LR;scale:60;/class/"
										$yuml = "";

										foreach ($patharray as $value) {
												$value = urldecode($value);
												if ($arraycount == 0) {
														 // add start to
														$yuml = $yuml . "[$value]";
												} else {
														$yuml = $yuml . "->[$value]";
														//$yuml = $yuml . ",[$value]";
												}
												$arraycount +=1;
										}

										$yuml= $yuml . "->[$end]";


										$yuml = str_replace("_"," ", $yuml);
										//$yuml = rawurlencode($yuml);
										//$yuml = $yuml . ".png' alt='Loading Wikirace steps diagram...' />";
										echo $yuml." </li>";
									}

							}

					include 'inc/sql-closedb.php';


					?>
					</ul>

</div>
<?
include("inc/footer.php");
?>