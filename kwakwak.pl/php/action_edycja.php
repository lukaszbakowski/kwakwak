<?php
require_once('connect.php');
require_once('functions.php');
if(!isset($_SESSION['zalogowany'])) {exit();}
$id_uzytkownika = $_SESSION['zalogowany'];
if(isset($_POST['submit'])) {
	$connect=connection_start();
	$opis = htmlentities($_POST['opis'], ENT_QUOTES, "UTF-8");
	$sql = "SELECT `id_ustawienia` FROM `ustawienia` WHERE `id_uzytkownika` = $id_uzytkownika";
	$result = $connect->query($sql);
	if($result->num_rows == 0) {
		$sql = "INSERT INTO `ustawienia`(`id_ustawienia`, `id_uzytkownika`, `opis`) VALUES (NULL, $id_uzytkownika, '$opis');";
		if($connect->query($sql)) {
			statement("php", "edycja.php", "zaktualizowano");
		} else {
			statement("php", "edycja.php", "brak połączenia, spróbuj ponownie później");
		}
	} else {
		$sql = "UPDATE `ustawienia` SET `opis`= '$opis' WHERE `id_uzytkownika` = $id_uzytkownika;";
		if($connect->query($sql)) {
			statement("php", "edycja.php", "zaktualizowano");
		} else {
			statement("php", "edycja.php", "brak połączenia, spróbuj ponownie później yo");
		}
	}

	$connect->close();
} else {
	header('Location:../index.php');
}