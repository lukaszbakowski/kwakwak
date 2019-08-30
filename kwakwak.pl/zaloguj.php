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
<title>kwakwak.pl zaloguj się na swoje konto</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/form.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<script src="audio/quack.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
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
		<h1>LOGOWANIE</h1>
		<?php 
			if(isset($_SESSION['statement'])) {
				echo $_SESSION['statement'];
				unset($_SESSION['statement']);
			}
		?>
		<form action="php/login.php" method="post">
		<p><input type="text" class="textin" name="login" placeholder="login" autofocus required></p>
		<p><input type="password" class="textin" name="haslo" placeholder="hasło" required></p>
	<!--	<div class="g-recaptcha" data-sitekey="6LcMV3AUAAAAACAV8HMsrIcBvQDIlTlTwC-V-5sa"></div> -->
		<a href="odzyskaj.php">zapomniałeś hasło?</a><br>
		<p><input class="submit" type="submit" name="submit" value="Zaloguj się"></p>
		</form>
		<a href="rejestracja.php">stwórz konto</a>
</section>
<div class="background"></div>
</main>
<?php include('index/footer.php') ?>

</body>
</html>