<html>
	<header>
		<script>
			var d = new Date();
			if (document.cookie != "") {
				document.write('<link rel="stylesheet" id="theme" type="text/css" href="' + document.cookie + '?' + d.getTime() + '"">'); 
			} else {
				document.write('<link rel="stylesheet" id="theme" type="text/css" href="./style.css?' + d.getTime() + '">'); 
			}
		</script>
		<link rel="icon" href="./images/PhoenixFavi.svg" type="image/svg">
        <title id="head_title">Phoenix Search</title>
	</header>

	<body>
		<script>
		function onsearch() {
			window.location.replace("https://phoenix-search.me/search.php?query=" + document.getElementById('search').value);
		}
		function onsearchimages() {
			var url = new URL(window.location.href);
			var query = url.searchParams.get("query");
			window.location.replace("https://phoenix-search.me/images.php?query=" + query);
		}

		function SwapStyleSheet(sheet) {
			document.getElementById("theme").setAttribute("href", sheet);  
			document.cookie = sheet + "; expires=Thu, 18 Dec 2025 12:00:00 UTC";
		}

		function SwapThemeLight() {  var d = new Date(); SwapStyleSheet("light.css?" + d.getTime()); }
		function SwapThemeDefault() {  var d = new Date(); SwapStyleSheet("style.css?" + d.getTime()); }

		</script>

		<div class="topnav">
			<a class="active" href="index.php">Home</a>
			<a class="active" href="javascript:onsearchimages();">Images</a>
			<div class="topnav-right">
				<button class="dropbtn"><a>Theme</a> 
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="javascript:SwapThemeDefault();">Default</a>
					<a href="javascript:SwapThemeLight();">Light</a>
				</div>
			</div>
		</div>

		<span class="center" style="position: relative; right: -80px; display: inline-block;">
		<form name="search" method="post" action="javascript:onsearch()" style="display: inline-block;">
		<input type="text" id="search" name="search" placeholder="Search" style="width: 700px; height: 30px;">
		<input type="image" src="images/search.jpg" alt="Submit" style="width: 0px;"></form></span>
		<label class="stats" id="_stats"></label>
	</body>

<?php
$time_pre = microtime(true);

require 'simple_html_dom.php';
stream_context_set_params($context, array('user_agent' => 'Mozilla/5.0 (Linux; Android 9; moto g(8) play) AppleWebKit/537.36 (KHTML, like Gecko)Chrome/83.0.4103.101 Mobile Safari/537.36'));

$html = file_get_html('https://www.ecosia.org/search?p=' . $_GET['page'] . '&q=' . urlencode($_GET['query']) , 0, $context);
$title = $_GET['query'];
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
			echo '<img src="' . "https://www.google.com/s2/favicons?domain=" .  urldecode($url) . '" style="position: relative; top: 2px;" width="13px"> ';
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

$u = 'https://phoenix-search.me/search.php?page=' . (string)((int)($_GET['page']) + 1) . '&query=' . $_GET['query'];
$u2 = 'https://phoenix-search.me/search.php?page=' . (string)((int)($_GET['page']) - 1) . '&query=' . $_GET['query'];

if ((int)$_GET['page'] != 0){
	echo '<div class="nextpage"><a href="'  . $u2 . '"></span><input style="-webkit-transform: scaleX(-1); transform: scaleX(-1); position: absolute; left: 304px;" type="image" src="images/arrow.png" width=15></a>';
}

if (empty($_GET['page']))
	$_GET['page'] = "0";
echo  '<span style="color: #474747; font-size: 13px; position: relative; top: -3px; left: 330px;">Page ' . $_GET['page'] . '<a href="'  . $u . '"></span><input style="position: absolute; left: 382px;" type="image" src="images/arrow.png" width=15></div></a>';

echo '</div>';
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
echo "<script> function SetText() { document.getElementById('_stats').innerHTML = 'Found " . $totalres . " results in " . (string)$exec_time . " seconds.'; document.getElementById('head_title').innerHTML = '" . $title . " - Phoenix Search';} </script>";
echo "<script> SetText(); </script>";
echo '<br><br> ';
?>

</html>