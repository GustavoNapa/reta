<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// functions
    include '../../../page-sistema/cadastrobasico/function/cadastrobasico.php';

	$getCadastroBasico = getCadastroBasico( $_POST['tabela'] );

?>

<div id="tabela_cadastro" class="row">
	<div class="col-12">
		<table class="table table-striped">
			<thead>
				<tr class="row">
					<th class="col">
						<div class="row">
							<div class="col-sm-6 col-md-6 text-left">Descrição</div>
							<div class="col-sm-4 col-md-4 text-center">Status</div>
							<div class="col-sm-4 col-md-2 text-right">
								<button onclick="editarCadastroBasico(0)" class="btn btn-success btn-sm">
									<i class="icofont-plus"></i>&nbsp;&nbsp;
									NOVO
								</button>
								<!-- Importante -->
								<input id="nome-0" value="" type="text" readonly hidden>
								<input id="status-0" value="" type="text" readonly hidden>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>

				<?php if ( $getCadastroBasico[0]=="SUCESSO" ): ?>

					<?php if ( $getCadastroBasico[1]>0 ): ?>
						<?php foreach ( $getCadastroBasico[2] as $key => $value): ?>
							<?php
								// importante
								$id 	= $_POST['prefixo'].'_id';
								$nome 	= $_POST['prefixo'].'_nome';
								$status = $_POST['prefixo'].'_status';
								$status_text = $value->$status==1?'Ativo':'Inativo';
							?>
							<tr class="row">
								<td class="col">
									<div class="row">
										<div class="col-sm-6 col-md-6 text-left"><?=$value->$nome?></div>
										<div class="col-sm-4 col-md-4 text-center"><?=$status_text?></div>
										<div class="col-sm-4 col-md-2 text-right">
											<button onclick="editarCadastroBasico('<?=$value->$id?>')" class="btn btn-primary btn-sm">
												<i class="icofont-ui-edit"></i>&nbsp;&nbsp;
												Editar
											</button>
										</div>

										<!-- Importante -->
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
								<?=$getCadastroBasico[2]?>
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
		<form id="form_cadastro" class="needs-validation" novalidate>
			<!-- IMPORTANTE -->
				<input id="id" name="id" type="text" value="" readonly hidden>
				<input id="tabela" name="tabela" type="text" value="<?=$_POST['tabela']?>" readonly hidden>
				<input id="prefixo" name="prefixo" type="text" value="<?=$_POST['prefixo']?>" readonly hidden>
				<input id="modal" name="modal" type="text" value="<?=$_POST['modal']?>" readonly hidden>

			<div class="row pl-3 pr-3 pt-0">
				<div class="col-md-12 mt-3 mb-3">
					<h4>Cadastro básico:</h4>
			    </div>
			</div>

			<div class="row pl-3 pr-3 pt-0">
				<div class="col-md-6 mb-3">
			        <label for="nome" class="small text-dark">Nome <span id="text_nome"></span></label>
			        <div class="input-group">
			            <input id="nome" name="nome" type="text" placeholder="Nome" class="form-control" value="" required>
			            <div class="invalid-feedback" style="width: 100%;">
			                Informe  o nome
			            </div>
			        </div>
			    </div>
			    <div class="col-md-6 mb-3">
			    	<label for="status" class="small text-dark">Status</label>
			        <div class="input-group">
			            <select id="status" name="status" class="custom-select d-block w-100  controle_dep" required>
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
			submitForm('salvarcadastro', form);
	    });

	}); // fim do ready

	function editarCadastroBasico(id) {
		$('#id').val( id );
		$('#nome').val( $('#nome-'+id).val() );
		$('#status').val( $('#status-'+id).val() );
		$('#div_formcadastro').fadeIn(500);
		$('#tabela_cadastro').hide();
		setTimeout(function(){
			$('#nome').focus();
        }, 300);
	}

	function validarcampo(campo) {
		$.ajax({
			url:    'page-sistema/cadastrobasico/controller/cadastrobasico.php',
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
			url:    'page-sistema/cadastrobasico/controller/cadastrobasico.php',
			type:   'POST',
			data:   'acao='+acao+'&'+form,
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				// console.log(retorno);
				if (arrRetorno[0]=="SUCESSO") {
                    swal({
                      title: "SUCESSO",
                      text: arrRetorno[1],
                      icon: "success",
                      buttons: false,
                    });
                    setTimeout(function(){
                        location.replace('cadastrobasico?view=modal&tabela='+$('#tabela').val());
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