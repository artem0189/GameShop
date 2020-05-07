<?php
	session_start();
	require_once('connection.php');

	$username = $_POST['username'];
	$password = hash('sha256', $_POST['password']);

	if (!$username || !$password) {
		$_SESSION['error'] = "Fill in all the fields";
		header("Location: ../login.php");
	} else {
		$sth = $pdo->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");

		$sth->bindValue(1, $username, PDO::PARAM_STR);
		$sth->bindValue(2, $password, PDO::PARAM_STR);

		$sth->execute();

		if ($sth->rowCount() == 0) {
			$_SESSION['error'] = 'Wrong login or password';
			header("Location: ../login.php");
		} else {
			$key = bin2hex(random_bytes(32));

			$sth = $pdo->prepare("UPDATE `users` SET `cookie` = ? WHERE `username` = ?");
			$sth->bindValue(1, $key, PDO::PARAM_STR);
			$sth->bindValue(2, $username, PDO::PARAM_STR);
			$sth->execute();

			setcookie("user", $username, time() + 3600, "/");
			setcookie("key", $key, time() + 3600, "/");
			header("Location: ../index.php");
		}
	}