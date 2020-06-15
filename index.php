<html>
	<header>
		<link rel="stylesheet" type="text/css" href="style.css">
        <title id="head_title">Phoenix Search</title>
	</header>

	<body>
		<script>
		function onsearch() {
			window.location.replace("https://phoenix-search.me/search.php?query=" + document.getElementById('search').value);
		}
		</script>

		<div class="topnav">
        <a class="active" href="index.php">Home</a>
        <div class="topnav-right">
            <a href="">Settings</a>
            <a href="">Theme</a>
        </div>
        </div>

		<img src="images/logo.png" class="center" width="450px">

		<form name="search" method="post" action="javascript:onsearch()">
		<center style="margin: 70px auto 0;">
			<input type="text" id="search" name="search" placeholder="Search" style="width: 700px; height: 30px;"></form>
		</center>

	</body>
</html>