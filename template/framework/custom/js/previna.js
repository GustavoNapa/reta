


$(document).on('click', '.card-header', function(e){
    var $this = $(this);

    if(!$this.hasClass('collapsed')) {
        // $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('collapsed');
        
        $this.find('i').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
    } else {
        // $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('collapsed');
        
        $this.find('i').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
    }
});

$(document).ready(function() {
    $('[data-toggle="popover"]').popover(); 

    $('.emProducao').click(function(norefresh){
        // evitar refresh de formulario
        norefresh.preventDefault(); 
        toastr["error"]("Em produção!");
        return false;
    });

    $(".somenteNumero").bind("keyup blur focus", function(e) {
        e.preventDefault();
        var expre = /[^\d.-]/g;
        $(this).val($(this).val().replace(expre,''));
        $(this).val($(this).val().substring(0, 14));
    });

    // buscar e validar cep
    $(".cep").bind("keyup blur", function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "" && (parseInt($('.cep').val().length) == 9)) {

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
                        $("#end_estado").val(dados.uf);
                        $('#end_numero').attr('readonly', false);
                        $('#end_complemento').attr('readonly', false);
                        $('#end_referencia').attr('readonly', false);
                        $('#end_numero').focus();
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
});

    // Controle de painéis    
    function controlerPanel(idDiv, idDivDestino, arquivo){
        $(idDiv).find('.panel-collapse').removeClass('in');
        $(idDiv).find('.panel-heading').addClass('panel-collapsed');
        $(idDiv).find('i').removeClass('fas fa-angle-up').addClass('fas fa-angle-down');

        $(idDivDestino).load(arquivo); 
    }

    // Controle de painéis    
    function fecharPanel(idDiv){
        $(idDiv).find('.collapse').removeClass('show');
        $(idDiv).find('.card-header').addClass('collapsed');
        $(idDiv).find('i').removeClass('fas fa-angle-up').addClass('fas fa-angle-down'); 
    }

    // Controle de painéis    
    function trocaPanel(idDiv, idDivDestino){
        $(idDiv).find('.panel-collapse').removeClass('show');
        $(idDiv).find('.panel-heading').addClass('panel-collapsed');
        $(idDiv).find('i').removeClass('fas fa-angle-up').addClass('fas fa-angle-down');

        $(idDivDestino).find('.panel-collapse').addClass('show');
        $(idDivDestino).find('.panel-heading').removeClass('panel-collapsed');
        $(idDivDestino).find('i').addClass('fas fa-angle-up').removeClass('fas fa-angle-down');
    }

    function converterEmDinheiro(v){

        v = v.toFixed(2);

        if(v.indexOf('.') === -1) {
            v = v.replace(/([\d]+)/, "$1,00");
            // alert('to aqui: '+v);
            if (v = "NaN") { v = ''}
        }

        v = v.replace(/([\d]+)\.([\d]{1})$/, "$1,$20");
        v = v.replace(/([\d]+)\.([\d]{2})$/, "$1,$2");
        v = v.replace(/([\d]+)([\d]{3}),([\d]{2})$/, "$1.$2,$3");

        return v;
    }

    function aguarde(tempo, info_carregando){
        
        if(tempo == "close"){
            $('#carregandoModal').modal('hide');
            setTimeout(function(){
                $('#carregandoModal').modal('hide');
            }, 500);        
            return true;
        }

        $('#btn_carregando').hide();
        $('#carregandoModal').modal('show');
        
        if(info_carregando == 'semfooter'){
            $('#footer_carregando').hide();
        }else if(info_carregando != ''){
            $('#info_carregando').html(info_carregando);
        }else{
            $('#info_carregando').html('verificando as informações...');
        }

        tempo = parseInt(tempo);

        if(tempo > 500){
            setTimeout(function(){
                $('#carregandoModal').modal('hide');
            }, tempo);
        }

        setTimeout(function() {
            $('#footer_carregando').fadeIn('500');
            $('#btn_carregando').fadeIn('500');
        }, 5000);
    }