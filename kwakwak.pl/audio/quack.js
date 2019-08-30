
function quackin() {
	var x = document.getElementById("quack");
	x.play();

	setTimeout("location.href='index.php';", 444);
}

function quack() {
	var x = document.getElementById("quack");
	x.play();

	setTimeout("location.href='welcome.php';", 444);
}
function quackstay() {
	var x = document.getElementById("quack");
	x.play();
}
function qq() {

	for(var i=444; i<888; i++)
	{
	setTimeout(quackstay, i);
	}
}