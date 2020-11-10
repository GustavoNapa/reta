<!-- Documento HTML Desenvolvido por: Pedro HSA -->

<!-- Sidebar -->
<div id="sidebar-wrapper" class="bg_tema wow slideInLeft" data-wow-delay="0.5s" style="border-right: solid 1px rgba(105, 0, 145, 0.5)!important;">

   <!-- Saudacao no menu -->
   <div class="list-group list-group-flush text-dark mb-5" align="left">
      <!-- NAO APAGUE ISSO -->
   </div>
   <div class="clearfix"></div>      

    <!-- BLOCO ACORCION -->
    <div id="menuprincipal" class="accordion list-group list-group-flush text-left upper mt-4" style="position: fixed;">

      <!-- IMG-PERFIL -->
      <a href="#" hidden class="list-group-item list-group-item-action text-dark border-0 pt-5 mt-5 nolink_perfil">
         <center hidden>
            <div class="img_perfil nolink_perfil">
               <?php // echo '<img class="nolink_perfil" src="global/media/semimagem.jpg">'; ?> 
               <h6 class="pt-2 pb-0 mb-0"><?=$_SESSION[SS_PREFIX.'_USUARIO']->usu_nome?></h6>
               <span><small><?=$_SESSION[SS_PREFIX.'_NIVELACESSO']->nva_nome?></small></span>
            </div>
         </center>            
      </a>

      <!-- MENU LATERAL -->
         <a class="list-group-item list-group-item-action bg-light text-dark upper text_menu">
            <i class="far fa-building"></i>&nbsp;&nbsp;EMPRESA
         </a>

         <a href="cadastrobasico" class="list-group-item list-group-item-action bg-light text-dark upper text_menu">
            <i class="fas fa-tools"></i>&nbsp;&nbsp;CADASTRO BÁSICO
         </a>

         <a data-target="#site" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-laptop-code"></i>&nbsp;&nbsp;SITE ACB
            <span class="float-right"><i class="fa fa-angle-down"></i></span>
         </a>
            <div id="site" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
               <a href="site" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-file-code"></i>
                  &nbsp;Arquivos
               </a>
               <a href="site" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-code-branch"></i>
                  &nbsp;Detalhes
               </a>
               <a href="site" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-spell-check"></i>
                  &nbsp;Textos
               </a>
               <a href="site" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-camera-retro"></i>
                  &nbsp;Imagens
               </a>
            </div>

         <a data-target="#produto" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-box-open"></i>&nbsp;&nbsp;CONTROLE DE ESTOQUE
            <span class="float-right"><i class="fa fa-angle-down"></i></span>
         </a>
            <div id="produto" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
               <a href="produto?view=formproduto" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-plus-square"></i>
                  &nbsp;Cadastrar produto
               </a>
               <a href="produto" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-search"></i>
                  &nbsp;Pesquisar
               </a>
            </div>

         <a data-target="#cliente" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
            <i class="far fa-user"></i>&nbsp;&nbsp;CONTROLE DE CLIENTE
            <span class="float-right"><i class="fa fa-angle-down"></i></span>
         </a>
            <div id="cliente" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
               <a href="cliente?view=formcliente" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-user-check"></i>
                  &nbsp;Editar cliente
               </a>
               <a href="cliente" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-search"></i>
                  &nbsp;Pesquisar
               </a>
            </div>

         <a data-target="#usuario" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-user-cog"></i>&nbsp;&nbsp;CONTROLE DE USUÁRIO
            <span class="float-right"><i class="fa fa-angle-down"></i></span>
         </a>
            <div id="usuario" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse">
               <a href="usuario?view=formusuario" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-user-lock"></i>
                  &nbsp;Gerenciar usuários
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

         <a data-target="#loja" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-store"></i>&nbsp;&nbsp;LOJAS ACB
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
               <a href="loja?view=formregiao" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="icofont-google-map"></i>
                  &nbsp;Cadastro de bairros
               </a>
            </div>

         <a class="list-group-item list-group-item-action bg-light text-dark upper text_menu">
            <i class="fas fa-cash-register"></i>&nbsp;&nbsp;FLUXO DE CAIXA
         </a>

         <a data-target="#financeiro" href="#" class="list-group-item list-group-item-action bg-light text-dark upper text_menu" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-balance-scale"></i>&nbsp;&nbsp;CONTROLE FINANCEIRO
            <span class="float-right"><i class="fa fa-angle-down"></i></span>
         </a>
            <div id="financeiro" data-parent="#menuprincipal" class="list-group list-group-flush text-left collapse" style="">
               <a href="financeiro?view=formfinanceiro" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-hand-holding-usd"></i>
                  &nbsp;Centro de custo
               </a>
               <a href="financeiro" class="list-group-item list-group-item-action text-left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <i class="fas fa-search"></i>
                  &nbsp;Pesquisar movimento
               </a>
            </div>

         <a class="list-group-item list-group-item-action bg-light text-dark upper text_menu">
            <i class="fas fa-info-circle"></i>&nbsp;&nbsp;CONFIGURAÇÕES
         </a>

         <a class="list-group-item list-group-item-action bg-light text-dark upper text_menu menu_toggle">
            <i class="fas fa-chevron-left faa-horizontal animated"></i>
            &nbsp;ENCOLHER MENU
         </a>
   </div>
   <div class="clearfix"></div>
</div> <!-- /#sidebar-wrapper -->