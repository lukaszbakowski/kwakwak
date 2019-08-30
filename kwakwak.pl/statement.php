<?php session_start(); 

if(!isset($_SESSION['statement'])) {
	header('Location:index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>statement</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/form.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<meta http-equiv="refresh" content="5; url=<?php echo $_SESSION['url']; ?>">
<style>
.statement {
	align-content:center;
	width:100%;
	height:100%;
	font-size:1.3rem;
	color:orangered;
	letter-spacing:0.3rem;
	flex-direction:column;
}
.statement > a {
	color:black;
	margin:2rem;
	text-align:right;
	width:100%;
}
.statement > a:hover {
	color:brown;
}
</style>
</head>
<body>
<audio id="quack"><source src="audio/quack.mp3" type="audio/mp3"></audio>
<menu>&nbsp;</menu>
	<header>
		<h1 style="margin:0; padding:0;"><img type="image" src="grafika/LOGO.SVG" alt="logo" width="100" onclick="quack()" style="vertical-align:middle; cursor:pointer;">darmowy serwis ogłoszeniowy</h1>
	</header>
<main>
<div class="logcont" title="ogłoszenia kwakwak.pl">
	<h1 class="logo"><a href="index.php"><span style="color:orange;">#</span><span style="color:black;">kwakwak.pl</span></a></h1>
</div>
<section>
<main class="statement"><?php

	echo '<p>'.$_SESSION['statement'].'</p>';
	unset($_SESSION['statement']);
	echo '<a href="'.$_SESSION['url'].'">powrót</a>';
	unset($_SESSION['url']);
?></main>
</section>
<div class="background"></div>
</main>
<?php include('index/footer.php') ?>
</body>
</html>