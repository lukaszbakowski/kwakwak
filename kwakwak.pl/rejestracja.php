<?php 

	session_start();

	if(isset($_SESSION['zalogowany'])) {
		header('Location:index.php');
		exit;
	}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>zaloguj</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/form.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<script src="audio/quack.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<audio id="quack"><source src="audio/quack.mp3" type="audio/mp3"></audio>
<?php if(!isset($_SESSION['zalogowany'])) { ?>
		<menu><a href="zaloguj.php">zaloguj się</a> | <a href="rejestracja.php">rejestracja</a></menu>
<?php } else { ?>
		<menu style="">Witaj&nbsp;<?= $_SESSION['zalogowany_jako'] ?>! | <a href="php/wyloguj.php">wyloguj się</a> | <a href="php/usun.php">usuń konto</a></menu>
<?php } ?>
	<header>
		<h1 style="margin:0; padding:0;"><img type="image" src="grafika/LOGO.SVG" alt="logo" width="100" onclick="quack()" style="vertical-align:middle; cursor:pointer;">darmowy serwis ogłoszeniowy</h1>
	</header>
<main>
<div class="logcont" title="ogłoszenia kwakwak.pl">
	<h1 class="logo"><a href="index.php"><span style="color:orange;">#</span><span style="color:black;">kwakwak.pl</span></a></h1>
</div>
<section>

		<h1>REJESTRACJA</h1>
		
			<?php

	if(isset($_SESSION['check']))
	{
		if(isset($_SESSION['zly_login']))
		{
			echo $_SESSION['zly_login'];
		}
		if(isset($_SESSION['zle_haslo']))
		{
			echo $_SESSION['zle_haslo'];
		}
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
		}
		if(isset($_SESSION['haslo']))
		{
			echo $_SESSION['haslo'];
		}
		if(isset($_SESSION['haslo2']))
		{
			echo $_SESSION['haslo2'];
		}
		if(isset($_SESSION['haslohaslo']))
		{
			echo $_SESSION['haslohaslo'];
		}
		if(isset($_SESSION['mail']))
		{
			echo $_SESSION['mail'];
		}
		if(isset($_SESSION['regulamin']))
		{
			echo $_SESSION['regulamin'];
		}
		if(isset($_SESSION['check_user']))
		{
			echo $_SESSION['check_user'];
		}
	}
	?>
		
		<form action="php/rejestruj.php" method="post">
		<p><input type="text" class="textin" 				name="login" autofocus placeholder="login" <?= isset($_SESSION['value_nick']) ? 'value="'. $_SESSION['value_nick'] .'"' : '' ?> required></p>
		<p><input type="password" class="textin" 			name="haslo" placeholder="hasło" required></p>
		<p><input type="password" class="textin" 			name="haslorep" placeholder="powtórz hasło" required></p>
		<p><input type="email" class="textin" 				name="mail" placeholder="E-mail" <?= isset($_SESSION['value_mail']) ? 'value="'.$_SESSION['value_mail'].'"' : '' ?> required></p>
		<p><label><input class="checkbox" type="checkbox" 	name="regulamin" value="accept" required>&nbsp;akceptuję</label>&nbsp;<a class="reglink" href="regulamin.php">regulamin</a></p>
		<div class="g-recaptcha" data-sitekey="6LeJCHcUAAAAAP8_pqr-vSi39XKxRxo6lt_4TSuH"></div>

		<p><input class="submit" type="submit" 				name="submit" value="Rejestruj"></p>
		<p><input class="submit reset" type="reset" value="Wyczyść"></p>
		</form>
		<a href="zaloguj.php">masz już konto?</a><br>
		
		<?php if(isset($_SESSION['check'])) session_unset(); ?>
		
</section>
<div class="background"></div>
</main>
<?php include('index/footer.php') ?>

</body>
</html>