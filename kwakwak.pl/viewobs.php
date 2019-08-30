<?php 

	session_start();

	if(!isset($_SESSION['zalogowany'])) {
		header('Location:zaloguj.php');
		$_SESSION['statement']= '<span style="color:red;">musisz się zalogować</span>';
		exit;
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ogłoszenia</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<link type="text/css" rel="stylesheet" href="css/nav.css">
<script src="script/newtag.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="audio/quack.js"></script>
<style>
.list {
	width:90%;
	text-align:left;
	font-size:1rem;
	padding:0.3rem;
	margin:0.3rem 2rem;
	display:flex;
	justify-content:space-between;
}
.list:hover {
	background-color:lightblue;
}
a {
	color:black;
}
.delete {
	color:orangered;
}
.delete:hover {
	color:blue;
}
</style>
</head>
<body>
<?php include('index/header.php') ?>
<main class="section col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">
<div id="lewa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="lewa">

<?php include('index/lewa.php'); ?>
	
	</div>

</div>

<div id="srodek" class="col-xl-6 col-l-8 col-m-12 col-s-12 col-xs-12">

	<div class="srodek">



	
	<h2>Obserwujesz:</h2>
	


<?php

require_once('php/connect.php');
$connect=connection_start();
$id_uzytkownika = $_SESSION['zalogowany'];
$sql = "SELECT * FROM ulubione WHERE id_obserwujacego = $id_uzytkownika LIMIT 99";
if($result = $connect->query($sql)) {
	$i=0;
	while($row = $result->fetch_assoc()) {
		$id_uzytkownika = $row['id_obserwowanego'];
		$sql = "SELECT login FROM uzytkownicy WHERE id_uzytkownika = $id_uzytkownika;";
		$res = $connect->query($sql);
		$r = $res->fetch_array(MYSQLI_NUM);
		$login = $r[0];
		if($i % 2 == 0) {
			echo '<main class="list"><a href="profil.php?id='.$row['id_obserwowanego'].'">'.$login.'</a>&nbsp;<a onclick="usun(this, '.$row['id_obserwowanego'].')" class="delete">usuń</a></main>';
		} else {
			echo '<main class="list" style="background-color:lightgrey;"><a href="profil.php?id='.$row['id_obserwowanego'].'">'.$login.'</a>&nbsp;<a onclick="usun(this, '.$row['id_obserwowanego'].')" class="delete">usuń</a></main>';
		}
		$i++;
	}
}

$connect->close();
?>

</div>
</div>
<script>
function usun(y, x) {

	let z = y.parentElement;
	url ="ajax/ajax_viewobs.php?usun=true&id_uz=" + x;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			z.innerHTML = this.responseText;
			setTimeout( function() {z.remove();}, 2222);
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
}
</script>

<div id="prawa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="prawa">
<?php include('index/kwakchat.php') ?>
	</div>

</div>
</main>
<?php include('index/stopka.php') ?>
<?php include('index/footer.php') ?>
</body>
</html>