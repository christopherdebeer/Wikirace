</div>

			<!-- /bodyContent -->

		</div>

		<!-- /content -->

		<!-- header -->

		<div id="mw-head" class="noprint">



<!-- /0 -->

			<div id="left-navigation">



<!-- /0 -->



<!-- 1 -->

<div id="p-variants" class="vectorMenu emptyPortlet">

		<h5><span>Variants</span><a href="#"></a></h5>

	<div class="menu">

		<ul>

					</ul>

	</div>

</div>



<!-- /1 -->

			</div>

		</div>

		<!-- /header -->

		<!-- panel -->

			<div id="mw-panel" class="noprint collapsible-nav">

				<!-- logo -->

					<div id="p-logo"><a style="background-image: url('images/wr-logo.gif');" href="http://wikirace.christopherdebeer.com/" title="WikiRace homepage"></a></div>

				<!-- /logo -->

				<div id="p-navigation" class="portal first persistent wikisidepanel">

						<h5>Navigation</h5>

						<div class="body" >

								<ul id="wikirace-nav" style="display:none;">

										<li id="wikirace-steps"style="font-size:6em; font-weight:bold;line-height:1em;padding:0; text-align:center;">0</li>

										<li style="font-size:0.7em; font-weight:normal;text-align:center;margin-bottom:20px;">Steps so far.</li>

										<li></li>

										<li style="font-size:1em; font-weight:bold;">Your goal is:</li>

										<li id="wikirace-destination"style="font-size:1em;"></li>

										<li style="font-size:1em; font-weight:bold;">You've gone via:</li>

										<ol id="wikirace-path" style="margin:0;padding:0;list-style:decimal outside none;">



										</ol>

								</ul>



								<div id="wikirace-sideleaders" style="margin-bottom:60px;">

										<p>Top 10 racers:</p>

								<ul class="overall">

				<?

				include 'inc/sql-config.php';

				include 'inc/sql-opendb.php';



				// Set users scores appropriately

				$count = 0;



				$query = "SELECT * FROM users ORDER BY games / steps DESC LIMIT 0,10";

				$res = mysql_query($query,$conn);





						while($row = mysql_fetch_array($res)){

								$count+= 1;

								$user = $row['username'];

								//echo $user;

								$games = (int)$row['games'];

								$steps = (int)$row['steps'];

								echo "<li><span class='username'><a href='/profile.php?user=$user'>".$user."</a></span> <span class='score'>" . $games. "/" . $steps . "</span></li>";

						}



				include 'inc/sql-closedb.php';





				?>

		</ul>

								</div>

								<div id="googleadsense">

										<script type="text/javascript"><!--

										google_ad_client = "ca-pub-3375429181295089";

										/* Wikirace thin vert */

										google_ad_slot = "5386126898";

										google_ad_width = 120;

										google_ad_height = 600;

										//-->

										</script>

										<script type="text/javascript"

										src="http://pagead2.googlesyndication.com/pagead/show_ads.js">

										</script>

								</div>

						</div>

				</div>



			</div>

		<!-- /panel -->

		<!-- footer -->

		<div id="footer">
												<script type="text/javascript"><!--
google_ad_client = "ca-pub-3375429181295089";
/* horiz links */
google_ad_slot = "9553600010";
google_ad_width = 728;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br/>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-3375429181295089";
/* horiz links */
google_ad_slot = "9553600010";
google_ad_width = 728;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
											<ul id="footer-info">

																	<li id="footer-info-lastmod"> This application was designed and coded by <a rel="creator" href="http://www.empirecollective.co.uk">Christopher de Beer</a> &copy; 2010. Using the <a href="http://www.mediawiki.org/wiki/API">Wiki Media API</a></li>

																							<li id="footer-info-copyright">All content courtesy <a href="http://www.wikipedia.org">Wikipedia.org</a>, and Text is available under the <a rel="license" href="http://en.wikipedia.org/wiki/Wikipedia:Text_of_Creative_Commons_Attribution-ShareAlike_3.0_Unported_License">Creative Commons Attribution-ShareAlike License</a><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/" style="display: none;"></a>;

additional terms may apply.

See <a href="http://wikimediafoundation.org/wiki/Terms_of_Use">Terms of Use</a> for details.<br>

Wikipedia&reg; is a registered trademark of the <a href="http://www.wikimediafoundation.org/">Wikimedia Foundation, Inc.</a>, a non-profit organization.<br></li>

																							<li id="footer-icon-poweredby"><a href="http://www.mediawiki.org/"><img src="Alcohol_files/poweredby_mediawiki_88x31.png" alt="Powered by MediaWiki" height="31" width="88"></a></li>

															</ul>

										<ul id="footer-icons" class="noprint">



							</ul>

			<div style="clear: both;"></div>

		</div>

		<!-- /footer -->

		<!-- fixalpha -->

		<script type="text/javascript"> if ( window.isMSIE55 ) fixalpha(); </script>

		<!-- /fixalpha -->



<script type="text/javascript">if (window.runOnloadHook) runOnloadHook();</script>

<script type="text/javascript" src="Alcohol_files/a"></script>		<!-- Served by srv197 in 0.046 secs. -->

<div class="suggestions" style="top: 73px; width: 188px; display: none; left: auto; right: 41px;">

<div class="suggestions-results"></div>

<div class="suggestions-special"></div>

</div>