<?php
session_start();

function statement($index, $url, $message) {
	if($index == "index") {
		$index = 'Location:statement.php';
	} else {
		$index = 'Location:../statement.php';
	}
	$_SESSION['statement'] = $message;
	$_SESSION['url'] = $url;
	header($index);
	exit;
}

//		$result = $connect->query($sql);
//		if($result->num_rows) {
//			while($row = $result->fetch_assoc()) {
//				statement($row["id"]);
//			}
//		}

