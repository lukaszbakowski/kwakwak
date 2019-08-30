<?php
require_once('../php/connect.php');
session_start();
$connect = connection_start();
if(isset($_GET['usun'])) {
	if($_GET['usun'] == "true") {
		$id_obserwowanego = filter_var($_GET['id_uz'], FILTER_SANITIZE_NUMBER_INT);
		$id_obserwujacego = $_SESSION['zalogowany'];
		$sql = "DELETE FROM `ulubione` WHERE id_obserwujacego = $id_obserwujacego AND id_obserwowanego = $id_obserwowanego;";
		if($result = $connect->query($sql)) {
			echo 'pomyślnie usunięto z listy obserwowanych';
		}
	}
	
}
$connect->close();