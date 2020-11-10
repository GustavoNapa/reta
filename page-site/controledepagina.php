<!DOCTYPE html>
<html lang="pt-br" prefix="og: http://ogp.me/ns#">
  <head>

    <!-- Comportamento // #FIXO -->
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="author" content="Pedro HSA"/>
      <meta name="robots" content="index, follow, noarchive">
      <meta name="keywords" content="<?=$_paginaatual->pge_keywords?>">
      <meta name="revisit-after" content="1 day">
      <meta name="language" content="Portuguese">
      <meta name="generator" content="phsa.com.br">
    <!-- fim comportamento -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3RTP4R2GT"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-Y3RTP4R2GT');
      </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <!-- Buscar dados do PWA -->
      <?php
        get_pwainfo($_paginaatual->pge_id);
      ?>
    <!-- fim PWA -->

    <!-- favIcon padrão -->
      <?php 
        // define diretório do favIcon
        $_favicon = 'global/media/'.$_paginaatual->pge_favicon;

        if (!file_exists($_favicon)) {
          $_favicon = 'global/media/favicon.ico';
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
        <link rel="canonical" href="<?=$_URL_COMPLETA?>" />
        <meta property="og:url" content="<?=$_URL_COMPLETA?>">
        <meta property="og:site_name" content="<?=$_paginaatual->pge_title?>">
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
    <!-- fim _opengraph -->

    <!-- Buscar dados do facebook -->
      <?php
        // $_pageapi = get_pageapi($_paginaatual->pge_id);
        // echo $_pageapi;
      ?>
    <!-- fim facebook -->

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

    <!-- Titulo e descrição da página -->
      <meta name="description" content="<?=$_paginaatual->pge_description?>"/>
      <title><?=$_paginaatual->pge_title?></title>
    <!-- fim Titulo e descrição -->

    <?php $_SESSION[SS_PREFIX.'_PAGINA'] = $_paginaatual; ?>

  </head>
  <body>
    <!-- Conteúdo geral -->
    <?php
      // Inclui se existir
        # Menu
        fgb_incluirarquivo('page-'.$_paginaatual->pge_diretorio.'/include/view/'.$_paginaatual->pge_menu);
        # Conteudo
        fgb_incluirarquivo('page-'.$_paginaatual->pge_diretorio.'/'.$_paginaatual->pge_urlnome.'/view/'.$_paginaatual->pge_urlnome.'.php');
        # Rodapé
        fgb_incluirarquivo('page-'.$_paginaatual->pge_diretorio.'/include/view/'.$_paginaatual->pge_rodape);
    ?>


    <a href="#" class="back-to-top nolink"><i class="icofont-swoosh-up"></i></a>

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <div id="preloader" class="text-center justify-content-center" align="center">
      <img class="p-3" src="global/media/logo_acb.gif" style="max-width: 300px;">
    </div>

  </body>
</html>

<script type="text/javascript">
  /**
  * Template Name: Gp - v2.1.0
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  */
  !(function($) {
    "use strict";

    // Preloader
    $(window).on('load', function() {
      if ($('#preloader').length) {
        $('#preloader').delay(1000).fadeOut('slow', function() {
          $(this).remove();
        });
      }
    });

    // Smooth scroll for the navigation menu and links with .scrollto classes
    var scrolltoOffset = $('#header').outerHeight() - 2;
    $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        e.preventDefault();
        var target = $(this.hash);
        if (target.length) {

          var scrollto = target.offset().top - scrolltoOffset;

          if ($(this).attr("href") == '#header') {
            scrollto = 0;
          }

          $('html, body').animate({
            scrollTop: scrollto
          }, 1500, 'easeInOutExpo');

          if ($(this).parents('.nav-menu, .mobile-nav').length) {
            $('.nav-menu .active, .mobile-nav .active').removeClass('active');
            $(this).closest('li').addClass('active');
          }

          if ($('body').hasClass('mobile-nav-active')) {
            $('body').removeClass('mobile-nav-active');
            $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
            $('.mobile-nav-overly').fadeOut();
          }
          return false;
        }
      }
    });

    // Activate smooth scroll on page load with hash links in the url
    $(document).ready(function() {
      if (window.location.hash) {
        var initial_nav = window.location.hash;
        if ($(initial_nav).length) {
          var scrollto = $(initial_nav).offset().top - scrolltoOffset;
          $('html, body').animate({
            scrollTop: scrollto
          }, 1500, 'easeInOutExpo');
        }
      }
    });

    // Mobile Navigation
    if ($('.nav-menu').length) {
      var $mobile_nav = $('.nav-menu').clone().prop({
        class: 'mobile-nav d-lg-none'
      });
      $('body').append($mobile_nav);
      $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
      $('body').append('<div class="mobile-nav-overly"></div>');

      $(document).on('click', '.mobile-nav-toggle', function(e) {
        $('body').toggleClass('mobile-nav-active');
        $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
        $('.mobile-nav-overly').toggle();
      });

      $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
        e.preventDefault();
        $(this).next().slideToggle(300);
        $(this).parent().toggleClass('active');
      });

      $(document).click(function(e) {
        var container = $(".mobile-nav, .mobile-nav-toggle");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
          if ($('body').hasClass('mobile-nav-active')) {
            $('body').removeClass('mobile-nav-active');
            $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
            $('.mobile-nav-overly').fadeOut();
          }
        }
      });
    } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
      $(".mobile-nav, .mobile-nav-toggle").hide();
    }

    // Navigation active state on scroll
    var nav_sections = $('section');
    var main_nav = $('.nav-menu, #mobile-nav');

    $(window).on('scroll', function() {
      var cur_pos = $(this).scrollTop() + 200;

      nav_sections.each(function() {
        var top = $(this).offset().top,
          bottom = top + $(this).outerHeight();

        if (cur_pos >= top && cur_pos <= bottom) {
          if (cur_pos <= bottom) {
            main_nav.find('li').removeClass('active');
          }
          main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
        }
        if (cur_pos < 300) {
          $(".nav-menu ul:first li:first").addClass('active');
        }
      });
    });

    // Toggle .header-scrolled class to #header when page is scrolled
    $(window).scroll(function() {
      if ($(this).scrollTop() > 100) {
        $('#header').addClass('header-scrolled');
      } else {
        $('#header').removeClass('header-scrolled');
      }
    });

    if ($(window).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    }

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

    // Clients carousel (uses the Owl Carousel library)
    $(".clients-carousel").owlCarousel({
      autoplay: true,
      dots: true,
      loop: true,
      responsive: {
        0: {
          items: 2
        },
        768: {
          items: 4
        },
        900: {
          items: 6
        }
      }
    });

    // Porfolio isotope and filter
    $(window).on('load', function() {
      var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item'
      });

      $('#portfolio-flters li').on('click', function() {
        $("#portfolio-flters li").removeClass('filter-active');
        $(this).addClass('filter-active');

        portfolioIsotope.isotope({
          filter: $(this).data('filter')
        });
        aos_init();
      });

      // Initiate venobox (lightbox feature used in portofilo)
      $(document).ready(function() {
        $('.venobox').venobox({
          'share': false
        });
      });
    });

    // jQuery counterUp
    $('[data-toggle="counter-up"]').counterUp({
      delay: 10,
      time: 1000
    });

    // Testimonials carousel (uses the Owl Carousel library)
    $(".testimonials-carousel").owlCarousel({
      autoplay: true,
      dots: true,
      loop: true,
      items: 1
    });

    // Portfolio details carousel
    $(".portfolio-details-carousel").owlCarousel({
      autoplay: true,
      dots: true,
      loop: true,
      items: 1
    });

    // Init AOS
    function aos_init() {
      AOS.init({
        duration: 1000,
        once: true
      });
    }
    $(window).on('load', function() {
      aos_init();
    });

  })(jQuery);
</script>