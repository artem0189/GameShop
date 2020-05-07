<?php
	session_start();

	require_once('connection.php');

	$sth = $pdo->prepare("DELETE FROM `cart` WHERE `id` = ?");
	$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
	$sth->execute();

	header("Location: ../cart.php");