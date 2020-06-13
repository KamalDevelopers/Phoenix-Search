<html>

	<header>
		<style type="text/css">
			body {background-color: black;}
		</style>
	</header>

	<body>
	</body>

<?php
require 'simple_html_dom.php';

$html = file_get_html('https://duckduckgo.com/html/?q=%22'.$_GET['query'].'%22');
$title = $html->find('title', 0);

foreach ($html->find('a[class=result__a]') as $element){
	$url = $pieces = explode("www.", $element->href)[1];
	echo '<a href="' . "http://" . urldecode($url) . '">' . $element->plaintext . '</a> <br>';
}
?>

</html>