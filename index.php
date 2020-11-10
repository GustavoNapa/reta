<?php
ob_start(); // SESSÃO SEMPRE ABERTA
session_start(); // SESSÃO SEMPRE INICIADA
error_reporting(0); // IGNORAR ERROS SIMPLES

	// Controle de HTTPS = http://localhost/modelo/exemplo?acao=teste
	$_URL_COMPLETA 	= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	// Reescrita de URL = exemplo/setivermais/semget/aparece/assim
    $_URL 			= ( isset($_GET['url']) ) ? $_GET['url']:'';
    $_URL_TOTAL		= $_URL==''?0:count($_URL);

    // Criar um array com as palavras contidas na URL separadas por "/"
    $_URL_ARRAY		= array_filter(explode('/', $_URL));

    // Se não houver /comando
    if ( $_URL_TOTAL<=0 ) {
    	header('location: inicio?acb_info=bemvindo');
		exit;
    }

	// Funções globais em PHP
	include_once 'global/controller/functions.php';

	// Configurações globais
	include_once 'global/controller/config.php';

	// Controle de URL
	include_once 'global/controller/controledeurl.php';

	# FIM DO INDEX
?>