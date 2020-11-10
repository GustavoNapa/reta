<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }

    if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarconfiguracoes!=1 ) {
        fgb_erro( 'Usuário sem permissão de gerenciar configurações', 'Usuário sem permissão de gerenciar configurações', 'configuracoes.php', 'NOTFOUND' );
        exit;
    }

    include_once 'page-sistema/configuracoes/function/configuracoes.php';

    switch ($_GET['view']) {

    	case 'imagens':
            fgb_incluirarquivo('page-sistema/configuracoes/view/imagens.php');
        break;

        case 'textosite':
            fgb_incluirarquivo('page-sistema/configuracoes/view/textosite.php');
        break;
    	
    	default:
    		fgb_incluirarquivo('page-sistema/configuracoes/view/geral.php');
    	break;
    }
?>