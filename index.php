<html>
	<header>
		<style type="text/css">
			body { 
				background-color: black;
				margin: 0;
				padding: 0;
			}
			 
			.center {
				display: block;
 				margin-left: auto;
				margin-right: auto;
				margin-top: 150px;
			}

			.list-item
			{
				float: left;
				clear: left;
			}

			li {
				float: left;
				font-family: "Open Sans";
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
				font-family: "Open Sans";
				color: black;
				font-size: 12px;
				list-style-type: none;
				width: 100%;
			}

			#search
			{
				font-family: "Open Sans";
				color: black;
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
		<li><a href="index.php" style="color: #d8d8d8; font-size: 11px;">Home</a></li>
		<li><a href="top_posts.php" style="color: #d8d8d8; font-size: 11px;">Settings</a></li>
		<li><a href="leaderboard.php" style="color: #d8d8d8; font-size: 11px;">Theme</a></li></ul>

		<img src="images/logo.png" class="center" width="25%" height="25%">

		<form name="search" method="post" onsubmit="return onsearch()">
		<center style="margin: 70px auto 0;">
			<input type="text" id="search" name="search" placeholder="Search" style="width: 700px; height: 30px;">
		</center>

	</body>
</html>