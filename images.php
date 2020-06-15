<html>
	<header>
		<?php echo '<link rel="stylesheet" type="text/css" href="./style.css?' . time(). '">' ?>
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
		</script>

		<div class="topnav">
			<a class="active" href="index.php">Home</a>
			<a class="active" href="javascript:onsearchweb();">Web</a>
			<div class="topnav-right">
				<a href="">Settings</a>
				<a href="">Theme</a>
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

$html = file_get_html('https://www.ecosia.org/images?p=' . $_GET['page'] . '&q=' . urlencode($_GET['query']) , 0, $context);
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
echo  '<span style="color: #474747; font-size: 13px; position: relative; top: -3px; left: 850px;">Page ' . $_GET['page'] . '<a href="'  . $u . '"></span><input style="position: absolute; left: 900px;" type="image" src="images/arrow.png" width=15></div></a>';

echo '</div>';
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
echo "<script> function SetText() { document.getElementById('_stats').innerHTML = 'Found " . $totalres . " results in " . (string)$exec_time . " seconds.'; document.getElementById('head_title').innerHTML = '" . $title . " - Phoenix Search';} </script>";
echo "<script> SetText(); </script>";
echo '<br><br> ';
?>

</html>