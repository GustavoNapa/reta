<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }

    if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja!=1 ) {
        fgb_erro( 'Usuário sem permissão de gerenciar lojas', 'Usuário sem permissão de gerenciar lojas', 'loja.php', 'NOTFOUND' );
        exit;
    }

    include_once 'page-sistema/loja/function/loja.php';

    switch ($_GET['view']) {

    	case 'formloja':
            fgb_incluirarquivo('page-sistema/loja/view/formloja.php');
        break;

        case 'formbairro':
            fgb_incluirarquivo('page-sistema/loja/view/formbairro.php');
        break;
    	
    	default:
    		fgb_incluirarquivo('page-sistema/loja/view/listarloja.php');
    	break;
    }
?>