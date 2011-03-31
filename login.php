<?php

$username = $_POST['username'];
$password = $_POST['password'];

include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

$query = "SELECT * FROM users WHERE username='".$username."';";
$res = mysql_query($query,$conn);

if (mysql_num_rows($res) > 0) {

		while($row = mysql_fetch_array($res)){
				if (md5($password) != $row['password']) {
						$message = "The password you entered is incorrect";
						$urlmessage = urlencode($message);
						include 'inc/sql-closedb.php';
						header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
						exit;
				}
		}

} else {
		$message = "The username you entered doesn&prime;t exist";
		$urlmessage = urlencode($message);
		include 'inc/sql-closedb.php';
		header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
		exit;
}

include 'inc/sql-closedb.php';

setcookie("wikirace", $username, time()+999000, "/" );
header("Location: http://wikirace.christopherdebeer.com/");


?>