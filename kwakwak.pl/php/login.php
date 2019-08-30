<?php
session_start();

$login =		@$_POST['login'];
$haslo =		@$_POST['haslo'];
$load =			@$_POST['submit'];



if($load)
{
	$login=htmlentities($login, ENT_QUOTES, "UTF-8");
	$haslo=htmlentities($haslo, ENT_QUOTES, "UTF-8");
//		$secret = "*********************************8";
//		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
//		$response = json_decode($check);
		
//		if($response->success == false) {
//			header('Location:../zaloguj.php');
//			exit;
//		}
	
	if(!$login||!$haslo)
	{
		$_SESSION['blad_logowania'] = '<br>Podaj prawidłowe dane<br>';
		header('Location:../index.php');
		exit;
	}
	else if($login&&$haslo)
	{
		require_once('connect.php');
		$connect = connection_start();
		
		if (!$connect) 
		{
			echo 'Error: Nie udało się połączyć z bazą danych.<br>Spróbuj ponownie później<br><a href="../index.php">Wróć do strony głównej</a><br>';
			exit;
		}
		$sql = "SELECT `id_uzytkownika`, `haslo` FROM `uzytkownicy` WHERE `login`='$login'";
		if($result = $connect->query($sql)) {
			if($check_user = $result->num_rows) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if(password_verify($haslo, $row['haslo'])) {
					$_SESSION['zalogowany']= $row['id_uzytkownika'];
					$connect->close();

					$_SESSION['nick'] = $login;
					
					header('Location:../profil.php');
					exit;
				} else {
					header('Location:../index.php');
					exit;
				}
			}
		}
		
	}
}
else
{
	if(isset($_SESSION['zalogowany']))
	{
		header('Location:../profil.php');
		exit;
	}
	else
	{
	session_unset();
	header('Location:../index.php');
	exit;
	}
}
