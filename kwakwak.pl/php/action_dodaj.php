<?php
include('functions.php');
if($_POST['search'] && $_POST['subject'] && $_POST['opis'] && $_POST['kategoria']) {

	$lok_id = 0;
	$zdj_id = 0;

	require_once('connect.php');
	$connect = connection_start();

	if($_POST['wojewodztwo'] && $_POST['wojewodztwo'] != "0" && $_POST['miejscowosc'] && $_POST['miejscowosc'] != "0") {
		$wojewodztwo = 	@$_POST['wojewodztwo'];
		$miejscowosc =	@$_POST['miejscowosc'];

		
		$sql = "SELECT `id_lokalizacja` FROM `lokalizacja` WHERE miejscowosc='$miejscowosc' AND wojewodztwo='$wojewodztwo'";
		$result = $connect->query($sql);
		if($result->num_rows) {
			while($row = $result->fetch_assoc()) {
				$lok_id = $row["id_lokalizacja"];
			}
		}
	} else {
		statement("php", "dodaj.php", 'Prosze uzupełnić wszystkie pola z gwiazdką');
	}
	
	$uz_id = $_SESSION['zalogowany'];

	$subject = 		htmlentities(@$_POST['subject'], ENT_QUOTES, "UTF-8");
	$opis = 		htmlentities(@$_POST['opis'], ENT_QUOTES, "UTF-8");
	$cena = 		htmlentities(@$_POST['cena'], ENT_QUOTES, "UTF-8");
	$kategoria =	htmlentities(@$_POST['kategoria'], ENT_QUOTES, "UTF-8");

	
	$sql = "INSERT INTO `ogloszenia`(`id_ogloszenia`, `id_uzytkownika`, `id_lokalizacja`, `kategoria`, `subject`, `opis`, `cena`, `data`, `unactiv`) VALUES (NULL, '$uz_id', '$lok_id', '$kategoria', '$subject', '$opis', '$cena', now(), now() + INTERVAL 7 DAY)";
	if($connect->query($sql)) {
		$id_ogloszenia = $connect->insert_id;
	} else statement("php", "dodaj.php", 'BŁĄD: coś poszło nie tak, baza danych nie odpowiada, spróbuj ponownie później');
	
	
	
	if($_POST['tag0'])	{

		$tag = [		htmlentities(@$_POST['tag0'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag1'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag2'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag3'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag4'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag5'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag6'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag7'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag8'], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_POST['tag9'], ENT_QUOTES, "UTF-8")];

		for($i=0;$i<10;$i++)	{
			if(!$tag[$i])	{
				$tagName[$i] = 0;
			}	else	{
					$sql = "SELECT id_taglist FROM `taglist` WHERE tagname = '$tag[$i]'";

					$result = $connect->query($sql);
					if($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$tagName[$i] = $row['id_taglist'];
						$connect->query("UPDATE `taglist` SET `tagsum`=`tagsum`+1 WHERE tagname = '$tag[$i]'");
					} else {
						$sql = "INSERT INTO `taglist`(`id_taglist`, `tagname`, `tagsum`) VALUES (NULL, '$tag[$i]', 1)";
						$connect->query($sql);
						$tagName[$i] = $connect->insert_id;
					}




				}
		}

		$sql = "INSERT INTO `hashtagi`(`id_hashtagi`, `id_ogloszenia`, `tag0`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `tag6`, `tag7`, `tag8`, `tag9`) VALUES (NULL, $id_ogloszenia, '$tagName[0]', '$tagName[1]', '$tagName[2]', '$tagName[3]', '$tagName[4]', '$tagName[5]', '$tagName[6]', '$tagName[7]', '$tagName[8]', '$tagName[9]')";

		if(!($connect->query($sql))) {
			statement("php", "dodaj.php", $connect->error);
		}

	} else {
		statement("php", "dodaj.php", 'BŁĄD: proszę użyć minimum jednego tagu');
	}
	if(!$_FILES["image_uploads0"]["error"] || !$_FILES["image_uploads1"]["error"] || !$_FILES["image_uploads2"]["error"] || !$_FILES["image_uploads3"]["error"] || !$_FILES["image_uploads4"]["error"]) {

		$filesNAME = [	htmlentities(@$_FILES["image_uploads0"]["name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads1"]["name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads2"]["name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads3"]["name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads4"]["name"], ENT_QUOTES, "UTF-8")];
		$filesSIZE = [	@$_FILES["image_uploads0"]["size"],
						@$_FILES["image_uploads1"]["size"],
						@$_FILES["image_uploads2"]["size"],
						@$_FILES["image_uploads3"]["size"],
						@$_FILES["image_uploads4"]["size"]];
		$filesTMP = [	htmlentities(@$_FILES["image_uploads0"]["tmp_name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads1"]["tmp_name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads2"]["tmp_name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads3"]["tmp_name"], ENT_QUOTES, "UTF-8"),
						htmlentities(@$_FILES["image_uploads4"]["tmp_name"], ENT_QUOTES, "UTF-8"),];
		$filesTYPE = [	@$_FILES["image_uploads0"]["type"],
						@$_FILES["image_uploads1"]["type"],
						@$_FILES["image_uploads2"]["type"],
						@$_FILES["image_uploads3"]["type"],
						@$_FILES["image_uploads4"]["type"]];
		$filesERROR = [	@$_FILES["image_uploads0"]["error"],
						@$_FILES["image_uploads1"]["error"],
						@$_FILES["image_uploads2"]["error"],
						@$_FILES["image_uploads3"]["error"],
						@$_FILES["image_uploads4"]["error"]];

		
		
		
		
		
		for($i=0;$i<5;$i++)	{
			$imgName[$i] = "";
			if($filesNAME[$i] && ($filesSIZE[$i]<999999) && !$filesERROR[$i]) {

				$randname = $i . rand(0, 999999) . $filesSIZE[$i] . $i . $filesNAME[$i];
				$target_file = '../img/' . $randname;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$uploadOk = 1;
				// Check if image file is a actual image or fake image
				$check = getimagesize($filesTMP[$i]);
				if($check == false) {
					$uploadOk = 0;
				}
				// Check if file already exists
				else if (file_exists($target_file)) {
					$uploadOk = 0;
				} 
				// Allow certain file formats
				else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $filesTYPE[$i]=="image/jpg" && $filesTYPE[$i]=="image/jpeg" && $filesTYPE[$i]=="image/png") {
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				else if ($uploadOk == 0) {
					statement("php", "dodaj.php", "Sorry, something goes wrong.. your file was not uploaded.<br>");
				// if everything is ok, try to upload file
				} else {
					$check = move_uploaded_file($filesTMP[$i], $target_file); 
					if(!$check) {
						statement("php", "dodaj.php", "Sorry, there was an error uploading your file.<br>");
					}
					$imgName[$i] = $randname;
				}
			}
		}
		if($check == true)	{
			$sql = "INSERT INTO `zdjecia`(`id_zdjecia`, `id_ogloszenia`, `img0`, `img1`, `img2`, `img3`, `img4`) VALUES (NULL, $id_ogloszenia, '$imgName[0]', '$imgName[1]', '$imgName[2]', '$imgName[3]', '$imgName[4]')";
			if($connect->query($sql)) {

			} else statement("php", "dodaj.php", "BŁĄD: coś poszło nie tak, baza danych nie odpowiada, spróbuj ponownie później");
		}
	} //end of file all shit

	
	
		$connect->close();
		statement("php", "profil.php", "Pomyślnie dodano ogłoszenie");
}	else	{
		statement("php", "dodaj.php", 'prosze wypełnić prawidłowo wszystkie wymagane pola');
	}
