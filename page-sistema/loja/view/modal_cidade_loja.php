<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// functions
    include '../../../page-sistema/loja/function/loja.php';

	$getCadastroBasicoLoja = getCadastroBasicoLoja( $_POST['tabela'] );

	$getEstado = getCadastroBasicoLoja( 'estado' );
?>

<div id="tabela_cadastro" class="row">
	<div class="col-12">
		<table class="table table-striped">
			<thead>
				<tr class="row">
					<th class="col">
						<div class="row">
							<div class="col-sm-2 col-md-2 text-left">Estado</div>
							<div class="col-sm-5 col-md-5 text-left">Descrição</div>
							<div class="col-sm-3 col-md-3 text-center">Status</div>
							<div class="col-sm-2 col-md-2 text-right">
								<button onclick="editarLoja(0)" class="btn btn-success btn-sm">
									<i class="icofont-plus"></i>&nbsp;&nbsp;
									NOVO
								</button>
								<!-- Importante -->
								<input id="idestado-0" value="" type="text" readonly hidden>
								<input id="nome-0" value="" type="text" readonly hidden>
								<input id="status-0" value="" type="text" readonly hidden>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>

				<?php if ( $getCadastroBasicoLoja[0]=="SUCESSO" ): ?>

					<?php if ( $getCadastroBasicoLoja[1]>0 ): ?>
						<?php foreach ( $getCadastroBasicoLoja[2] as $key => $value): ?>
							<?php
								// importante
								$id 			= $_POST['prefixo'].'_id';
								$idestado 		= $_POST['prefixo'].'_idestado';
								$nomeestado 	= $_POST['prefixo'].'_nomeestado';
								$nome 			= $_POST['prefixo'].'_nome';
								$status 		= $_POST['prefixo'].'_status';
								$status_text 	= $value->$status==1?'Ativo':'Inativo';
							?>
							<tr class="row">
								<td class="col">
									<div class="row">
										<div class="col-sm-2 col-md-2 text-left">
											<?php foreach ($getEstado[2] as $key => $estado): ?>
												<?php if ($estado->est_id==$value->cid_idestado): ?>
													<span title="<?=$estado->est_nome?>"><?=$estado->est_uf?></span>
												<?php endif ?>
											<?php endforeach ?>
										</div>
										<div class="col-sm-5 col-md-5 text-left"><?=$value->$nome?></div>
										<div class="col-sm-3 col-md-3 text-center"><?=$status_text?></div>
										<div class="col-sm-2 col-md-2 text-right">
											<button onclick="editarLoja('<?=$value->$id?>')" class="btn btn-primary btn-sm">
												<i class="icofont-ui-edit"></i>&nbsp;&nbsp;
												Editar
											</button>
										</div>

										<!-- Importante -->
										<input id="idestado-<?=$value->$id?>" value="<?=$value->$idestado?>" type="text" readonly hidden>
										<input id="nome-<?=$value->$id?>" value="<?=$value->$nome?>" type="text" readonly hidden>
										<input id="status-<?=$value->$id?>" value="<?=$value->$status?>" type="text" readonly hidden>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr class="row">
							<td class="col">
								<h1 class="text-secondary">Nenhum <?=$_POST['titulo']?> encontrado(a).</h1>
							</td>
						</tr>
					<?php endif ?>
				<?php else: ?>
					<tr class="row">
						<td class="col">
							<h1 class="text-danger">Ocorreu um erro ao buscar dados do(a) <?=$_POST['titulo']?></h1>
							<var>
								<?=$getCadastroBasicoLoja[2]?>
							</var>
						</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>

<div id="div_formcadastro" class="row">
	<div class="col-12">
		<?php if ( $getEstado[1]>0 ): ?>
			<form id="form_cadastro" class="needs-validation" novalidate>
				<!-- IMPORTANTE -->
					<input id="id" name="id" type="text" value="" readonly hidden>
					<input id="tabela" name="tabela" type="text" value="<?=$_POST['tabela']?>" readonly hidden>
					<input id="prefixo" name="prefixo" type="text" value="<?=$_POST['prefixo']?>" readonly hidden>
					<input id="modal" name="modal" type="text" value="<?=$_POST['modal']?>" readonly hidden>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-md-12 mt-3 mb-3">
						<h4>Cadastro de cidade:</h4>
				    </div>
				</div>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-md-4 mb-3">
				    	<label for="idestado" class="small text-dark">Estado</label>
				        <div class="input-group">
				            <select id="idestado" name="idestado" class="custom-select d-block w-100" required>
				            	<option value hidden>- Selecione -</option>
				            	<?php foreach ($getEstado[2] as $key => $estado): ?>
				            		<?php if ($estado->est_status==1): ?>
				            			<option value="<?=$estado->est_id?>" ><?=$estado->est_uf?> - <?=$estado->est_nome?></option>
				            		<?php endif ?>
				            	<?php endforeach ?>
							</select>
				            <div class="invalid-feedback" style="width: 100%;">
				                Selecione uma opção
				            </div>
				        </div>
				    </div>
					<div class="col-md-5 mb-3">
				        <label for="nome" class="small text-dark">Nome <span id="text_nome"></span></label>
				        <div class="input-group">
				            <input id="nome" name="nome" type="text" placeholder="Nome" class="form-control text-uppercase" value="" required>
				            <div class="invalid-feedback" style="width: 100%;">
				                Informe  o nome
				            </div>
				        </div>
				    </div>
				    <div class="col-md-3 mb-3">
				    	<label for="status" class="small text-dark">Status</label>
				        <div class="input-group">
				            <select id="status" name="status" class="custom-select d-block w-100" required>
								<option value="1" >Ativo</option>
								<option value="0" >Inativo</option>
							</select>
				            <div class="invalid-feedback" style="width: 100%;">
				                Selecione uma opção
				            </div>
				        </div>
				    </div>
				</div>

				<div class="row pl-3 pr-3 pt-0">
			        <div class="col-md-12 mb-3 text-right">
			        	<button id="btn_cancelar" class="btn btn-secondary mr-2" style="border-radius: 50px" type="button">CANCELAR</button>
			        	<button id="btn_salvarcadastro" class="btn btn-success" style="border-radius: 50px" type="submit">SALVAR</button>
			        </div>
			    </div>			
			</form>
		<?php else: ?>
			<h1>Erro, nenhum estado encontrado para realizar cadastro de cidade!</h1>
		<?php endif ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 

		// Hides
			$('#div_formcadastro').hide();

		$('#btn_cancelar').click(function(){
			$('#div_formcadastro').hide();
			$('#tabela_cadastro').fadeIn(500);
		});

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
			submitForm('salvarcidade', form);
	    });

	}); // fim do ready

	function editarLoja(id) {
		$('#id').val( id );
		$('#idestado').val( $('#idestado-'+id).val() );
		$('#nome').val( $('#nome-'+id).val() );
		$('#status').val( $('#status-'+id).val() );
		$('#div_formcadastro').fadeIn(500);
		$('#tabela_cadastro').hide();
		setTimeout(function(){
			$('#idestado').focus();
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
                        location.replace('loja?view=formbairro&tabela='+$('#tabela').val());
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