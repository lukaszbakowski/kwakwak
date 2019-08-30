

<h2>KwakChat</h2>


<?php
require_once('php/connect.php');
$connect=connection_start();

$sql="SELECT * FROM kwakchat ORDER BY czas LIMIT 20";
$result = $connect->query($sql);
$i=0;
while($row = $result->fetch_assoc()) {
	$id_uzytkownika = $row['id_uzytkownika'];
	$sql = "SELECT login FROM uzytkownicy WHERE id_uzytkownika = $id_uzytkownika";
	$res = $connect->query($sql);
	if($r = $res->fetch_array(MYSQLI_ASSOC)) {

			echo '<main><div style="width:100%; background-color:lightgrey; text-align:left; padding-left: 0.3rem;"><a href="profil.php?id='.$row['id_uzytkownika'].'">'.$r['login'].'</a></div>'.$row['kwak'].'</main><hr>';

	}

	$i++;
}


$connect->close();
?>