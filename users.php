<?php
if (isset($_COOKIE["wikirace"]) && $_COOKIE["wikirace"] != "") {
		$user = $_COOKIE["wikirace"];
} else {
		$user = "Guest";
}
include("inc/header.php");
?>
<div id="wikirace">

		<p>Welcome, if you have an account please log in to continue, otherwise you can create an account too.<br/>This is just to keep track of your score, and game history, so you can compete with friends and nemeses.</p>
		<?
		if (isset($_GET['m']) && $_GET['m'] != "") {
				$message = $_GET['m'];
				echo "<p class='wikirace-feedback'>$message</p>";
		}
		?>
		<div id="wikirace-forms" style="overflow:auto;">
			<form action="/login.php" method="post" style="float:left; width:40%; margin-right:2.5%;margin-bottom:40px;">
					<h2>Log in</h2>
					<br/><br/>
					<label for="">Username: </label>
					<input type="text" name="username"/>
					<br/><br/>
					<label for="">Password: </label>
					<input type="password" name="password"/>
					<br/><br/>
					<input type="submit"  value="Log in"/>
			</form>


			<form action="/createprofile.php" method="post" style="float:left; width:40%; padding-left:2.5%; border-left:1px solid #ccc; margin-bottom:40px;" >
					<h2>Create a profile</h2>
					<br/><br/>
					<label for="">Pick a username: </label>
					<input type="text" name="username"/>
					<br/><br/>
					<label for="">Pick a password: </label>
					<input type="password"  name="password1"/>
					<br/><br/>
					<label for="">Retype password: </label>
					<input type="password"  name="password2"/>
					<br/><br/>
					<label for="">Email address :</label>
					<input type="text" name="email"/>
					<br/><br/>
					<input type="submit" value="Create Profile" />

			</form>
		</div>

</div>
<?
include("inc/footer.php");
?>