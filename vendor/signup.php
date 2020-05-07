<?php
	session_start();
	require_once('connection.php');
	require_once('sendmail.php');
	require_once('password.php');

	$username = $_POST['username'];
	$email = $_POST['email'];
	$email_confirm = $_POST['email_confirm'];

	if (!$username || !$email || !$email_confirm) {
		$_SESSION['error'] = "Fill in all the fields";
		header("Location: ../registration.php");
	} elseif (!preg_match('/^[a-zA-Z](([a-zA-Z0-9]*[\.\-]?)+[a-zA-Z0-9])*@([a-zA-Z]+\.)+[a-zA-Z]+/m', $email)) {
		$_SESSION['error'] = "Invalid email";
		header("Location: ../registration.php");
	} elseif ($email !== $email_confirm) {
		$_SESSION['error'] = "Emails do not match";
		header("Location: ../registration.php");
	} else {
		$password = getPassword();
		sendMessage($email, "Login: " . $username . "<br>Password: " . $password);
		$password = hash('sha256', $password);

		$sth = $pdo->prepare("INSERT INTO `users` (`id`, `username`, `email`, `password`, `cookie`) VALUES (NULL, ?, ?, ?, ?)");
	
		$sth->bindValue(1, $username, PDO::PARAM_STR);
		$sth->bindValue(2, $email, PDO::PARAM_STR);
		$sth->bindValue(3, $password, PDO::PARAM_STR);
		$sth->bindValue(4, bin2hex(random_bytes(32)), PDO::PARAM_STR);

		try
		{
			$sth->execute();
		}
		catch (PDOException $e)
		{
			$_SESSION['error'] = "Invalid username or mail";
			header("Location: ../registration.php");
			exit;
		}

		header("Location: ../login.php");
	}