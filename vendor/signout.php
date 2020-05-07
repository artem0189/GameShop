<?php
	session_start();

	echo($_COOKIE['user']);

	if (isset($_COOKIE['user'])) {
		unset($_COOKIE['user']);
		setcookie('user', null, -1, '/');
	}

	header("Location: ../index.php");