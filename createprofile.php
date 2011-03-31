<?php

$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email= $_POST['email'];

if ($password1 != $password2) {
		$message = "The psswords you entered didn&prime;t match, please try create your proffile again";
		$urlmessage = urlencode($message);
		header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
		exit;
}


// check if user exists

include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

$query = "SELECT * FROM users WHERE username='".$username."';";
$res = mysql_query($query,$conn);

if (mysql_num_rows($res) > 0) {
		$message = "The username you entered already exists, please try create your proffile again";
		$urlmessage = urlencode($message);
		include 'inc/sql-closedb.php';
		header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
		exit;
}

include 'inc/sql-closedb.php';

// check if email address is valid

include('inc/EmailAddressValidator.php');
$validator = new EmailAddressValidator;
if ($validator->check_email_address($email)) {

} else {
    $message = "The email address you entered doesnt seem to be valid, please try create your proffile again";
		$urlmessage = urlencode($message);
		header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
		exit;
}


// check if email address is being used

include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

// Set users scores appropriately

$query = "SELECT * FROM users WHERE email='".$email."';";
$res = mysql_query($query,$conn);

if (mysql_num_rows($res) > 0) {
		include 'inc/sql-closedb.php';
		$message = "The email address you entered is already associated with a profile. Either check your mailbox for your password if you&prime;ve forgotten it, or try again to create your profile.";
		$urlmessage = urlencode($message);
		header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
		exit;
}

include 'inc/sql-closedb.php';


// create profile beacuse if it got here,
// everything should be fine

include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

// create a new game

$sql="INSERT INTO users VALUES('','".mysql_real_escape_string($username)."','".mysql_real_escape_string(md5($password1))."','".mysql_real_escape_string($email)."','0','0')";
if (!mysql_query($sql,$conn))  {  die('Error: ' . mysql_error());  }

$query = "SELECT * FROM users WHERE id=LAST_INSERT_ID()";
$res = mysql_query($query,$conn);

if (mysql_num_rows($res) > 0) {
		while($row = mysql_fetch_array($res)){
				$username_check = $row['username'];
		}
}

include 'inc/sql-closedb.php';

if ($username != $username_check) {

		// email admin error

		$to = "christopherdebeer@gmail.com";
		$subject = "Wikirace error!";
		$body = "Error occured on users sign up \n\n Username: $username tried to register but check returned: $username_check \n\n their email address is $email";
		if (mail($to, $subject, $body)) { }


		include 'inc/sql-closedb.php';
		$message = "An unknown error occured during the creation of your user profile, I&prime;m very sorry. Please try again.";
		$urlmessage = urlencode($message);
		header("Location: http://wikirace.christopherdebeer.com/users.php?m=$urlmessage");
		exit;
}

// email users details to them

$to = $email;
$subject = "Welcome to Wikirace";
$body = "Hi, $username \n\nThanks for creating an account at http://wikirace.christopherdebeer.com \nYour account details are as follows:\n\nUsername: $username \nPassword: $password1 \n\n\nPlease let me know if there's anything that you feel could be done better, or if you encounter any issues.\nPlease keep this email as a reference, incase you forget your username or password. \n\nRegards, \nChristopher de Beer\nhttp://www.empirecollective.co.uk\nchristopherdebeer@gmail.com";
$headers = "From: wikiraceapp@gmail.com\r\n" .
     "X-Mailer: php";

if (mail($to, $subject, $body, $headers)) { }

// log user in as a cookie

setcookie("wikirace", $username, time()+999000, "/" );



header("Location: http://wikirace.christopherdebeer.com");
exit;

?>