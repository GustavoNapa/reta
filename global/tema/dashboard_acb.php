


  <!-- MODAL GLOBAL -->
  <div id="modal_global" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div id="modal_global_header" class="modal-header">
                  <h4 id="modal_global_title">S4BIT</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div id="modal_global_body" class="modal-body"><!-- BODY --></div>
              <div id="modal_global_footer" class="modal-footer"><!-- FOOTER --></div>
          </div>
      </div>
  </div>



<!-- https://bootsnipp.com/snippets/xb1bN -->
<style type="text/css">

  /* GLOBAL */
    .nolink{
      text-decoration: none!important;
      cursor: pointer!important;
    }
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
      background: rgba(40, 167, 70, 1);
      color: rgba(255, 255, 255, 1);
    }
    .bg_tema{
      /*background: rgba(105, 0, 145, 0.7)!important;*/
      background: #333!important;
      color: rgba(255, 255, 255, 1)!important;
    }

    .bg_tema_hover:hover{
      background: rgba(105, 0, 145, 0.97);
      color: #fff;
      transition: all 0.7s;
    }

    body {
      overflow-x: hidden;
    }
    .chamar_menu {
      cursor: pointer;
      position: fixed;
      /*top: 80px;*/
      left: 0px;
      /*display:none;*/
    }
    .btn_editar:hover{
      border: 1px solid #ccc!important;
    }
    .laterais{
      padding: 25px!important 10%!important 25%!important 10%!important;
    }
    .form-style{
      border: 1px #ccc solid;
      padding: 2% 3% 12% 3%;
    }

    .btn-circle, .btn-xl {
      width: 70px;
      height: 70px;
      padding: 10px 16px;
      border-radius: 35px;
      font-size: 24px;
      line-height: 1.33;
    }

    .btn-circle {
      width: 30px;
      height: 30px;
      padding: 6px 0px;
      border-radius: 15px;
      text-align: center;
      font-size: 12px;
      line-height: 1.42857;
    }

    /* Imagens ambiente da loja */
    .div_ambiente {
      width: 250px!important;
      height: 270px!important;
      margin: 10px!important;
      padding: 0px!important;
      position: relative;
      display:         flex!important;
      display: -webkit-flex!important; /* Garante compatibilidade com navegador Safari. */
      justify-content: center!important;
      align-items: center!important;
    }
    .img_ambiente{
      width: 100%!important;
      max-height: 300px!important;
      position: relative;
      justify-content: center!important;
      align-items: center!important;
      display:         flex!important;
      display: -webkit-flex!important; 
    }
    .img_ambiente img{
      width: 100%!important;
      height: 250px!important;
      position: relative;
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
      font-size: 20px;
      width: 30px;
      height: 30px;
      border-radius: 4px;
      background: #7cfc00;
      color: #fff;
      transition: all 0.4s;
    }

    .back-to-top i:hover {
      background: rgba(91, 46, 129, 0.9);
      color: #fff;
    }

  /* TEMPLATE */
    .accordion .list-group a{
      font-size: 11.5px;
    }
    .accordion .list-group-item, .text_menu, .nav-admin{
      font-size: 13px;
    }
    .nav-admin      padding-top: 10px!important;
    }
    .accordion .list-group-item:hover, .text_menu:hover, .nav-admin:hover{
      background: rgba(105, 0, 145, 0.7)!important;
      color: #fff!important;
    }

    .navbar-text{
      color: #fff!important;
    }

    .navbar-text:hover{
      color: #aaa!important;
    }

    #sidebar-wrapper {
      min-height: 100vh;
      margin-left: -15rem;
      -webkit-transition: margin .25s ease-out;
      -moz-transition: margin .25s ease-out;
      -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
    }

    #sidebar-wrapper .sidebar-heading {
      padding: 0.875rem 1.25rem;
      font-size: 1.2rem;
    }

    .logo-admin {
      padding: 7px 7px;
      padding: 0.875rem 1.25rem;
      font-size: 1.2rem;
    }

    .img_perfil{
      position: relative;
      top: -50px;
      max-width: 150px!important;
      max-height: 190px!important;
    }

    .img_perfil img{
      max-width: 150px!important;
      max-height: 190px!important;
      -webkit-border-radius: 45%;
      -moz-border-radius: 45%;
      border-radius: 45%;
      border: 3px solid rgba(255,255,255,0.8);
      transition: all .4s ease;
      -webkit-transition: all .4s ease;
    }

    .img_perfil img:hover, .img_perfil img:after{
      -webkit-border-radius: 15%;
      -moz-border-radius: 15%;
      border-radius: 15%;
      transition: all .4s ease;
      -webkit-transition: all .4s ease;
    }

    .nolink_perfil:hover{
      background: #f8f9fa!important
    }

    .nolink_perfil{
      background: #f8f9fa!important;
    }

    #sidebar-wrapper .list-group {
      width: 15rem;
    }

    #page-content-wrapper {
      min-width: 100vw;
    }

    #wrapper.toggled #sidebar-wrapper {
      margin-left: 0;
    }

    @media (min-width: 768px) {
      #sidebar-wrapper {
        margin-left: 0;
      }

      #page-content-wrapper {
        min-width: 0;
        width: 100%;
      }

      #wrapper.toggled #sidebar-wrapper {
        margin-left: -15rem;
      }
    }
</style>

<script type="text/javascript">
  $(document).ready(function() {

      // Mask globs
      $('.celular').mask('(99) 9 9999-9999');
      $('.telefone').mask('(99) 9999-9999');
      $('.contato').mask('(99) 999999999');
      $('.time').mask('99:99');
      $('.dinheiro').mask("#.##0,00", {reverse: true});

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

  function aguarde(tempo, info_carregando){

      setTimeout(function() {
        $('#modal_global_close').fadeIn('500');
      }, 5000);

      if(tempo == "close"){
        fecharModalGlobal();       
        return true;
      }

      abrirModalGlobal('<h4>Açai com Bobagens</h4>',info_carregando,'aguarde');

      if (tempo!="freeze") {
          tempo = parseInt(tempo);

          if(tempo > 500){
              setTimeout(function(){
                  $('#carregandoModal').modal('hide');
              }, tempo);
          } 
      }        
  }

  // MODAL GLOBAL
  function abrirModalGlobal(md_title, md_body, md_footer){

    $('#modal_global_footer').html('<button id="modal_global_close" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>');

    if (md_title=='') {
        $('#modal_global_title').hide();
    }else{
        $('#modal_global_title').html(md_title);
    }

    if (md_body == '') {
        $('#modal_global_body').hide();
    }else{
        $('#modal_global_body').html(md_body);
    }

    switch(md_footer) {

        case "":
            $('#modal_global_footer').hide();
        break;

        case "success":
            $('#modal_global_footer').html('<button id="modal_global_close" type="button" class="btn btn-success" data-dismiss="modal">OK</button>');
        break;

        case "copyright":
            $('#modal_global_footer').html('<button id="modal_global_close" type="button" class="btn btn-default btn-sm text-muted" data-dismiss="modal">© 2020 S4BIT ®</button>');
        break;

        case "aguarde":
            $('#modal_global_body').html('<center><img class="img img-fluid" style="max-height: 300px; max-width: 300px" src="global/media/logo_acb.gif"></center><h3 class="text-center">PROCESSANDO</h3><center><span class="help-block text-muted text-center">'+md_body+'</span></center>');
            $('#modal_global_close').hide();
        break;

        // cdr_logincompuforte()
        case "LOGIN":
            $('#modal_global_footer').append('<button onclick="cdr_logincompuforte()" type="button" class="btn btn-primary">Entrar</button>');
        break;

        default:
            $('#modal_global_footer').append(md_footer);
    } 

    $('#modal_global').modal('show');
  }

  function fecharModalGlobal(){
    $('#modal_global').modal('hide'); 
  }
  
</script>