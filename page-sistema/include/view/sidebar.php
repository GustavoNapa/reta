<!-- Documento HTML Desenvolvido por: Pedro HSA -->

<!-- Sidebar -->
<div id="sidebar-wrapper" class="bg_tema wow slideInLeft" data-wow-delay="0.5s">

   <!-- Saudacao no menu -->
   <div class="list-group list-group-flush text-dark mb-5" align="left">
      <!-- NAO APAGUE ISSO -->
   </div>

    <!-- BLOCO ACORCION -->
    <div id="menuprincipal" class="accordion list-group list-group-flush text-left upper mt-3" style="position: fixed;">

      <!-- IMG-PERFIL -->
      <a href="#" hidden class="list-group-item list-group-item-action text-dark border-0 pt-5 mt-5 nolink_perfil">
         <center hidden>
            <div class="img_perfil nolink_perfil">
               <h6 class="pt-2 pb-0 mb-0"><?=$_SESSION[SS_PREFIX.'_USUARIO']->usu_nome?></h6>
               <span><small><?=$_SESSION[SS_PREFIX.'_USUARIO']->nva_nome?></small></span>
            </div>
         </center>            
      </a>

      <!-- MENU LATERAL -->
         <a class="list-grou pl-4 pb-2 list-group-item-action bg-light text-dark upper text_menu" style="border-bottom: 1px solid #ccc">
            <h6 class="pt-2 pb-0 mb-0"><?=$_SESSION[SS_PREFIX.'_USUARIO']->usu_nome?></h6>
            <span><small><?=$_SESSION[SS_PREFIX.'_USUARIO']->nva_nome?></small></span>
         </a>

         <?php if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarbasico==1 ): ?>
            <a href="cadastrobasico" class="list-group-item list-group-item-action bg-light text-dark upper text_menu">
               <i class="fas fa-tools"></i>&nbsp;&nbsp;CADASTRO BÁSICO
            </a>
         <?php endif ?>

         <?php if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja==1 ): ?>
            <!-- <a data-target="#loja" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
               <i class="fas fa-store"></i>&nbsp;&nbsp;LOJAS RTV
               <span class="float-right"><i class="fa fa-angle-down"></i></span>
            </a>
               <div id="loja" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
                  <a href="loja?view=formloja" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="far fa-plus-square"></i>
                     &nbsp;Nova loja
                  </a>
                  <a href="loja" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-search"></i>
                     &nbsp;Pesquisar
                  </a>
                  <a href="loja?view=formbairro" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="icofont-google-map"></i>
                     &nbsp;Cadastro de regiões
                  </a>
               </div> -->
         <?php endif ?>

         <?php if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarproduto==1 ): ?>
            <a data-target="#produto" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
               <i class="fas fa-box-open"></i>&nbsp;&nbsp;PRODUTO
               <span class="float-right"><i class="fa fa-angle-down"></i></span>
            </a>
               <div id="produto" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
                  <a href="produto?view=formproduto" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="far fa-plus-square"></i>
                     &nbsp;Novo produto
                  </a>
                  <a href="produto" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-search"></i>
                     &nbsp;Pesquisar
                  </a>
               </div>
         <?php endif ?>

         <?php if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarusuario==1 ): ?>
            <a data-target="#usuario" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
               <i class="fas fa-user-cog"></i>&nbsp;&nbsp;CONTROLE DE USUÁRIO
               <span class="float-right"><i class="fa fa-angle-down"></i></span>
            </a>
               <div id="usuario" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse">
                  <a href="usuario?view=formusuario" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-user-lock"></i>
                     &nbsp;Novo usuário
                  </a>
                  <a href="usuario" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-search"></i>
                     &nbsp;Pesquisar
                  </a>
                  <a href="usuario?view=nivelacesso" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-shield-alt"></i>
                     &nbsp;Niveís de acesso
                  </a>
               </div>
         <?php endif ?>

         <?php if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarconfiguracoes==1 ): ?>
            <a data-target="#configuracoes" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
               <i class="fas fa-laptop-code"></i>&nbsp;&nbsp;CONFIGURAÇÕES
               <span class="float-right"><i class="fa fa-angle-down"></i></span>
            </a>
               <div id="configuracoes" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
                  <a href="configuracoes?view=imagens" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-camera-retro"></i>
                     &nbsp;Imagens
                  </a>
                  <a href="configuracoes?view=textosite" class="list-group-item list-group-item-action text-left">
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="fas fa-spell-check"></i>
                     &nbsp;Texto site
                  </a>
               </div>
         <?php endif ?>

         <a class="list-group-item list-group-item-action bg-light text-dark upper text_menu menu_toggle">
            <i class="fas fa-chevron-left faa-horizontal animated"></i>
            &nbsp;ENCOLHER MENU
         </a>
   </div>
   <div class="clearfix"></div>
</div> <!-- /#sidebar-wrapper -->