<?php
	session_start();
	if (!isset($_COOKIE['user'])) {
		$_SESSION['error'] = 'You need to sign in';
		header("Location: ../game.php?name=" . $_GET['name']);
		exit;
	}

	require_once('connection.php');

	$sth = $pdo->prepare("INSERT INTO `cart` (`id`, `username`, `product_id`, `count`) VALUES (NULL, ?, ?, ?)");
	$sth->bindValue(1, $_COOKIE['user'], PDO::PARAM_STR);
	$sth->bindValue(2, $_GET['id'], PDO::PARAM_INT);
	$sth->bindValue(3, 1, PDO::PARAM_INT);

	$sth->execute();

	header("Location: ../catalog.php");
