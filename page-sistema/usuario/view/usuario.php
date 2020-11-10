<?php
    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }

    if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarusuario!=1 ) {
        fgb_erro( 'Usuário sem permissão de Gerenciar usuário', 'Usuário sem permissão de Gerenciar usuário', 'usuario.php', 'NOTFOUND' );
        exit;
    }

    include_once 'page-sistema/usuario/function/usuario.php';

    switch ($_GET['view']) {

        case 'formusuario':
            fgb_incluirarquivo('page-sistema/usuario/view/formusuario.php');
        break;

        case 'nivelacesso':
            fgb_incluirarquivo('page-sistema/usuario/view/formnivelacesso.php');
        break;
        
        default:
            fgb_incluirarquivo('page-sistema/usuario/view/listarusuario.php');
        break;
    }
?>