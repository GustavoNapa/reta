<?php
    
    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }

    include 'page-sistema/cliente/function/cliente.php';

    switch ($_GET['view']) {

    	case 'formcliente':
    		fgb_incluirarquivo('page-sistema/cliente/view/formcliente.php');
    	break;
    	
    	default:
    		fgb_incluirarquivo('page-sistema/cliente/view/listarcliente.php');
    	break;
    }
?>