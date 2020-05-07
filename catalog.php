<?php
	session_start();
    require_once('lib/twig.php');
    require_once('vendor/connection.php');
    require_once('vendor/checksignin.php');

    $sth = $pdo->prepare("SELECT * FROM `catalog`");
	$sth->execute();

    echo $twig->render('catalog.html.twig', [
    		'isLogin' => checkAuth(),
    		'games' => $sth->fetchAll()
    	]);