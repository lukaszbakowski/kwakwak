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
<link type="text/css" rel="stylesheet" href="css/search.css">
<link type="text/css" rel="stylesheet" href="css/add.css">
<noscript><meta http-equiv="refresh" content="0; url=index/whatyouwant.php"></noscript>
<script src="script/newtag.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="script/catactive.js"></script>
<script src="img/img.js"></script>
<style>
.infocolor {color:DodgerBlue ;}
.infocolor:hover {color:black;}
</style>
</head>

<body>
<?php include('index/header.php');?>

<main class="section col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">
<div id="lewa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	
	<div class="lewa">

<?php include('index/lewa.php'); ?>
	
	</div>
</div>

<div id="srodek" class="col-xl-6 col-l-8 col-m-12 col-s-12 col-xs-12">
	<div class="srodek">
<p><a href="dodaj.php"><button class="zakladka unactualzakladka">Dodaj ogłoszenie</button></a><button class="zakladka actualzakladka">kwakChat</button></p>
chcesz mieć większy rozgłoś? kwaknij coś w swojej okolicy

	<form action="php/action_kwakchat.php" method="post">
	

	
	
	
		<p style="text-align:left; widht:100%; margin-left:3.75%;">Napisz coś:</p>
		<p style="width:100%;"><textarea style="margin:0 auto;" name="kwak" rows="10" maxlength="500" placeholder="niech wszyscy usłyszą Twój głos"></textarea></p>
		<input type="hidden" name="lokalizacja" value="<?php $ip = $_SERVER['REMOTE_ADDR']; $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json")); echo $details->city; ?>">
		<p style="width:100%; text-align:right;"><input style="margin-right:3.75%;" type="submit" name="submit" class="submit" value="kwaknij"></p>


	</form>
		
	</div>



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