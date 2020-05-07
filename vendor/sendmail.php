<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require '../lib/PHPMailer/Exception.php';
	require '../lib/PHPMailer/PHPMailer.php';
	require '../lib/PHPMailer/SMTP.php';

	$mail = new PHPMailer;
	createConnection();

	function createConnection() {
		global $mail;
		try
		{	
			$mail->isSMTP(); 
			$mail->SMTPDebug = 2;
			$mail->Host = "smtp.yandex.com";
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = 'site.gameshop';
			$mail->Password = 'qwertyasd';
		} catch (Exception $e) {
			$_SESSION['error'] = "Failed to sent email";
			header("Location: ../registreation.php");
			exit;
		}
	}

	function sendMessage($to, $message) {
		global $mail;
		try
		{	
			$mail->setFrom('site.gameshop@yandex.by', 'GameShop');
			$mail->addAddress($to, 'User');
			$mail->Subject = 'Registration';
			$mail->msgHTML($message);
	
			$mail->send();
			} catch (Exception $e) {
				$_SESSION['error'] = "Failed to sent email";
				header("Location: ../registreation.php");
				exit;
			}
	}