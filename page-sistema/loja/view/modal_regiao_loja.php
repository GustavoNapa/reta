<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

	// functions
    include '../../../page-sistema/loja/function/loja.php';

	$getRegiao = getCadastroBasicoLoja( 'regiao', array('reg_id' => $_POST['reg_id'] ) );

	$getLocalidade = getCadastroBasicoLoja( 'bairro b', '', ' INNER JOIN acb_cidade c  ON b.`bai_idcidade`=c.`cid_id`, acb_cidade d INNER JOIN acb_estado e  ON d.`cid_idestado`=e.`est_id` group by b.bai_id' );

	$_regiao = $getRegiao[2][0];

?>

<div id="div_formcadastro" class="row">
	<div class="col-12">
		<?php if ( $getRegiao[0]=="SUCESSO" ): ?>
			<form id="form_cadastro" class="needs-validation" novalidate>
				<!-- IMPORTANTE -->
					<input id="reg_id" name="reg_id" type="text" value="<?=$_regiao->reg_id?>" readonly hidden>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-md-12 mt-3 mb-3">
						<h4>Cadastro de região:</h4>
				    </div>
				</div>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-md-6 mb-3">
				    	<label for="reg_idbairro" class="small text-dark">Bairro, Cidade/UF</label>
				        <div class="input-group">
				            <select id="reg_idbairro" name="reg_idbairro" class="custom-select d-block w-100" required>
				            	<option value hidden>- Selecione -</option>
				            	<?php foreach ($getLocalidade[2] as $key => $localidade): ?>
				            		<?php if ($localidade->bai_status==1): ?>
				            			<option value="<?=$localidade->bai_id?>" <?=$_regiao->reg_idbairro==$localidade->bai_id?'selected':''?> >
				            				<?=$localidade->bai_nome?>, <?=$localidade->cid_nome?>/<?=$localidade->est_uf?>
				            			</option>
				            		<?php endif ?>
				            	<?php endforeach ?>
							</select>
				            <div class="invalid-feedback" style="width: 100%;">
				                Selecione uma opção
				            </div>
				        </div>
				    </div>
					<div class="col-md-3 mb-3">
				        <label for="reg_valordelivery" class="small text-dark">Valor delivery</label>
				        <div class="input-group">
				            <input id="reg_valordelivery" name="reg_valordelivery" type="text" placeholder="Valor delivery" class="form-control text-uppercase dinheiro" value="<?=$_regiao->reg_valordelivery?>" required>
				            <div class="invalid-feedback" style="width: 100%;">
				                Informe o valor de entrega (delivery)
				            </div>
				        </div>
				    </div>
				    <div class="col-md-3 mb-3">
				    	<label for="reg_status" class="small text-dark">Status</label>
				        <div class="input-group">
				            <select id="reg_status" name="reg_status" class="custom-select d-block w-100" required>
				            	<option value hidden>- Selecione -</option>
								<option value="1" <?=!is_null($_regiao->reg_status)&&$_regiao->reg_status==1?'selected':''?>>Ativo</option>
								<option value="0" <?=!is_null($_regiao->reg_status)&&$_regiao->reg_status==0?'selected':''?>>Inativo</option>
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
			<h1>Erro, ao buscar dados da região!</h1>
			<var>
			</var>
		<?php endif ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 

		$('.dinheiro').mask("#.##0,00", {reverse: true});

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
			submitForm('salvarregiao', form);
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

	// function
	function submitForm(acao, form) {
		$('#form_cadastro').find("input,select").attr("disabled", true);
		$.ajax({
			url:    'page-sistema/loja/controller/loja.php',
			type:   'POST',
			data:   'acao='+acao+'&reg_idloja='+$('#loj_id').val()+'&'+form,
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
                        location.replace('loja?view=formloja&loj_id='+$("#loj_id").val()+'&tab=tab_regiao');
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