<?php

	try {		
	    $conexao = new PDO('mysql:host=your_hostname;dbname=your_database;','your_user', 'your_password');
	    $conexao->exec('set names UTF8');
	    $conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	    echo 'ERRO: ' . $e->getMessage();
	}

?>
