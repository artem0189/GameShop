<?php
	require_once('connection.php');

	function checkAuth() : bool {
		global $pdo;
		$result = false;
		if (isset($_COOKIE['key']) && isset($_COOKIE['user'])) {
			$key = $_COOKIE['key'];
			$username = $_COOKIE['user'];

			$sth = $pdo->prepare("SELECT * FROM `users` WHERE `username` = ? AND `cookie` = ?");
			$sth->bindValue(1, $username, PDO::PARAM_STR);
			$sth->bindValue(2, $key, PDO::PARAM_STR);
			$sth->execute();

			if ($sth->rowCount() != 0) {
				$result = true;
			}
		}
		return $result;
	}
