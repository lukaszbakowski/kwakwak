<?php 

	session_start();

	
	if($_POST['submit'])
	{
		
		$regulamin=		@$_POST['regulamin'];
		$login = 		@$_POST['login'];
		$haslo = 		@$_POST['haslo'];
		$haslo2 =		@$_POST['haslorep'];
		$mail = 		@$_POST['mail'];	
		
		$login=htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo=htmlentities($haslo, ENT_QUOTES, "UTF-8");
		$mail=htmlentities($mail, ENT_QUOTES, "UTF-8");
		
		$secret = "6LeJCHcUAAAAAAVIweermUrPL8gBt5lE-4mKDOHu";
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$response = json_decode($check);
		
		if($response->success == false) {
			header('Location:../rejestracja.php');
			exit;
		}
		
		if (!$login)
		{
		$_SESSION['login']= '<p style="color:tomato">podaj login</p><br>';
		}
		else if (!preg_match('/(?=^.{5,17}$)(?=.*[a-z]).*$/', $login)||(ctype_alnum($login)===false))
		{
			$_SESSION['zly_login'] = '<span style="color:tomato">login powinen składać się z samych małych liter i minimum 5 znaków</span><br>';
		}
		if (!$haslo)
		{
		$_SESSION['haslo']= '<span style="color:tomato">podaj haslo</span><br>';
		}
		else if (!preg_match('/(?=^.{8,17}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-z]).*$/', $haslo)||(ctype_alnum($haslo)===false))
		{
			$_SESSION['zle_haslo'] = '<span style="color:tomato">haslo powinno skladać sie z przynajmniej 8 znaków, małych liter i cyfr</span><br>';
		}
		if (!$haslo2)
		{
		$_SESSION['haslorep']= '<span style="color:tomato">powtórz haslo</span><br>';
		}
		else if($haslo!=$haslo2)
		{
		$_SESSION['haslohaslo']= '<span style="color:tomato">hasła muszą być takie same</span><br>';
		}
		if (!$mail)		
		{
		$_SESSION['mail']= '<span style="color:tomato">Podaj prawidłowy adres e-mail</span><br>';
		}	
		if (!$regulamin)		
		{
		$_SESSION['regulamin']= '<span style="color:tomato">ZAAKCEPTUJ REGULAMIN</span>';
		}
		if(isset($_SESSION['zle_haslo'])||isset($_SESSION['zly_login'])||!$login||!$haslo||!$haslo2||($haslo!=$haslo2)||!$mail||!$regulamin)
		{
			$_SESSION['check']=1;
			$_SESSION['value_nick']=$login;
			$_SESSION['value_mail']=$mail;
			header('Location:../rejestracja.php');
			exit;
		}
		
		else if ($login&&$haslo&&$haslo2&&$mail&&$regulamin)
		{
			$connect = @new mysqli("localhost", "root", "", "kwakwak");

			if (!$connect) 
				{
				echo 'Error: Nie udało się połączyć z bazą danych.<br>Spróbuj ponownie później<br><a href="../index.php">Wróć do strony głównej</a><br>';
				exit;
				}
			$sql = "SELECT * FROM `uzytkownicy` WHERE `login`='$login'";
			
			$check_user = ($connect->query($sql))->num_rows;
			
			if($check_user)
				{
				$_SESSION['check_user']= 'sorry bro, już ktoś ma taki login :/<br>';
				$connect->close();
				$_SESSION['check']=1;
				header('Location:../rejestracja.php');
				exit;
				}
			else if ($check_user==0)
			{
				$haslo = password_hash($haslo, PASSWORD_DEFAULT);
			$sql = "INSERT INTO uzytkownicy(id_uzytkownika, login, haslo, email) VALUES (NULL, '$login', '$haslo', '$mail')";	
			}
			else
			{
				echo 'connect error: spróbuj ponownie później<br><a href="../index.php">Wróć do strony głównej</a><br>';
				exit;
			}
			

				
			if ($connect->query($sql)) 
				{
				$_SESSION['gratulacje']='<br>Gratulacje! Rejestracja przebiegła pomyślnie<br>Teraz już możesz się zalogować<br>';
				$connect->close();
				header('Location:../index.php');
				} 
				else 
				{
				echo 'connect error: spróbuj ponownie później<br><a href="index.php">Wróć do strony głównej</a><br>';
				}
		}
	}
	else
	{
		if(isset($_SESSION['zalogowany']))
		{
		header('Location:../profil.php');
		exit;
		}
		else
		{	
		session_unset();
		header('Location:../index.php');
		}
	}