<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar nivel acesso
	$getNivelAcesso = acb_getNivelAcesso();

	if ( $getNivelAcesso[0]!="SUCESSO" || $getNivelAcesso[1]<=0 ) {
		fgb_erro( 'Cadastro básico de nivel de acesso não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo nivel de acesso', 'formusuario.php', 'NOTFOUND' );
        exit;
	}

	$_nivelacesso = $getNivelAcesso[2];
?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">
		<div class="card shadow mb-3">
			<div class="card-header">
				<div class="row pl-3 pr-3 pt-0">
					<div class="col-12 mb-3">
						<b>NÍVEL DE ACESSO</b>
						<a onclick="verFormCadastro()" id="btn_novo" type="button" class="btn btn-success btn-sm float-right text-light" style="border-radius: 50px;">
							<i class="fas fa-plus"></i>
							<span class="d-none d-md-inline">NOVO</span>
						</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">

						<table id="table_acesso" class="table table-striped">
							<thead>
								<tr class="row">
									<th class="col">
										<div class="row">
											<div class="col-md-5 text-left">
												Descrição
											</div>
											<div class="col-md-4 text-center">
												Status
											</div>
											<div class="col-md-3 text-right">
												#
											</div>
										</div>
									</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ( $_nivelacesso as $key => $acesso ): ?>
									<tr class="row">
										<td class="col">
											<div class="row mb-1">
												<div class="col-md-5 text-left">
													<?=$acesso->nva_nome?>
												</div>
												<div class="col-md-4 text-center">
													<?=$acesso->nva_status==1?'Ativo':'Inativo'?>
												</div>
												<div class="col-md-3 text-right">

													<button onclick="verFormCadastro('<?=$acesso->nva_id?>')" class="btn btn-secondary btn-sm" type="button">
														<i class="fas fa-pencil-alt"></i>
													</button>

													<!-- IMPORTANTE -->
													<input 
														id="nva_status-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_status?>" 
														hidden
													>
													<input 
														id="nva_nome-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_nome?>" 
														hidden
													>
													<input 
														id="nva_gerenciarbasico-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_gerenciarbasico?>"
														hidden
													>
													<input 
														id="nva_gerenciarconfiguracao-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_gerenciarconfiguracao?>" 
														hidden
													>				
													<input 
														id="nva_gerenciarcliente-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_gerenciarcliente?>" hidden
													>
													<input 
														id="nva_gerenciarproduto-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_gerenciarproduto?>"
														hidden
													>
													<input 
														id="nva_gerenciarusuario-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_gerenciarusuario?>"
														hidden
													>
													<input 
														id="nva_gerenciarloja-<?=$acesso->nva_id?>"
														value="<?=$acesso->nva_gerenciarloja?>" 
														hidden
													>

													<button id="bnt-down-<?=$acesso->nva_id?>" onclick="$(this).hide();$('#bnt-up-<?=$acesso->nva_id?>').show();" class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#registro-<?=$acesso->nva_id?>">
														<i class="icofont-simple-down"></i>
													</button>
													<button id="bnt-up-<?=$acesso->nva_id?>" onclick="$(this).hide();$('#bnt-down-<?=$acesso->nva_id?>').show();" class="btn btn-primary btn-sm btn-hide" type="button" data-toggle="collapse" data-target="#registro-<?=$acesso->nva_id?>">
														<i class="icofont-simple-up"></i>
													</button>
												</div>
											</div>

											<div id="registro-<?=$acesso->nva_id?>" class="row collapse registro-<?=$acesso->nva_id?>">
												<div class="col-md-4">
													<b>Gerenciar cadastro básico?</b>
													<?=$acesso->nva_gerenciarbasico==1?'Sim':'Não'?>
												</div>
												<div class="col-md-4">
													<b>Gerenciar configuração?</b>
													<?=$acesso->nva_gerenciarconfiguracao==1?'Sim':'Não'?>
												</div>
												<div class="col-md-4">
													<b>Gerenciar cliente?</b>
													<?=$acesso->nva_gerenciarcliente==1?'Sim':'Não'?>
												</div>
												<div class="col-md-4">
													<b>Gerenciar produto?</b>
													<?=$acesso->nva_gerenciarproduto==1?'Sim':'Não'?>
												</div>
												<div class="col-md-4">
													<b>Gerenciar usuário?</b>
													<?=$acesso->nva_gerenciarusuario==1?'Sim':'Não'?>
												</div>
												<div class="col-md-4">
													<b>Gerenciar loja?</b>
													<?=$acesso->nva_gerenciarloja==1?'Sim':'Não'?>
												</div>

											</div>
										</td>
									</tr>
								<?php endforeach ?>

							</tbody>
						</table>

						<form id="form_cadastro" class="needs-validation" novalidate>
							<!-- IMPORTANTE -->
								<input id="nva_id" name="nva_id" type="text" value="" readonly hidden>

							<div class="row pl-3 pr-3 pt-0">
								<div class="col-md-6 mb-3">
							        <label for="nva_nome" class="small text-dark">Nome <span id="text_nome"></span></label>
							        <div class="input-group">
							            <input id="nva_nome" name="nva_nome" type="text" placeholder="Nome" class="form-control" value="" required>
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe  o nome
							            </div>
							        </div>
							    </div>
							    <div class="col-md-6 mb-3">
							    	<label for="nva_status" class="small text-dark">Status</label>
							        <div class="input-group">
							            <select id="nva_status" name="nva_status" class="custom-select d-block w-100" required>
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
							    <div class="col-md-3 mb-3">
							    	<label for="nva_gerenciarbasico" class="small text-dark">Gerenciar cadastro básico?</label>
							        <div class="input-group">
							            <select id="nva_gerenciarbasico" name="nva_gerenciarbasico" class="custom-select d-block w-100" required>
											<option value="" hidden disabled selected >Selecione</option>
											<option value="1" >Sim</option>
											<option value="0" >Não</option>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							    <div class="col-md-3 mb-3">
							    	<label for="nva_gerenciarconfiguracao" class="small text-dark">Gerenciar configuração?</label>
							        <div class="input-group">
							            <select id="nva_gerenciarconfiguracao" name="nva_gerenciarconfiguracao" class="custom-select d-block w-100" required>
											<option value="" hidden disabled selected >Selecione</option>
											<option value="1" >Sim</option>
											<option value="0" >Não</option>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							    <div class="col-md-3 mb-3">
							    	<label for="nva_gerenciarcliente" class="small text-dark">Gerenciar cliente?</label>
							        <div class="input-group">
							            <select id="nva_gerenciarcliente" name="nva_gerenciarcliente" class="custom-select d-block w-100" required>
											<option value="" hidden disabled selected >Selecione</option>
											<option value="1" >Sim</option>
											<option value="0" >Não</option>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							    <div class="col-md-3 mb-3">
							    	<label for="nva_gerenciarproduto" class="small text-dark">Gerenciar produto?</label>
							        <div class="input-group">
							            <select id="nva_gerenciarproduto" name="nva_gerenciarproduto" class="custom-select d-block w-100" required>
											<option value="" hidden disabled selected >Selecione</option>
											<option value="1" >Sim</option>
											<option value="0" >Não</option>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							</div>

							<div class="row pl-3 pr-3 pt-0">
							    <div class="col-md-3 mb-3">
							    	<label for="nva_gerenciarusuario" class="small text-dark">Gerenciar usuário?</label>
							        <div class="input-group">
							            <select id="nva_gerenciarusuario" name="nva_gerenciarusuario" class="custom-select d-block w-100" required>
											<option value="" hidden disabled selected >Selecione</option>
											<option value="1" >Sim</option>
											<option value="0" >Não</option>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							    <div class="col-md-3 mb-3">
							    	<label for="nva_gerenciarloja" class="small text-dark">Gerenciar loja?</label>
							        <div class="input-group">
							            <select id="nva_gerenciarloja" name="nva_gerenciarloja" class="custom-select d-block w-100" required>
											<option value="" hidden disabled selected >Selecione</option>
											<option value="1" >Sim</option>
											<option value="0" >Não</option>
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
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 

		// HIDE
			$('.btn-hide, #form_cadastro').hide()
			$('.dinheiro').mask("0.000,00", {reverse: true});

		setTimeout(function(){
            $('#nva_nome').focus();
        }, 300);

        setInterval(function(){ 
			if ( $('#nva_nome').val().length>4 ) {
				validarnivelacesso('nome');
			}

			// if ( $('#nva_permitirdesconto').is(':checked') ) {
			// 	$('#nva_limitedesconto').attr('readonly', false);
			// 	$('#nva_limitedesconto').attr('required', false);
			// 	$('#nva_limitedesconto').attr('disabled', false);
			// } else {
			// 	$('#nva_limitedesconto').attr('readonly', true);
			// 	$('#nva_limitedesconto').attr('required', true);
			// 	$('#nva_limitedesconto').attr('disabled', true);
			// }

			// if ( $('#nva_abrircaixa').is(':checked') ) {
			// 	$('#nva_limitesangria').attr('readonly', false);
			// 	$('#nva_limitesangria').attr('required', false);
			// 	$('#nva_limitesangria').attr('disabled', false);
			// } else {
			// 	$('#nva_limitesangria').attr('readonly', true);
			// 	$('#nva_limitesangria').attr('required', true);
			// 	$('#nva_limitesangria').attr('disabled', true);
			// }
		}, 100);

		$("#btn_cancelar").click(function(event) {
	      	event.preventDefault();
			$('#table_acesso, #btn_novo').fadeIn();
			$('#form_cadastro').hide();
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
			aguarde('', 'processando informações, por favor aguarde...');
			$('#form_cadastro').find("input,select,textarea").attr("disabled", false);
			var form = $('#form_cadastro').serialize();
			submitForm('salvaracesso', form);
	    });

	}); // fim do ready

	function validarnivelacesso(campo) {
		$.ajax({
			url:    'page-sistema/usuario/controller/usuario.php',
			type:   'POST',
			data:   'acao=validarnivelacesso&nva_id='+$("#nva_id").val()+'&campo='+$('#nva_'+campo).attr("id")+'&valor='+$('#nva_'+campo).val(),
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				// console.log(retorno);
				if ( arrRetorno[0]=="DISPONIVEL" ) {
					$('#text_'+campo).html('<span class="text-success"> - Disponível</span>');
					$('#btn_salvarcadastro').attr('disabled', false);
				} else {
					$('#text_'+campo).html('<span class="text-danger"> - Indisponível</span>');
					$('#btn_salvarcadastro').attr('disabled', true);
				}
			} // fim da function
	    }); // fim do ajax
	}

	function verFormCadastro(nva_id="") {
		if ( nva_id!="" ) {
			$('#nva_id').val( nva_id );
			$('#nva_nome').val( $('#nva_nome-'+nva_id).val() );
			$('#nva_status').val( $('#nva_status-'+nva_id).val() );
			$('#nva_gerenciarbasico').val( $('#nva_gerenciarbasico-'+nva_id).val() );
			$('#nva_gerenciarconfiguracao').val( $('#nva_gerenciarconfiguracao-'+nva_id).val() );
			$('#nva_gerenciarcliente').val( $('#nva_gerenciarcliente-'+nva_id).val() );
			$('#nva_gerenciarproduto').val( $('#nva_gerenciarproduto-'+nva_id).val() );
			$('#nva_gerenciarusuario').val( $('#nva_gerenciarusuario-'+nva_id).val() );
			$('#nva_gerenciarloja').val( $('#nva_gerenciarloja-'+nva_id).val() );
		}else{
			$('#form_cadastro')[0].reset();
		}

		$('#table_acesso, #btn_novo').hide();
		$('#form_cadastro').fadeIn();
	}

	// function
	function submitForm(acao, form) {
		$.ajax({
			url:    'page-sistema/usuario/controller/usuario.php',
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
                    if ( $("#nva_id").val()=="" ) {
                		setTimeout(function(){
	                        location.replace('usuario?view=nivelacesso&nva_id='+arrRetorno[2]);
	                    }, 1500);
                	} else {
                		setTimeout(function(){
	                        location.reload();
	                    }, 1500);
                	}
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