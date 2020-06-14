<html>

	<header>
		<style type="text/css">
			html *
			{
				font-family: "Open Sans" !important;
			}

			body { 
				background-color: black;
				margin: 0;
				padding: 0;
				overflow-x: hidden;
			}
			 
			.resultbox {
				display: inline-block; 
				width: 720px;
				border: 1px solid black;
				word-wrap: break-word;
				overflow-x: hidden;
			}

			.center {
				display: block;
 				margin-left: auto;
				margin-right: auto;
				margin-top: 70px;
				overflow-x: hidden;
			}

			.list-item
			{
				float: left;
				clear: left;
			}

			li {
				float: left;
			}

			li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			li a:hover {
				background-color: #333;
			}

			ul {
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #101010;
				color: black;
				font-size: 12px;
				list-style-type: none;
				width: 100%;
			}
			
			a { color: inherit; } 

			.results {
				color: white;
				font-size: 14px;
				position: relative;
				top: 20px;
				right: -80px;
			}

			.url {
				color: #474747;
			}

			.stats {
				position: relative;
				right: -80px;

				color: #474747;
				font-size: 11px;
				display: block;
 				margin-left: auto;
				margin-right: auto;
				margin-top: -15px;
			}

		</style>
	</header>

	<body>
		<script>
		function onsearch() {
			window.location = "search.php?query=" + document.getElementById('search').value;
			return false;
		}
		</script>

		<ul style="position: absolute; background-color: #6B0E0E; top: 10px; height: 40px;">
		<center><li><a href="index.php" style="color: #d8d8d8; font-size: 11px;">Home</a></li></center>
		<center><li><a href="top_posts.php" style="color: #d8d8d8; font-size: 11px;">Settings</a></li></center>
		<center><li><a href="leaderboard.php" style="color: #d8d8d8; font-size: 11px;">Theme</a></li></ul></center>

		<span class="center" style="position: relative; right: -80px; display: inline-block;">
		<form name="search" target="#here" method="post" onsubmit="return onsearch()" style="display: inline-block;">
		<input type="text" id="search" name="search" placeholder="Search" style="width: 700px; height: 30px;">
		<input type="image" src="images/search.jpg" alt="Submit" style="width: 0px;"></form></span>
		<label class="stats" id="_stats"></label>
	</body>

<?php
$time_pre = microtime(true);

require 'simple_html_dom.php';
stream_context_set_params($context, array('user_agent' => 'Mozilla/5.0 (Linux; Android 9; moto g(8) play) AppleWebKit/537.36 (KHTML, like Gecko)Chrome/83.0.4103.101 Mobile Safari/537.36'));

$html = file_get_html('https://www.ecosia.org/search?p=' . $_GET['page'] . '&q=' . $_GET['query'], 0, $context);
$title = $html->find('title', 0);
//a[class=result__snippet]
$snippets = $html->find('p[class=result-snippet]');
$favicons = $html->find('img[class=result__icon__img]');
$totalres = 0;

echo '<div class="results">';
//DUCK 'a[class=result__a]'
$searchdel = "bing";

foreach ($html->find('a[class=result-title js-result-title]') as $index => $element){
	if ($element->plaintext != "No  results."){
		$url = $element->href;

		if (!preg_match("/{$searchdel}/i", $url)) {
			//$url = $pieces = explode("uddg=", $element->href)[1];
			echo '<img src="' . "http://www.google.com/s2/favicons?domain=" .  urldecode($url) . '" width="13px"> ';
			echo '<a href="' . urldecode($url) . '" style="font-size: 16px;">' . $element->plaintext . '</a><br>';
			echo '<span class="url" style="font-size: 12px;">' . urldecode($url) . '</span><br>';
			echo '<span class="resultbox"><p style="font-size: 12px; color: #959595;">' . $snippets[$index]->plaintext . '</p></span><br><br>';
			
			$totalres = $index;
		}
	}
}

if ($totalres == 0){
	echo '<p style="font-size: 14px; color: #959595;">No results found.</p>';
}

$u = 'http://phoenix-search.me/search.php?page=' . (string)((int)($_GET['page']) + 1) . '&query=' . $_GET['query'];
$u2 = 'http://phoenix-search.me/search.php?page=' . (string)((int)($_GET['page']) - 1) . '&query=' . $_GET['query'];

if ((int)$_GET['page'] != 0){
	echo '<div class="nextpage"><a href="'  . $u2 . '"></span><input style="-webkit-transform: scaleX(-1); transform: scaleX(-1); position: absolute; left: 304px;" type="image" src="images/arrow.png" width=15></a>';
}

if (empty($_GET['page']))
	$_GET['page'] = "0";
echo  '<span style="color: #474747; font-size: 13px; position: relative; top: -3px; left: 330;">Page ' . $_GET['page'] . '<a href="'  . $u . '"></span><input style="position: absolute; left: 382;" type="image" src="images/arrow.png" width=15></div></a>';

echo '</div>';
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
echo "<script> function SetText() { document.getElementById('_stats').innerHTML = 'Found " . $totalres . " results in " . (string)$exec_time . " seconds.'; } </script>";
echo "<script> SetText(); </script>";
?>

</html>