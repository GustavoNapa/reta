



<!-- https://bootsnipp.com/snippets/xb1bN -->
<style type="text/css">

  /* GLOBAL */
  .nolink{
    text-decoration: none!important;
    cursor: pointer!important;
  }
  .btn-acb{
    background: rgba(91, 46, 129, 0.97);
    color: #fff;
    transition: all 0.7s;
  }

  .btn-acb:hover{
    transition: all 0.7s;
    background: rgba(255, 255, 255, 0.7);
    color: rgba(91, 46, 129, 1);
  }

  .card_nossaslojas{
      flex: 0 0 40%!important;
      max-width: 25rem!important;
      margin: 2px 0.5rem!important;
      padding: 2px 0.5rem!important;
    }

  /*--------------------------------------------------------------
  # Back to top button
  --------------------------------------------------------------*/
    .back-to-top {
      position: fixed;
      display: none;
      right: 15px;
      bottom: 15px;
      z-index: 99999;
    }

    .back-to-top i {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      width: 40px;
      height: 40px;
      border-radius: 4px;
      background: #7cfc00;
      color: #fff;
      transition: all 0.4s;
    }

    .back-to-top i:hover {
      background: rgba(91, 46, 129, 0.9);
      color: #fff;
    }

  /*--------------------------------------------------------------
  # Preloader
  --------------------------------------------------------------*/
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999;
      overflow: hidden;
      background: rgba(91, 46, 129, 0.9);
    }

  /* ----------------------------------------------------------------
  # RESPONSIVE
  ----------------------------------------------------------------*/
  /* Dispositivos extras pequenos (telefones, 480px e down) */
  @media only screen and (max-width: 480px) {
    #preloader img{
      margin-top: 65%;
    }
  } 

  /* Pequenos dispositivos (telefones medios, 480px e até) */
  @media only screen and (min-width: 480px) {
    #preloader img{
      margin-top: 45%;
    }
  }

  /* Pequenos dispositivos (tablets retrato e telefones grandes, 600px e até) */
  @media only screen and (min-width: 600px) {
    #preloader img{
      margin-top: 30%;
    }
  } 

  /* Dispositivos médios (tablets de paisagem, 768 px e acima) */
  @media only screen and (min-width: 768px) {
    #preloader img{
      margin-top: 40%;
    }
  } 

  /* Grandes dispositivos (laptops / desktops, 992px e acima) */
  @media only screen and (min-width: 992px) {
    #preloader img{
      margin-top: 32%;
    }
  } 

  /* Dispositivos extra grandes (grandes laptops e desktops, 1200px e acima) */
  @media only screen and (min-width: 1200px) {
    #preloader img{
      margin-top: 32%;
    }
  }

  /* Dispositivos hiper grandes (grandes mointores, 1200px e acima) */
  @media only screen and (min-width: 1500px) {
    #preloader img{
      margin-top: 35%;
    }
  }

  /*--------------------------------------------------------------
  # Disable aos animation delay on mobile devices
  --------------------------------------------------------------*/
    @media screen and (max-width: 768px) {
      [data-aos-delay] {
        transition-delay: 0 !important;
      }
    }

  /*--------------------------------------------------------------
  # Header
  --------------------------------------------------------------*/
    #header {
      transition: all 0.5s;
      z-index: 997;
      padding: 15px 0;
    }

    #header.header-scrolled, #header.header-inner-pages {
      background: rgba(91, 46, 129, 0.97);
    }

    #header .logo {
      font-size: 32px;
      margin: 0;
      padding: 0;
      line-height: 1;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    #header .logo a {
      color: #fff;
    }

    #header .logo a span {
      color: #7cfc00;
    }

    #header .logo img {
      max-height: 40px;
    }

  /*--------------------------------------------------------------
  # Navigation Menu
  --------------------------------------------------------------*/
  /* Desktop Navigation */
    .nav-menu ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .nav-menu > ul {
      display: flex;
    }

    .nav-menu > ul > li {
      position: relative;
      white-space: nowrap;
      padding: 10px 0 10px 28px;
    }

    .nav-menu a {
      display: block;
      position: relative;
      color: #fff;
      transition: 0.3s;
      font-size: 15px;
      font-family: "Open Sans", sans-serif;
      font-weight: 600;
      text-decoration: none!important;
      cursor: pointer!important;
    }

    .nav-menu a:hover, .nav-menu .active > a, .nav-menu li:hover > a {
      color: #7cfc00;
    }

    .nav-menu .drop-down ul {
      display: block;
      position: absolute;
      left: 14px;
      top: calc(100% + 30px);
      z-index: 99;
      opacity: 0;
      visibility: hidden;
      padding: 0;
      background: #fff;
      box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
      transition: 0.3s;
    }

    .nav-menu .drop-down:hover > ul {
      opacity: 1;
      top: 100%;
      visibility: visible;
    }

    .nav-menu .drop-down li {
      min-width: 180px;
      position: relative;
    }

    .nav-menu .drop-down ul a {
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none!important;
      cursor: pointer!important;
      color: #151515;
    }

    .nav-menu .drop-down ul a:hover, .nav-menu .drop-down ul .active > a, .nav-menu .drop-down ul li:hover > a {
      color: #fff;
      background: #7cfc00;
    }

    .nav-menu .drop-down > a:after {
      content: "\ea99";
      font-family: IcoFont;
      padding-left: 5px;
    }

    .nav-menu .drop-down .drop-down ul {
      top: 0;
      left: calc(100% - 30px);
    }

    .nav-menu .drop-down .drop-down:hover > ul {
      opacity: 1;
      top: 0;
      left: 100%;
    }

    .nav-menu .drop-down .drop-down > a {
      padding-right: 35px;
    }

    .nav-menu .drop-down .drop-down > a:after {
      content: "\eaa0";
      font-family: IcoFont;
      position: absolute;
      right: 15px;
    }

    @media (max-width: 1366px) {
      .nav-menu .drop-down .drop-down ul {
        left: -90%;
      }
      .nav-menu .drop-down .drop-down:hover > ul {
        left: -100%;
      }
      .nav-menu .drop-down .drop-down > a:after {
        content: "\ea9d";
      }
    }

  /* Get Startet Button */
    .get-started-btn {
      color: #fff;
      border-radius: 7px;
      padding: 7px 25px 8px 25px;
      white-space: nowrap;
      transition: 0.3s;
      font-size: 14px;
      display: inline-block;
      border: 2px solid #7cfc00;
      text-decoration: none!important;
      cursor: pointer!important;
    }

    .get-started-btn:hover {
      background: #7cfc00;
      border: 2px solid #fff;
      color: #5b2e81;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .get-started-btn {
        margin: 0 48px 0 0;
        padding: 7px 20px 8px 20px;
      }
    }

  /* Mobile Navigation */
    .mobile-nav-toggle {
      position: fixed;
      top: 20px;
      right: 15px;
      z-index: 9998;
      border: 0;
      background: none;
      font-size: 24px;
      transition: all 0.4s;
      outline: none !important;
      line-height: 1;
      cursor: pointer;
      text-align: right;
    }

    .mobile-nav-toggle i {
      color: #fff;
    }

    .mobile-nav {
      position: fixed;
      top: 55px;
      right: 15px;
      bottom: 15px;
      left: 15px;
      z-index: 9999;
      overflow-y: auto;
      background: #fff;
      transition: ease-in-out 0.2s;
      opacity: 0;
      visibility: hidden;
      border-radius: 10px;
      padding: 10px 0;
    }

    .mobile-nav * {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .mobile-nav a {
      display: block;
      position: relative;
      color: #151515;
      padding: 10px 20px;
      font-weight: 500;
      outline: none;
    }

    .mobile-nav a:hover, .mobile-nav .active > a, .mobile-nav li:hover > a {
      color: #fff;
      text-decoration: none;
      background: #7cfc00;
    }

    .mobile-nav .drop-down > a:after {
      content: "\ea99";
      font-family: IcoFont;
      padding-left: 10px;
      position: absolute;
      right: 15px;
    }

    .mobile-nav .active.drop-down > a:after {
      content: "\eaa1";
    }

    .mobile-nav .drop-down > a {
      padding-right: 35px;
    }

    .mobile-nav .drop-down ul {
      display: none;
      overflow: hidden;
    }

    .mobile-nav .drop-down li {
      padding-left: 20px;
    }

    .mobile-nav-overly {
      width: 100%;
      height: 100%;
      z-index: 9997;
      top: 0;
      left: 0;
      position: fixed;
      background: rgba(20, 0, 25, 0.6);
      overflow: hidden;
      display: none;
      transition: ease-in-out 0.2s;
    }

    .mobile-nav-active {
      overflow: hidden;
    }

    .mobile-nav-active .mobile-nav {
      opacity: 1;
      visibility: visible;
    }

    .mobile-nav-active .mobile-nav-toggle i {
      color: #fff;
    }

  /*--------------------------------------------------------------
  # Hero Section
  --------------------------------------------------------------*/
    #hero {
      width: 100%;
      height: 100vh;
      background: url("page-site/inicio/media/loja_acb2.jpg") top center;
      background-size: cover;
      position: relative;
    }

    #hero:before {
      content: "";
      background: rgba(20, 0, 25, 0.6);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }

    #hero .container {
      position: relative;
      padding-top: 74px;
      text-align: center;
    }

    #hero h1 {
      margin: 0;
      font-size: 56px;
      font-weight: 700;
      line-height: 64px;
      color: #fff;
      font-family: "Poppins", sans-serif;
    }

    #hero h1 span {
      color: #7cfc00;
    }

    #hero h2 {
      color: rgba(255, 255, 255, 0.9);
      margin: 10px 0 0 0;
      font-size: 24px;
    }

    #hero .icon-box {
      padding: 30px 20px;
      transition: ease-in-out 0.3s;
      border: 1px solid rgba(255, 255, 255, 0.3);
      height: 100%;
      text-align: center;
      background: rgba(255, 255, 255, 0.3);
    }

    #hero .icon-box i {
      font-size: 32px;
      line-height: 1;
      color: #7cfc00;
    }

    #hero .icon-box h3 {
      font-weight: 700;
      margin: 10px 0 0 0;
      padding: 0;
      line-height: 1;
      font-size: 20px;
      line-height: 26px;
    }

    #hero .icon-box h3 a {
      color: #fff;
      transition: ease-in-out 0.3s;
      text-decoration: none!important;
      cursor: pointer!important;
    }

    #hero .icon-box h3 a:hover {
      color: #7cfc00;
    }

    #hero .icon-box:hover {
      border-color: #7cfc00;
    }

    @media (min-width: 1024px) {
      #hero {
        background-attachment: fixed;
      }
    }

    @media (max-width: 768px) {
      #hero {
        height: auto;
      }
      #hero h1 {
        font-size: 28px;
        line-height: 36px;
      }
      #hero h2 {
        font-size: 20px;
        line-height: 24px;
      }
    }

  /*--------------------------------------------------------------
  # Sections General
  --------------------------------------------------------------*/
    section {
      padding: 60px 0;
      overflow: hidden;
    }

    .section-title {
      padding-bottom: 40px;
    }

    .section-title h2 {
      font-size: 14px;
      font-weight: 500;
      padding: 0;
      line-height: 1px;
      margin: 0 0 5px 0;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #aaaaaa;
      font-family: "Poppins", sans-serif;
    }

    .section-title h2::after {
      content: "";
      width: 120px;
      height: 1px;
      display: inline-block;
      background: #ffde9e;
      margin: 4px 10px;
    }

    .section-title p {
      margin: 0;
      margin: 0;
      font-size: 36px;
      font-weight: 700;
      text-transform: uppercase;
      font-family: "Poppins", sans-serif;
      color: #151515;
    }

  /*--------------------------------------------------------------
  # About
  --------------------------------------------------------------*/
    .about .content h3 {
      font-weight: 700;
      font-size: 28px;
      font-family: "Poppins", sans-serif;
    }

    .about .content ul {
      list-style: none;
      padding: 0;
    }

    .about .content ul li {
      padding: 0 0 8px 26px;
      position: relative;
    }

    .about .content ul i {
      position: absolute;
      font-size: 20px;
      left: 0;
      top: -3px;
      color: #7cfc00;
    }

    .about .content p:last-child {
      margin-bottom: 0;
    }

  /*--------------------------------------------------------------
  # Clients
  --------------------------------------------------------------*/
    .clients {
      padding-top: 20px;
    }

    .clients .owl-item {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0 20px;
    }

    .clients .owl-item img {
      width: 70%;
      opacity: 0.5;
      transition: 0.3s;
      -webkit-filter: grayscale(100);
      filter: grayscale(100);
    }

    .clients .owl-item img:hover {
      -webkit-filter: none;
      filter: none;
      opacity: 1;
    }

    .clients .owl-nav, .clients .owl-dots {
      margin-top: 5px;
      text-align: center;
    }

    .clients .owl-dot {
      display: inline-block;
      margin: 0 5px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #ddd !important;
    }

    .clients .owl-dot.active {
      background-color: #7cfc00 !important;
    }

  /*--------------------------------------------------------------
  # Features
  --------------------------------------------------------------*/
    .features {
      padding-top: 20px;
    }

    .features .icon-box {
      padding-left: 15px;
    }

    .features .icon-box h4 {
      font-size: 20px;
      font-weight: 700;
      margin: 5px 7px 10px 60px;
      padding-top: 7px!important;
    }

    .features .icon-box i {
      font-size: 48px;
      float: left;
      color: #7cfc00;
    }

    .features .icon-box p {
      font-size: 15px;
      color: #848484;
      margin-left: 67px;
    }

    .features .image {
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
      min-height: 400px;
    }

  /*--------------------------------------------------------------
  # Services
  --------------------------------------------------------------*/
    .services .icon-box {
      text-align: center;
      border: 1px solid #ebebeb;
      padding: 20px 20px;
      transition: all ease-in-out 0.3s;
      background: #fff;
    }

    .services .container ul {
      list-style: none;
      padding: 0;
    }

    .services .icon-box .icon {
      margin: 0 auto;
      width: 64px;
      height: 64px;
      background: #7cfc00;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      transition: 0.3s;
    }

    .services .icon-box .icon i {
      color: #fff;
      font-size: 28px;
      transition: ease-in-out 0.3s;
    }

    .services .icon-box h4 {
      font-weight: 700;
      margin-bottom: 15px;
      font-size: 24px;
    }

    .services .icon-box h4 a {
      color: #151515;
      transition: ease-in-out 0.3s;
    }

    .services .icon-box h4 a:hover {
      color: #7cfc00;
    }

    .services .icon-box p {
      line-height: 24px;
      font-size: 14px;
      margin-bottom: 0;
    }

    .services .icon-box:hover {
      border-color: #fff;
      box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
      transform: translateY(-10px);
    }

  /*--------------------------------------------------------------
  # Cta
  --------------------------------------------------------------*/
    .cta {
      background: 
        linear-gradient(rgba(2, 2, 2, 0.5), 
        rgba(0, 0, 0, 0.5)),
        url("page-site/creampurple/media/fundoroxo.png") fixed center center;
      background-size: cover;
      padding: 60px 0;
    }

    .cta h3 {
      color: #fff;
      font-size: 28px;
      font-weight: 700;
    }

    .cta p {
      color: #fff;
    }

    .cta .cta-btn {
      font-family: "Raleway", sans-serif;
      font-weight: 600;
      font-size: 16px;
      letter-spacing: 1px;
      display: inline-block;
      padding: 8px 28px;
      border-radius: 4px;
      transition: 0.5s;
      margin-top: 10px;
      border: 2px solid #fff;
      color: #fff;
    }

    .cta .cta-btn:hover {
      background: #7cfc00;
      border-color: #7cfc00;
      color: #151515;
    }

  /*--------------------------------------------------------------
  # Portfolio
  --------------------------------------------------------------*/
    .portfolio .portfolio-item {
      margin-bottom: 30px;
    }

    .portfolio #portfolio-flters {
      padding: 0;
      margin: 0 auto 20px auto;
      list-style: none;
      text-align: center;
    }

    .portfolio #portfolio-flters li {
      cursor: pointer;
      display: inline-block;
      padding: 8px 15px 10px 15px;
      font-size: 14px;
      font-weight: 600;
      line-height: 1;
      text-transform: uppercase;
      color: #444444;
      margin-bottom: 5px;
      transition: all 0.3s ease-in-out;
      border-radius: 3px;
    }

    .portfolio #portfolio-flters li:hover, .portfolio #portfolio-flters li.filter-active {
      color: #151515;
      background: #7cfc00;
    }

    .portfolio #portfolio-flters li:last-child {
      margin-right: 0;
    }

    .portfolio .portfolio-wrap {
      transition: 0.3s;
      position: relative;
      overflow: hidden;
      z-index: 1;
      background: rgba(21, 21, 21, 0.6);
    }

    .portfolio .portfolio-wrap::before {
      content: "";
      background: rgba(21, 21, 21, 0.6);
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      transition: all ease-in-out 0.3s;
      z-index: 2;
      opacity: 0;
    }

    .portfolio .portfolio-wrap img {
      transition: all ease-in-out 0.3s;
    }

    .portfolio .portfolio-wrap .portfolio-info {
      opacity: 0;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 3;
      transition: all ease-in-out 0.3s;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      align-items: flex-start;
      padding: 20px;
    }

    .portfolio .portfolio-wrap .portfolio-info h4 {
      font-size: 20px;
      color: #fff;
      font-weight: 600;
    }

    .portfolio .portfolio-wrap .portfolio-info p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 14px;
      text-transform: uppercase;
      padding: 0;
      margin: 0;
      font-style: italic;
    }

    .portfolio .portfolio-wrap .portfolio-links {
      text-align: center;
      z-index: 4;
    }

    .portfolio .portfolio-wrap .portfolio-links a {
      color: #fff;
      margin: 0 5px 0 0;
      font-size: 28px;
      display: inline-block;
      transition: 0.3s;
    }

    .portfolio .portfolio-wrap .portfolio-links a:hover {
      color: #7cfc00;
    }

    .portfolio .portfolio-wrap:hover::before {
      opacity: 1;
    }

    .portfolio .portfolio-wrap:hover img {
      transform: scale(1.2);
    }

    .portfolio .portfolio-wrap:hover .portfolio-info {
      opacity: 1;
    }

  /*--------------------------------------------------------------
  # Counts
  --------------------------------------------------------------*/
    .counts .content {
      padding: 30px 0;
    }

    .counts .content h3 {
      font-weight: 700;
      font-size: 34px;
      color: #151515;
    }

    .counts .content p {
      margin-bottom: 0;
    }

    .counts .content .count-box {
      padding: 20px 0;
      width: 100%;
    }

    .counts .content .count-box i {
      display: block;
      font-size: 36px;
      color: #7cfc00;
      float: left;
    }

    .counts .content .count-box span {
      font-size: 36px;
      line-height: 30px;
      display: block;
      font-weight: 700;
      color: #151515;
      margin-left: 50px;
    }

    .counts .content .count-box p {
      padding: 15px 0 0 0;
      margin: 0 0 0 50px;
      font-family: "Raleway", sans-serif;
      font-size: 14px;
      color: #3b3b3b;
    }

    .counts .content .count-box a {
      font-weight: 600;
      display: block;
      margin-top: 20px;
      color: #3b3b3b;
      font-size: 15px;
      font-family: "Poppins", sans-serif;
      transition: ease-in-out 0.3s;
    }

    .counts .content .count-box a:hover {
      color: #626262;
    }

    .counts .image {
      background: url("../img/counts-img.jpg") center center no-repeat;
      background-size: cover;
      min-height: 400px;
    }

    @media (max-width: 991px) {
      .counts .image {
        text-align: center;
      }
      .counts .image img {
        max-width: 80%;
      }
    }

    @media (max-width: 667px) {
      .counts .image img {
        max-width: 100%;
      }
    }

  /*--------------------------------------------------------------
  # Testimonials
  --------------------------------------------------------------*/
    .testimonials {
      padding: 80px 0;
      background: url("../img/testimonials-bg.jpg") no-repeat;
      background-position: center center;
      background-size: cover;
      position: relative;
    }

    .testimonials::before {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.7);
    }

    .testimonials .section-header {
      margin-bottom: 40px;
    }

    .testimonials .testimonial-item {
      text-align: center;
      color: #fff;
    }

    .testimonials .testimonial-item .testimonial-img {
      width: 100px;
      border-radius: 50%;
      border: 6px solid rgba(255, 255, 255, 0.15);
      margin: 0 auto;
    }

    .testimonials .testimonial-item h3 {
      font-size: 20px;
      font-weight: bold;
      margin: 10px 0 5px 0;
      color: #fff;
    }

    .testimonials .testimonial-item h4 {
      font-size: 14px;
      color: #ddd;
      margin: 0 0 15px 0;
    }

    .testimonials .testimonial-item .quote-icon-left, .testimonials .testimonial-item .quote-icon-right {
      color: rgba(255, 255, 255, 0.6);
      font-size: 26px;
    }

    .testimonials .testimonial-item .quote-icon-left {
      display: inline-block;
      left: -5px;
      position: relative;
    }

    .testimonials .testimonial-item .quote-icon-right {
      display: inline-block;
      right: -5px;
      position: relative;
      top: 10px;
    }

    .testimonials .testimonial-item p {
      font-style: italic;
      margin: 0 auto 15px auto;
      color: #eee;
    }

    .testimonials .owl-nav, .testimonials .owl-dots {
      margin-top: 5px;
      text-align: center;
    }

    .testimonials .owl-dot {
      display: inline-block;
      margin: 0 5px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.4) !important;
    }

    .testimonials .owl-dot.active {
      background-color: #7cfc00 !important;
    }

    @media (min-width: 1024px) {
      .testimonials {
        background-attachment: fixed;
      }
    }

    @media (min-width: 992px) {
      .testimonials .testimonial-item p {
        width: 80%;
      }
    }

  /*--------------------------------------------------------------
  # Team
  --------------------------------------------------------------*/
    .team {
      background: #fff;
      padding: 60px 0;
    }

    .team .member {
      margin-bottom: 20px;
      overflow: hidden;
      border-radius: 5px;
      background: #fff;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      max-width: 200px!important;
      height: 400px!important;
    }

    .team .member .member-img {
      position: relative;
      overflow: hidden;
    }

    .team .member .member-img img{
      width: 200px!important;
      height: 200px!important;
    }

    .team .member .social {
      position: absolute;
      left: 0;
      bottom: 30px;
      right: 0;
      opacity: 0;
      transition: ease-in-out 0.3s;
      text-align: center;
    }

    .team .member .social a {
      transition: color 0.3s;
      color: #151515;
      margin: 0 3px;
      padding: 7px;
      border-radius: 4px;
      background: #7cfc00;
      display: inline-block;
      transition: ease-in-out 0.3s;
      color: #fff;
      text-decoration: none!important;
      cursor: pointer!important;
    }

    .ver-mais-produtos {
      background: rgba(91, 46, 129, 0.9);
      color: #fff;
      border-radius: 7px;
      padding: 7px 25px 8px 25px;
      white-space: nowrap;
      transition: 0.3s;
      font-size: 20px;
      display: inline-block;
      border: 2px solid rgba(91, 46, 129, 0.9);
      text-decoration: none!important;
      cursor: pointer!important;
    }

    .ver-mais-produtos:hover{
      background: rgba(91, 46, 129, 0.9)!important;
      color: #ffbb38!important;
      border: 2px solid #ffbb38;
    }

    .team .member .social i {
      font-size: 18px;
    }

    .team .member .member-info {
      padding: 25px 15px;
    }

    .team .member .member-info h4 {
      font-weight: 700;
      margin-bottom: 5px;
      font-size: 18px;
      color: #151515;
    }

    .team .member .member-info span {
      display: block;
      font-size: 13px;
      font-weight: 400;
      color: #aaaaaa;
    }

    .team .member .member-info p {
      font-style: italic;
      font-size: 14px;
      line-height: 26px;
      color: #777777;
    }

    .team .member:hover .social {
      opacity: 1;
      bottom: 15px;
    }

  /*--------------------------------------------------------------
  # Contact
  --------------------------------------------------------------*/
    .comprar-na-loja {
      background: rgba(91, 46, 129, 0.9);
      color: #fff;
      border-radius: 7px;
      margin-top: 15px;
      padding: 7px 12px 8px 12px;
      white-space: nowrap;
      transition: 0.3s;
      font-size: 16px;
      display: inline-block;
      border: 2px solid rgba(91, 46, 129, 0.9);
      text-decoration: none!important;
      cursor: pointer!important;
    }

    .comprar-na-loja:hover{
      background: rgba(91, 46, 129, 0.9)!important;
      color: #ffbb38!important;
      border: 2px solid #ffbb38;
    }

    .contact .info {
      width: 100%;
      background: #fff;
    }

    .contact .info i {
      font-size: 20px;
      background: #7cfc00;
      color: #fff;
      float: left;
      width: 44px;
      height: 44px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 4px;
      transition: all 0.3s ease-in-out;
    }

    .contact .info h5 {
      padding: 0 0 0 60px;
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 5px;
      color: #151515;
    }

    .contact .info p {
      padding: 0 0 0 60px;
      margin-bottom: 0;
      font-size: 14px;
      color: #484848;
    }

    .contact .info .email, .contact .info .phone {
      margin-top: 10px;
    }

    .contact .php-email-form {
      width: 100%;
      background: #fff;
    }

    .contact .php-email-form .form-group {
      padding-bottom: 8px;
    }

    .contact .php-email-form .validate {
      display: none;
      color: red;
      margin: 0 0 15px 0;
      font-weight: 400;
      font-size: 13px;
    }

    .contact .php-email-form .error-message {
      display: none;
      color: #fff;
      background: #ed3c0d;
      text-align: left;
      padding: 15px;
      font-weight: 600;
    }

    .contact .php-email-form .error-message br + br {
      margin-top: 25px;
    }

    .contact .php-email-form .sent-message {
      display: none;
      color: #fff;
      background: #18d26e;
      text-align: center;
      padding: 15px;
      font-weight: 600;
    }

    .contact .php-email-form .loading {
      display: none;
      background: #fff;
      text-align: center;
      padding: 15px;
    }

    .contact .php-email-form .loading:before {
      content: "";
      display: inline-block;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      margin: 0 10px -6px 0;
      border: 3px solid #18d26e;
      border-top-color: #eee;
      -webkit-animation: animate-loading 1s linear infinite;
      animation: animate-loading 1s linear infinite;
    }

    .contact .php-email-form input, .contact .php-email-form textarea {
      border-radius: 0;
      box-shadow: none;
      font-size: 14px;
      border-radius: 4px;
    }

    .contact .php-email-form input:focus, .contact .php-email-form textarea:focus {
      border-color: #7cfc00;
    }

    .contact .php-email-form input {
      height: 44px;
    }

    .contact .php-email-form textarea {
      padding: 10px 12px;
    }

    .contact .php-email-form button[type="submit"] {
      background: #7cfc00;
      border: 0;
      padding: 10px 24px;
      color: #151515;
      transition: 0.4s;
      border-radius: 4px;
    }

    .contact .php-email-form button[type="submit"]:hover {
      background: #ffcd6b;
    }

    @-webkit-keyframes animate-loading {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes animate-loading {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

  /*--------------------------------------------------------------
  # Breadcrumbs
  --------------------------------------------------------------*/
    .breadcrumbs {
      padding: 15px 0;
      background: whitesmoke;
      min-height: 40px;
      margin-top: 74px;
    }

    .breadcrumbs h2 {
      font-size: 28px;
      font-weight: 400;
    }

    .breadcrumbs ol {
      display: flex;
      flex-wrap: wrap;
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .breadcrumbs ol li + li {
      padding-left: 10px;
    }

    .breadcrumbs ol li + li::before {
      display: inline-block;
      padding-right: 10px;
      color: #2f2f2f;
      content: "/";
    }

    @media (max-width: 992px) {
      .breadcrumbs {
        margin-top: 68px;
      }
      .breadcrumbs .d-flex {
        display: block !important;
      }
      .breadcrumbs ol {
        display: block;
      }
      .breadcrumbs ol li {
        display: inline-block;
      }
    }

  /*--------------------------------------------------------------
  # Portfolio Details
  --------------------------------------------------------------*/
    .portfolio-details {
      padding-top: 40px;
    }

    .portfolio-details .portfolio-details-container {
      position: relative;
    }

    .portfolio-details .portfolio-details-carousel {
      position: relative;
      z-index: 1;
    }

    .portfolio-details .portfolio-details-carousel .owl-nav, .portfolio-details .portfolio-details-carousel .owl-dots {
      margin-top: 5px;
      text-align: left;
    }

    .portfolio-details .portfolio-details-carousel .owl-dot {
      display: inline-block;
      margin: 0 10px 0 0;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #ddd !important;
    }

    .portfolio-details .portfolio-details-carousel .owl-dot.active {
      background-color: #7cfc00 !important;
    }

    .portfolio-details .portfolio-info {
      padding: 30px;
      position: absolute;
      right: 0;
      bottom: -70px;
      background: #fff;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      z-index: 2;
    }

    .portfolio-details .portfolio-info h3 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }

    .portfolio-details .portfolio-info ul {
      list-style: none;
      padding: 0;
      font-size: 15px;
    }

    .portfolio-details .portfolio-info ul li + li {
      margin-top: 10px;
    }

    .portfolio-details .portfolio-description {
      padding-top: 50px;
    }

    .portfolio-details .portfolio-description h2 {
      width: 50%;
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .portfolio-details .portfolio-description p {
      padding: 0 0 0 0;
    }

    @media (max-width: 992px) {
      .portfolio-details .portfolio-description h2 {
        width: 100%;
      }
      .portfolio-details .portfolio-info {
        position: static;
        margin-top: 30px;
      }
    }

  /*--------------------------------------------------------------
  # Footer
  --------------------------------------------------------------*/
    #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
    }

    #footer .footer-top {
      background: #151515;
      border-bottom: 1px solid #222222;
      padding: 60px 0 30px 0;
    }

    #footer .footer-top .footer-info {
      margin-bottom: 30px;
    }

    #footer .footer-top .footer-info h3 {
      font-size: 28px;
      margin: 0 0 20px 0;
      padding: 2px 0 2px 0;
      line-height: 1;
      font-weight: 700;
      text-transform: uppercase;
    }

    #footer .footer-top .footer-info h3 span {
      color: #7cfc00;
    }

    #footer .footer-top .footer-info p {
      font-size: 14px;
      line-height: 24px;
      margin-bottom: 0;
      font-family: "Raleway", sans-serif;
      color: #fff;
    }

    #footer .footer-top .social-links a {
      font-size: 18px;
      display: inline-block;
      background: #292929;
      color: #fff;
      line-height: 1;
      padding: 8px 0;
      margin-right: 4px;
      border-radius: 4px;
      text-align: center;
      width: 36px;
      height: 36px;
      transition: 0.3s;
    }

    #footer .footer-top .social-links a:hover {
      background: #7cfc00;
      color: #151515;
      text-decoration: none;
    }

    #footer .footer-top h4 {
      font-size: 16px;
      font-weight: 600;
      color: #fff;
      position: relative;
      padding-bottom: 12px;
    }

    #footer .footer-top .footer-links {
      margin-bottom: 30px;
    }

    #footer .footer-top .footer-links ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    #footer .footer-top .footer-links ul i {
      padding-right: 2px;
      color: #7cfc00;
      font-size: 18px;
      line-height: 1;
    }

    #footer .footer-top .footer-links ul li {
      padding: 10px 0;
      display: flex;
      align-items: center;
    }

    #footer .footer-top .footer-links ul li:first-child {
      padding-top: 0;
    }

    #footer .footer-top .footer-links ul a {
      color: #fff;
      transition: 0.3s;
      display: inline-block;
      line-height: 1;
      text-decoration: none!important;
      cursor: pointer!important;
    }

    #footer .footer-top .footer-links ul a:hover {
      color: #7cfc00;
    }

    #footer .footer-top .footer-newsletter form {
      margin-top: 30px;
      background: #fff;
      padding: 6px 10px;
      position: relative;
      border-radius: 4px;
    }

    #footer .footer-top .footer-newsletter form input[type="email"] {
      border: 0;
      padding: 4px;
      width: calc(100% - 110px);
    }

    #footer .footer-top .footer-newsletter form input[type="submit"] {
      position: absolute;
      top: 0;
      right: -2px;
      bottom: 0;
      border: 0;
      background: none;
      font-size: 16px;
      padding: 0 20px;
      background: #7cfc00;
      color: #151515;
      transition: 0.3s;
      border-radius: 0 4px 4px 0;
    }

    #footer .footer-top .footer-newsletter form input[type="submit"]:hover {
      background: #ffcd6b;
    }

    #footer .copyright {
      text-align: center;
      padding-top: 30px;
    }

    #footer .credits {
      padding-top: 10px;
      text-align: center;
      font-size: 13px;
      color: #fff;
    }

  /*--------------------------------------------------------------
  # Intro Section
  --------------------------------------------------------------*/
    #intro {
      width: 100%;
      height: 100vh;
      background: url(page-site/creampurple/media/background.jpg) top center;
      background-size: cover;
      overflow: hidden;
      position: relative;
    }

    @media (min-width: 1024px) {
      #intro {
        background-attachment: fixed;
      }
    }

    #intro:before {
      content: "";
      background: rgba(6, 12, 34, 0.8);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }

    #intro .intro-container {
      position: absolute;
      bottom: 0;
      left: 0;
      top: 90px;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      padding: 0 15px;
    }

    @media (max-width: 991px) {
      #intro .intro-container {
        top: 70px;
      }
    }

    #intro h1 {
      color: #fff;
      font-family: "Raleway", sans-serif;
      font-size: 56px;
      font-weight: 600;
      text-transform: uppercase;
    }

    #intro h1 span {
      color: #7cfc00;
    }

    @media (max-width: 991px) {
      #intro h1 {
        font-size: 34px;
      }
    }

    #intro p {
      color: #ebebeb;
      font-weight: 700;
      font-size: 20px;
    }

    @media (max-width: 991px) {
      #intro p {
        font-size: 16px;
      }
    }

    #intro .play-btn {
      width: 94px;
      height: 94px;
      background: radial-gradient(#f82249 50%, rgba(101, 111, 150, 0.15) 52%);
      border-radius: 50%;
      display: block;
      position: relative;
      overflow: hidden;
    }

    #intro .play-btn::after {
      content: '';
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translateX(-40%) translateY(-50%);
      width: 0;
      height: 0;
      border-top: 10px solid transparent;
      border-bottom: 10px solid transparent;
      border-left: 15px solid #fff;
      z-index: 100;
      transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
    }

    #intro .play-btn:before {
      content: '';
      position: absolute;
      width: 120px;
      height: 120px;
      -webkit-animation-delay: 0s;
      animation-delay: 0s;
      -webkit-animation: pulsate-btn 2s;
      animation: pulsate-btn 2s;
      -webkit-animation-direction: forwards;
      animation-direction: forwards;
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      -webkit-animation-timing-function: steps;
      animation-timing-function: steps;
      opacity: 1;
      border-radius: 50%;
      border: 2px solid rgba(163, 163, 163, 0.4);
      top: -15%;
      left: -15%;
      background: rgba(198, 16, 0, 0);
    }

    #intro .play-btn:hover::after {
      border-left: 15px solid #f82249;
      transform: scale(20);
    }

    #intro .play-btn:hover::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translateX(-40%) translateY(-50%);
      width: 0;
      height: 0;
      border: none;
      border-top: 10px solid transparent;
      border-bottom: 10px solid transparent;
      border-left: 15px solid #fff;
      z-index: 200;
      -webkit-animation: none;
      animation: none;
      border-radius: 0;
    }

    #intro .about-btn {
      font-family: "Raleway", sans-serif;
      font-weight: 500;
      font-size: 14px;
      letter-spacing: 1px;
      display: inline-block;
      padding: 12px 32px;
      border-radius: 50px;
      transition: 0.5s;
      line-height: 1;
      margin: 10px;
      color: #fff;
      -webkit-animation-delay: 0.8s;
      animation-delay: 0.8s;
      border: 2px solid #7cfc00;
    }

    #intro .about-btn:hover {
      background: rgba(91, 46, 129, 0.97);
      color: #fff;
    }

    @-webkit-keyframes pulsate-btn {
      0% {
        transform: scale(0.6, 0.6);
        opacity: 1;
      }
      100% {
        transform: scale(1, 1);
        opacity: 0;
      }
    }

    @keyframes pulsate-btn {
      0% {
        transform: scale(0.6, 0.6);
        opacity: 1;
      }
      100% {
        transform: scale(1, 1);
        opacity: 0;
      }
    }

  /*--------------------------------------------------------------
  # Subscribe Section
  --------------------------------------------------------------*/
    #subscribe {
      padding: 60px;
      /*background: url(page-site/creampurple/media/folder_acb.jpg) top center;*/
      background: rgba(91, 46, 129, 0.97);
      background-size: cover;
      overflow: hidden;
      position: relative;
    }

    #subscribe:before {
      content: "";
      background: rgba(6, 12, 34, 0.6);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }

    @media (min-width: 1024px) {
      #subscribe {
        background-attachment: fixed;
      }
    }

    #subscribe .section-header h2, #subscribe p {
      color: #fff;
    }

    #subscribe input, #subscribe select, #subscribe textarea {
      background: #fff;
      color: #060c22;
      border: 0;
      outline: none;
      margin: 0;
      padding: 9px 20px;
      border-radius: 50px;
      font-size: 14px;
    }

    @media (min-width: 767px) {
      #subscribe input, #subscribe select, #subscribe textarea {
        min-width: 400px;
      }
    }

    #subscribe button {
      border: 0;
      padding: 9px 25px;
      cursor: pointer;
      background: #7cfc00;
      color: #fff;
      transition: all 0.3s ease;
      outline: none;
      font-size: 14px;
      border-radius: 50px;
    }

    #subscribe button:hover {
      background: rgba(91, 46, 129, 0.9);
    }

    @media (max-width: 460px) {
      #subscribe button {
        margin-top: 10px;
      }
    }

   
</style>

<script type="text/javascript">
  $(document).ready(function() {

      // Mask globs
      $('.whatsapp').mask('(99) 9 9999-9999');
      $('.telefone').mask('(99) 9999-9999');
      $('.time').mask('99:99');

      // Somente numeros
      $(".somenteNumero").bind("keyup blur focus", function(e) {
         e.preventDefault();
         var expre = /[^\d.-]/g;
         $(this).val($(this).val().replace(expre,''));
         $(this).val($(this).val().substring(0, 14));
      });

      // buscar e validar cep
         $(".end_cep").bind("keyup blur", function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "" && (parseInt($('.end_cep').val().length) == 9)) {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#end_logradouro").val("");
                    $("#end_bairro").val("");
                    $("#end_cidade").val("");
                    $("#end_estado").val("");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#end_logradouro").val(dados.logradouro);
                            $("#end_bairro").val(dados.bairro);
                            $("#end_cidade").val(dados.localidade);
                                // // Controle de região
                                // if (dados.localidade == "Belo Horizonte") {
                                //     $('#desbloquear_reg').click();
                                // }else{
                                //     $('#bloquear_reg').click();
                                // }
                            $("#end_estado").val(dados.uf);
                            $("#end_numero").attr("readonly", false);
                            $("#end_complemento").attr("readonly", false);
                            $("#end_referencia").attr("readonly", false);
                            $("#end_numero").focus();
                            $("#end_pais").val('BRASIL');
                        } //end if.
                        else {
                            // CEP não encontrado
                            toastr["warning"]("CEP não encontrado!");
                            return true;
                        }
                    });
                } //end if.
                else {
                    // CEP inválido
                    toastr["warning"]("Formato de CEP inválido!");
                    return true;
                }
            } //end if.
            else {
            }
         });

  }); // fim do ready

  function validarCPF(cpf) {  
    cpf = cpf.replace(/[^\d]+/g,'');  
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos  
    if (cpf.length != 11 || 
      cpf == "00000000000" || 
      cpf == "11111111111" || 
      cpf == "22222222222" || 
      cpf == "33333333333" || 
      cpf == "44444444444" || 
      cpf == "55555555555" || 
      cpf == "66666666666" || 
      cpf == "77777777777" || 
      cpf == "88888888888" || 
      cpf == "99999999999")
        return false;   
    // Valida 1o digito 
    add = 0;  
    for (i=0; i < 9; i ++)    
      add += parseInt(cpf.charAt(i)) * (10 - i);  
      rev = 11 - (add % 11);  
      if (rev == 10 || rev == 11)   
        rev = 0;  
      if (rev != parseInt(cpf.charAt(9)))   
        return false;   
    // Valida 2o digito 
    add = 0;  
    for (i = 0; i < 10; i ++)   
      add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
      rev = 0;  
    if (rev != parseInt(cpf.charAt(10)))
      return false;   
    return true;   
  }

  function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
      return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
      cnpj == "11111111111111" ||
      cnpj == "22222222222222" ||
      cnpj == "33333333333333" ||
      cnpj == "44444444444444" ||
      cnpj == "55555555555555" ||
      cnpj == "66666666666666" ||
      cnpj == "77777777777777" ||
      cnpj == "88888888888888" ||
      cnpj == "99999999999999")
      return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
        pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
      return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
        pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
      return false;

    return true;
  }

</script>