<!doctype html>
<html lang="en">
	<head>
		<title>Palindrome Stuff</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<main>
			<form action="palindrome.php" method="post">	
				<input type="text" name="search-word" placeholder="Enter a word">
				<input type="submit">
				<?php
					if (isset($_GET['error']) && $_GET['error'] == "true")
						echo'<p class="warning">Enter Something!</p>';
					?>
			</form>
		</main>
	</body>
</html>
