<?php
require_once('../php/connect.php');
require_once('../php/functions.php');
if(!isset($_SESSION['zalogowany'])) {
	exit();
} else {
	$id_uzytkownika = $_SESSION['zalogowany'];
}
if(isset($_GET['reactive'])) {
	if($_GET['reactive'] === "true") {
		$id_ogl = htmlentities($_GET['id_ogloszenia'], ENT_QUOTES, "UTF-8");
		$id_ogloszenia = filter_var($id_ogl, FILTER_SANITIZE_NUMBER_INT);
		if($id_ogl != $id_ogloszenia) {exit();}
		$connect = connection_start();
		$sql = "UPDATE `ogloszenia` SET `unactiv` = (now() + INTERVAL 7 DAY) WHERE `id_ogloszenia` = $id_ogloszenia AND `id_uzytkownika` = $id_uzytkownika;";
		if($result = $connect->query($sql)) {
			$connect->close();
			exit();
		} else {
			$connect->close();
			statement("ajax", "zarzadzaj.php", "brak połączenia, spróbuj ponownie później");
		}
		
	} else exit();
	
} else exit();