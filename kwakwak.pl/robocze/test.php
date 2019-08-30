<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>test</title>
<script type="text/javascript">

function sprawdz()
{
	var liczba = document.getElementById("wartosc").value;


	if(liczba>0) document.getElementById("test").innerHTML="dodatnia";
	else if(liczba<0) document.getElementById("test").innerHTML="ujemna";
	else if((liczba==0)&&(liczba)) document.getElementById("test").innerHTML="zero";
	else document.getElementById("test").innerHTML="to nie liczba";

}

</script>
</head>
<body>
<input type="text" id="wartosc">
<input type="submit" value="submit" id="submit" onclick="sprawdz()">
<div id="test"></div>
</body>
</html>