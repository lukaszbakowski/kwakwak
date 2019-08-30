<?php
require_once('functions.php');

if(isset($_SESSION['zalogowany'])) {
	
	if(isset($_POST['usun'])) {
	$id_uzytkownika = $_SESSION['zalogowany'];

	require_once('connect.php');
	$connect = connection_start();


		$sql = "DELETE FROM uzytkownicy WHERE id_uzytkownika = $id_uzytkownika;";
		
		if($result = $connect->query($sql))
		{
			session_unset();
			statement("php", "index.php", "Twoje konto zostało usunięte");
		
		}
		else
		{
			statement("php", "ustawienia.php", "błąd połączenia, spróbuj ponownie później");
		}
	} else if(isset($_GET['usun'])) {
		if($_GET['usun'] === "true") {
			echo '<p>Bardzo nam przykro, że chcesz nas opuścić.</p>
			<form action="#" method="post"><p><textarea rows="11" cols="33" placeholder="podaj powód dla którego chcesz skasować konto, abyśmy w przyszłości byli w stanie spełnić Twoje oczekiwania"></textarea></p>
			<p><input type="submit" name="usun" value="usuwam"></p></form>
			<p>Mamy nadzieję, że jeszcze do nas wrócisz.</p>';
		}
	} else {
		goto here;
	}
}
else
{ here:
	session_unset();
	header('Location:../index.php');
	exit();
	
}
