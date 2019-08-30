<?php
require_once('connect.php');
require_once('functions.php');
if(!isset($_SESSION['zalogowany'])) {
	exit();
}
$connect=connection_start();
$id_uzytkownika = $_SESSION['zalogowany'];
if(isset($_POST['pwchange'])) {
	$actualpw = htmlentities($_POST['actualpw'], ENT_QUOTES, "UTF-8");
	$newpw = htmlentities($_POST['typepw'], ENT_QUOTES, "UTF-8");
	$repw = htmlentities($_POST['retypepw'], ENT_QUOTES, "UTF-8");
	if($newpw === $repw) {
		$sql = "SELECT haslo FROM uzytkownicy WHERE id_uzytkownika = $id_uzytkownika";
		if($result = $connect->query($sql)) {
			$r = $result->fetch_array(MYSQLI_ASSOC);
			if($actualpw === $r['haslo']) {
				$sql = "UPDATE `uzytkownicy` SET `haslo` = '$newpw' WHERE `id_uzytkownika` = $id_uzytkownika";
				if($connect->query($sql)) {
					statement("php", "ustawienia.php", "hasło zostało zaktualizowane");
				} else {
					statement("php", "ustawienia.php", "brak połączenia, spróbuj ponownie później");
				}
				
			} else {
				statement("php", "ustawienia.php", "nieprawidłowe hasło");
			}
		}
	} else {
		statement("php", "ustawienia.php", "powtórz hasło");
	}
}
if(isset($_POST['emailchange'])) {
	$email = htmlentities($_POST['newemail'], ENT_QUOTES, "UTF-8");
	$sql = "UPDATE `uzytkownicy` SET `email` = '$email' WHERE `id_uzytkownika` = $id_uzytkownika;";
	if($connect->query($sql)) {
		statement("php", "ustawienia.php", "zaktualizowano");
	} else {
		statement("php", "ustawienia.php", "brak połączenia, spróbuj ponownie później");
	}
}