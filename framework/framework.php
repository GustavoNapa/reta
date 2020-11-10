



<!-- FRAMEWORKS - CSS -->

    <!-- Animate -->
    <link rel="stylesheet" href="framework/animate/animate.css" />

    <!-- Bootstrap v4.4.1 -->
    <link rel="stylesheet" href="framework/bootstrap/css/bootstrap.min.css"/>

    <!-- Datatables -->
    <link rel="stylesheet" href="framework/datatables/datatables.min.css"/>
    
    <!-- Fontawesome -->
    <link rel="stylesheet" href="framework/fontawesome/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="framework/ionicons/css/ionicons.min.css" />

    <!-- Lightbox -->
    <link rel="stylesheet" href="framework/lightbox/css/lightbox.min.css" />

    <!-- OWL Carousel -->
    <link rel="stylesheet" href="framework/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="framework/owlcarousel/css/owl.theme.default.min.css">

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="framework/slick/slick.css">

    <!-- Superfish -->
    <link rel="stylesheet" href="framework/superfish/css/superfish.css" media="screen">

    <!-- Toastr -->
    <link rel="stylesheet" href="framework/toastr/css/toastr.min.css" />

    <!-- SummerNote -->
    <link rel="stylesheet" href="framework/summernote/summernote-bs4.css" />

    <!-- Icofonts -->
    <link href="framework/icofont/icofont.min.css" rel="stylesheet">
    
    <!-- Boxicons -->
    <link href="framework/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- Venobox -->
    <link href="framework/venobox/venobox.css" rel="stylesheet">

    <!-- Aos -->
    <link href="framework/aos/aos.css" rel="stylesheet">

    <!-- Chart -->
    <link href="framework/chart/css/chart.css" rel="stylesheet">

    <!-- OUTROS -->
<!-- FIM - CSS -->

<!-- FRAMEWORKS - JS -->

    <!-- Datatables !ANTES DE JQUERY -->
    <script src="framework/datatables/datatables.min.js"></script>

    <!-- jQuery -->
    <script src="framework/jquery/jquery.min.js"></script>

    <!-- Popper -->
    <script src="framework/popper/popper.min.js"></script>
    
    <!-- Bootstrap -->
    <!-- <script src="framework/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="framework/bootstrap/js/bootstrap.min.js"></script>

    <!-- Jquery Extensions -->
    <script src="framework/jquerymask/jquery.mask.min.js"></script>
    <script src="framework/jquerycomplexify/jquery.complexify.min.js"></script>
    <script src="framework/jqueryqrcode/jquery.qrcode.min.js"></script>

    <!-- touchSwipe -->
    <script src="framework/touchSwipe/jquery.touchSwipe.min.js"></script>

    <!-- Counterup -->
    <script src="framework/counterup/counterup.min.js"></script>

    <!-- Easing -->
    <script src="framework/easing/easing.min.js"></script>

    <!-- Isotope -->
    <script src="framework/isotope/isotope.pkgd.min.js"></script>

    <!-- Pace -->
    <script src="framework/pace/pace.js"></script>

    <!-- Hammer -->
    <script src="framework/hammer/hammer.min.js"></script>

    <!-- Lightbox -->
    <script src="framework/lightbox/js/lightbox.min.js"></script>

    <!-- OWL Carousel -->
    <script src="framework/owlcarousel/js/owl.carousel.min.js"></script>

    <!-- Slick Carousel -->
    <script src="framework/slick/slick.min.js"></script>

    <!-- Superfish -->
    <script src="framework/superfish/js/hoverIntent.js"></script>
    <script src="framework/superfish/js/superfish.min.js"></script>

    <!-- Waypoints -->
    <script src="framework/waypoints/waypoints.min.js"></script>

    <!-- Highcharts -->
    <script src="framework/highcharts/code/highcharts.js"></script>  
    <script src="framework/highcharts/code/modules/exporting.js"></script>
    <script src="framework/highcharts/code/modules/export-data.js"></script> 
    <script src="framework/highcharts/code/modules/accessibility.js"></script> 

    <!-- JSONQ -->
    <!-- <script src="framework/jsonq/jsonQ.min.js"></script>  -->

    <!-- simpleUpload -->
    <script src="framework/simpleupload/simpleupload.js"></script> 

    <!-- Chart -->
    <script src="framework/chart/js/chart.js"></script> 

    <!-- Sweetalert -->
    <script src="framework/sweetalert/sweetalert.min.js"></script> 

    <!-- Venobox -->
    <script src="framework/venobox/venobox.min.js"></script> 

    <!-- Aos -->
    <script src="framework/aos/aos.js"></script> 

    <!-- Chart -->
    <script src="framework/chart/js/chart.js"></script> 

    <!-- WOW -->
    <script src="framework/wow/wow.min.js"></script>
    <script>
      wow = new WOW(
        {
          animateClass: 'animated',
          offset:       100,
          callback:     function(box) {
            // console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
          }
        }
      );
      wow.init();
    </script>

    <!-- Toastr -->
    <script src="framework/toastr/js/toastr.min.js"></script>
    <script>
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "rtl": false,
          "positionClass": "toast-bottom-left",
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": 300,
          "hideDuration": 1000,
          "timeOut": 5000,
          "extendedTimeOut": 1000,
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }  
    </script> 

    <!-- Script para validação de formulários bootstrap -->
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>   

<!-- FIM - JS -->