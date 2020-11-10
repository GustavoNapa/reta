<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }

    if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarproduto!=1 ) {
        fgb_erro( 'Usuário sem permissão de gerenciar produtos', 'Usuário sem permissão de gerenciar produtos', 'produto.php', 'NOTFOUND' );
        exit;
    }

    include_once 'page-sistema/produto/function/produto.php';

    switch ($_GET['view']) {

    	case 'formproduto':
            fgb_incluirarquivo('page-sistema/produto/view/formproduto.php');
        break;

        // case 'formcategoria':
        //     fgb_incluirarquivo('page-sistema/produto/view/formcategoria.php');
        // break;
    	
    	default:
    		fgb_incluirarquivo('page-sistema/produto/view/listarproduto.php');
    	break;
    }
?>