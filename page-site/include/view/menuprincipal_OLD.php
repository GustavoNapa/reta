



  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- <h1 class="logo"><a href="inicio"></a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="#" class="logo" onclick="$('.back-to-top').click()">
        <?php if ( $_SESSION[SS_PREFIX.'_PAGINA']->pge_urlnome=="creampurple" ): ?>
          <img src="global/media/logo_cp.png" class="img-fluid">
        <?php else: ?>
          <img src="global/media/logo_acb.png" class="img-fluid">
        <?php endif ?>
      </a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="inicio#hero">Inicio</a></li>
          <li><a href="inicio#about">Sobre</a></li>
          <li><a href="inicio#team">Produtos</a></li>
          <!-- <li><a href="#portfolio">Portfolio</a></li> -->
          <!-- <li><a href="#team">Team</a></li> -->
          <!-- <li class="drop-down"><a href="">Nossas lojas</a>
            <ul>
              <li class="drop-down"><a href="#">Belo Horizonte</a>
                <ul>
                  <li><a href="#">Centro</a></li>
                  <li><a href="#">Barreiro</a></li>
                </ul>
              </li>
              <li><a href="#">Contagem</a></li>
              <li><a href="#">Ibirité</a></li>
            </ul>
          </li> -->
          <li class="drop-down"><a href="">Para você</a>
            <ul>
              <li><a href="inicio#contact">Conheça nossas lojas</a></li>
              <li><a hidden href="creampurple?iam=franqueado#">Seja um franqueado</a></li>
              <li><a href="creampurple?iam=revendedor#">Seja um revendedor</a></li>
              <li><a href="creampurple?#">Conheça nossa fábrica</a></li>
            </ul>
          </li>
          <!-- <li><a href="creampurple">Seja um revendedor</a></li> -->
          <li><a href="inicio#contact">Contato</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <a href="https://deliveryapp.neemo.com.br/franquia/acai-com-bobagens" target="_blank" class="get-started-btn">Compre agora!</a>

    </div>
  </header><!-- End Header -->