<?php
	session_start();

	if (isset($_COOKIE['user'])) {
		unset($_COOKIE['user']);
		setcookie('user', null, -1, '/');
	}

	if (isset($_COOKIE['key'])) {
		unset($_COOKIE['key']);
		setcookie('key', null, -1, '/');
	}

	header("Location: ../index.php");