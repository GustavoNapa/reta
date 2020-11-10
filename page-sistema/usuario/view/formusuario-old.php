<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar usuário
	if ( isset($_GET['usu_id']) && $_GET['usu_id']!="" ) {
		$getUsuario = acb_getUsuario( array('usu_id' => $_GET['usu_id'] ) );

		if ( $getUsuario[0]!="SUCESSO" && $getUsuario[1]!=1 ) {
			fgb_erro( 'Usuário não encontrado', 'Não encontramos o usuário com id: '.$_GET['usu_id'], 'formusuario.php', 'NOTFOUND' );
            exit;
		}

		$_usuario=$getUsuario[2][0];

		$getBasicoUsuario = acb_getBasicoUsuario();
	}else{
		$getBasicoUsuario = acb_getBasicoUsuario(1);
	}

	if ( $getBasicoUsuario[0]=="SUCESSO" ) {
		if ( $getBasicoUsuario[DB_PREFIX."_nivelacesso"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de nivel de acesso não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo nivel de acesso', 'formusuario.php', 'NOTFOUND' );
            exit;
		}

		if ( $getBasicoUsuario[DB_PREFIX."_sexo"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de sexo não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo sexo', 'formusuario.php', 'NOTFOUND' );
            exit;
		}

		if ( $getBasicoUsuario[DB_PREFIX."_estadocivil"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de estado civil não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo estado civil', 'formusuario.php', 'NOTFOUND' );
            exit;
		}

		if ( $getBasicoUsuario[DB_PREFIX."_setor"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de setor não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo setor', 'formusuario.php', 'NOTFOUND' );
            exit;
		}

		$_nivelacesso 		= $getBasicoUsuario[DB_PREFIX."_nivelacesso"]['resultado'];
		$_sexo 				= $getBasicoUsuario[DB_PREFIX."_sexo"]['resultado'];
		$_estadocivil 		= $getBasicoUsuario[DB_PREFIX."_estadocivil"]['resultado'];
		$_setor				= $getBasicoUsuario[DB_PREFIX."_setor"]['resultado'];
	}

?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">

		<div class="card shadow mb-3">
			<div class="card-header">
				<div class="row pl-3 pr-3 pt-0">
					<div class="col-12 mb-3">
						<b>CADASTRO DE USUÁRIO</b>
						<div class="float-right">
							<?php if ( isset($_GET['usu_id']) && $_GET['usu_id']!="" ): ?>
								<button onclick="visualizarimpressao('<?=$_usuario->usu_id?>')" class="btn btn-info btn-sm mr-2" style="border-radius: 50px;" type="button">
									<i class="icofont-printer"></i>
									<span class="d-none d-md-inline">VISUALIZAR</span>
								</button>
							<?php endif ?>
							<a href="usuario" type="button" class="btn btn-secondary btn-sm" style="border-radius: 50px;">
								<i class="fas fa-undo-alt"></i>
								<span class="d-none d-md-inline">VOLTAR</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form id="form_usuario" class="needs-validation" novalidate>
					<!-- IMPORTANTE -->
					<input id="usu_id" name="usu_id" type="text" value="<?=$_usuario->usu_id?>" readonly hidden>
					<input id="end_id" name="end_id" type="text" value="<?=$_usuario->end_id?>" readonly hidden>
					<input id="controle_usuario" name="controle_usuario" type="text" value="<?=$_usuario->usu_status==1?'NOCHANGE':''?>" valueantigo="<?=$_usuario->usu_status==1?'NOCHANGE':''?>" readonly hidden>

		            <h4 class="text-secondary">Dados pessoais</h4>

					<div class="row pl-3 pr-3 pt-0">
						<div class="col-md-5 mb-3">
					        <label for="usu_cpf" class="small text-dark">CPF <span id="usu_validacao" validacao=""></span></label>
					        <div class="input-group">
					            <div class="input-group-prepend">
					                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
					            </div>
					            <input id="usu_cpf" name="usu_cpf" type="text" class="form-control open_cpf cpf" placeholder="CPF" required validar_usuario="ON" value="<?=$_usuario->usu_cpf?>">
					            <div class="input-group-prepend novousuario">
									<button id="btn_novousuario" class="btn btn-success open_cpf" type="button"><i class="fas fa-check"></i></button>
									<a id="btn_editarusuario" class="btn btn-primary open_cpf" type="button" href="#"><i class="fas fa-eye"></i></a>
								</div>
						        <div class="invalid-feedback" style="width: 100%;">
					                Informe um CPF [válido]
					            </div>
					        </div>
					    </div>
					    <div class="col-md-7 mb-3">
					        <label for="usu_nome" class="small text-dark text_nome">Nome Completo</label>
					        <div class="input-group">
					            <div class="input-group-prepend">
					                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
					            </div>
					            <input id="usu_nome" name="usu_nome" type="text" class="form-control text_nome" placeholder="Nome completo" required pattern="[\wà-úÀ-Ú ]+[\s]{1,}/?[\wà-úÀ-Ú ]*" value="<?=$_usuario->usu_nome?>">
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe <span class="text_nome_2">o nome do usuário</span>
					            </div>
					        </div>
					    </div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
						<div class="col-md-3 mb-3">
					        <label for="usu_idsexo" class="small text-dark">Sexo</label>
					        <div class="input-group">
					            <select id="usu_idsexo" name="usu_idsexo" class="custom-select d-block w-100 controle_tipo" required>
					            	<option value hidden>- Selecione -</option>
					            	<?php foreach ($_sexo as $key => $sexo): ?>
					            		<option value="<?=$sexo->sex_id?>" <?=$sexo->sex_id==$_usuario->usu_idsexo?'selected':''?>>
					            			<?=$sexo->sex_nome?>
					            		</option>
					            	<?php endforeach ?>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
					    </div>
					    <div class="col-md-4 mb-3">
					        <label for="usu_idestadocivil" class="small text-dark">Estado Civil</label>
					        <div class="input-group">
					            <select id="usu_idestadocivil" name="usu_idestadocivil" class="custom-select d-block w-100  controle_tipo" required>
									<option value hidden>- Selecione -</option>
									<?php foreach ($_estadocivil as $key => $estadocivil): ?>
					            		<option value="<?=$estadocivil->ecv_id?>" <?=$estadocivil->ecv_id==$_usuario->usu_idestadocivil?'selected':''?>>
					            			<?=$estadocivil->ecv_nome?>
					            		</option>
					            	<?php endforeach ?>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
					    </div>
					    <div class="col-md-5 mb-3">
					        <label for="usu_dtnasc" class="small text-dark text_data">Data de nascimento</label>
					        <div class="input-group">
					            <input id="usu_dtnasc" name="usu_dtnasc" type="date" class="form-control text_data" required value="<?=$_usuario->usu_dtnasc?>">
					            <div class="input-group-prepend">
					                <span id="label_dtnasc_usu" class="input-group-text">&nbsp;&nbsp;&nbsp;</span>
					            </div>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe a <span class="text_data">data de nascimento</span>
					            </div>
					        </div>
					    </div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
						<div class="col-md-6 mb-3">
					        <label for="usu_email" class="small text-dark">Email <span id="text_email"></span></label>
					        <div class="input-group">
					            <input id="usu_email" name="usu_email" type="email" placeholder="Email pessoal" class="form-control" minlength="4" required value="<?=$_usuario->usu_email?>">
					            <div class="input-group-prepend div_duvidaemail">
									<button onclick="$('.div_duvidaemail').hide();$('.duvida_email').fadeIn(500)" class="btn btn-secondary" type="button"><i class="icofont-question"></i></button>
								</div>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe email
					            </div>
					        </div>
					        <span class="text-muted small duvida_email">Não pode ser repetido no sistema<br>Pode ser usado no login</span>
					    </div>
					    <div class="col-md-6 mb-3">
					        <label for="usu_emailacb" class="small text-dark">Email ACB <span id="text_email"></span></label>
					        <div class="input-group">
					            <input id="usu_emailacb" name="usu_emailacb" type="email" placeholder="Email profissional" class="form-control" minlength="4" value="<?=$_usuario->usu_emailacb?>">
					        </div>
					    </div>
					</div>

		            <div class="row pl-3 pr-3 pt-0">
		              <div class="col-md-5 mb-3">
		                <label for="usu_telefone" class="small text-dark">Telefone</label>
		                <div class="input-group">
		                    <input id="usu_telefone" name="usu_telefone" type="text" placeholder="Telefone" class="form-control telefone" minlength="8" value="<?=$_usuario->usu_telefone?>">
		                    <div class="invalid-feedback" style="width: 100%;">
		                        Informe telefone
		                    </div>
		                </div>
		              </div>
		              <div class="col-md-7 mb-3">
		                <label for="usu_celular" class="small text-dark">Celular *</label>
		                <div class="input-group">
		                  <input id="usu_celular" name="usu_celular" type="text" class="form-control celular" placeholder="Só números"  value="<?=$_usuario->usu_celular?>" minlength="8">
		                  <div class="input-group-prepend">
		                    <div class="input-group-text">
		                      <div class="custom-control custom-checkbox">
		                        <input id="usu_whatsapp" name="usu_whatsapp" type="checkbox" class="custom-control-input">
		                        <label for="usu_whatsapp" class="custom-control-label">Whatsapp</label>
		                      </div>
		                    </div>
		                  </div>
		                  <div class="invalid-feedback">
		                    Informe seu celular.
		                  </div>
		                </div>
		              </div>
		            </div>

		            <div class="row pl-3 pr-3 pt-0">
						<div class="col-md-6 mb-3">
							<label for="usu_cargo" class="small text-dark">Cargo/Função</label>
							<div class="input-group">
								<input id="usu_cargo" name="usu_cargo" type="text" placeholder="Cargo/Função" class="form-control" value="<?=$_usuario->usu_cargo?>">
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="usu_corporativo" class="small text-dark">Nº Corporativo</label>
							<div class="input-group">
								<input id="usu_corporativo" name="usu_corporativo" type="text" placeholder="Telefone ACB" class="form-control contato" value="<?=$_usuario->usu_corporativo?>">
							</div>
						</div>
		            </div>

		            <div class="row pl-3 pr-3 pt-0">
						<div class="col-md-5 mb-3">
					    	<label for="usu_idsetor" class="small text-dark">Setor</label>
					        <div class="input-group">
					            <select id="usu_idsetor" name="usu_idsetor" class="custom-select d-block w-100  controle_dep" required>
					            	<option value hidden>- Selecione -</option>
					            	<?php foreach ($_setor as $key => $setor): ?>
					            		<option value="<?=$setor->set_id?>" <?=$setor->set_id==$_usuario->usu_idsetor?'selected':''?>>
					            			<?=$setor->set_nome?>
					            		</option>
					            	<?php endforeach ?>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
					        <span class="text-muted small">A comissão é calculada pelo setor</span>
					    </div>
						<div class="col-md-4 mb-3">
							<label for="usu_remuneracao" class="small text-dark">Remuneração</label>
							<div class="input-group">
								<input id="usu_remuneracao" name="usu_remuneracao" type="text" placeholder="Valor do salário" class="form-control dinheiro" value="<?=number_format($_usuario->usu_remuneracao, 2, ',', '.')?>">
								<div class="input-group-prepend">
									<span class="input-group-text">R$</span>
								</div>
							</div>
						</div>
		            </div>

		            <hr>
		            <h4 class="text-secondary">Endereço</h4>

				    <div class="row pl-3 pr-3 pt-0">
				    	<div class="col-md-3 mb-3">
				            <label class="small" for="end_cep">CEP *</label>
				            <div class="input-group">
				              <div class="input-group-prepend">
				                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
				              </div>
				              <input id="end_cep" name="end_cep" type="text" class="form-control end_cep" placeholder="CEP" required  value="<?=$_usuario->end_cep?>">
				              <div class="invalid-feedback" style="width: 100%;">
				                Campo obrigatório
				              </div>
				            </div>
				            <span class="text-muted small">
				              Digite somente os números e aguarde
				            </span>
				         </div>
				        <div class="col-sm-8 col-md-7 mb-3">
				          <label for="end_logradouro">Logradouro</label>
				          <div class="input-group">
				            <input id="end_logradouro" name="end_logradouro" type="text" class="form-control input_end" placeholder="Logradouro" readonly  value="<?=$_usuario->end_logradouro?>">
				            <div class="input-group-append">
				              <button id="desbloquear_end" type="button" class="btn btn-outline-dark btn-block">
				                  <i class="fas fa-lock"></i>
				              </button>
				              <div class="clearfix"></div>
				              <button id="bloquear_end" type="button" class="btn btn-outline-dark btn-block">
				                  <i class="fas fa-lock-open"></i>
				              </button>
				            </div>
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				          <span class="text-muted small">
				            Clique no botão <i id="text_block_icon" class="fas fa-lock"></i> para <span id="text_block">desbloquear</span> os campos
				          </span>
				        </div>
				        <div class="col-sm-2 col-md-2 mb-3">
				          <label for="end_numero">Nº</label>
				          <div class="input-group">
				            <input id="end_numero" name="end_numero" type="text" class="form-control input_end" placeholder="Nº" readonly  value="<?=$_usuario->end_numero?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-12 mb-3">
				          <label for="end_complemento">Complemento</label>
				          <div class="input-group">
				            <textarea id="end_complemento" name="end_complemento" maxlength="100" type="text" class="form-control input_end" placeholder="Complemento" readonly><?=$_usuario->end_complemento?></textarea>
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-6 mb-3">
				          <label for="end_bairro">Bairro</label>
				          <div class="input-group">
				            <input id="end_bairro" name="end_bairro" type="text" class="form-control input_end input_end" placeholder="Bairro" readonly  value="<?=$_usuario->end_bairro?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-6 mb-3">
				          <label for="end_cidade">Cidade</label>
				          <div class="input-group">
				            <input id="end_cidade" name="end_cidade" type="text" class="form-control input_end" placeholder="Cidade" readonly  value="<?=$_usuario->end_cidade?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-6 mb-3">
				          <label for="end_estado">Estado</label>
				          <div class="input-group">
				            <input id="end_estado" name="end_estado" type="text" class="form-control input_end" placeholder="Estado" readonly  value="<?=$_usuario->end_estado?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-6 mb-3">
				          <label for="end_pais">País</label>
				          <div class="input-group">
				            <input id="end_pais" name="end_pais" type="text" class="form-control input_end" placeholder="Brasil" readonly  value="<?=$_usuario->end_pais==""?'Brasil':$_usuario->end_pais?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				    </div>

		            <hr>

		            <div class="dadosdeacesso">
		            	<h4 class="text-secondary">Dados de acesso</h4>

		            	<div class="row pl-3 pr-3 pt-0">
							<div class="col-md-4 mb-3">
						        <label for="usu_username" class="small text-dark">Usuário <span id="text_username"></span></label>
						        <div class="input-group">
						            <input id="usu_username" name="usu_username" type="text" placeholder="Nome de usuário" class="form-control validar_campo controle_required" value="<?=$_usuario->usu_username?>">
						            <div class="invalid-feedback" style="width: 100%;">
						                Informe nome de usuário
						            </div>
						        </div>
						    </div>
						    <div class="col-md-4 mb-3">
						        <label for="usu_idnivelacesso" class="small text-dark">Nivel de acesso</label>
						        <div class="input-group">
						            <select id="usu_idnivelacesso" name="usu_idnivelacesso" class="custom-select d-block w-100 controle_required">
						            	<option value hidden>- Selecione -</option>
						            	<?php foreach ($_nivelacesso as $key => $nivelacesso): ?>
						            		<option value="<?=$nivelacesso->nva_id?>" <?=$nivelacesso->nva_id==$_usuario->usu_idnivelacesso?'selected':''?>>
						            			<?=$nivelacesso->nva_nome?>
						            		</option>
						            	<?php endforeach ?>
									</select>
						            <div class="invalid-feedback" style="width: 100%;">
						                Selecione uma opção
						            </div>
						        </div>
						    </div>
						    <div class="col-md-4 mb-3">
						    	<label for="usu_status" class="small text-dark">Status</label>
						        <div class="input-group">
						            <select id="usu_status" name="usu_status" class="custom-select d-block w-100 controle_required">
										<option value="1" <?=$_usuario->usu_status==1?'selected':''?> >Ativo</option>
										<option value="0" <?=$_usuario->usu_status==0?'selected':''?> >Inativo</option>
									</select>
						            <div class="invalid-feedback" style="width: 100%;">
						                Selecione uma opção
						            </div>
						        </div>
						    </div>
						</div>

						<div class="row pl-3 pr-3 pt-0">
						    <div class="col-md-6 mb-3">
						        <label for="usu_senha" class="small text-dark">Senha</label>
	                            <div class="input-group">
	                                <div class="input-group-prepend" onclick="$('#usu_senha').attr('type', 'password');$('#ver_senha').fadeIn();">
	                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
	                                </div>
	                                <input id="usu_senha" name="usu_senha" type="password" class="form-control controle_required" placeholder="Senha" minlength="4">
	                                <div id="ver_senha" class="input-group-prepend" onclick="$('#usu_senha').attr('type', 'text');$(this).hide();">
	                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
	                                </div>
	                                <div class="invalid-feedback" style="width: 100%;">
	                                    Informe sua senha de acesso
	                                </div>
	                            </div>
						    </div>
						    <div class="col-md-6 mb-3">
						        <label for="usu_confirme" class="small text-dark">Confirme</label>
	                            <div class="input-group">
	                                <div class="input-group-prepend" onclick="$('#usu_confirme').attr('type', 'password');$('#ver_senha').fadeIn();">
	                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
	                                </div>
	                                <input id="usu_confirme" name="usu_confirme" type="password" class="form-control controle_required" placeholder="Senha">
	                                <div id="ver_senha" class="input-group-prepend" onclick="$('#usu_confirme').attr('type', 'text');$(this).hide();">
	                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
	                                </div>
	                                <div class="invalid-feedback" style="width: 100%;">
	                                    Confirme sua senha de acesso
	                                </div>
	                            </div>
						    </div>
						</div>

						<hr>
		            </div>						

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-12 mt-3 mb-3">
				        	<button id="btn_dadosdeacesso" class="btn btn-secondary" style="border-radius: 50px" type="button"><i class="fas fa-user-lock"></i>&nbsp;&nbsp;DADOS DE ACESSO</button>
				        	<button id="btn_hidedadosacesso" class="btn btn-dark btn_hidedadosacesso" style="border-radius: 50px" type="button"><i class="fas fa-user-lock"></i>&nbsp;&nbsp;DADOS DE ACESSO</button>
				        	<button id="btn_salvarusuario" class="btn btn-outline-success float-right" style="border-radius: 50px" type="submit">SALVAR</button>
				        </div>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 

		setTimeout(function(){
			$('.back-to-top').click();
        }, 350);

		// Hides
			$('.dadosdeacesso, .duvida_email, .btn_hidedadosacesso').hide();	

		// Calcular idade
	        $('#usu_dtnasc').bind("blur, focus, mouseover", function() {
	            //recupera valor e tamanho do campo em variaveis
	            var data = $(this).val();
	            var tamanho = data.length;
	            var origem = $(this).attr('id').split('_')[0];
	            //só valida a partir do momento que o campo esta totalmente preenchido
	            if (tamanho >= 10) {
	            	$("#label_dtnasc_"+origem).html(calcularIdade(data));
	            }else{
	            	$("#label_dtnasc_"+origem).html('');
	            }
	        });

		<?php if ( isset($_GET['usu_id']) && $_GET['usu_id']!="" ): ?>

			// HIDE
				$('.novousuario').hide();

	    	setTimeout(function(){
				$('#form_usuario').find('input, button, select, textarea').attr('disabled', false);
				setTimeout(function(){
		            $('#usu_cpf').attr('validar_usuario', 'OFF');
		            $('#usu_cpf').attr('readonly', true);
					$('#usu_cpf').attr('disabled', true);
					$('#btn_cpf').hide();
					$('#usu_nome').focus();						
		        }, 300);
			}, 300);
		<?php else: ?>
			
			$('#form_usuario').find('input, button, select, textarea').attr('disabled', true);
			setTimeout(function(){
				$('.open_cpf').attr('disabled', false);
	            $('#usu_cpf').focus();
	        }, 300);

	        $('#usu_cpf').mask("999.999.999-99");
			
			setInterval(function(){ 
				if ( $('#usu_cpf').val().length>7 ) {
					if ( validarCPF( $('#usu_cpf').val() ) ) {
						if ( $('#usu_validacao').attr('validacao')=="" ) {
							$('#usu_validacao').html(' - <span class="text-success"> Válido! <span id="text_cpf" class="text-secondary">Aguarde...</span></span>');
							validarcampo('cpf');
						}
					} else {
						$('#usu_validacao').html(' - <span class="text-danger"> inválido!</span>');
						$('#usu_validacao').attr('validacao', '');
						$('#btn_novousuario, #btn_editarusuario').hide();
					}
				}else{
					$('#btn_novousuario, #btn_editarusuario').hide();
				}
			}, 100);

			// CPF valido
				$('#btn_novousuario').click(function(event) {
					$(this).hide();
					$('#form_usuario').find('input, button, select, textarea').attr('disabled', false);
					$('#usu_cpf').attr('disabled', true);
					$('#usu_nome').focus();
				});
	    <?php endif ?>

	    setInterval(function(){ 

	    	// validar contato
	    		if ( $('#usu_telefone').val().length>4 ) {
	    			$('#usu_celular').attr('required', false);
	    		} else {
	    			$('#usu_celular').attr('required', true);
	    		}

	    	// validarcampo
				if ( $('#usu_email').val().length>3 ) {
					validarcampo('email');
				}else{
					$('#text_email').html('');
				}

				if ( $('#usu_username').val().length>3 ) {
					validarcampo('username');
				}else{
					$('#text_username').html('');
				}

			// Calcular idade
				$('#usu_dtnasc').mouseover();
		}, 100);

	    // Controle de endereço
	      $('#bloquear_end').hide(); 
	      $('#end_cep').mask("99999-999");
	      $('#bloquear_end').click(function() {
	          $('.input_end').attr('readonly', true);
	          $('#text_block_icon').removeClass('fas fa-lock-open').addClass('fas fa-lock');
	          $('#text_block').html('desbloquear');
	          $('#desbloquear_end').fadeIn(500);
	          $('#bloquear_end').hide();
	      });
	      $('#desbloquear_end').click(function() {
	          $('.input_end').attr('readonly', false);
	          $('#text_block_icon').removeClass('fas fa-lock').addClass('fas fa-lock-open');
	          $('#text_block').html('bloquear');
	          $('#bloquear_end').fadeIn(500);
	          $('#desbloquear_end').hide(); 
	      });

	    // Controle de Acesso
	    	$('#btn_dadosdeacesso').click(function() {
	    		$(this).hide();
	    		$('.dadosdeacesso').fadeIn(500);
	    		$('.controle_required').attr('required', true);
	    		$('#btn_hidedadosacesso').fadeIn(500);
	    		$('#controle_usuario').val('ATIVO');
	    		$('#usu_username').focus();
			});
			$('#btn_hidedadosacesso').click(function() {
	    		$(this).hide();
	    		$('.dadosdeacesso').hide();
	    		$('.controle_required').attr('required', false);
	    		$('#btn_dadosdeacesso').fadeIn(500);
	    		$('#controle_usuario').val($('#controle_usuario').attr('valueantigo'));
			});

		$("#form_usuario").submit(function(event) {
			if ( $('#controle_usuario').val() == "ATIVO" ) {
				if ( $('#usu_senha').val() != $('#usu_confirme').val() ) {
		    		toastr["error"]("Confirme sua senha corretamente!");
			        this.classList.add('was-validated');
			        $('#usu_senha').focus();
			        return false;
		    	}
			}
		    	
			event.preventDefault();
			if (this.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
				toastr["warning"]("Confira os campos obrigatórios!");
				this.classList.add('was-validated');
				return false;
			}
			this.classList.add('was-validated');
			// aguarde('', 'processando informações, por favor aguarde...');
			$('#form_usuario').find('input, button, select, textarea').attr('disabled', false);
			var form = $('#form_usuario').serialize();
			submitForm('salvarusuario', form);
	    });

	}); // fim do ready

	function validarcampo(campo) {
		$.ajax({
			url:    'page-sistema/usuario/controller/usuario.php',
			type:   'POST',
			data:   'acao=validarcampo&usu_id='+$("#usu_id").val()+'&campo='+$('#usu_'+campo).attr("id")+'&valor='+$('#usu_'+campo).val(),
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				console.log(retorno);

				switch (campo) {
					case 'cpf':
						$('#usu_validacao').attr('validacao', 'OFF');
						if ( arrRetorno[0]=="DISPONIVEL" ) {
							$('#btn_editarusuario').hide();
							$('#btn_novousuario').fadeIn();
						} else {
							$('#btn_novousuario').hide();
							$('#btn_editarusuario').fadeIn();
							$('#btn_editarusuario').attr('href', 'usuario?view=formusuario&usu_id='+arrRetorno[2]);
						}
					break;

					default:
						// .....
					break;
				}
				
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

	function calcularIdade(data) {
	    var dataNascimento = data;
	    var d = new Date,
	    ano_atual = d.getFullYear();
	    mes_atual = d.getMonth()+1;
	    dia_atual = d.getDate();

	    split = dataNascimento.split('-');
	    ano_nascimento = split[0];
	    mes_nascimento = split[1];
	    dia_nascimento = split[2];

	    quantos_anos = ano_atual - ano_nascimento;

	    //valida se a pessoa já fez aniversario no ano
	    if ( mes_atual<mes_nascimento ) {
	      quantos_anos = quantos_anos-1;
	    }else{
	      if ( mes_atual==mes_nascimento ) {
	        if ( dia_nascimento > dia_atual ) {
	          quantos_anos = quantos_anos-1;
	        }
	      }
	    }

	    if(ano_nascimento != ''){
	        //caso seja menor de idade exibe mensagem avisando que se trata de um menor de idade
	        if(quantos_anos < 18){
	            // toastr["warning"]("Não é possivel associados com menos de 18 anos...");
	            return '<span style="color: #D40000FF;">  '+quantos_anos+' anos';
	            //caso seja maior que 150 anos exibe uma mensagem dizendo que esta data é invalida
	        }else if(quantos_anos >= 150){
	            // toastr["error"]("Idade maior que o permitido!");
	            return '<span style="color: #D40000FF;">  '+quantos_anos+' anos';
	            //caso a data esteja dentro do range estabelecido da uma mensagem de sucesso
	        }else{
	            // toastr["info"]("O associado possui "+quantos_anos+" anos de idade");
	            return '<span style="color: #4FAC03FF;">  '+quantos_anos+' anos';
	        }  
	    }else{
	      return '';
	    }
	}

	// function
	function submitForm(acao, form) {
		$.ajax({
			url:    'page-sistema/usuario/controller/usuario.php',
			type:   'POST',
			data:   'acao='+acao+'&usu_id='+$("#usu_id").val()+'&end_id='+$("#end_id").val()+'&'+form,
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
                    if ( $("#usu_id").val()=="" ) {
                		setTimeout(function(){
	                        location.replace('usuario?view=formusuario&usu_id='+arrRetorno[2]);
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

	<?php if ( isset($_GET['usu_id']) && $_GET['usu_id']!="" ): ?>
		function visualizarimpressao(argument) {
	        $.ajax({
	            url:    'page-sistema/usuario/view/imprimirusuario.php',
	            type:   'POST',
	            data:   'usu_id=<?=$_usuario->usu_id?>',
	            success: function(retornoloadfile){
	                abrirModalGlobal('<i class="icofont-printer"></i> <?=$_usuario->usu_nome?>', retornoloadfile, '<button id="btn_verdadosacesso" type="button" class="btn btn-primary"><i class="fas fa-user-lock"></i>&nbsp;&nbsp;Dados de acesso</button><button id="btn_verobservacao" type="button" class="btn btn-primary"><i class="icofont-ui-text-chat"></i>&nbsp;&nbsp;Observação</button><button id="btn_verassinatura" type="button" class="btn btn-primary"><i class="icofont-pen-alt-1"></i>&nbsp;&nbsp;Assinatura</button><button onclick="acb_imprimir()" type="button" class="btn btn-success"><i class="icofont-printer"></i>&nbsp;&nbsp;Imprimir</button>');
	                $("#modal_global_body").addClass('pt-0');
	            } // fim da function
	        }); // fim do ajax 
		}
	<?php endif ?>
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