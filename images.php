<html>
	<header>
		<script>
			var url = window.location.href;
			var http = url.split(":/")[0];
			if (http == "http") { window.location.replace("https:/" + url.split(":/")[1]); }
			var d = new Date();
			document.write('<link rel="stylesheet" type="text/css" href="./main.css?' + d.getTime() + '">');

			if (document.cookie != "") {
				document.write('<link rel="stylesheet" id="theme" type="text/css" href="' + document.cookie + '?' + d.getTime() + '"">'); 
			} else {
				document.write('<link rel="stylesheet" id="theme" type="text/css" href="./default.css?' + d.getTime() + '">'); 
			} 
		</script>
		<link rel="icon" href="./images/PhoenixFavi.svg" type="image/svg">
        <title id="head_title">Phoenix Search</title>
	</header>

	<body>
		<script>
		function onsearch() {
			window.location.replace("https://phoenix-search.me/images.php?query=" + document.getElementById('search').value);
		}
		function onsearchweb() {
			var url = new URL(window.location.href);
			var query = url.searchParams.get("query");
			window.location.replace("https://phoenix-search.me/search.php?query=" + query);
		}

		function SwapStyleSheet(sheet) {
			var d = new Date();
			document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });  
			document.cookie = sheet + "; expires=Thu, 18 Dec 2025 12:00:00 UTC";
			if (document.getElementById("theme").getAttribute("href").split("?")[0] != sheet){
				location.reload();
			}
		}

		function SwapThemeLight() { SwapStyleSheet("light.css"); }
		function SwapThemeDefault() { SwapStyleSheet("default.css"); }

		</script>

		<div class="topnav">
			<a class="active" href="index.php">Home</a>
			<a class="active" href="javascript:onsearchweb();">Web</a>
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
        
		<span class="center" style="position: relative; right: -73px; display: inline-block;">
		<form name="search" method="post" action="javascript:onsearch()" style="display: inline-block;">
		<?php echo '<input type="text" id="search" name="search" value="' . $_GET['query'] . '" class="searchbar">'; ?>
		<input type="image" src="images/search.jpg" alt="Submit" style="width: 0px;">
		<a href="index.php"><img src="images/PhoenixFavi.svg" width="30px" height="30px" style="position: relative; top: 10px;"></a></form></span>

		<label class="stats" id="_stats"></label>
	</body>

<?php
$time_pre = microtime(true);
require 'simple_html_dom.php';

$html = file_get_html('https://www.ecosia.org/images?p=' . $_GET['page'] . '&q=' . urlencode($_GET['query']));
$title = $_GET['query'];
$totalres = 0;

$imagelink = $html->find('a[class=image-preview-page-link]');
echo '<div class="resultsimages">';
foreach ($html->find('a[class=image-result js-image-result js-infinite-scroll-item]') as $index => $element){
	$url = $element->href;
    $secure = substr($url, 0, 5);
    if ($secure == "https"){
        $url = str_replace("https://", "//", $url);

	    echo '<a href="' . $imagelink[$index]->href . '"><img src="' . $url . '" style="position: relative; top: 2px; background-color: white;" height="164px"></a> ';
	    $totalres = $index;
    }
}
echo '<br><br>';
if ($totalres == 0){
	echo '<p style="font-size: 14px; color: #959595;">No results found.</p>';
}

$u = 'https://phoenix-search.me/images.php?page=' . (string)((int)($_GET['page']) + 1) . '&query=' . $_GET['query'];
$u2 = 'https://phoenix-search.me/images.php?page=' . (string)((int)($_GET['page']) - 1) . '&query=' . $_GET['query'];

if ((int)$_GET['page'] != 0){
	echo '<div class="nextpage"><a href="'  . $u2 . '"></span><input style="-webkit-transform: scaleX(-1); transform: scaleX(-1); position: absolute; left: 825px;" type="image" src="images/arrow.png" width=15></a>';
}

if (empty($_GET['page']))
	$_GET['page'] = "0";
echo  '<span style="color: #474747; font-size: 13px; position: relative; top: -3px; left: 850px;">Page ' . (string)((int)($_GET['page']) + 1) . '<a href="'  . $u . '"></span><input style="position: absolute; left: 900px;" type="image" src="images/arrow.png" width=15></div></a>';

echo '</div>';
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
echo "<script> function SetText() { document.getElementById('_stats').innerHTML = 'Found " . $totalres . " results in " . (string)$exec_time . " seconds.'; document.getElementById('head_title').innerHTML = '" . $title . " - Phoenix Search';} </script>";
echo "<script> SetText(); </script>";
echo '<br><br> ';
?>

</html>