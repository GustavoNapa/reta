<?php

	try {		
	    $conexao = new PDO('mysql:host=108.179.193.0:3306;dbname=espac083_reta;','espac083_reta', 'valete');
	    $conexao->exec('set names UTF8');
	    $conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	    echo 'ERRO: ' . $e->getMessage();
	}

?>
