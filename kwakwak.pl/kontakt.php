<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pl">
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3690304735816428",
    enable_page_level_ads: true
  });
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Niewątpliwie najlepszy i najszybciej rozwijający się darmowy serwis ogłoszeń lokalnych w zupełnie nowej odsłonie, wykwakaj światu co tylko zechcesz">
<meta name="author" content="Łukasz Bąkowski">
<meta name="keywords" content="kwakwak,kwakwa,kaczka,kaczuszka,ogłoszenia,praca,rozrywka,elektronika,nieruchomości,ruchomości,biznes,zwierzaki,wydarzenia,imprezy,społeczność,randki,moda,uroda,sport,zdrowie,sztuka,prawo,oddam,zamienie,hobby,usługi,restauracje,edukacja,dziecko,pomysł,kupie,sprzedam,kupię,szukam">
<title>Ogłoszenia kwakwak.pl jedyny taki</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<link type="text/css" rel="stylesheet" href="css/nav.css">
<script src="script/newtag.js"></script>
<script src="script/navbar.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="audio/quack.js"></script>
<style>
.maincont {
	text-align:left;
	padding:0 2rem;
}

.infocolor {color:DodgerBlue ;}
.infocolor:hover {color:black;}
input[type="email"].textin:focus {
	transform: scale(1.0);
}
</style>
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



	<div class="srodek">
		<h1>Kontakt</h1>
		<p class="art">Chcesz się z nami skontaktować lub podjąć współpracę.. albo może szukasz miejsca na reklamę? Jesteśmy otwarci na wszelkiego rodzaju pomysły,
		propozycje, a nawet i krytykę jeśli tylko miałaby ona pomóc w rozwoju serwisu :) Wypełnij poniższy formularz i czekaj cierpliwie na odpowiedź.</p>
<form action="php/action_help.php" method="post">	
<section class="maincont col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">		<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">W jakim celu chcesz się z nami skontaktować?</li>
				</ul>Temat:&nbsp;<span style="color:red;">*</span>
			</div>
		<input style="width:100%;" type="text" class="subject" name="subject" maxlength="50" placeholder="Temat.."></section>
<section class="maincont col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">		<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">Podaj swój adres e-mail, byśmy mogli udzielić Ci odpowiedzi</li>
				</ul>Kontakt zwrotny:&nbsp;<span style="color:red;">*</span>
			</div>
		<input type="email" name="re" class="textin" placeholder="E-mail"></section>
<section class="maincont col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">		<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">Opisz jak najbardziej szczegółowo swoją propozycję (1000 znaków)</li>
				</ul>Opis:&nbsp;<span style="color:red;">*</span>
			</div>
				<textarea style="width:100%;" name="tresc" rows="11" maxlength="1000" placeholder="jaką masz do nas sprawę?"></textarea>
</section>
<main style="justify-content:flex-end; width:100%; padding:2rem;"><input type="submit" name="submit" class="submit" value="wyślij"></main>
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