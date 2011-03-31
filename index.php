<?php

		$domain = $_SERVER['HTTP_HOST'];
		if ($domain != "wikirace.christopherdebeer.com") {
				header("Location: http://wikirace.christopherdebeer.com/");
				exit;
		}


// WikiRaces v0.01
// By Christopher de Beer 2010

// http://en.wikipedia.org/wiki/Special:Random

if (isset($_COOKIE["wikirace"]) && $_COOKIE["wikirace"] != "") {
		$user = $_COOKIE["wikirace"];
} else {
		$user = "Guest";
}



include("checkopengames.php");
include("inc/header.php");


?>

		<div id="wikirace">
				<a id="wikirace-startbutton" style="cursor:pointer;" href="/race.php"><img src="images/startbutton.gif" alt="Start Race" style="border:0 none;margin:20px;" border="0" /></a>
				<a id="wikirace-leaderboardbutton" style="cursor:pointer;" href="/leaderboard.php"><img src="images/leaderboard.gif" alt="View Leaderboard" style="border:0 none;margin:20px 20px 20px 10px; " border="0" /></a>
				<a id="wikirace-loginbutton" style="cursor:pointer;" href="/users.php"><img src="images/login.gif" alt="Log in or create a profile" style="border:0 none;margin:20px 20px 20px 10px; " border="0" /></a>
				<h2><span class="mw-headline"><a name="about">About</a></span></h2>
				<p>The point of the game, is to try get from one wikipedia article to another in as few steps as possible. See the <a href="#rules">rules</a> for more information.</p>
				<p>I first came across the concept of Wiki Racing while listening to <a href="http://www.shorttermmemoryloss.com/">James Bridle</a>'s <a href="http://2010.dconstruct.org/speakers/james-bridle">dConstruct talk</a> with friends, and it sounded awlfully nerdy, but we had to give it a go - and as it turns out, it's quite addictive. I figured it would be an easy game/application to put together, so I gave it a go. This is an experimental version and was done over a Saturday and Sunday with friends - not bad for 2 days work. I'm not the first to have made an application similar to this, but I thought I was till I finished it and did some research. oh well.</p>
				<p>I'd appreciate it if you signed up for a an account to record your score, and more so if you'd click on the <strong>Facebook Like button</strong> at the top of the page.</p>
				<h2><span class="mw-headline"><a name="rules">Rules</a></span></h2>
				<p>Current rules are:</p>
				<ul>
						<li>No going back</li>
						<li>No using history</li>
						<li>No editing pages</li>
						<li>No searching</li>
						<li>No typing of anything</li>
						<li>You may only use the mouse</li>
						<li>If you get stuck - <em>grow a pair and sort it out</em></li>
				</ul>
				<h3><a name="scoring">Scoring and ranking</a></h3>
				<p>The aim of the game is to get to the destinationa in as few steps and as little time as possible. The scoring system currently works as follows:</p>
				<p>Of a maximum of 4000 points a game, you will lose 100 points for each step you take and 1 point for every second that passes.</p>
				<p>Players are also ranked by ratio ie: 7/53 being 53 steps over the course of 7 games. As well as by number of games played... for those of a stubborn nature.</p>
				<h3><a name="forfeit">Forfeiting</a></h3>
				<p>Leaving the game before it's complete will forfeit the game.</p>
				<p>If you get stuck and forfeit a race, then you will be given the maximum number of moves added to your stats (which is 25 ie: 1/25) and the game will be shown as having taken 30 minutes to complete. Which converts to -300 points. Your score may look fine, but every hour games that are still open, are closed and your score will be adjusted accordingly - for those that get a fright when there ranking drops (after having forfeited all the hard races).</p>
				<h2>Wow I didn't realise how cool Wikipedia could be</h2>
				<p>Well in that case maybe you should consider <a href="http://wikimediafoundation.org/wiki/Fundraising"><strong>donating to wikipedia</strong></a>, I'm sure every bit helps. I made this game/application <em>free of charge</em>, so if you feel like the time you spent browsing wikipedia was enjoyable (if not challenging), then you should consider <a href="http://wikimediafoundation.org/wiki/Fundraising"><strong>donating to wikipedia</strong></a>.</p>

		</div>
<?php include("inc/footer.php"); ?>
</body>
</html>