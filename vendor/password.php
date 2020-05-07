<?php
	function getPassword() {
			$symbols = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$passwordLength = rand(8, 13);
			$size = strlen($symbols);

			$password = null;
			while ($passwordLength--) {
				$password .= $symbols[rand(1, $size)];
			}
			return $password;
	}