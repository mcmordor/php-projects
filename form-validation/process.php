<?php
	$ec = 0;
	if(!empty($_POST['city']) && !empty($_POST['state']) &&	!empty($_POST['phone']))
	{
		if(!preg_match("/\d+/", $_POST['city'])) $ec +=1;
		if(!preg_match("/\d+/", $_POST['state'])) $ec +=2;
		if(!preg_match("/\d+/", $_POST['phone'])) $ec +=4;
		if($ec) header('location: .?ec='.$ec.'&ph='.$_POST['phone'].'&c='.$_POST['city'].'&s='.$_POST['state']);
	}
	else
	{
		header('location: .?sub=true&ec=0&ph='.$_POST['phone'].'&c='.$_POST['city'].'&s='.$_POST['state']);
	}
	
	echo 'yay';

?>