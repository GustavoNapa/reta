<?php

    # Controle da URL através das informações salvas pelo ADMIN ou DEFAULT no BD

    // Buscar dados da página no BD
    $s_dadospage = "SELECT * FROM ".DB_PREFIX."_page";
    try{ 
        $r_dadospage = $conexao->prepare($s_dadospage);
        $r_dadospage->execute(); 
        $c_dadospage = $r_dadospage->rowCount();
        //se encontrar mais que um monte um array
        if ($c_dadospage > 0) {
            // Array de objeto(s) com todos as paginas encontradas          
            $_dadospage = $r_dadospage->fetchAll(PDO::FETCH_OBJ);
            $page_notfound = true;
            // Procurar no array, URLNOME == requisitada na URL
            foreach ($_dadospage as $_pagina) {

                // gravando dados da página atual
                $_paginaatual = $_pagina;

                # $_URL_ARRAY[0] -> definido em index.php
                if ( $_pagina->pge_urlnome == $_URL_ARRAY[0] ) {
                    $page_notfound = false;
                    # Verificar status da página
                    if ( $_pagina->pge_status==0 ) {
                        fgb_erro( 'Página inacessivel, contate o suporte', 'Página inativada pelo administrador do sistema', 'controledeurl.php', 'NOTFOUND' );
                        exit;
                    }

                    # Verificar se é necessário controle de login
                    if ( $_pagina->pge_controlelogin == 1 ) {
                        // Controle de acesso
                        if ( !isset($_SESSION[SS_PREFIX.'_LOGIN']) ) {
                            // redirecionamento -> $_destino, $_mensagem='', $_log='', $_origem='', $_case='', $_redirect=''
                            fgb_header('login', 'Usuário deslogado', 'Sessão de _LOGIN não encontrada', 'controledeurl', '', '');
                            exit;
                        }

                        // Atualiza dados do usuário logado
                        fgb_atualizarusuariologado();
                    }

                    # Verificar se existe LOGOUT.php - inclui se existir
                    fgb_incluirarquivo('global/controller/logout.php');

                    # Buscar controle de página na raiz -> page-site/controledepagina.php
                    if ( file_exists('page-'.$_pagina->pge_diretorio.'/controledepagina.php') ) {
                        include_once 'page-'.$_pagina->pge_diretorio.'/controledepagina.php';
                    }else{
                        fgb_console('page-'.$_pagina->pge_diretorio.'/controledepagina.php não encontrado no controle de url', 'error', 'controledeurl');
                    }

                    # SAIR DO FOREACH
                    break;    
                }  // fim $_pagina->pge_urlnome == $_URL_ARRAY[0]
            } // fim do foreach

            if ( $page_notfound==true ) {
                fgb_erro( 'Página '.$_URL_ARRAY[0].' não encontrada!', $_URL_ARRAY[0].' não encontrada na tabela de páginas do banco de dados', 'controledeurl.php', 'NOTFOUND' );
                exit;
            }

        }else{
            // função global de redirecionamentp - $_mensagem, $_log, $_origem, $_case=''
            fgb_erro( 'Parâmetros da página não encontrados, contate o suporte', 'NENHUMA página encontrada no controle de URL, no BANCO DE DADOS', 'controledeurl.php', 'NOTFOUND' );
            exit;
        }
    }catch(PDOException $e){
        // função global de redirecionamentp - $_mensagem, $_log, $_origem, $_case=''
        fgb_erro( $e, 'ERROGRAVE', 'controledeurl.php', 'ERROGRAVE' );
        exit;
    };
?>