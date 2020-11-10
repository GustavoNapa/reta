<?php
	// LEGENDA - PREFIXO
	// fgb - função global

    // Conectar-se ao banco de dados
    include_once 'global/controller/conexao/conexao_pdo.php';

    // Função para escrever no console do navegador
    function fgb_console($_debug, $_toastr='', $_origem=''){
        if ($_origem == "") {
            $_origem = "Depuração no PHP";
        }
        if ($_debug != '') {            
            echo "<script type='text/javascript'>
                        console.log('".$_origem." - ".$_debug."');
                </script>";
        }
        if ($_toastr != "") {
            echo "<script type='text/javascript'>
                        setTimeout(function(){
                            toastr['".$_toastr."']('".$_debug."');
                        }, 500);
                </script>";
        }
    }

    // Função para redirecionamento da página de erro
    function fgb_erro( $_mensagem, $_log, $_origem, $_case='', $_redirect='' ){
        header('location: erro?mensagem='.$_mensagem.'&log='.$_log.'&origem='.$_origem.'&case='.$_case.'&redirect='.$_redirect);
        exit;
    }

    // Função para redirecionamento de página em geral
    function fgb_header( $_destino, $_mensagem='', $_log='', $_origem='', $_case='', $_redirect='' ){
        header('location: '.$_destino.'?mensagem='.$_mensagem.'&log='.$_log.'&origem='.$_origem.'&case='.$_case.'&redirect='.$_redirect);
        exit;
    }

    // Atualiza dados do usuário logado
    function fgb_atualizarusuariologado(){
        // Criar função que atualiza sessão de usuário logado
        include_once '../../../global/controller/conexao/conexao_pdo.php';
        include_once 'global/controller/conexao/conexao_pdo.php';
        include_once '../../../page-sistema/usuario/function/usuario.php';
        include_once 'page-sistema/usuario/function/usuario.php';
        // include 'page-sistema/caixa/function/caixa.php';

        $usu_id = $_SESSION[SS_PREFIX.'_USUARIO']->usu_id;

        $get_atualizaUsuario = acb_getUsuario( array( 'usu_id' => $usu_id, 'usu_status' => 1 ) );

        // var_dump($usu_id);
        // var_dump($get_atualizaUsuario);
        // exit;

        if ( $get_atualizaUsuario[0]=="SUCESSO" && $get_atualizaUsuario[1]==1 ) {

            $_SESSION[SS_PREFIX.'_USUARIO'] = $get_atualizaUsuario[2][0];

            // // VALIDAR SESSÃO DO CAIXA
            // $getCaixa = json_decode( get_caixa( '', ' WHERE C.`cax_status`=1 AND U.`usu_id`='.$usu_id.' AND date(C.`cax_dtabertura`)=CURDATE() ') );

            // if ( $getCaixa->total==1 ) {
            //     $_SESSION[SS_PREFIX.'_CAIXA'] = $getCaixa->dados[0];
            // } else {
            //     $_SESSION[SS_PREFIX.'_CAIXA'] = NULL;
            // }
            return true;

        } else {
            fgb_console( 'Erro na função global fgb_atualizarusuariologado() que atualiza os dados do usuário logado!', 'ERROGRAVE', 'functions.php', 'ERROGRAVE' );
            // fgb_erro( 'Erro ao atualizar seus dados de acesso, faça login e tente novamente!', 'Erro na função global fgb_atualizarusuariologado() que atualiza os dados do usuário logado!', 'functions.php', 'LOGOUT' );
            // exit;
            return false;
        }
    }

    // Incluir arquivo se existir
    function fgb_incluirarquivo($_diretorio){
    	if (isset($_diretorio)) {
    		include_once $_diretorio;
    	}else{
    		// $_debug, $_toastr='', $_origem=''
    		fgb_console($_diretorio.' não encontrado pela função fgb_incluirarquivo', 'error', 'functions');
    	}
    }

    function fgb_includeconexao(){
        fgb_incluirarquivo('global/controller/conexao/conexao_pdo.php');
        fgb_incluirarquivo('../global/controller/conexao/conexao_pdo.php');
        fgb_incluirarquivo('../../global/controller/conexao/conexao_pdo.php');
        fgb_incluirarquivo('../../../global/controller/conexao/conexao_pdo.php');
    }

    #######################################################################################

    // Buscar no banco informações!
    function get_pwainfo( $pge_id ){
        // include;
        include 'global/controller/conexao/conexao_pdo.php';
        # buscar dados do PWA
        $s_pwainfo =    "SELECT * FROM ".DB_PREFIX."_pwainfo
                        INNER JOIN ".DB_PREFIX."_page ON pge_idpwa = pwa_id
                        WHERE pge_id=:pge_id";        

        try{ 
            $r_pwainfo = $conexao->prepare($s_pwainfo);
            $r_pwainfo->bindValue(':pge_id',    $pge_id);
            $r_pwainfo->execute(); 
            $c_pwainfo = $r_pwainfo->rowCount();

            if ($c_pwainfo==1) {
                // Objeto pwainfo
                $_pwainfo = $r_pwainfo->fetchAll(PDO::FETCH_OBJ)[0];

                // PWA DINAMICO
                $manifest_json = array(
                    # SUPORTE PWA: https://developer.mozilla.org/en-US/docs/Web/Manifest

                    // os mais simples - Ordem alfabética
                        'background_color'              => $_pwainfo->pwa_background_color,
                        'description'                   => $_pwainfo->pwa_description,
                        'dir'                           => $_pwainfo->pwa_dir,
                        'display'                       => $_pwainfo->pwa_display,
                        'lang'                          => $_pwainfo->pwa_lang,
                        'name'                          => $_pwainfo->pwa_name,
                        'orientation'                   => $_pwainfo->pwa_orientation,
                        'scope'                         => $_pwainfo->pwa_scope,
                        'short_name'                    => $_pwainfo->pwa_short_name,
                        'start_url'                     => $_pwainfo->pwa_start_url,
                        'theme_color'                   => $_pwainfo->pwa_theme_color,
                        'url'                           => $_pwainfo->pwa_url,

                    // "categories": ["books", "education", "medical"]
                    // Link: https://github.com/w3c/manifest/wiki/Categories
                    // Info: Array
                    'categories'                        => $_pwainfo->pwa_categories,

                    // Exemplo: "iarc_rating_id": "e84b072d-71b3-4d3e-86ae-31a8ce4e53b7"
                    // Link: https://www.globalratings.com/
                    // Info: Classificação de conteúdo
                    'iarc_rating_id'                    => $_pwainfo->pwa_iarc_rating_id,

                    # Exemplo
                    // "related_applications": [
                        //   {
                        //     "platform": "play",
                        //     "url": "https://play.google.com/store/apps/details?id=com.example.app1",
                        //     "id": "com.example.app1"
                        //   }, {
                        //     "platform": "itunes",
                        //     "url": "https://itunes.apple.com/app/example-app1/id123456789"
                        //   }
                        // ]
                        // Link: https://github.com/w3c/manifest/wiki/Platforms
                        // Array de objeto
                        'related_applications'          => $_pwainfo->pwa_related_applications,

                    // Exemplo: true = torna o pwa um aplicativo preferencial
                    // Info: Depende do related_applications
                    'prefer_related_applications'       => $_pwainfo->pwa_prefer_related_applications,

                    # Exemplo
                    // "shortcuts" : [
                        //   {
                        //     "name": "Today's agenda",
                        //     "url": "/today",
                        //     "description": "List of events planned for today"
                        //   },
                        //   {
                        //     "name": "New event",
                        //     "url": "/create/event"
                        //   }
                        // ]
                        // Info: atalhos ou links para as principais tarefas ou páginas em um aplicativo Web
                        // Array de objeto
                        'shortcuts'                     => $_pwainfo->pwa_shortcuts,

                    # IMAGENS !!!
                        // Exemplo
                        // "icons/screenshots": [
                        //   {
                        //     "src": "icon/lowres.webp",
                        //     "sizes": "48x48",
                        //     "type": "image/webp"
                        //   },
                        //   {
                        //     "src": "icon/lowres",
                        //     "sizes": "48x48"
                        //   }
                        // ]
                        // Array de objeto
                        'icons'                         => $_pwainfo->pwa_icons,
                        'screenshots'                   => $_pwainfo->pwa_screenshots,                    

                    # Serviceworker ! NÃO USAR
                    // 'serviceworker'                 => $_pwainfo->pwa_serviceworker,

                    # Segurança HTTP
                    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
                    'content_security_policy'           => 'upgrade-insecure-request',

                    // true = funcionará offline > chrome
                    'offline_enabled'                   => $_pwainfo->pwa_offline_enabled,

                    # controle de versão
                    'version'                           => $_pwainfo->pwa_version, // 1.0.X
                    'version_name'                      => $_pwainfo->pwa_version_name, // 1.0.X
                    'manifest_version'                  => $_pwainfo->pwa_manifest_version, // 1.0.X
                    
                    // FIXO
                    'author'                            => 'Pedro HSA',
                    'developer'                         => array(
                        'name'                          => 'Pedro HSA',
                        'url'                           => 'https://phsa.com.br'
                    )
                );

                $manifest_json = json_encode($manifest_json);

                echo '<link rel="manifest" href="'.$manifest_json.'">';

            }else{
                fgb_console('Não foi encontrado dados para renderizar o PWA', '', 'get_pagepwainfo()');
            }

        }catch(PDOException $e){
            // função global de redirecionamentp - $_mensagem, $_log, $_origem, $_case=''
            fgb_console( $e, 'ERROGRAVE', 'controledeurl.php', 'ERROGRAVE' );
            var_dump($e);
        };
    }

    // Buscar parametros
    function get_opcoes($opc_nome, $opc_default="NOTFOUND||Parâmetro não encontrado"){
        // include;
        include 'global/controller/conexao/conexao_pdo.php';

        $s_opcoes = "SELECT opc_valor FROM ".DB_PREFIX."_opcoes
                    WHERE `opc_nome`=:opc_nome";
        
        try{ 
            $r_opcoes = $conexao->prepare($s_opcoes);
            $r_opcoes->bindValue(':opc_nome', $opc_nome);
            $r_opcoes->execute();
            $c_opcoes  = $r_opcoes->rowCount();

            if ( $c_opcoes>0 ) {
                return $r_opcoes->fetchAll(PDO::FETCH_OBJ)[0]->opc_valor;
                exit;
            }else{
                return $opc_default; 
                exit;
            }
        }catch(PDOException $e) {                 
            return "ERROGRAVE||Erro na função: ".$e; 
            exit;
        }
    }


?>