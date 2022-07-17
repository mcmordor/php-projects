let rc = {col: 1, row: 10, dir: "n", bottom: 18, left : 15, beeper: 3};

window.addEventListener('keyup', controlRobot);
let karel = document.getElementById('karel');
let divs = document.querySelectorAll("div#world > div");