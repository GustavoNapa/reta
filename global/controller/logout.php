<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	if ( $_GET['logout']=="true" || isset($_REQUEST['sair']) ) {
        // session_destroy();
        // DESTRUIR SESSOES
        unset($_SESSION[SS_PREFIX.'_LOGIN']);
		unset($_SESSION[SS_PREFIX.'_USUARIO']);
		unset($_SESSION[SS_PREFIX.'_NIVELACESSO']);
		unset($_SESSION[SS_PREFIX.'_DTLOGIN']);
	}
?>