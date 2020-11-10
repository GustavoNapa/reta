<?php
	
	// Váriaveis GLOBAIS #690091
	define('DB_PREFIX', 'acb');
	define('SS_PREFIX', 'ACB');

	// // HTTP
	// define('HTTP_SERVER', 'http://localhost/s4bit/lavor/public/');

	// // HTTPS
	// define('HTTPS_SERVER', 'https://localhost/s4bit/lavor/public/');

	// // DIR
	// define('DIR_APPLICATION', 'C:/wamp64/www/s4bit/lavor/public/catalog/');
	// define('DIR_SYSTEM', 'C:/wamp64/www/s4bit/lavor/public/system/');
	// define('DIR_IMAGE', 'C:/wamp64/www/s4bit/lavor/public/image/');
	// define('DIR_STORAGE', 'C:/wamp64/www/s4bit/lavor/storage/');

	// // NO CHANGE
	// define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
	// define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
	// define('DIR_CONFIG', DIR_SYSTEM . 'config/');
	// define('DIR_CACHE', DIR_STORAGE . 'cache/');
	// define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
	// define('DIR_LOGS', DIR_STORAGE . 'logs/');
	// define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
	// define('DIR_SESSION', DIR_STORAGE . 'session/');
	// define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

	// // DB
	// define('DB_DRIVER', 'mysqli');
	// define('DB_HOSTNAME', 'localhost');
	// define('DB_USERNAME', 'root');
	// define('DB_PASSWORD', '');
	// define('DB_DATABASE', 'lavor');
	// define('DB_PORT', '3306');
	// define('DB_PREFIX', 'oc_');

// Váriaveis globais - Saudação
    $hsa_hora = date("H");
    if($hsa_hora >= 12 && $hsa_hora<18) {
        $_SESSION[SS_PREFIX.'_SAUDACAO'] = "BOA TARDE";
    }else if ($hsa_hora >= 0 && $hsa_hora <12 ){
        $_SESSION[SS_PREFIX.'_SAUDACAO'] = "BOM DIA";
    }else {
        $_SESSION[SS_PREFIX.'_SAUDACAO'] = "BOA NOITE";
    }