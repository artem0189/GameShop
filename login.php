<?php
	session_start();

	require_once('lib/twig.php');
	require_once('vendor/checksignin.php');
	
	if (checkAuth()) {
		header("Location: index.php");
		exit;
	}	

	$error = "";
	if (isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}

	echo $twig->render('login.html.twig', [
			'error' => $error
		]);