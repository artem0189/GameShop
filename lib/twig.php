<?php
	require_once('Twig/Autoloader.php');
	Twig_Autoloader::register();

	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig = new \Twig\Environment($loader);