<!doctype html>
<html lang="en">
	<head>
		<title>Karel Jr.</title>
		<script defer src="js/functions.js"></script>
		<script defer src="js/variables.js"></script>
		<link href="css/style.css" type="text/css" rel="stylesheet">
	</head>
	<body>	
		<div id="world">
			<?php 
				for ($r = 1; $r <= 10; $r++)	
					for ($c = 1; $c <= 10; $c++)
						echo'<div id="r'.$r.'c'.$c.'"><p>+</p></div>';
				
				echo '<img id="karel" style="bottom: 18px; left: 15px;" src="img/robot.png">';
				?>
		</div>
	</body>
</html>