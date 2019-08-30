<?php


if(isset($_POST['submit'])){
	require_once('functions.php');
	$lokalizacja = htmlentities($_POST['lokalizacja'], ENT_QUOTES, "UTF-8");

	require_once('connect.php');
	$connect = connection_start();
	$kwak = htmlentities($_POST['kwak'], ENT_QUOTES, "UTF-8");

	$id_uzytkownika = $_SESSION['zalogowany'];
		
	$sql = "SELECT (now() - `czas`) AS roznica FROM kwakchat WHERE id_uzytkownika = $id_uzytkownika ORDER BY czas DESC LIMIT 1";
	if($result = $connect->query($sql)) {
		if($r = $result->fetch_array(MYSQLI_ASSOC)) {
			if($r['roznica'] < 18000) {
				statement("php", "kwakchat.php", 'przysługuje tylko jeden wpis na trzy godziny, pozostało jeszcze około '.ceil(180 - $r['roznica']/100).' minut');
			}
		}
	}

	$sql = "INSERT INTO `kwakchat`(`id_kwak`, `id_uzytkownika`, `lokalizacja`, `kwak`, `czas`) VALUES (NULL, $id_uzytkownika, '$lokalizacja', '$kwak', now());";
	if($result = $connect->query($sql)) {
		statement("php", "kwakchat.php", "pomyślnie dodano wpis");
	} else {
		statement("php", "kwakchat.php", "przepraszamy, wystąpił błąd.. spróbuj ponownie później");
	}

} else {
	header('Location:../index.php');
	exit;
}
