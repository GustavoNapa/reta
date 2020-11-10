<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

	// functions
    include '../../../page-sistema/loja/function/loja.php';

	$getBairro = getCadastroBasicoLoja( 'bairro', array('bai_id' => $_POST['bai_id'] ) );

	$getCidadeUF = getCadastroBasicoLoja( 'cidade c', '', ' INNER JOIN acb_estado e  ON c.`cid_idestado`=e.`est_id` ' );

	$_bairro = $getBairro[2][0];

?>

<div id="div_formcadastro" class="row">
	<div class="col-12">
		<?php if ( $getBairro[0]=="SUCESSO" ): ?>
			<form id="form_cadastro" class="needs-validation" novalidate>
				<!-- IMPORTANTE -->
					<input id="bai_id" name="bai_id" type="text" value="<?=$_bairro->bai_id?>" readonly hidden>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-md-12 mt-3 mb-3">
						<h4>Cadastro de bairro:</h4>
				    </div>
				</div>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-md-4 mb-3">
				    	<label for="bai_idcidade" class="small text-dark">UF/Cidade</label>
				        <div class="input-group">
				            <select id="bai_idcidade" name="bai_idcidade" class="custom-select d-block w-100" required>
				            	<option value hidden>- Selecione -</option>
				            	<?php foreach ($getCidadeUF[2] as $key => $cidadeUF): ?>
				            		<?php if ($cidadeUF->cid_status==1): ?>
				            			<option value="<?=$cidadeUF->cid_id?>" <?=$_bairro->bai_idcidade==$cidadeUF->cid_id?'selected':''?> ><?=$cidadeUF->est_uf?> - <?=$cidadeUF->cid_nome?></option>
				            		<?php endif ?>
				            	<?php endforeach ?>
							</select>
				            <div class="invalid-feedback" style="width: 100%;">
				                Selecione uma opção
				            </div>
				        </div>
				    </div>
					<div class="col-md-5 mb-3">
				        <label for="bai_nome" class="small text-dark">Nome <span id="text_nome"></span></label>
				        <div class="input-group">
				            <input id="bai_nome" name="bai_nome" type="text" placeholder="Nome" class="form-control text-uppercase" value="<?=$_bairro->bai_nome?>" required>
				            <div class="invalid-feedback" style="width: 100%;">
				                Informe  o nome
				            </div>
				        </div>
				    </div>
				    <div class="col-md-3 mb-3">
				    	<label for="bai_status" class="small text-dark">Status</label>
				        <div class="input-group">
				            <select id="bai_status" name="bai_status" class="custom-select d-block w-100" required>
				            	<option value hidden>- Selecione -</option>
								<option value="1" <?=!is_null($_bairro->bai_status)&&$_bairro->bai_status==1?'selected':''?>>Ativo</option>
								<option value="0" <?=!is_null($_bairro->bai_status)&&$_bairro->bai_status==0?'selected':''?>>Inativo</option>
							</select>
				            <div class="invalid-feedback" style="width: 100%;">
				                Selecione uma opção
				            </div>
				        </div>
				    </div>
				</div>

				<div class="row pl-3 pr-3 pt-0">
			        <div class="col-md-12 mb-3 text-right">
			        	<button hidden id="btn_salvarcadastro" class="btn btn-success" style="border-radius: 50px" type="submit">SALVAR</button>
			        </div>
			    </div>			
			</form>
		<?php else: ?>
			<h1>Erro, ao buscar dados do bairro!</h1>
			<var>
			</var>
		<?php endif ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 

	    $("#form_cadastro").submit(function(event) {
			event.preventDefault();
			if (this.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
				toastr["warning"]("Confira os campos obrigatórios!");
				this.classList.add('was-validated');
				return false;
			}
			this.classList.add('was-validated');
			$('#form_cadastro').find("input,select").attr("disabled", false);
			var form = $('#form_cadastro').serialize();
			submitForm('salvarbairro', form);
	    });

	}); // fim do ready

	function btn_salvarcadastro() {
		$('#btn_salvarcadastro').click();
	}

	function editarLoja(id) {
		$('#id').val( id );
		$('#idcidade').val( $('#idcidade-'+id).val() );
		$('#nome').val( $('#nome-'+id).val() );
		$('#status').val( $('#status-'+id).val() );
		$('#div_formcadastro').fadeIn(500);
		$('#tabela_cadastro').hide();
		setTimeout(function(){
			$('#idcidade').focus();
        }, 300);
	}

	function validarcampo(campo) {
		$.ajax({
			url:    'page-sistema/loja/controller/loja.php',
			type:   'POST',
			data:   'acao=validarcampo&nome='+$("#nome").val(),
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				console.log(retorno);
				return false;
				if ( arrRetorno[0]=="DISPONIVEL" ) {
					$('#text_'+campo).html('<span class="text-success"> - Disponível</span>');
					$('#btn_salvarusuario').attr('disabled', false);
				} else {
					$('#text_'+campo).html('<span class="text-danger"> - Indisponível</span>');
					$('#btn_salvarusuario').attr('disabled', true);
				}
			} // fim da function
	    }); // fim do ajax
	}

	// function
	function submitForm(acao, form) {
		$('#form_cadastro').find("input,select").attr("disabled", true);
		$.ajax({
			url:    'page-sistema/loja/controller/loja.php',
			type:   'POST',
			data:   'acao='+acao+'&'+form,
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				// console.log(retorno);
				// return false;
				if (arrRetorno[0]=="SUCESSO") {
                    swal({
                      title: "SUCESSO",
                      text: arrRetorno[1],
                      icon: "success",
                      buttons: false,
                    });
                    setTimeout(function(){
                        location.replace('loja?view=formbairro&tabela=bairro');
                    }, 1500);
                } else {
                    // toastr["error"](arrRetorno[1]);
                    swal({
                      title: "Atenção",
                      text: arrRetorno[1],
                      icon: "warning",
                      // buttons: true,
                    });
                    console.log(retorno);
                }
                $('#form_cadastro').find("input,select").attr("disabled", false);
			} // fim da function
		}); // fim do ajax
	}
</script>

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