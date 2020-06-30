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

		<script>
		function onsearch() {
			var url = new URL(window.location.href);
			var c = url.searchParams.get("i");
			if (c == "1") {
				window.location.replace("images.php?query=" + document.getElementById('search').value);
			}
			else {
				window.location.replace("search.php?query=" + document.getElementById('search').value);
			}
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

	</header>

	<body>
		<div class="topnav">
			<a class="active" href="index.php">Home</a>
			<?php
			if ($_GET['i'] == "1")
				echo '<a class="active" href="index.php">Web</a>';
			else
				echo '<a class="active" href="index.php?i=1">Images</a>';
			?>
			
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

		<img src="images/PhoenixSearchLogo.svg" class="center" width="450px" style="position: relative; top:120px;">
		<br><br><br>
		<form name="search" method="post" action="javascript:onsearch()">
		<center style="margin: 70px auto 0;">
			<?php
			if ($_GET['i'] == "1")
				echo '<input type="text" id="search" name="search" placeholder="Search for images" class="searchbar"></form>';
			else
				echo '<input type="text" id="search" name="search" placeholder="Search" class="searchbar"></form>';
			?>
		</center>

	</body>
</html>