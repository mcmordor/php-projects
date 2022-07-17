function reset()
{
	rc = {col: 1, row: 10, dir: "n", bottom: 18, left : 15, beeper: 3};
	position();
	for (div of divs) div.innerHTML = "<p>+</p>";
}
//BEEPER MANAGER
function beeper()
{
	let square = document.getElementById('r'+rc.row+'c'+rc.col);
	if(square.innerHTML == '<p>+</p>' && rc.beeper)
	{
		square.innerHTML='<img src="img/the-beeper.png">';
		rc.beeper --;
	}
	else if (square.innerHTML != '<p>+</p>')
	{
		square.innerHTML = '<p>+</p>';
		rc.beeper++;
	}
}
function position()
{
	karel.attributes['style'].nodeValue = "bottom: "+rc.bottom+"px; left: "+rc.left+"px;";
	karel.className = rc.dir;
}
//CONTROLS THE ROBOT'S MOVEMENT
function move(direction)
{
	switch (direction)
	{
		case "n": if(rc.row==1) return; rc.bottom +=100; rc.row--; break;
		case "e": if(rc.col==10) return; rc.left +=100; rc.col++; break;
		case "s": if(rc.row==10) return; rc.bottom -=100; rc.row++; break;
		case "w": if(rc.col==1) return; rc.left -=100; rc.col--; break;
	}
}

//ROTATES THE ROBOT AND MOVES THE ROBOT
function controlRobot(event)
{
	switch(event.keyCode)
	{
		case 32: move(rc.dir); break;
		case 38: rc.dir = "n"; break;
		case 39: rc.dir = "e"; break;
		case 40: rc.dir = "s"; break;
		case 37: rc.dir = "w"; break;
		case 13: beeper(); break;
		case 27: reset(); break;
	}
	position();
}
