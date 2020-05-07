<?php
	session_start();
	require_once('lib/twig.php');
	require_once('vendor/connection.php');
	require_once('vendor/checksignin.php');

	$game_name = "";
	if (isset($_GET['name'])) {
		$game_name = $_GET['name'];
		unset($_GET['name']);
	} else {
		header("Location: catalog.php");
		exit;
	}

	$error = "";
	if (isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}

	$sth = $pdo->prepare("SELECT * FROM `catalog` WHERE name = ?");
	$sth->bindValue(1, $game_name, PDO::PARAM_STR);
	$sth->execute();

	echo $twig->render('game.html.twig', [
			'isLogin' => checkAuth(),
			'game' => $sth->fetch(),
			'error' => $error
		]);