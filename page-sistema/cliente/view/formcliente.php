<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar cliente
	if ( isset($_GET['cli_id']) && $_GET['cli_id']!="" ) {
		$getCliente = fd_getCliente( array('cli_id' => $_GET['cli_id'] ) );

		if ( $getCliente[0]!="SUCESSO" && $getCliente[1]!=1 ) {
			fgb_erro( 'Cliente não encontrado', 'Não encontramos o cliente com id: '.$_GET['cli_id'], 'formcliente.php', 'NOTFOUND' );
            exit;
		}

		$_cliente=$getCliente[2][0];

		$getBasicoCliente = fd_getBasicoCliente();
	}else{
		$getBasicoCliente = fd_getBasicoCliente(1);
	}

	if ( $getBasicoCliente[0]=="SUCESSO" ) {
		if ( $getBasicoCliente[DB_PREFIX."_sexo"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de sexo não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo sexo', 'formcliente.php', 'NOTFOUND' );
            exit;
		}

		if ( $getBasicoCliente[DB_PREFIX."_estadocivil"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de estado civil não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo estado civil', 'formcliente.php', 'NOTFOUND' );
            exit;
		}

		if ( $getBasicoCliente[DB_PREFIX."_motivobloqueio"]['total']<=0 ) {
			fgb_erro( 'Cadastro básico de motivo bloqueio não encontrado', 'Não encontramos no cadastro básico, dados para listar no campo motivo bloqueio', 'formcliente.php', 'NOTFOUND' );
            exit;
		}

		$_sexo 				= $getBasicoCliente[DB_PREFIX."_sexo"]['resultado'];
		$_estadocivil 		= $getBasicoCliente[DB_PREFIX."_estadocivil"]['resultado'];
		$_motivobloqueio	= $getBasicoCliente[DB_PREFIX."_motivobloqueio"]['resultado'];
	}
?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">
		<div class="card shadow mb-3">
			<div class="card-header">

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-12 mb-3">
						<b>CADASTRO DE CLIENTE</b>
						<a href="cliente" type="button" class="btn btn-secondary btn-sm float-right" style="border-radius: 50px;">
							<i class="fas fa-undo-alt"></i>
							<span class="d-none d-md-inline">VOLTAR</span>
						</a>
					</div>

					<!-- IMPORTANTE -->
					<input id="cli_id" name="cli_id" type="text" value="<?=$_cliente->cli_id?>" readonly hidden>
				</div>

				<div class="row pl-3 pr-3 pt-0">
					<div class="col-12">
						<ul id="cadastro_cliente" class="nav nav-tabs card-header-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#tab_dadosprincipais" role="tab" aria-controls="tab_dadosprincipais" aria-selected="true">Dados principais</a>
							</li>

							<?php if ( isset($_GET['cli_id']) && $_GET['cli_id']!="" ): ?>
								<li class="nav-item">
									<a class="nav-link"  href="#tab_dependente" role="tab" aria-controls="tab_dependente" aria-selected="false">Dependente</a>
								</li>
							<?php endif ?>
								
							<!-- <li class="nav-item">
								<a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Deals</a>
							</li> -->
						</ul>
					</div>
				</div>
			</div>
			<div class="card-body">

				<div class="tab-content mt-3">
					<div id="tab_dadosprincipais" class="tab-pane active" role="tabpanel">
						<form id="form_cliente" class="needs-validation" novalidate>
							
							<div class="row pl-3 pr-3 pt-0">
								<div class="col-md-5 mb-3">
							        <label for="cli_cpfcnpj" class="small text-dark text_cpfcnpj">CPF <span id="cli_validacao" validacao=""></span></label>
							        <div class="input-group">
							            <div class="input-group-prepend novocliente">
											<button id="btn_cpfcnpj" opcao="CNPJ" class="btn btn-info open_cpfcnpj" type="button"><i class="fas fa-exchange-alt"></i></button>
										</div>
							            <input id="cli_cpfcnpj" name="cli_cpfcnpj" type="text" class="form-control open_cpfcnpj cpf" placeholder="CPF" required validar_cliente="ON" value="<?=$_cliente->cli_cpfcnpj?>">
							            <div class="input-group-prepend novocliente">
											<button id="btn_novocliente" class="btn btn-success open_cpfcnpj" type="button"><i class="fas fa-check"></i></button>
											<a id="btn_editarcliente" class="btn btn-primary open_cpfcnpj" type="button" href="#"><i class="fas fa-eye"></i></a>
										</div>
								        <div class="invalid-feedback" style="width: 100%;">
							                Informe um <span class="text_cpfcnpj">CPF</span> [válido]
							            </div>
							        </div>
							        <?php if ( !isset($_GET['cli_id']) && $_GET['cli_id']=="" ): ?>
							        	<span class="small text-muted">Clique em <i class="text-info fas fa-exchange-alt"></i> para <span class="text_alternar">CNPJ</span></span>
							        <?php endif ?>
							    </div>
							    <div class="col-md-7 mb-3">
							        <label for="cli_nome" class="small text-dark text_nome">Nome Completo</label>
							        <div class="input-group">
							            <div class="input-group-prepend">
							                <span class="input-group-text"><i class="far fa-user"></i></span>
							            </div>
							            <input id="cli_nome" name="cli_nome" type="text" class="form-control text_nome" placeholder="Nome completo" required pattern="[\wà-úÀ-Ú ]+[\s]{1,}/?[\wà-úÀ-Ú ]*" value="<?=$_cliente->cli_nome?>">
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe <span class="text_nome_2">o nome do cliente</span>
							            </div>
							        </div>
							    </div>
							</div>

							<div class="row pl-3 pr-3 pt-0">
								<div class="col-md-4 mb-3">
							        <label for="cli_idsexo" class="small text-dark">Sexo</label>
							        <div class="input-group">
							            <select id="cli_idsexo" name="cli_idsexo" class="custom-select d-block w-100 controle_tipo controle_cnpj" required>
							            	<option value hidden>- Selecione -</option>
							            	<?php foreach ($_sexo as $key => $sexo): ?>
							            		<option value="<?=$sexo->sex_id?>" <?=$sexo->sex_id==$_cliente->cli_idsexo?'selected':''?>>
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
							        <label for="cli_idestadocivil" class="small text-dark">Estado Civil</label>
							        <div class="input-group">
							            <select id="cli_idestadocivil" name="cli_idestadocivil" class="custom-select d-block w-100  controle_tipo controle_cnpj" required>
											<option value hidden>- Selecione -</option>
											<?php foreach ($_estadocivil as $key => $estadocivil): ?>
							            		<option value="<?=$estadocivil->ecv_id?>" <?=$estadocivil->ecv_id==$_cliente->cli_idestadocivil?'selected':''?>>
							            			<?=$estadocivil->ecv_nome?>
							            		</option>
							            	<?php endforeach ?>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							    <div class="col-md-4 mb-3">
							        <label for="cli_dtnasc" class="small text-dark text_data">Data de nascimento</label>
							        <div class="input-group">
							            <input id="cli_dtnasc" name="cli_dtnasc" type="date" class="form-control text_data" required value="<?=$_cliente->cli_dtnasc?>">
							            <div class="input-group-prepend">
							                <span id="label_dtnasc_cli" class="input-group-text">&nbsp;&nbsp;&nbsp;</span>
							            </div>
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe a <span class="text_data">data de nascimento</span>
							            </div>
							        </div>
							    </div>
							</div>

							<div class="row pl-3 pr-3 pt-0">
								<div class="col-md-4 mb-3">
							        <label for="cli_status" class="small text-dark">Associado inativo?</label>
							        <div class="input-group">
							        	<div class="input-group-prepend" align="center">
							                <span class="input-group-text">
							                	<div class="custom-control custom-checkbox">
													<input id="cli_status" name="cli_status" type="checkbox" class="custom-control-input">
													<label class="custom-control-label" for="cli_status"></label>
												</div>
											</span>
							            </div>
							            <select id="cli_idmotivobloqueio" name="cli_idmotivobloqueio" class="custom-select " required>
											<option value hidden>- Selecione -</option>
											<?php foreach ($_motivobloqueio as $key => $motivobloqueio): ?>
							            		<option value="<?=$motivobloqueio->mtb_id?>" <?=$motivobloqueio->mtb_id==$_cliente->cli_idmotivobloqueio?'selected':''?>>
							            			<?=$motivobloqueio->mtb_nome?>
							            		</option>
							            	<?php endforeach ?>
										</select>
							            <div class="invalid-feedback" style="width: 100%;">
							                Selecione uma opção
							            </div>
							        </div>
							    </div>
							    <div class="col-md-4 mb-3">
							        <label for="cli_dtbloqueio" class="small text-dark">Data bloqueio</label>
							        <div class="input-group">
							            <input id="cli_dtbloqueio" name="cli_dtbloqueio" type="date" class="form-control " required value="<?=$_cliente->cli_dtbloqueio?>">
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe data do bloqueio
							            </div>
							        </div>
							    </div>
							</div>

							<div class="row pl-3 pr-3 pt-0">
								<div class="col-md-6 mb-3">
							        <label for="cli_nomecartao" class="small text-dark">Nome no cartão</label>
							        <div class="input-group">
							            <input id="cli_nomecartao" name="cli_nomecartao" type="text" placeholder="Nome no cartão" class="form-control " required value="<?=$_cliente->cli_nomecartao?>" >
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe nome no cartão
							            </div>
							        </div>
							    </div>
							    <div class="col-md-6 mb-3">
							        <label for="cli_email" class="small text-dark">Email</label>
							        <div class="input-group">
							            <input id="cli_email" name="cli_email" type="email" placeholder="Email" class="form-control " required value="<?=$_cliente->cli_email?>">
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe email
							            </div>
							        </div>
							    </div>
							</div>

							<div class="row pl-3 pr-3 pt-0">
								<div class="col-md-4 mb-3">
							        <label for="cli_telefone" class="small text-dark">Telefone fixo</label>
							        <div class="input-group">
							            <input id="cli_telefone" name="cli_telefone" type="text" placeholder="Telefone" class="form-control telefone" value="<?=$_cliente->cli_telefone?>" >
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe telefone
							            </div>
							        </div>
							    </div>
							    <div class="col-md-4 mb-3">
							        <label for="cli_celular" class="small text-dark">Celular</label>
							        <div class="input-group">
							            <input id="cli_celular" name="cli_celular" type="text" placeholder="Celular" class="form-control celular" value="<?=$_cliente->cli_celular?>">
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe celular
							            </div>
							        </div>
							    </div>
							    <div class="col-md-4 mb-3">
							        <label for="cli_contato" class="small text-dark">Outros</label>
							        <div class="input-group">
							            <input id="cli_contato" name="cli_contato" type="text" placeholder="Outro contato" class="form-control telefone" value="<?=$_cliente->cli_contato?>">
							            <div class="invalid-feedback" style="width: 100%;">
							                Informe outro contato
							            </div>
							        </div>
							    </div>
							</div>

						    <div class="row pl-3 pr-3 pt-0">
						    	<div class="col-md-3 mb-3">
						            <label class="small" for="end_cep">CEP *</label>
						            <div class="input-group">
						              <div class="input-group-prepend">
						                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
						              </div>
						              <input id="end_cep" name="end_cep" type="text" class="form-control end_cep" placeholder="CEP" required  value="<?=$_cliente->end_cep?>">
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
						            <input id="end_logradouro" name="end_logradouro" type="text" class="form-control input_end" placeholder="Logradouro" readonly  value="<?=$_cliente->end_logradouro?>">
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
						            <input id="end_numero" name="end_numero" type="text" class="form-control input_end" placeholder="Nº" readonly  value="<?=$_cliente->end_numero?>">
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
						            <textarea id="end_complemento" name="end_complemento" maxlength="100" type="text" class="form-control input_end" placeholder="Complemento" readonly><?=$_cliente->end_complemento?></textarea>
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
						            <input id="end_bairro" name="end_bairro" type="text" class="form-control input_end input_end" placeholder="Bairro" readonly  value="<?=$_cliente->end_bairro?>">
						            <div class="invalid-feedback" style="width: 100%;">
						              Campo obrigatório
						            </div>
						          </div>
						        </div>
						        <div class="col-md-6 mb-3">
						          <label for="end_cidade">Cidade</label>
						          <div class="input-group">
						            <input id="end_cidade" name="end_cidade" type="text" class="form-control input_end" placeholder="Cidade" readonly  value="<?=$_cliente->end_cidade?>">
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
						            <input id="end_estado" name="end_estado" type="text" class="form-control input_end" placeholder="Estado" readonly  value="<?=$_cliente->end_estado?>">
						            <div class="invalid-feedback" style="width: 100%;">
						              Campo obrigatório
						            </div>
						          </div>
						        </div>
						        <div class="col-md-6 mb-3">
						          <label for="end_pais">País</label>
						          <div class="input-group">
						            <input id="end_pais" name="end_pais" type="text" class="form-control input_end" placeholder="Brasil" readonly  value="<?=$_cliente->end_pais==""?'Brasil':$_cliente->end_pais?>">
						            <div class="invalid-feedback" style="width: 100%;">
						              Campo obrigatório
						            </div>
						          </div>
						        </div>
						    </div>

						    <div class="row pl-3 pr-3 pt-0">
						        <div class="col-md-12 mb-3">
						          <label for="cli_observacao">Observação</label>
						          <div class="input-group">
						            <textarea id="cli_observacao" name="cli_observacao" minlength="5" maxlength="100" type="text" class="form-control" placeholder="Observação"><?=$_cliente->cli_observacao?></textarea>
						          </div>
						        </div>
						    </div>

						    <div class="row pl-3 pr-3 pt-0">
						        <div class="col-md-12 mb-3">
						        	<button class="btn btn-outline-success float-right" style="border-radius: 50px">SALVAR</button>
						        </div>
						    </div>
						</form>
					</div>
					
					<?php if ( isset($_GET['cli_id']) && $_GET['cli_id']!="" ): ?>
						<div id="tab_dependente" class="tab-pane" role="tabpanel">

							<table id="table_dependente" class="table table-hover mt-0 pt-0">
								<thead>
									<tr class="row table-secondary pl-3 pr-3 pt-0">
										<th scope="col" class="col-12 pt-1 pb-1">
											<div class="row">
												<div class="col-3 small text-left">
													<b>CPF</b>
												</div>
												<div class="col-4 small text-left">
													<b>NOME</b>
												</div>
												<div class="col-3 small text-left">
													<b>RELAÇÃO</b>
												</div>
												<div class="col-2 text-right">
													#
												</div>
											</div>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr class="row pl-3 pr-3 pt-0">
										<td class="col-12 mb-1">
											<div class="row">
												<div class="col-3 small text-left">
													11024565602
												</div>
												<div class="col-4 small text-left">
													PEDRO HERNANE SANTOS AQUI
												</div>
												<div class="col-3 small text-left">
													FILHO
												</div>
												<div class="col-2 text-right">
													<button class="btn btn-sm btn-primary">
														<i class="fas fa-eye"></i>
													</button>
												</div>
											</div>
										</td>
									</tr>

									<tr class="row pl-3 pr-3 pt-0">
										<td class="col-12 mb-1">
											<div class="row">
												<div class="col-3 small text-left">
													11024565602
												</div>
												<div class="col-4 small text-left">
													PEDRO HERNANE SANTOS AQUI
												</div>
												<div class="col-3 small text-left">
													FILHO
												</div>
												<div class="col-2 text-right">
													<button class="btn btn-sm btn-primary">
														<i class="fas fa-eye"></i>
													</button>
												</div>
											</div>
										</td>
									</tr>

									<tr class="row pl-3 pr-3 pt-0">
										<td class="col-12 mb-1">
											<div class="row">
												<div class="col-3 small text-left">
													11024565602
												</div>
												<div class="col-4 small text-left">
													NOME DO DEPENDENTE AQUI
												</div>
												<div class="col-3 small text-left">
													FILHO
												</div>
												<div class="col-2 text-right">
													<button class="btn btn-sm btn-primary">
														<i class="fas fa-eye"></i>
													</button>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

							<hr>
							<div class="row pl-3 pr-3 pt-0">
								<div class="col-12 mb-3">
							        <button id="btn_formdependente" class="btn btn-outline-primary float-right" style="border-radius: 50px" type="button">NOVO DEPENDENTE</button>
							    </div>
							</div>

							<form id="form_dependente" class="needs-validation" novalidate>							
								<div class="row pl-3 pr-3 pt-0">
									<div class="col-md-4 mb-3">
								        <label for="dep_cpf" class="small text-dark">CPF <span id="dep_validacao" validacao=""></span></label>
								        <div class="input-group">
								            <input id="dep_cpf" name="dep_cpf" type="text" class="form-control cpf" placeholder="CPF" required validar_dependente="ON" value="<?=$_cliente->dep_cpf?>">
								            <div class="input-group-prepend novodependente">
												<button id="btn_novodependente" class="btn btn-success" type="button"><i class="fas fa-check"></i></button>
											</div>
									        <div class="invalid-feedback" style="width: 100%;">
								                Informe um CPF [válido]
								            </div>
								        </div>
								    </div>
								    <div class="col-md-6 mb-3">
								        <label for="dep_nome" class="small text-dark">Nome do Dependente</label>
								        <div class="input-group">
								            <div class="input-group-prepend">
								                <span class="input-group-text"><i class="fas fa-people-arrows"></i></span>
								            </div>
								            <input id="dep_nome" name="dep_nome" type="text" class="form-control controle_dep" placeholder="Nome do Dependente" required pattern="[\wà-úÀ-Ú ]+[\s]{1,}/?[\wà-úÀ-Ú ]*" value="<?=$_cliente->dep_nome?>">
								            <div class="invalid-feedback" style="width: 100%;">
								                Informe <span class="text_nome_2">o nome do dependente</span>
								            </div>
								        </div>
								    </div>

								    <div class="col-2 mb-3">
								        <label for="dep_status" class="small text-dark">Status</label>
								        <div class="input-group">
								            <select id="dep_status" name="dep_status" class="custom-select d-block w-100  controle_dep" required>
												<option value="1">Ativo</option>
												<option value="0">Inativo</option>
											</select>
								            <div class="invalid-feedback" style="width: 100%;">
								                Selecione uma opção
								            </div>
								        </div>
								    </div>
								</div>

								<div class="row pl-3 pr-3 pt-0">
									<div class="col-md-4 mb-3">
								        <label for="dep_relacao" class="small text-dark">Relação</label>
								        <div class="input-group">
								            <select id="dep_relacao" name="dep_relacao" class="custom-select d-block w-100 controle_dep controle_cnpj" required>
								            	<option value hidden>- Selecione -</option>
								            	<?php foreach ($_relacao as $key => $relacao): ?>
								            		<option value="<?=$relacao->rel_id?>" <?=$relacao->rel_id==$_cliente->dep_idrelacao?'selected':''?>>
								            			<?=$relacao->rel_nome?>
								            		</option>
								            	<?php endforeach ?>
											</select>
								            <div class="invalid-feedback" style="width: 100%;">
								                Selecione uma opção
								            </div>
								        </div>
								    </div>
								    <div class="col-md-4 mb-3">
								        <label for="dep_idsexo" class="small text-dark">Sexo</label>
								        <div class="input-group">
								            <select id="dep_idsexo" name="dep_idsexo" class="custom-select d-block w-100 controle_dep" required>
								            	<option value hidden>- Selecione -</option>
								            	<?php foreach ($_sexo as $key => $sexo): ?>
								            		<option value="<?=$sexo->sex_id?>" <?=$sexo->sex_id==$_cliente->dep_idsexo?'selected':''?>>
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
								        <label for="dep_dtnasc" class="small text-dark">Data de nascimento</label>
								        <div class="input-group">
								            <input id="dep_dtnasc" name="dep_dtnasc" type="date" class="form-control controle_dep" required value="<?=$_cliente->dep_dtnasc?>">
								            <div class="input-group-prepend">
								                <span id="label_dtnasc_dep" class="input-group-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								            </div>
								            <div class="invalid-feedback" style="width: 100%;">
								                Informe a data de nascimento
								            </div>
								        </div>
								    </div>
								</div>

							    <div class="row pl-3 pr-3 pt-0">
							        <div class="col-md-12 mb-3">
							        	<button class="btn btn-outline-success float-right" style="border-radius: 50px">SALVAR</button>
							        </div>
							    </div>
							</form>						
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 

		// se for cadastro novo
		$('#btn_novocliente, #btn_editarcliente, #btn_novodependente').hide();
		if ( $('#cli_id').val()=="" ) {
			$('#form_cliente, #form_dependente').find('input, button, select, textarea').attr('disabled', true);
			setTimeout(function(){
	            $('.open_cpfcnpj').attr('disabled', false);
	            $('#cli_cpfcnpj').focus();
	        }, 1500);
		}

		// Calcular idade - PROIBE O CADASTRO DE MENORES DE IDADE
        $('#cli_dtnasc, #dep_dtnasc').bind("blur, focus, mouseover", function() {

            //recupera valor e tamanho do campo em variaveis
            var data = $(this).val();
            var tamanho = data.length;

            //só valida a partir do momento que o campo esta totalmente preenchido
            if (tamanho >= 10) {
            	var origem = $(this).attr('id').split('_')[0];
            	$("#label_dtnasc_"+origem).html(calcularIdade(data));
            }
        });

		<?php if ( isset($_GET['cli_id']) && $_GET['cli_id']!="" ): ?>
	    	setTimeout(function(){
				$('#form_cliente').find('input, button, select, textarea').attr('disabled', false);
				setTimeout(function(){
					if ( $('#btn_cpfcnpj').attr('opcao')=="CPF" ) {
						$('.controle_cnpj').attr('readonly', true);
						$('.controle_cnpj').attr('required', true);
						$('.controle_cnpj').attr('disabled', true);
					}
		            $('#cli_cpfcnpj').attr('validar_cliente', 'OFF');
		            $('#cli_cpfcnpj').attr('readonly', true);
					$('#cli_cpfcnpj').attr('disabled', true);
					$('#btn_cpfcnpj').hide();
					$('#cli_nome').focus();

					<?php if ( $_cliente->cli_tipo=="J" ): ?>
						$('.controle_tipo').attr('readonly', true);
						$('.controle_tipo').attr('required', true);
						$('.controle_tipo').attr('disabled', true);
					<?php endif ?>
						
		        }, 300);
			}, 300);

			setInterval(function(){ 
				if ( $('#dep_cpf').val().length>7 ) {
					if ( validarCPF( $('#dep_cpf').val() ) ) {
						if ( $('#dep_validacao').attr('validacao')=="" ) {
							$('#dep_validacao').html(' - <span class="text-success"> Válido! <span id="dep_disponibilidade" class="text-secondary">Aguarde...</span></span>');
						}
						validar_cliente('dependente');
					} else {
						$('#dep_validacao').html(' - <span class="text-danger"> inválido!</span>');
						$('#btn_novodependente').hide();
					}
				}else{
					$('#btn_novodependente').hide();
				}
			}, 100);
		<?php else: ?>
			setInterval(function(){ 
				if ( $('#cli_cpfcnpj').attr('placeholder')=="CPF" ) {
					if ( $('#cli_cpfcnpj').val().length>7 ) {
						if ( validarCPF( $('#cli_cpfcnpj').val() ) ) {
							if ( $('#cli_validacao').attr('validacao')=="" ) {
								$('#cli_validacao').html(' - <span class="text-success"> Válido! <span id="cli_disponibilidade" class="text-secondary">Aguarde...</span></span>');
							}
							validar_cliente();
						} else {
							$('#cli_validacao').html(' - <span class="text-danger"> inválido!</span>');
							$('#btn_novocliente, #btn_editarcliente').hide();
						}
					}else{
						$('#btn_novocliente, #btn_editarcliente').hide();
					}
				} else {
					if ( $('#cli_cpfcnpj').val().length>10 ) {
						if ( validarCNPJ( $('#cli_cpfcnpj').val() ) ) {
							if ( $('#cli_validacao').attr('validacao')=="" ) {
								$('#cli_validacao').html(' - <span class="text-success"> Válido! <span id="cli_disponibilidade" class="text-secondary">Aguarde...</span></span>');
							}
							validar_cliente();
						} else {
							$('#cli_validacao').html(' - <span class="text-danger"> inválido!</span>');
							$('#btn_novocliente, #btn_editarcliente').hide();
						}
					}else{
						$('#btn_novocliente, #btn_editarcliente').hide();
					}
				}
			}, 100);
	    <?php endif ?>

		setInterval(function(){ 
			if ( $('#cli_status').is(':checked') ) {
				$('#cli_idmotivobloqueio').attr('readonly', false);
				$('#cli_idmotivobloqueio').attr('required', false);
				$('#cli_idmotivobloqueio').attr('disabled', false);
				$('#cli_dtbloqueio').attr('readonly', false);
				$('#cli_dtbloqueio').attr('required', false);
				$('#cli_dtbloqueio').attr('disabled', false);
			} else {
				$('#cli_idmotivobloqueio').attr('readonly', true);
				$('#cli_idmotivobloqueio').attr('required', true);
				$('#cli_idmotivobloqueio').attr('disabled', true);
				$('#cli_dtbloqueio').attr('readonly', true);
				$('#cli_dtbloqueio').attr('required', true);
				$('#cli_dtbloqueio').attr('disabled', true);
			}

			$('#cli_dtnasc, #dep_dtnasc').mouseover();
		}, 100);	

		$('#cli_cpfcnpj, #dep_cpf').mask("999.999.999-99");
		$('#btn_cpfcnpj').click(function(event) {
			if ( $(this).attr('opcao')=="CNPJ" ) {
				$('.text_alternar').html('CPF');
				$('.text_cpfcnpj').html('CNPJ');
				$('#cli_cpfcnpj').val();
				$('#cli_cpfcnpj').mask("99.999.999/9999-99");
				$('#cli_cpfcnpj').attr('placeholder', 'CNPJ');
				$('#cli_cpfcnpj').removeClass('form-control cpf').addClass('form-control cnpj');
				$(this).attr('opcao', 'CPF');

				$('.text_nome').html('Razão social');
				$('.text_nome').attr('placeholder', 'Razão social');
				$('.text_nome_2').attr('placeholder', 'a Razão social');
				$('.text_data').html('Data de fundação');

				if ( $('#cli_id').val()!="" ) {
					$('.controle_tipo').attr('readonly', true);
					$('.controle_tipo').attr('required', true);
					$('.controle_tipo').attr('disabled', true);
				}
			} else {
				$('.text_alternar').html('CNPJ');
				$('.text_cpfcnpj').html('CPF');
				$('#cli_cpfcnpj').val();
				$('#cli_cpfcnpj').mask("999.999.999-99");
				$('#cli_cpfcnpj').attr('placeholder', 'CPF');
				$('#cli_cpfcnpj').removeClass('form-control cnpj').addClass('form-control cpf');
				$(this).attr('opcao', 'CNPJ');

				$('.text_nome').html('Nome Completo');
				$('.text_nome').attr('placeholder', 'Nome Completo')
				$('.text_nome_2').html('placeholder', 'o nome completo')
				$('.text_data').html('Data de nascimento');

				if ( $('#cli_id').val()!="" ) {
					$('.controle_tipo').attr('readonly', false);
					$('.controle_tipo').attr('required', false);
					$('.controle_tipo').attr('disabled', false);
				}
					
			}
		});

		// importante
		$('#cadastro_cliente a').on('click', function (e) {
			e.preventDefault()
			$(this).tab('show')
		});

	    // Controle de endereço
	      $('#bloquear_end').hide(); 
	      $('#bloquear_reg').hide();
	      $('#end_cep').mask("99999-999");
	      // controle para ver senha
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

	    // btn_novocliente
		$('#btn_novocliente').click(function(event) {
			$('.novocliente').hide();
			$('#form_cliente').find('input, button, select, textarea').attr('disabled', false);
			setTimeout(function(){
				if ( $('#btn_cpfcnpj').attr('opcao')=="CPF" ) {
					$('.controle_cnpj').attr('readonly', true);
					$('.controle_cnpj').attr('required', true);
					$('.controle_cnpj').attr('disabled', true);
				}
	            $('#cli_cpfcnpj').attr('validar_cliente', 'OFF');
	            $('#cli_cpfcnpj').attr('readonly', true);
				$('#cli_cpfcnpj').attr('disabled', true);
				$('#cli_nome').focus();
	        }, 300);
		});

		// btn_novodependente
		$('#btn_novodependente').click(function(event) {
			$('.novodependente').hide();
			$('#form_dependente').find('input, button, select, textarea').attr('disabled', false);
			setTimeout(function(){
	            $('#dep_cpf').attr('validar_dependente', 'OFF');
	            $('#dep_cpf').attr('readonly', true);
				$('#dep_cpf').attr('disabled', true);
				$('#dep_nome').focus();
	        }, 300);
		});

	    // HIDE
	    $('#form_dependente').hide();

	    $('#btn_formdependente').click(function(event) {
	    	$(this).hide();
	    	$('#form_dependente').find('.controle_dep').attr('disabled', true);
	    	$('#form_dependente').show(500);
		    $('#table_dependente').hide();
		    setTimeout(function(){
	            $('#dep_cpf').attr('disabled', false);
	            $('#dep_cpf').focus();
	        }, 500);
	    });

	    $("#form_cliente").submit(function(event) {
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
	      $('#form_cliente').find("input,select,textarea").attr("disabled", false);
	      var form = $('#form_cliente').serialize();
	      submitForm('salvarcliente', form);
	    });

	}); // fim do ready

	function calcularIdade(data) {
        var dataNascimento = data;
        var d = new Date,
        ano_atual = d.getFullYear(),
        mes_atual = d.getMonth(),
        dia_atual = d.getDate(),

        split = dataNascimento.split('-'),
        ano_nascimento = split[0],
        mes_nascimento = split[1],
        dia_nascimento = split[2],

        quantos_anos = ano_atual - ano_nascimento;

        //valida se a pessoa já fez aniversario no ano
        if (mes_atual <= mes_nascimento && dia_atual < dia_nascimento) {
            quantos_anos--;
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
        }
    }

	function validar_cliente(dependente="") {
		if (dependente=="") {
			if ( $('#cli_cpfcnpj').attr('validar_cliente')=='ON' ) {
				$.ajax({
					url:    'page-sistema/cliente/controller/cliente.php',
					type:   'POST',
					data:   'acao=validarcpfcnpj&cpfcnpj='+$("#cli_cpfcnpj").val(),
					success: function(retorno){
						var arrRetorno = retorno.split('||');
						console.log(retorno);
						switch (arrRetorno[0]) {

							case 'CLIENTEENCONTRADO':
								$('#cli_disponibilidade').html('Cliente encontrado!');
								$('#btn_editarcliente').fadeIn(500);
								$('#btn_novocliente').hide();
								$('#cli_validacao').attr('validacao', arrRetorno[0]);
								$('#btn_editarcliente').attr('href', 'cliente?view=formcliente&cli_id='+arrRetorno[1]);
							break;

							case 'NOVOCLIENTE':
								$('#cli_disponibilidade').html('Novo cliente');
								$('#btn_novocliente').fadeIn(500);
								$('#btn_editarcliente').hide();
								$('#cli_validacao').attr('validacao', arrRetorno[0]);
								$('#btn_editarcliente').attr('href', '#');
							break;

							default:
								console.log(retorno);
								$('#cli_validacao').attr('validacao', '');
							break;
						}
					} // fim da function
			    }); // fim do ajax
			}
		} else {
			if ( $('#dep_cpf').attr('validar_dependente')=='ON' ) {
				$.ajax({
					url:    'page-sistema/cliente/controller/cliente.php',
					type:   'POST',
					data:   'acao=validarcpfcnpj&cpfcnpj='+$("#dep_cpf").val(),
					success: function(retorno){
						var arrRetorno = retorno.split('||');
						console.log(retorno);
						switch (arrRetorno[0]) {

							case 'CLIENTEENCONTRADO':
								$('#dep_disponibilidade').html('<span class="text-danger">CPF em USO</span>');
								$('#btn_novodependente').hide();
								$('#dep_validacao').attr('validacao', arrRetorno[0]);
							break;

							case 'NOVOCLIENTE':
								$('#dep_disponibilidade').html('CPF disponível');
								$('#btn_novodependente').fadeIn(500);
								$('#dep_validacao').attr('validacao', arrRetorno[0]);
							break;

							default:
								console.log(retorno);
								$('#dep_validacao').attr('validacao', '');
							break;
						}
					} // fim da function
			    }); // fim do ajax
			}
		}
	}

	// function
	function submitForm(acao, form) {
		$.ajax({
			url:    'page-sistema/cliente/controller/cliente.php',
			type:   'POST',
			data:   'acao='+acao+'&cli_id='+$("#cli_id").val()+'&'+form,
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				console.log(retorno);
				if (arrRetorno[0]=="SUCESSO") {
                    swal({
                      title: "SUCESSO",
                      text: arrRetorno[1],
                      icon: "success",
                      buttons: false,
                    });
                    if ( arrRetorno[3]!="" ) {
                    	setTimeout(function(){
	                        location.replace('cliente?view=formcliente&cli_id='+arrRetorno[3]);
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