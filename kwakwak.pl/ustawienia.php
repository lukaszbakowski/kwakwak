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
<form method="post" action="php/action_ustawienia.php">
<main>
<div style="width:50%;">
<p style="text-align:left; widht:100%; margin-left:3.75%;">Zmiana adresu e-mail</p>
<p style="text-align:right; widht:100%; margin-right:3.75%;">aktualy adres e-mail:</p>
<p style="text-align:right; widht:100%; margin-right:3.75%;">nowy adres e-mail:</p>
</div>
<div style="width:50%;">
<p>&nbsp;</p>
<p style="width:100%; text-align:left;"><?php require_once('php/connect.php'); $connect = connection_start();
$id_uzytkownika = $_SESSION['zalogowany'];
$sql = "SELECT email FROM uzytkownicy WHERE id_uzytkownika = $id_uzytkownika";
$result = $connect->query($sql);
$r = $result->fetch_array(MYSQLI_ASSOC);
echo $r['email']; ?></p>
<p style="width:100%; text-align:left;"><input type="email" name="newemail"></p>
</div>
</main>
<p style="width:100%; text-align:right;"><input style="margin-right:3.75%;" type="submit" name="emailchange" class="submit" value="aktualizuj"></p>
</form>
<form method="post" action="php/action_ustawienia.php">
<main>
<div style="width:50%;">
<p style="text-align:left; widht:100%; margin-left:3.75%;">Zmiana hasła</p>
<p style="text-align:right; widht:100%; margin-right:3.75%;">aktualne hasło:</p>
<p style="text-align:right; widht:100%; margin-right:3.75%;">nowe hasło:</p>
<p style="text-align:right; widht:100%; margin-right:3.75%;">powtórz hasło:</p>
</div>
<div style="width:50%;">
<p>&nbsp;</p>

<p style="width:100%; text-align:left;"><input type="password" name="actualpw"></p>
<p style="width:100%; text-align:left;"><input type="password" name="typepw"></p>
<p style="width:100%; text-align:left;"><input type="password" name="retypepw"></p>
</div>
</main>
<p style="width:100%; text-align:right;"><input style="margin-right:3.75%;" type="submit" name="pwchange" class="submit" value="potwierdz"></p>
</form>
<a onclick="usun();">usuń konto</a>
<script>
function usun() {
	if (confirm('Jesteś pewny, że chcesz trwale usunąć konto? Wszelkie dane, w tym ogłoszenia, komentarze i oceny zostaną usunięte.')) {
		location.href='php/usun.php?usun=true';
	} else {
		// Do nothing!
	}
}
</script>

</div>


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