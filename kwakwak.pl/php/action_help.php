<?php
require_once('connect.php');
require_once('functions.php');
if(isset($_POST['submit'])) {
	$sbj = htmlentities($_POST['subject'], ENT_QUOTES, "UTF-8");
	$re = htmlentities($_POST['re'], ENT_QUOTES, "UTF-8");
	$tresc = htmlentities($_POST['tresc'], ENT_QUOTES, "UTF-8");
	$send = $re.'<br>'.$tresc;
	
	$connect = connection_start();
	$sql = "INSERT INTO `messages`(`id_messages`, `id_nadawcy`, `id_odbiorcy`, `subject`, `tresc`, `readed`, `data`) VALUES (NULL, 1, 1, '$sbj', '$send', 0, now());";
	if($result = $connect->query($sql)) {
		statement("php", "index.php", "Twoja wiadomość została wysłana, czekaj cierpliwie na odpowiedz");
	} else statemenet("php", "index.php", "wystąpił problem z połączeniem, spróbuj ponownie później");
} else {
	exit;
}