<?php
	session_start();
	if (!isset($_COOKIE['user'])) {
		header("Location: index.php");
		exit;
	}

	require_once('lib/twig.php');
	require_once('vendor/connection.php');
	require_once('vendor/checksignin.php');

	$sth = $pdo->prepare("SELECT * FROM `catalog` AS cat, `cart` AS car WHERE cat.id = car.product_id");
	$sth->bindValue(1, $_COOKIE['user'], PDO::PARAM_STR);
	$sth->execute();

	echo $twig->render('cart.html.twig', [
			'isLogin' => checkAuth(),
			'games' => $sth->fetchAll()
		]);