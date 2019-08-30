<?php
function connection_start() {
	$server = "localhost";
	$uname = "root";
	$password = "";
	$db = "kwakwak";

	$connect = @new mysqli($server, $uname, $password, $db);
	$connect -> query('SET NAMES utf8');
	$connect -> query('SET CHARACTER_SET utf8_general_ci');
	return $connect;
}