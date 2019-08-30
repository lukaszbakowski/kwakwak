<?php
require_once('../php/connect.php');
require_once('../php/functions.php');

if(!isset($_SESSION['zalogowany'])) {
	exit;
} else {
	$id_uzytkownika = $_SESSION['zalogowany'];
}
if(isset($_GET['delete'])) {
	if($_GET['delete'] === "true") {
		$howmany = htmlentities($_GET['howmany'], ENT_QUOTES, "UTF-8");
		$hwm = filter_var($howmany, FILTER_SANITIZE_NUMBER_INT);
		if($hwm != $howmany) {exit;}
		$sql = "";
		for($i = 1; $i < $hwm; $i++) {
			${'id'.$i} = $_GET['id'.$i];
			$sql .= "DELETE FROM messages WHERE id_messages = ${'id'.$i} AND id_odbiorcy = $id_uzytkownika;";
		}
		$connect = connection_start();
		if($result = $connect->multi_query($sql)) {
			echo 'usunieto';
		}
		$connect->close();
	}
}
if(isset($_GET['read'])) {
	if($_GET['read'] === "true") {
		$id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
		$id_msg = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($id_msg != $id) {exit;}
		$sql = "SELECT (SELECT uzytkownicy.login FROM uzytkownicy WHERE uzytkownicy.id_uzytkownika = messages.id_nadawcy) AS logname, subject, tresc, data, id_nadawcy FROM messages
		WHERE id_messages = $id_msg AND id_odbiorcy = $id_uzytkownika;";
		$connect = connection_start();
		if($result = $connect->query($sql)) {
			if($row = $result->fetch_array(MYSQLI_ASSOC)) {
				echo '	<div class="readnadawca"><a href="profil.php?id='.$row['id_nadawcy'].'">'.$row['logname'].'</a></div><div class="readdate">'.$row['data'].'</div>
						<div id="sbj" class="readsubject">'.$row['subject'].'</div>
						<div class="readtresc">'.$row['tresc'].'</div>
						<p class="readbutton"><input type="button" onclick="readmsg();" value="zamknij" class="submit reset">&nbsp;<input type="button" class="submit" onclick="remsg('.$row['id_nadawcy'].')" value="odpowiedz"></p>';
			}

		} else {
			echo 'brak po³¹czenia, spróbuj ponownie póŸniej';
			exit;
		}
		$sql = "SELECT `readed` FROM `messages` WHERE `id_messages` = $id_msg AND `id_odbiorcy` = $id_uzytkownika;";
		if($result = $connect->query($sql)) {
			$r = $result->fetch_array(MYSQLI_ASSOC);
			if($r['readed'] === "1") {exit;} else {
				$sql = "UPDATE `messages` SET `readed` = 1 WHERE `id_messages` = $id_msg AND `id_odbiorcy` = $id_uzytkownika;";
				if($result = $connect->query($sql)) {
					$connect->close();
					exit;
				} else {
					$connect->close();
					echo 'brak po³¹czenia, spróbuj ponownie póŸniej';
					exit;
				}
			}
		}
	}
}