
$(document).ready(function () {
		window.starting = true;
		window.goal = "";
		window.steps = 0;
		window.gamepath = "";
		window.wikirace_goals = [
				"Mickey_Mouse",
				"Volvo",
				"Axe",
				"Jesus_Christ",
				"Microsoft",
				"Concrete",
				"Banana",
				"Prince_William_of_Wales",
				"Iraq_War",
				"Amazon_River",
				"AK-47",
				"World_War_II",
				"Tupperware",
				"Walt_Disney",
				"Denmark",
				"South_Africa",
				"Religion",
				"Genocide",
				"Microprocessor",
				"Bill_Gates",
				"Apple",
				"New_York",
				"England",
				"Scotland",
				"Zimbabwe",
				"India",
				"China",
				"Japan",
				"Australia",
				"New_Zealand",
				"Cotton",
				"Sword",
				"Mount_Everest",
				"Nepal",
				"Communism",
				"Socialism",
				"Karl_Marx",
				"Philosophy",
				"Greek_language",
				"Crete",
				"Pacific_Ocean",
				"Earth",
				"Solar_System",
				"Jupiter",
				"Ancient_Rome",
				"Carthage",
				"Mammal",
				"Vertebrate",
				"Anus",
				"Herbivore",
				"Fungus",
				"DNA",
				"Information",
				"Knowledge",
				"Plato",
				"Socrates",
				"Aristotle",
				"Renaissance",
				"Politics",
				"Jews",
				"Arabs",
				"Palestine",
				"Israel",
				"Zionism",
				"Typography",
				"Visual_arts",
				"DVD",
				"CD-ROM",
				"United_States",
				"The_Levant",
				"Strait_of_Gibraltar",
				"Iberian",
				"Ancient_Macedonians",
				"Black_Sea",
				"Sardinia",
				"Malta_Island",
				"Olive",
				"Tide",
				"Vatican_City",
				"Libya",
				"Innings",
				"Cook_Strait",
				"Constantinople",
				"Diffusion",
				"Philip_II_of_Macedon",
				"White_Sea",
				"Palaeolithic",
				"Wool",
				"Stamen",
				"Coriolis_effect",
				"National_Fascist_Party",
				"Ronald_Reagan",
				"Dwight_D._Eisenhower",
				"Harry_S._Truman",
				"Whaler",
				"Danube",
				"Euphrates",
				"Yellow_Sea",
				"Yellow_River",
				"Yangtze_River",
				"Red_Sea",
				"Ganges",
				"The_Beatles",
				"Shiva",
				"Lhasa",
				"Dalai_Lama",
				"Genghis_Khan",
				"Tatars",
				"Gobi_Desert",
				"Kalahari_Desert",
				"Sahara",
				"Antarctica",
				"River_delta",
				"Bay_of_Bengal",
				"Tiger",
				"Mass",
				"Fern",
				"Cashmere_wool",
				"Flanders",
				"Leopard",
				"Cougar",
				"Predator",
				"Root",
				"Mosquito",
				"Venom",
				"Platypus",
				"Sediment",
				"Gold_mining",
				"Copper",
				"Alloy",
				"Coca-Cola",
				"Morphine",
				"Opium",
				"Latex",
				"Agnosticism",
				"Gnosis",
				"Universe",
				"Cosmos"
		];

		startrace();
});

function sanitizepage() {

				$("#wikiuser").remove();
				$("#wikirace-debug").append("<p>Sanatizing the page... </p>");
				$("a").click(function(e) {


						var whereto = $(this).attr("href").replace("/wiki/","");

						// provided it doesnt start with "#"
						if (whereto.substring(0,4) == "http") {
								var response = window.confirm('You have chosen to click on an external link, would you like to leave the race without achiving the goal? If you are logged in, this will affect your overall score.');
								if (response) {}
								else { e.preventDefault();}
						}
						else if (whereto[0]  != "#") {
								e.preventDefault();
								nextstep(whereto);
						}
				});
				$("span.editsection").remove();
				$("#p-logo a").click(function (e){
						e.preventDefault();
						window.location = "/";

				});
		}

		function startrace () {

				var total_goals = wikirace_goals.length;
				var randomnumber=Math.floor(Math.random()*total_goals)
				goal = wikirace_goals[randomnumber];
				$("#wikirace-destination").html(goal);
				$(".wikisidepanel .steps").html("0");
				steps = 0;
				$("#wikirace-nav").show();
				$("#wikirace-sideleaders").hide();

				$.getJSON('http://en.wikipedia.org/w/api.php?action=query&list=random&rnnamespace=0&rnlimit=1&redirects&format=json&callback=?', function(data) {
						window.firstpage = data.query.random[0].title;
						$("#wikirace-steps").html("0");
						steps = 0;
						startgame(firstpage);
				});
		}

		function startgame(p) {
				$("#wikirace-debug").append("<p>Start game ajax sending ["+p+"] ... </p>");
				$.ajax({
						type: 'POST',
						url: 'http://wikirace.christopherdebeer.com/startgame.php',
						data: {
								secret: secret,
								user: username,
								start: p,
								goal: goal
						},
						complete: function(data) {
								//console.log("Got POST response:" + data.responseText);
								window.gameid = data.responseText;
								$("#wikirace-debug").append("<p>Start game ajax returned [Game ID: "+window.gameid+"] ... </p>");
								nextstep(p);
						},
						dataType: "json"
				});


		}

		function urldecode(url) {
				return decodeURIComponent(url.replace(/\+/g, ' '));
		}

		function nextstep(p) {
				$("#wikirace-debug").append("<p>Next step run, sending ["+p+"] ... </p>");
				if (p != goal) {
						$("#wikirace-debug").append("<p>which isnt a win... </p>");

						if (starting) {
								starting = false;
								window.gamepath = p;
						} else {
								$("#wikirace-steps").html(steps+1);
								steps += 1;
								window.gamepath = window.gamepath + "###" + p;
						}

						$("#wikirace").html("<img id='wikiload' src='images/loading.gif' />");
						$("#firstHeading").text(urldecode(p.replace(/_/g, " ")));
						$("#siteSub").text("From Wikipedia, the free encyclopedia");


						$("#wikirace-path").append("<li style='list-style:decimal outside none;line-height:1em;margin-bottom:5px;'>" + urldecode(p.replace(/_/g, " ")) +"</li>");
						//alert("got here. goal is: " + goal);

						//alert("and its not the goal - so getting json for new page: " + p);
						$.getJSON('http://en.wikipedia.org/w/api.php?action=parse&prop=text&page=' + p + '&redirects&format=json&callback=?', function(data) {
								$("#wikirace").html(data.parse.text['*']);
								sanitizepage();
						});
				} else {
						$("#wikirace-debug").append("<p>which IS a win... </p>");
						endgame();
				}
		}

		function endgame () {

				$("#wikirace").html("<h1>Congratulations, you reached your Goal.</h1>");
				$("#wikirace-steps").html(steps+1);
				steps += 1;
				$("#wikirace-debug").append("<p>Endgame function run</p>");
				$("a").unbind("click");

				$.ajax({
						type: 'POST',
						url: 'http://wikirace.christopherdebeer.com/endgame.php',
						data: {
								secret: secret,
								user: username,
								steps: steps,
								gameid: gameid,
								path: gamepath
						},
						complete: function(data) {
								window.time = data.responseText;
								$("#wikirace-debug").append("<p>Endgame returned a message after post [time taken "+window.time+"] </p>");
								$("#wikirace").append("<p>Well done "+username+". You completed the race in "+ ( Math.round(parseInt(window.time) / 60*100)/100).toString() +" minutes, over a course of "+steps+" steps. Giving you a score for this game of: <strong>"+( 4000 - (parseInt(steps) * 100) - window.time ).toString()+"</strong>.</p>");
								if (username == "Guest") {
										$("#wikirace").append("<p><strong>We noticed you don't have an account to record your score, if you'd like to record your score and compare it with other users, please visit the <a href='/users.php'>Create profile</a> page.</strong></p>");
								}
								$("#wikirace").append("<p>You might like to <a href='/leaderboard.php'>View the Leaderboard</a> or <a href='/race.php'>Race again</a>. Or if you'd like to view your racing history, visit your <a href='/profile.php?user=" +username+"'>Profile page</a>.</p>");
						},
						dataType: "json"
				});

				// show games stats.

				$("#wikirace").append("<p>You got from <strong>"+startpage+"</strong> to <strong>"+goal+"</strong> in <strong>"+toString(parseInt(window.time) / 60)+" minutes</strong> using <strong>"+steps+"</strong>.</p>");
				$("#wikirace").append("<p>To view your over all score and ranking, go to the <a href='/leaderboard.php'>Leaderboard</a></p>");
		}
