<?php
	$c = $emsg = $ph = $s = ""; $ec = 0;

	if (isset($_GET['sub']) && $_GET['sub'] == "true")
	{
		$errorMessage[0] = "<p>Fill everything out!</p>";
		$errorMessage[1] = "<p>Wrong format for City</p>";
		$errorMessage[2] = "<p>Wrong format for State</p>";
		$errorMessage[4] = "<p>Wrong format for Phone</p>";
		
		if(isset($_GET['c'])) $c = $_GET['c'];  
		if(isset($_GET['ph'])) $ph = $_GET['ph'];
		if(isset($_GET['s'])) $s = $_GET['s'];
		if(isset($_GET['ec'])) $ec = $_GET['ec'];
		
		switch($ec)
		{
			case 7: $emsg = $errorMessage[1].$errorMessage[2].$errorMessage[4]; break;
			case 6: $emsg = $errorMessage[2].$errorMessage[4]; break;
			case 5: $emsg = $errorMessage[1].$errorMessage[4]; break;
			case 4: $emsg = $errorMessage[4]; break;
			case 3: $emsg = $errorMessage[2].$errorMessage[1]; break;
			case 2: $emsg = $errorMessage[2]; break;
			case 1: $emsg = $errorMessage[1]; break;
			case 0: $emsg = $errorMessage[0]; break;
		}
	}
?>
<form action="process.php" method="post">
	<input value="<?php echo $c;?>" placeholder="City" name="city"><br><br>
	<input value="<?php echo $s;?>" placeholder="state" name="state"><br><br>
	<input value="<?php echo $ph;?>" placeholder="Phone" name="phone"><br><br>
	<input type="reset">
	<input name="submit-button" type="submit">
</form>

<?php echo $emsg; ?>
