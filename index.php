<html>
	<header>
		<link rel="stylesheet" type="text/css" href="style.css">
        <title id="head_title">Phoenix Search</title>
	</header>

	<body>
		<script>
		function onsearch() {
			var url = new URL(window.location.href);
			var c = url.searchParams.get("i");
			if (c == "1") {
				window.location.replace("https://phoenix-search.me/images.php?query=" + document.getElementById('search').value);
			}
			else {
				window.location.replace("https://phoenix-search.me/search.php?query=" + document.getElementById('search').value);
			}
		}
		</script>

		<div class="topnav">
			<a class="active" href="index.php">Home</a>
			<?php
			if ($_GET['i'] == "1")
				echo '<a class="active" href="index.php">Web</a>';
			else
				echo '<a class="active" href="index.php?i=1">Images</a>';
			?>
			<div class="topnav-right">
				<a href="">Settings</a>
				<a href="">Theme</a>
			</div>
		</div>

		<img src="images/logo.png" class="center" width="450px">

		<form name="search" method="post" action="javascript:onsearch()">
		<center style="margin: 70px auto 0;">
			<?php
			if ($_GET['i'] == "1")
				echo '<input type="text" id="search" name="search" placeholder="Search for images" style="width: 700px; height: 30px;"></form>';
			else
				echo '<input type="text" id="search" name="search" placeholder="Search" style="width: 700px; height: 30px;"></form>';
			?>
			?>
		</center>

	</body>
</html>