<style>
menu {
	display:flex;
	align-items:baseline;
	flex-wrap:nowrap;
	justify-content:flex-end;
}
.menupref {

}
.menupref > .pref {
	list-style-type:none;
	display:none;
	position:absolute;
	right:3rem;
	color:black;
	z-index:100;
	width:13rem;
	background-color:white;
	border:1px solid red;
	margin:0 auto;
	padding:0.25rem 0.5rem;
}
.menupref:hover > .pref {
	display:block;
}
.menupref {color:grey;}
.menupref:hover {
	color:brown;
}
@keyframes fapping {
	0% {transform:rotate(0deg);
	color:white;}
	5% {transform:rotate(7deg);}
	10% {transform:rotate(13deg);}
	15% {transform:rotate(21deg);}
	20% {transform:rotate(13deg);}
	25% {transform:rotate(7deg);}
	30% {transform:rotate(0deg);}
	35% {transform:rotate(-7deg);}
	40% {transform:rotate(-13deg);}
	45% {transform:rotate(-21deg);}
	50% {transform:rotate(-13deg);
	color:grey;}
	55% {transform:rotate(-7deg);}
	60% {transform:rotate(0deg);}
	65% {transform:rotate(0deg);}
	70% {transform:rotate(0deg);}
	75% {transform:rotate(0deg);}
	80% {transform:rotate(0deg);}
	85% {transform:rotate(0deg);}
	90% {transform:rotate(0deg);}
	95% {transform:rotate(0deg);}
	100% {transform:rotate(0deg);
	color:white;}
}
.fapping {
	display:block;
	animation: fapping 1.5s infinite;

}
menu > a {
	display:flex;
	flex-wrap:nowrap;
}
</style>

<audio id="quack"><source src="audio/quack.mp3" type="audio/mp3"></audio>
	<header>
<?php if(!isset($_SESSION['zalogowany'])) { ?>
<script>
if(localStorage.nick) {
	localStorage.removeItem('nick');
}
</script>
		<menu><a href="zaloguj.php">zaloguj się</a>&nbsp;|&nbsp;<a href="rejestracja.php">rejestracja</a></menu>
<?php } else { if(isset($_SESSION['nick'])) { ?>

<script>
if(!localStorage.nick){
	localStorage.nick = "<?php echo $_SESSION['nick']; unset($_SESSION['nick']); ?>";
}
</script>
<?php } ?>
		<menu style="">
			Witaj&nbsp;<ul class="menupref"><script>document.write(localStorage.nick)</script><i class="icon-angle-double-down"></i>
				<ol class="pref">
					<li class="pref"><a href="edycja.php">edycja profilu</a></li>
					<li class="pref"><a href="ustawienia.php">ustawienia konta</a></li>
					<li class="pref"><a href="php/wyloguj.php">wyloguj się</a></li>
				</ol>
			</ul>!&nbsp;|&nbsp;
		
		<?php
		require_once('php/connect.php');

		$connect=connection_start();
		$id = $_SESSION['zalogowany'];
			$sql="SELECT * FROM messages WHERE id_odbiorcy = $id AND readed = false";
			if(!$result = $connect->query($sql)) echo "brak polaczenia";
			$unreaded = $result->num_rows;
			if($unreaded == 0) $icon = "icon-mail";
			else $icon="icon-mail-alt fapping";

			echo '<a href="messages.php">masz '.$unreaded.'&nbsp;<i class="'.$icon.'"></i></a>';
		?>
		</menu>
<?php } ?>

		<h1><img type="image" src="grafika/LOGO.SVG" alt="logo" width="100" onclick="quack()" style="vertical-align:middle; cursor:pointer;">darmowy serwis ogłoszeniowy</h1>
	</header>
<nav id="navbar">
		<ol class="navbar" onmouseover="activenav()" onmouseout="unactivenav()">
			<li><a class="navlink" href="index.php" title="home"><i class="icon-home"></i></a></li>
			<li><a class="navlink" href="szukaj.php" title="szukaj"><i class="icon-search"></i></a></li>
			<li><a class="navlink" href="dodaj.php" title="dodaj ogłoszenie"><i class="icon-plus-squared"></i></a></li>
			<li><a class="navlink" href="polubione.php" title="polubione"><i class="icon-heart"></i></a></li>
			<li><a class="navlink" href="profil.php" title="profil"><i class="icon-user"></i></a></li>
		</ol>
</nav>