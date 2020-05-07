<?php
	session_start();
	if (isset($_COOKIE['user'])) {
		header("Location: index.php");
		exit;
	}

	require_once('lib/twig.php');

	$error = "";
	if (isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}

	echo $twig->render('registration.html.twig', [
			'error' => $error
		]);