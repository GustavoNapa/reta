<!DOCTYPE html>
<html lang="pt-br" prefix="og: http://ogp.me/ns#">
  <head>

    <!-- Comportamento // #FIXO -->
      <meta charset="utf-8"/>
      <meta name="msapplication-tap-highlight" content="no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="author" content="Pedro HSA"/>
      <meta name="robots" content="index, follow, noarchive">
      <meta name="keywords" content="<?=$_paginaatual->pge_keywords?>">
    <!-- fim comportamento -->

    <!-- Buscar dados do PWA -->
      <?php
        get_pwainfo($_paginaatual->pge_id);
      ?>
    <!-- fim PWA -->

    <!-- favIcon padrão -->
      <?php 
        // define diretório do favIcon
        $_favicon = 'page-'.$_paginaatual->pge_diretorio.'/'.$_paginaatual->pge_urlnome.'/media/'.$_paginaatual->pge_favicon;

        if (!file_exists($_favicon)) {
          $_favicon = 'global/media/logo_fp.png';
        }
      ?>
      <link rel="shortcut icon" type="image/x-icon" href="<?=$_favicon?>" />
    <!-- fim favicon padrao -->

    <!-- Buscar dados do OPEN GRAPH -->
      <?php
        // $_opengraph = get_opengraph($_paginaatual->pge_id);
      ?>
        <!-- NÃO FUNCIONA COMPLETAMENTE AINDA!!! -->
        <meta property="og:type" content="website">
        <meta property="og:locale" content="pt_BR">
        <link rel="canonical" href="<?=$og_url?>" />
        <meta property="og:url" content="<?=$og_url?>">
        <meta property="og:site_name" content="<?=$og_site_name?>">
        <meta property="og:title" content="<?=$_paginaatual->pge_title?>">
        <meta property="og:description" content="<?=$_paginaatual->pge_description?>">
        <meta property="og:image" content="<?=$_paginaatual->pge_image_preview?>">
        <meta property="og:image:type" content="image/<?=$_paginaatual->pge_image_type?>">
        <meta property="og:image:alt" content="<?=$_paginaatual->pge_image_alt?>">
        <meta property="og:image:width" content="400">
        <meta property="og:image:height" content="400">
        <meta name="twitter:title" content="<?=$_paginaatual->pge_title?>">
        <meta name="twitter:description" content="<?=$_paginaatual->pge_description?>">
        <meta name="twitter:image" content="<?=$_paginaatual->pge_image_preview?>">
        <meta name="twitter:image:alt" content="<?=$_paginaatual->pge_image_alt?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="<?=$_paginaatual->pge_twitter?>">
    <!-- fim PWA -->

    <!-- Buscar dados do facebook -->
      <?php
        // $_pageapi = get_pageapi($_paginaatual->pge_id);
        // echo $_pageapi;
      ?>
    <!-- fim PWA -->

    <!-- Controle de framework -->
      <?php
        // # Verificar framework - inclui se precisar/existir
        if ( $_paginaatual->pge_framework == 1 ) {
            fgb_incluirarquivo('framework/framework.php'); // ex: boostrap, icones, jquery...
        }
      ?>
    <!-- fim CSS -->

    <!-- TEMA -->
      <?php
        // # Verificar controle de TEMA global - inclui se precisar/existir
        if ( !is_null($_paginaatual->pge_tema) ) {
            // tema com css e js personalizado!
            fgb_incluirarquivo('global/tema/'.$_pagina->pge_tema);
        }
      ?>                    
    <!-- fim TEMA -->

    <!-- Funções -->
      <?php
        // Inclui se existir
        fgb_incluirarquivo('page-sistema/include/functions/functions.php');
      ?>                    
    <!-- fim TEMA -->

    <!-- Titulo e descrição da página -->
      <meta name="description" content="<?=$_paginaatual->pge_description?>"/>
      <title ><?=$_paginaatual->pge_title?></title>
    <!-- fim Titulo e descrição -->
  </head>
  <body>

    <!-- Back -->
    <style type="text/css">
        body{
            min-height:100vh;
            background-repeat: repeat;
            background: url(global/media/17580.jpg) fixed center center;
        background-size: cover;
        }
    </style>

    <!-- Template -->
    <section style="min-height: 100vh;">
      <div id="wrapper" class="d-flex" >
        
        <!-- INCLUDE MENU SIDEBAR -->
        <?php 
          # Menu
          fgb_incluirarquivo('page-'.$_paginaatual->pge_diretorio.'/include/view/'.$_paginaatual->pge_menu);
        ?>

        <!-- INCLUDE CONTEUDO -->
        <div id="page-content-wrapper">

            <!-- INCLUDE MENU -->
            <nav id="menufix" class="navbar navbar-expand-lg navbar-light bg_tema fixed-top wow slideInDown" data-wow-delay="0.5s">
                <button class="btn btn-primary" style="display: none;">Toggle Menu</button>

                <!-- MENU FIXO -->
                <div class="menu_toggle" align="left">
                    <img src="global/media/logo_fp.png" height="50" align="center">
                </div>
                <div class="menu_toggle col justify-content-start text-left">
                    <small class="float-left" >
                        <span><?=$_SESSION[SS_PREFIX.'_SAUDACAO']?></span><br>
                        <span><?=date('d/m/y')?></span>
                    </small>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                      <!-- Ir para o site -->
                        <li class="nav-item nav-admin">
                          <a class="nav-link navbar-text nolink" href="inicio" target="_blank">
                            <i class="icofont-globe"></i>
                            SITE
                          </a>
                        </li>

                        <!-- nav- -->
                        <?php if ( $_paginaatual->pge_urlnome!="admin"): ?>
                          <li class="nav-item nav-admin">
                              <a class="nav-link navbar-text nolink" href="admin">
                                <i class="icofont-chart-histogram"></i>
                                DASHBOARD
                              </a>
                          </li>
                        <?php endif ?>
                        
                        <li class="nav-item nav-admin dropdown ml-1 pl-1" style="border-left: 1px #ccc solid; ">
                            <a id="navbarDropdown" class="navbar-text nolink pl-2 pr-2 dropdown-toggle" data-toggle="dropdown" href="#">
                              <?=$_SESSION[SS_PREFIX.'_USUARIO']->usu_nome?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Perfil</a>
                                <a class="dropdown-item" href="#">Dados de Acesso</a>
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item" onclick='jqr_sair()'>
                                  Sair
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- INCLUDE CONTEUDO PRINCIPAL -->
            <div id="pvn_container" class="container-fluid wow fadeInUp" data-wow-delay="0.5s">
                <div class="clearfix"></div>
                <section class="mt-3" style="background: transparent;">
                  <!-- Conteúdo geral -->
                  <?php
                    # Conteudo
                    fgb_incluirarquivo('page-'.$_paginaatual->pge_diretorio.'/'.$_paginaatual->pge_urlnome.'/view/'.$_paginaatual->pge_urlnome.'.php');
                  ?>
                </section>
                  
            </div>
        </div><!-- /#page-content-wrapper -->
      </div><!-- /#wrapper --> 
    </section>

    <!-- Encolher menu -->
    <a href="#" class="btn bg_tema btn-sm menu_toggle chamar_menu" role="button" title="Clique aqui para encolher o menu"><i class="fas fa-chevron-right faa-horizontal animated"></i></a>

    <!-- SCROLL TO TOP -->
    <a href="#" class="back-to-top nolink"><i class="icofont-swoosh-up"></i></a>

    <!-- Scripts -->
    <script type="text/javascript">
      $(document).ready(function(){ 
            // EFEITO PRE LOADER
            // aguarde(900, 'semfooter');

            // window.onbeforeunload = confirmExit;
            // function confirmExit(){
            //   return "Se você fechar o navegador, seus dados serão perdidos. Desena Realmente sair?";
            // }

            // CONTROLE DO MENU
            setInterval(function(){
              var tamanhoMenu = $('#menufix').height();
              $('.chamar_menu').css('top',tamanhoMenu+12);
              // $('#menuprincipal').css('padding-top',tamanhoMenu);
              $('#pvn_container').css('padding-top',tamanhoMenu+15);
            }, 500);

            // Encolher menu
            $(".menu_toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                // Controle de MENU 
                jqr_alternarmenu();               
            });

            // BTN para encolher menu
            setInterval(function(){ 
                var larguraTela = window.innerWidth;
                if (larguraTela <= 768) {
                    if ($("#wrapper").hasClass('toggled')) {
                        $('.chamar_menu').hide();
                    }else{
                        $('.chamar_menu').fadeIn(1000);
                    }
                }else{
                    if ($("#wrapper").hasClass('toggled')) {
                        $('.chamar_menu').fadeIn(1000);
                    }else{
                        $('.chamar_menu').hide();
                    }
                }                    
            }, 1000);

            // Back to top button
            $(window).scroll(function() {
              if ($(this).scrollTop() > 100) {
                $('.back-to-top').fadeIn('slow');
              } else {
                $('.back-to-top').fadeOut('slow');
              }
            });

            $('.back-to-top').click(function() {
              $('html, body').animate({
                scrollTop: 0
              }, 1500, 'easeInOutExpo');
              return false;
            });
      }); // fim do ready

      // Functions javascript
      function jqr_sair() {
        swal({
          title: "",
          text: "Deseja sair do sistema?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((btn_sair) => {
          if (btn_sair) {
            window.location.replace('login?logout=true');
          }
        });
      }

      // controle de menu
      function jqr_alternarmenu() {
        $.ajax({
          url:    'page-site/login/controller/login.php',
          type:   'POST',
          data:   'acao=alternarmenu',
          success: function(retorno){
              console.log(retorno);
          } // fim da function
        }); // fim do ajax
      }

    </script>
  </body>
</html>