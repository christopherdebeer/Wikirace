<?php

		if (isset($_COOKIE["wikirace"]) && $_COOKIE["wikirace"] != "") {
				$user = $_COOKIE["wikirace"];
		} else { $user = "Guest";}
		$datesalt = "christophredebeer.com" . date("Y-m-d H");
		$secret = md5($datesalt);

		include("inc/header.php");

?>

		<script type="text/javascript">
				window.username = "<?php echo $user; ?>";
				window.secret = "<?php echo $secret; ?>";
		</script>
		<script type="text/javascript" src="/js/wikirace.js?c=<?php echo time(); ?>"></script>
		<div id="wikirace">

		</div>

<?php

		include("inc/footer.php");
		if ($_GET['debug'] == "1") {
				echo "<div id='wikirace-debug'>Debugging set to True</div>";
		}
?>
		</body>
		</html>
