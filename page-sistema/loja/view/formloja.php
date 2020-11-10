<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar loja
	if ( isset($_GET['loj_id']) && $_GET['loj_id']!="" ) {
		$getLoja = sc_getLoja( array('loj_id' => $_GET['loj_id'] ) );
		

		if ( $getLoja[0]!="SUCESSO" && $getLoja[1]!=1 ) {
			fgb_erro( 'Loja não encontrada', 'Não encontramos a loja com id: '.$_GET['loj_id'], 'formloja.php', 'NOTFOUND' );
            exit;
		}

		$_loja=$getLoja[2][0];

		if ( !is_null($_loja->loj_id) ) {
			$getRegiao = getRegiao( $_loja->loj_id );
		}
	}
?>

<form id="form_loja" class="needs-validation" novalidate>
	<div class="card shadow mb-3">
		<div class="card-header">
			<div class="row">
				<div class="col-12 h5">
					<i class="fas fa-store"></i> CADASTRO DE LOJA
					<a href="loja" type="button" class="btn btn-secondary btn-sm float-right" style="border-radius: 50px;">
						<i class="fas fa-undo-alt"></i>
						<span class="d-none d-md-inline">VOLTAR</span>
					</a>
				</div>

				<!-- IMPORTANTE -->
				<input id="loj_id" name="loj_id" type="text" value="<?=$_loja->loj_id?>" readonly hidden>
				<input id="end_id" name="end_id" type="text" value="<?=$_loja->end_id?>" readonly hidden>
			</div>

			<div class="row pl-3 pr-3 pt-0">
				<div class="col-12">
					<ul id="cadastro_loja" class="nav nav-tabs card-header-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link tab_dadosprincipais active" href="#tab_dadosprincipais" role="tab" aria-controls="tab_dadosprincipais" aria-selected="true">Dados principais</a>
						</li>

						<?php if ( !is_null($_loja->loj_id) ): ?>
							<li class="nav-item">
								<a class="nav-link tab_imgloja" href="#tab_imgloja" role="tab" aria-controls="tab_imgloja" aria-selected="false">Imagens da loja</a>
							</li>

							<li class="nav-item">
								<a class="nav-link tab_regiao" href="#tab_regiao" role="tab" aria-controls="tab_regiao" aria-selected="false">Região de Entrega</a>
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
					<!-- CNPJ -->
					<div class="row pl-3 pr-3 pt-0">
					    <div class="col-md-6 mb-3">
					        <label for="loj_cnpj" class="small text-dark">CNPJ <span id="loj_validacao" validacao=""></span></label>
					        <div class="input-group">
					            <div class="input-group-prepend">
					                <span class="input-group-text">
					                	<i class="fas fa-store"></i>
					                </span>
					            </div>
					            <input id="loj_cnpj" name="loj_cnpj" type="text" class="form-control cnpj" placeholder="CNPJ" required value="<?=$_loja->loj_cnpj?>">
					            <div class="input-group-prepend">
									<button id="btn_novaloja" class="btn btn-success open_cnpj" type="button"><i class="fas fa-check"></i></button>
									<a id="btn_editarloja" class="btn btn-primary open_cnpj" type="button" href="#"><i class="fas fa-eye"></i></a>
								</div>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o CNPJ da loja</span>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-3 mb-3">
					    	<label for="loj_status" class="small text-dark">Status</label>
					        <div class="input-group">
					            <select id="loj_status" name="loj_status" class="custom-select d-block w-100 controle_cnpj" required>
					            	<option value="" hidden>- Selecione -</option>
									<option value="1" <?=$_loja->loj_status==1||is_null($_loja->loj_status)?'selected':''?> >Ativo</option>
									<option value="0" <?=$_loja->loj_status==0&&!is_null($_loja->loj_status)?'selected':''?> >Inativo</option>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
				    	</div>
				    	<div class="col-md-3 mb-3">
					    	<label for="loj_disponibilidade" class="small text-dark">Disponibilidade</label>
					        <div class="input-group">
					            <select id="loj_disponibilidade" name="loj_disponibilidade" class="custom-select d-block w-100 controle_cnpj" required>
					            	<option value <?=$_loja->loj_disponibilidade==-1?'selected':''?> hidden>- Selecione -</option>
									<option value="1" <?=$_loja->loj_disponibilidade==1?'selected':''?> >Mostrar no site</option>
									<option value="0" <?=$_loja->loj_disponibilidade==0?'selected':''?> >Ocultar do site</option>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
				    	</div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
					    <div class="col-md-6 mb-3">
					        <label for="loj_razaosocial" class="small text-dark">Razão Social <span id="text_razaosocial" class="text-secondary"></span></label>
					        <div class="input-group">
					            <div class="input-group-prepend">
					                <span class="input-group-text"><i class="far fa-user"></i></span>
					            </div>
					            <input id="loj_razaosocial" name="loj_razaosocial" type="text" class="form-control controle_cnpj" placeholder="Razão Social" required pattern="[\wà-úÀ-Ú ]+[\s]{1,}/?[\wà-úÀ-Ú ]*" maxlength="50" value="<?=$_loja->loj_razaosocial?>">
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe a Razão Social da loja</span>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-6 mb-3">
					        <label for="loj_nomefantasia" class="small text-dark">Nome Fantasia</label>
					        <div class="input-group">
					            <input id="loj_nomefantasia" name="loj_nomefantasia" type="text" class="form-control controle_cnpj" placeholder="Nome Fantasia" required minlength="4" maxlength="50" value="<?=$_loja->loj_nomefantasia?>">
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o nome da loja</span>
					            </div>
					        </div>
					    </div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
						<div class="col-md-6 mb-3">
					        <label for="loj_im" class="small text-dark">Inscrição Municipal</label>
					        <div class="input-group">
					            <input id="loj_im" name="loj_im" type="text" class="form-control controle_cnpj" placeholder="Inscrição Municipal" value="<?=$_loja->loj_im?>">
					        </div>
					    </div>
					    <div class="col-md-6 mb-3">
					        <label for="loj_ie" class="small text-dark">Inscrição Estadual</label>
					        <div class="input-group">
					            <input id="loj_ie" name="loj_ie" type="text" class="form-control controle_cnpj" placeholder="Inscrição Estadual" value="<?=$_loja->loj_ie?>">
					        </div>
					    </div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
					    <div class="col-md-4 mb-3">
					        <label for="loj_email" class="small text-dark">Email</label>
					        <div class="input-group">
					            <input id="loj_email" name="loj_email" type="email" class="form-control controle_cnpj" placeholder="Email" value="<?=$_loja->loj_email?>" required>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o Email da loja
					            </div>
					        </div>
					    </div>
						<div class="col-md-4 mb-3">
							<label for="loj_telefone" class="small text-dark">Telefone</label>
							<div class="input-group">
								<input id="loj_telefone" name="loj_telefone" type="text" placeholder="Telefone" class="form-control controle_cnpj telefone" minlength="8" required value="<?=$_loja->loj_telefone?>">
								<div class="invalid-feedback" style="width: 100%;">
									Informe o telefone da loja
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="loj_celular" class="small text-dark">Celular</label>
							<div class="input-group">
								<input id="loj_celular" name="loj_celular" type="text" class="form-control celular controle_cnpj" placeholder="Só números"  value="<?=$_loja->loj_celular?>" minlength="8" required>
								<div class="input-group-prepend">
									<div class="input-group-text">
										<div class="custom-control custom-checkbox">
											<input id="loj_whatsapp" name="loj_whatsapp" type="checkbox" class="custom-control-input controle_cnpj">
											<label for="loj_whatsapp" class="custom-control-label"><i class="fab fa-whatsapp"></i></label>
										</div>
									</div>
								</div>
								<div class="invalid-feedback">
									Informe o celular da loja
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
				              <input id="end_cep" name="end_cep" type="text" class="form-control end_cep controle_cnpj" placeholder="CEP" required  value="<?=$_loja->end_cep?>">
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
				            <input id="end_logradouro" name="end_logradouro" type="text" class="form-control input_end" placeholder="Logradouro" readonly  value="<?=$_loja->end_logradouro?>">
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
				            <input id="end_numero" name="end_numero" type="text" class="form-control input_end" placeholder="Nº" readonly  value="<?=$_loja->end_numero?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-4 mb-3">
				          <label for="end_complemento">Complemento</label>
				          <div class="input-group">
				            <input id="end_complemento" name="end_complemento" type="text" class="form-control input_end input_end" placeholder="Complemento" readonly  value="<?=$_loja->end_complemento?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_bairro">Bairro</label>
				          <div class="input-group">
				            <input id="end_bairro" name="end_bairro" type="text" class="form-control input_end input_end" placeholder="Bairro" readonly  value="<?=$_loja->end_bairro?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_cidade">Cidade</label>
				          <div class="input-group">
				            <input id="end_cidade" name="end_cidade" type="text" class="form-control input_end" placeholder="Cidade" readonly  value="<?=$_loja->end_cidade?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-4 mb-3">
				          <label for="end_estado">Estado</label>
				          <div class="input-group">
				            <input id="end_estado" name="end_estado" type="text" class="form-control input_end" placeholder="Estado" readonly  value="<?=$_loja->end_estado?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_pais">País</label>
				          <div class="input-group">
				            <input id="end_pais" name="end_pais" type="text" class="form-control input_end" placeholder="Brasil" readonly  value="<?=$_loja->end_pais==""?'Brasil':$_loja->end_pais?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_googlemaps">Google Maps</label>
				          <div class="input-group">
				            <input id="end_googlemaps" name="end_googlemaps" type="link" class="form-control input_end input_end controle_cnpj" placeholder="Link"  value="<?=$_loja->end_googlemaps?>">
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-12 mb-3">
				          <label for="loj_descricao">Descrição</label>
				          <div class="input-group">
				            <textarea id="loj_descricao" name="loj_descricao" minlength="20" maxlength="250" type="text" class="form-control controle_cnpj" placeholder="Descrição sobre a loja" rows="3" required><?=$_loja->loj_descricao?></textarea>
				            <div class="invalid-feedback" style="width: 100%;">
				              Descreva a loja
				            </div>
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-12 mb-3 text-right">
				        	<button id="btn_cancelardep" type="button" class="btn btn-outline-danger mr-3" style="border-radius: 50px">CANCELAR</button>
				        	<button type="submit" class="btn btn-outline-success" style="border-radius: 50px">SALVAR</button>
				        </div>
				    </div>
				</div>

				<?php if ( !is_null($_loja->loj_id) ): ?>
					<div id="tab_imgloja" class="tab-pane" role="tabpanel">

						<div class="row pl-3 pr-3 pt-0 mb-3">
							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(1)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 1</button>
									<button onclick="delete_imagem( 1, 'loj_ambiente1' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(1)" type="button" class="btn btn-success btn-sm send_hide send_ambiente1"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="loj_ambiente1-<?=$_loja->loj_id?>" name="loj_ambiente1-<?=$_loja->loj_id?>" class="file_ambiente" img_id="1" type="file" hidden>
									<input id="loj_ambiente1_name" name="loj_ambiente1_name" type="text" hidden>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(2)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 2</button>
									<button onclick="delete_imagem( 2, 'loj_ambiente2' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(2)" type="button" class="btn btn-success btn-sm send_hide send_ambiente2"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="loj_ambiente2-<?=$_loja->loj_id?>" name="loj_ambiente2-<?=$_loja->loj_id?>" class="file_ambiente" img_id="2" type="file" hidden>
									<input id="loj_ambiente2_name" name="loj_ambiente2_name" type="text" hidden>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(3)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 3</button>
									<button onclick="delete_imagem( 3, 'loj_ambiente3' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(3)" type="button" class="btn btn-success btn-sm send_hide send_ambiente3"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="loj_ambiente3-<?=$_loja->loj_id?>" name="loj_ambiente3-<?=$_loja->loj_id?>" class="file_ambiente" img_id="3" type="file" hidden>
									<input id="loj_ambiente3_name" name="loj_ambiente3_name" type="text" hidden>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(4)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 4</button>
									<button onclick="delete_imagem( 4, 'loj_ambiente4' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(4)" type="button" class="btn btn-success btn-sm send_hide send_ambiente4"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="loj_ambiente4-<?=$_loja->loj_id?>" name="loj_ambiente4-<?=$_loja->loj_id?>" class="file_ambiente" img_id="4" type="file" hidden>
									<input id="loj_ambiente4_name" name="loj_ambiente4_name" type="text" hidden>
								</div>
							</div>
						</div>

						<div class="row pl-3 pr-3 pt-0">
							<div class="col-md-12">
								
								<div class="slick_ambiente">

									<div>
										<div class="div_ambiente bg-secondary shadow ml-2 mr-2">
											<div class="img_ambiente">
												<?php if ( file_exists('page-sistema/loja/media/'.$_loja->loj_ambiente1) && !is_null($_loja->loj_ambiente1) ): ?>
													<img id="img_ambiente1" src="page-sistema/loja/media/<?=$_loja->loj_ambiente1?>" class="img-fluid img_ambiente1" alt="Imagem do ambiente da loja">
												<?php else: ?>
													<img id="img_ambiente1" src="page-sistema/loja/media/loj_ambiente1.png" class="img-fluid img_ambiente1" alt="Imagem 1 do ambiente da loja">
												<?php endif ?>
											</div>
										</div>
										<div class="text-center text-secondary">
											Imagem 1
										</div>
									</div>

									<div>
										<div class="div_ambiente bg-secondary shadow ml-2 mr-2">
											<div class="img_ambiente">
												<?php if ( file_exists('page-sistema/loja/media/'.$_loja->loj_ambiente2) && !is_null($_loja->loj_ambiente2) ): ?>
													<img id="img_ambiente2" src="page-sistema/loja/media/<?=$_loja->loj_ambiente2?>" class="img-fluid img_ambiente2" alt="Imagem do ambiente da loja">
												<?php else: ?>
													<img id="img_ambiente2" src="page-sistema/loja/media/loj_ambiente2.png" class="img-fluid img_ambiente2" alt="Imagem 2 do ambiente da loja">
												<?php endif ?>
											</div>
										</div>
										<div class="text-center text-secondary">
											Imagem 2
										</div>
									</div>

									<div>
										<div class="div_ambiente bg-secondary shadow ml-2 mr-2">
											<div class="img_ambiente">
												<?php if ( file_exists('page-sistema/loja/media/'.$_loja->loj_ambiente3) && !is_null($_loja->loj_ambiente3) ): ?>
													<img id="img_ambiente3" src="page-sistema/loja/media/<?=$_loja->loj_ambiente3?>" class="img-fluid img_ambiente3" alt="Imagem do ambiente da loja">
												<?php else: ?>
													<img id="img_ambiente3" src="page-sistema/loja/media/loj_ambiente3.png" class="img-fluid img_ambiente3" alt="Imagem 3 do ambiente da loja">
												<?php endif ?>
											</div>
										</div>
										<div class="text-center text-secondary">
											Imagem 3
										</div>
									</div>

									<div>
										<div class="div_ambiente bg-secondary shadow ml-2 mr-2">
											<div class="img_ambiente">
												<?php if ( file_exists('page-sistema/loja/media/'.$_loja->loj_ambiente4) && !is_null($_loja->loj_ambiente4) ): ?>
													<img id="img_ambiente4" src="page-sistema/loja/media/<?=$_loja->loj_ambiente4?>" class="img-fluid img_ambiente4" alt="Imagem do ambiente da loja">
												<?php else: ?>
													<img id="img_ambiente4" src="page-sistema/loja/media/loj_ambiente4.png" class="img-fluid img_ambiente4" alt="Imagem 4 do ambiente da loja">
												<?php endif ?>
											</div>
										</div>
										<div class="text-center text-secondary">
											Imagem 4
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="row pl-3 pr-3 pt-3 mb-3">
							<div class="col-md-12">
								<p align="justify" class="text-secondary">
									<b>Importante:</b> O fundo cinza não aparece no site, ele só aparece aqui para saber se a proporção da imagem está preenchendo todo espaço. Se não houver imagem, não irá aparecer o número e sim uma imagem de 'sem imagem'.
								</p>
							</div>
						</div>
					</div>

					<div id="tab_regiao" class="tab-pane" role="tabpanel">
						<div class="row pl-3 pr-3 pt-0">
							<div class="col-md-12 text-secondary h5">
								Regiões cadastradas
								<span class="float-right">
									<button onclick="gerenciarRegiao('0')" type="button" class="btn btn-success btn-sm" style="border-radius: 50px;">
										<i class="fas fa-map-marker-alt"></i>
										<span class="d-none d-md-inline">NOVA REGIÃO</span>
									</button>
								</span>
							</div>
							<div class="col-md-12">
								<table class="table table-striped">
									<thead>
										<tr class="row">
											<th class="col">
												<div class="row">
													<div class="col-sm-5 text-left">BAIRRO, CIDADE/UF</div>
													<div class="col-sm-3 text-left">VALOR DELIVERY</div>
													<div class="col-sm-2 text-left">STATUS</div>
													<div class="col-sm-2 text-right">#</div>
												</div>
											</th>
										</tr>
									</thead>
									<tbody>

										<?php if ( $getRegiao[0]=="SUCESSO" ): ?>
											<?php if ( $getRegiao[1]>0 ): ?>

												<?php foreach ($getRegiao[2] as $key => $regiao): ?>
													<tr class="row">
														<td class="col">
															<div class="row">
																<div class="col-sm-5 text-left" title="<?=$regiao->bai_nome?>">
																	<?=$regiao->bai_nome?>, <?=$regiao->cid_nome?>/<?=$regiao->est_uf?>
																</div>
																<div class="col-sm-3 text-left">
																	<?php if ( $regiao->reg_valordelivery>0 ): ?>
																		R$ <?=number_format($regiao->reg_valordelivery, 2, ',', '.')?>
																	<?php else: ?>
																		<span class="text-success">GRÁTIS</span>
																	<?php endif ?>
																</div>
																<div class="col-sm-2 text-left"><?=$regiao->reg_status==1?'Ativo':'Inativo'?></div>
																<div class="col-sm-2 text-right">
																	<button type="button" onclick="gerenciarRegiao('<?=$regiao->reg_id?>')" class="btn btn-primary btn-sm">
																		<i class="icofont-ui-edit"></i>&nbsp;&nbsp;
																		Editar
																	</button>
																</div>
															</div>
														</td>
													</tr>
												<?php endforeach ?>

											<?php else: ?>
												<tr class="row">
													<td class="col">
														<h1 class="text-secondary">Nenhuma região cadastrada.</h1>
													</td>
												</tr>
											<?php endif ?>
										<?php else: ?>
											<tr class="row">
												<td class="col">
													<h1 class="text-danger">Ocorreu um erro ao buscar dados de região</h1>
													<var>
														<?=$getRegiao[2]?>
													</var>
												</td>
											</tr>
										<?php endif ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php endif ?>

			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){ 

		<?php if ( !isset($_GET['loj_id']) && $_GET['loj_id']=="" ): ?>
			// desativando os campos para formulário vazio
				if ( $('#loj_id').val()=="" ) {
					$('.controle_cnpj').attr('disabled', true);
					setTimeout(function(){
			            $('#loj_cnpj').focus();
			        }, 1500);
				}
		<?php else: ?>
			// click automático whatsapp
			<?php if ( $_loja->loj_whatsapp==1 ): ?>
				setTimeout(function(){
		            $('#loj_whatsapp').click();
		        }, 1000);
			<?php endif ?>

			$('.slick_ambiente').slick({
				infinite: true,
				centerMode: true,
				centerPadding: '60px',
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2000,
				arrows: false,
				dots: false,
				pauseOnHover: true,
				// fade: true
				lazyLoad: 'ondemand',
				centerMode: true,
				adaptiveHeight: true,
				variableWidth: true,

				// RESPONSIVIDADE
				responsive: [ 
					{
						breakpoint: 768,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '40px',
							slidesToShow: 2
						}
					}, {
						breakpoint: 480,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '40px',
							slidesToShow: 1
						}
					}
				]
			});
		<?php endif ?>

		// Click auto
		<?php if ( isset($_GET['tab']) && $_GET['tab']!="" ): ?>
			setTimeout(function(){
	            $(".<?=$_GET['tab']?>").click();
	        }, 1500);
		<?php endif ?>

		// Mask
			$('#loj_cnpj').mask("99.999.999/9999-99");

		// hides
			$('.open_cnpj, .send_hide').hide();

		// controle upload imagem
			$(".file_ambiente").change(function(){
				var fileName = $(this).val().split("\\").pop();
				$('#loj_logo_progress').html('<button id="btn_enviarlogo" type="button" class="btn btn-sm btn-outline-primary nolink">Enviar  '+fileName+' <i class="far fa-paper-plane"></i></button>');
				var img_id = $(this).attr('img_id');
				// console.log('fileName: '+fileName);
				// console.log('img_id: '+img_id);
				readURL(this, img_id);
				// var produto = document.getElementById(name).files[0];
			});
			function readURL(input, img_id) { 
		        var reader = new FileReader();        
		        reader.onload = function (e) {
		            // Carregar imagem
		            $('.img_ambiente'+img_id).attr('src', e.target.result);
		            $('.send_ambiente'+img_id).fadeIn(500);
		        }
		        reader.readAsDataURL(input.files[0]);
		      }

		// importante
			$('#cadastro_loja a').on('click', function (e) {
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

		// Salvar loja
			$("#form_loja").submit(function(event) {
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
				$('#form_loja').find("input,select,textarea").attr("disabled", false);
				var form = $('#form_loja').serialize();
				submitForm('salvarloja', form);
			});

		// CNPJ valido
			$('#btn_novaloja').click(function(event) {
				$(this).hide();
				$('#loj_cnpj').attr('disabled', true);
				$('.controle_cnpj').attr('disabled', false);
				$('#loj_disponibilidade').focus();
			});

		// CNPJ valido
			$('#btn_continuar').click(function(event) {
				$("#form_novaloja").submit();
			});

		setInterval(function(){ 
			if ( $('#loj_cnpj').val().length>10 ) {
				if ( validarCNPJ( $('#loj_cnpj').val() ) ) {
					if ( $('#loj_validacao').attr('validacao')=="" ) {
						$('#loj_validacao').html(' - <span class="text-success"> Válido! <span id="text_cnpj" class="text-secondary">Aguarde...</span></span>');
						validarcampo('cnpj');
					}
				} else {
					$('#loj_validacao').attr('validacao', '');
					$('#loj_validacao').html(' - <span class="text-danger"> inválido!</span>');
					$('.open_cnpj').hide();
					$('.controle_cnpj').attr('disabled', true);
				}
			}else{
				$('.open_cnpj').hide();
				$('#loj_validacao').attr('validacao', '');
				$('.controle_cnpj').attr('disabled', true);
			}
			if ( $('#loj_razaosocial').val().length>4 ) {
				validarcampo('razaosocial');
			}
		}, 100);
	}); // fim do ready

	function upload_imagem(img_id) {
		$('#loj_ambiente'+img_id+'-<?=$_loja->loj_id?>').click();
	}

	function save_imagem(img_id) {
		var progressoHtml = '<div id="loj_logo_progress" class="loj_logo_progress small text-secondary pt-2"></div><div id="loj_logo_progressBar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>';

		$('#loj_ambiente'+img_id+'-<?=$_loja->loj_id?>').simpleUpload("page-sistema/loja/controller/controledeimagem.php", {

			start: function(file){
				//upload started
				aguarde('', file.name+' carregada, por favor aguarde...<br>'+progressoHtml);
			},

			progress: function(progress){
				//received progress
				$('#loj_logo_progress').html("Progress: " + Math.round(progress) + "%");
				$('#loj_logo_progressBar').width(progress + "%");
			},

			success: function(data){
				var arrRetorno = data.split('||');
				// console.log(data);
				// return false;
				if (arrRetorno[0]=="SUCESSO") {
                    swal({
                      title: "SUCESSO",
                      text: arrRetorno[1],
                      icon: "success",
                      buttons: false,
                    });
                    setTimeout(function(){
	                	swal.close();
	                	aguarde('close');
	                }, 1000);
                } else {
                    // toastr["error"](arrRetorno[1]);
                    swal({
                      title: "Atenção",
                      text: arrRetorno[1],
                      icon: "warning",
                      // buttons: true,
                    });
                    setTimeout(function(){
	                	swal.close();
	                	aguarde('close');
	                }, 1000);
                    console.log(data);
                }
			},

			error: function(error){
				//upload failed
				$('#loj_logo_progress').html("Failure!<br>" + error.name + ": " + error.message);
				swal({
                  title: "Atenção",
                  text: arrRetorno[1],
                  icon: "warning",
                  // buttons: true,
                });
                setTimeout(function(){
                	swal.close();
                	aguarde('close');
                }, 1000);
                console.log(retorno);
			}

		});
	}

	function gerenciarRegiao(reg_id) {
        $.ajax({
            url:    'page-sistema/loja/view/modal_regiao_loja.php',
            type:   'POST',
            data:   'reg_id='+reg_id,
            success: function(retornoloadfile){
                abrirModalGlobal('<i class="fas fa-map-marker-alt"></i> Região', retornoloadfile, '<button onclick="btn_salvarcadastro()" type="button" class="btn btn-success">Salvar</button>');
                $("#modal_global_body").addClass('pt-0');
            } // fim da function
        }); // fim do ajax  
    }

	function delete_imagem(img_id, campo) {
		swal({
			title: "ATENÇÃO",
          	text: 'Deletar imagem '+img_id+'?',
          	icon: "warning",
			buttons: {
				cancel: "Cancelar",
				confirm: {
					text: "Confirmar",
					value: true,
				}
			},
		})
		.then((value) => {
			if ( value ) {
				$.ajax({
					url:    'page-sistema/loja/controller/loja.php',
					type:   'POST',
					data:   'acao=deletarimagem&loj_id=<?=$_loja->loj_id?>&campo='+campo,
					success: function(retorno){
						var arrRetorno = retorno.split('||');
						console.log(retorno);
						// return false;
						if (arrRetorno[0]=="SUCESSO") {
							swal({
								title: "SUCESSO",
								text: arrRetorno[1],
								icon: "success",
								buttons: false,
							});
							setTimeout(function(){
								location.reload();
							}, 1500);
						} else {
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
		});
	}

	function validarcampo(campo) {
		$.ajax({
			url:    'page-sistema/loja/controller/loja.php',
			type:   'POST',
			data:   'acao=validarcampo&loj_id='+$("#loj_id").val()+'&campo='+$('#loj_'+campo).attr("id")+'&valor='+$('#loj_'+campo).val(),
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				// console.log(retorno);
				// return false;
				if ( campo=="cnpj" ) {
					$('#loj_validacao').attr('validacao', arrRetorno[0]);
					if ( arrRetorno[0]=="DISPONIVEL" ) {
						$('#text_'+campo).html('<span class="text-success"> - Disponível</span>');
						$('#btn_editarloja').hide();
						$('#btn_novaloja').fadeIn();
					} else {
						$('#text_'+campo).html('<span class="text-danger"> - Indisponível</span>');
						$('.controle_cnpj').attr('disabled', true);
						$('#btn_novaloja').hide();
						$('#btn_editarloja').fadeIn();
						$('#btn_editarloja').attr('href', 'loja?view=formloja&loj_id='+arrRetorno[2]);
					}
				} else {
					if ( arrRetorno[0]=="DISPONIVEL" ) {
						$('#text_'+campo).html('<span class="text-success"> - Disponível</span>');
						$('.controle_rs').attr('disabled', false);
						$('#btn_continuar').fadeIn();
					} else {
						$('#text_'+campo).html('<span class="text-danger"> - Indisponível</span>');
						$('.controle_rs').attr('disabled', true);
						$('#btn_continuar').hide();
					}
				}
					
			} // fim da function
	    }); // fim do ajax
	}

	// function
	function submitForm(acao, form) {
		$.ajax({
			url:    'page-sistema/loja/controller/loja.php',
			type:   'POST',
			data:   'acao='+acao+'&loj_id='+$("#loj_id").val()+'&end_id='+$("#end_id").val()+'&'+form,
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
                    if ( arrRetorno[3]!="" ) {
	                    if (acao="salvarloja") {
                    		setTimeout(function(){
		                        location.replace('loja?view=formloja&loj_id='+arrRetorno[2]);
		                    }, 1500);
                    	} else {
                    		setTimeout(function(){
		                        location.reload();
		                    }, 1500);
                    	}
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