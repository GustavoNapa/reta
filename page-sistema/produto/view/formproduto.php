<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar produto
	// if ( isset($_GET['pro_id']) && $_GET['pro_id']!="" ) {
	// 	$getProduto = sc_getProduto( array('pro_id' => $_GET['pro_id'] ) );
		

	// 	if ( $getProduto[0]!="SUCESSO" && $getProduto[1]!=1 ) {
	// 		fgb_erro( 'Produto não encontrada', 'Não encontramos a produto com id: '.$_GET['pro_id'], 'formproduto.php', 'NOTFOUND' );
 //            exit;
	// 	}

	// 	$_produto=$getProduto[2][0];

	// }
?>

<form id="form_produto" class="needs-validation" novalidate>
	<div class="card shadow mb-3">
		<div class="card-header">
			<div class="row">
				<div class="col-12 h5">
					<i class="fas fa-store"></i> CADASTRO DE PRODUTO
					<a href="produto" type="button" class="btn btn-secondary btn-sm float-right" style="border-radius: 50px;">
						<i class="fas fa-undo-alt"></i>
						<span class="d-none d-md-inline">VOLTAR</span>
					</a>
				</div>

				<!-- IMPORTANTE -->
				<input id="pro_id" name="pro_id" type="text" value="<?=$_produto->pro_id?>" readonly hidden>
				<input id="end_id" name="end_id" type="text" value="<?=$_produto->end_id?>" readonly hidden>
			</div>

			<div class="row pl-3 pr-3 pt-0">
				<div class="col-12">
					<ul id="cadastro_produto" class="nav nav-tabs card-header-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link tab_dadosprincipais active" href="#tab_dadosprincipais" role="tab" aria-controls="tab_dadosprincipais" aria-selected="true">Dados principais</a>
						</li>

						<?php if ( !is_null($_produto->pro_id) ): ?>
							<li class="nav-item">
								<a class="nav-link tab_imgproduto" href="#tab_imgproduto" role="tab" aria-controls="tab_imgproduto" aria-selected="false">Imagens da produto</a>
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
					        <label for="pro_cnpj" class="small text-dark">CNPJ <span id="pro_validacao" validacao=""></span></label>
					        <div class="input-group">
					            <div class="input-group-prepend">
					                <span class="input-group-text">
					                	<i class="fas fa-store"></i>
					                </span>
					            </div>
					            <input id="pro_cnpj" name="pro_cnpj" type="text" class="form-control cnpj" placeholder="CNPJ" required value="<?=$_produto->pro_cnpj?>">
					            <div class="input-group-prepend">
									<button id="btn_novaproduto" class="btn btn-success open_cnpj" type="button"><i class="fas fa-check"></i></button>
									<a id="btn_editarproduto" class="btn btn-primary open_cnpj" type="button" href="#"><i class="fas fa-eye"></i></a>
								</div>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o CNPJ da produto</span>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-3 mb-3">
					    	<label for="pro_status" class="small text-dark">Status</label>
					        <div class="input-group">
					            <select id="pro_status" name="pro_status" class="custom-select d-block w-100 controle_cnpj" required>
					            	<option value="" hidden>- Selecione -</option>
									<option value="1" <?=$_produto->pro_status==1||is_null($_produto->pro_status)?'selected':''?> >Ativo</option>
									<option value="0" <?=$_produto->pro_status==0&&!is_null($_produto->pro_status)?'selected':''?> >Inativo</option>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
				    	</div>
				    	<div class="col-md-3 mb-3">
					    	<label for="pro_disponibilidade" class="small text-dark">Disponibilidade</label>
					        <div class="input-group">
					            <select id="pro_disponibilidade" name="pro_disponibilidade" class="custom-select d-block w-100 controle_cnpj" required>
					            	<option value <?=$_produto->pro_disponibilidade==-1?'selected':''?> hidden>- Selecione -</option>
									<option value="1" <?=$_produto->pro_disponibilidade==1?'selected':''?> >Mostrar no site</option>
									<option value="0" <?=$_produto->pro_disponibilidade==0?'selected':''?> >Ocultar do site</option>
								</select>
					            <div class="invalid-feedback" style="width: 100%;">
					                Selecione uma opção
					            </div>
					        </div>
				    	</div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
					    <div class="col-md-6 mb-3">
					        <label for="pro_razaosocial" class="small text-dark">Razão Social <span id="text_razaosocial" class="text-secondary"></span></label>
					        <div class="input-group">
					            <div class="input-group-prepend">
					                <span class="input-group-text"><i class="far fa-user"></i></span>
					            </div>
					            <input id="pro_razaosocial" name="pro_razaosocial" type="text" class="form-control controle_cnpj" placeholder="Razão Social" required pattern="[\wà-úÀ-Ú ]+[\s]{1,}/?[\wà-úÀ-Ú ]*" maxlength="50" value="<?=$_produto->pro_razaosocial?>">
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe a Razão Social da produto</span>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-6 mb-3">
					        <label for="pro_nomefantasia" class="small text-dark">Nome Fantasia</label>
					        <div class="input-group">
					            <input id="pro_nomefantasia" name="pro_nomefantasia" type="text" class="form-control controle_cnpj" placeholder="Nome Fantasia" required minlength="4" maxlength="50" value="<?=$_produto->pro_nomefantasia?>">
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o nome da produto</span>
					            </div>
					        </div>
					    </div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
						<div class="col-md-6 mb-3">
					        <label for="pro_im" class="small text-dark">Inscrição Municipal</label>
					        <div class="input-group">
					            <input id="pro_im" name="pro_im" type="text" class="form-control controle_cnpj" placeholder="Inscrição Municipal" value="<?=$_produto->pro_im?>">
					        </div>
					    </div>
					    <div class="col-md-6 mb-3">
					        <label for="pro_ie" class="small text-dark">Inscrição Estadual</label>
					        <div class="input-group">
					            <input id="pro_ie" name="pro_ie" type="text" class="form-control controle_cnpj" placeholder="Inscrição Estadual" value="<?=$_produto->pro_ie?>">
					        </div>
					    </div>
					</div>

					<div class="row pl-3 pr-3 pt-0">
					    <div class="col-md-4 mb-3">
					        <label for="pro_email" class="small text-dark">Email</label>
					        <div class="input-group">
					            <input id="pro_email" name="pro_email" type="email" class="form-control controle_cnpj" placeholder="Email" value="<?=$_produto->pro_email?>" required>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o Email da produto
					            </div>
					        </div>
					    </div>
						<div class="col-md-4 mb-3">
							<label for="pro_telefone" class="small text-dark">Telefone</label>
							<div class="input-group">
								<input id="pro_telefone" name="pro_telefone" type="text" placeholder="Telefone" class="form-control controle_cnpj telefone" minlength="8" required value="<?=$_produto->pro_telefone?>">
								<div class="invalid-feedback" style="width: 100%;">
									Informe o telefone da produto
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="pro_celular" class="small text-dark">Celular</label>
							<div class="input-group">
								<input id="pro_celular" name="pro_celular" type="text" class="form-control celular controle_cnpj" placeholder="Só números"  value="<?=$_produto->pro_celular?>" minlength="8" required>
								<div class="input-group-prepend">
									<div class="input-group-text">
										<div class="custom-control custom-checkbox">
											<input id="pro_whatsapp" name="pro_whatsapp" type="checkbox" class="custom-control-input controle_cnpj">
											<label for="pro_whatsapp" class="custom-control-label"><i class="fab fa-whatsapp"></i></label>
										</div>
									</div>
								</div>
								<div class="invalid-feedback">
									Informe o celular da produto
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
				              <input id="end_cep" name="end_cep" type="text" class="form-control end_cep controle_cnpj" placeholder="CEP" required  value="<?=$_produto->end_cep?>">
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
				            <input id="end_logradouro" name="end_logradouro" type="text" class="form-control input_end" placeholder="Logradouro" readonly  value="<?=$_produto->end_logradouro?>">
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
				            <input id="end_numero" name="end_numero" type="text" class="form-control input_end" placeholder="Nº" readonly  value="<?=$_produto->end_numero?>">
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
				            <input id="end_complemento" name="end_complemento" type="text" class="form-control input_end input_end" placeholder="Complemento" readonly  value="<?=$_produto->end_complemento?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_bairro">Bairro</label>
				          <div class="input-group">
				            <input id="end_bairro" name="end_bairro" type="text" class="form-control input_end input_end" placeholder="Bairro" readonly  value="<?=$_produto->end_bairro?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_cidade">Cidade</label>
				          <div class="input-group">
				            <input id="end_cidade" name="end_cidade" type="text" class="form-control input_end" placeholder="Cidade" readonly  value="<?=$_produto->end_cidade?>">
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
				            <input id="end_estado" name="end_estado" type="text" class="form-control input_end" placeholder="Estado" readonly  value="<?=$_produto->end_estado?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_pais">País</label>
				          <div class="input-group">
				            <input id="end_pais" name="end_pais" type="text" class="form-control input_end" placeholder="Brasil" readonly  value="<?=$_produto->end_pais==""?'Brasil':$_produto->end_pais?>">
				            <div class="invalid-feedback" style="width: 100%;">
				              Campo obrigatório
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4 mb-3">
				          <label for="end_googlemaps">Google Maps</label>
				          <div class="input-group">
				            <input id="end_googlemaps" name="end_googlemaps" type="link" class="form-control input_end input_end controle_cnpj" placeholder="Link"  value="<?=$_produto->end_googlemaps?>">
				          </div>
				        </div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-12 mb-3">
				          <label for="pro_descricao">Descrição</label>
				          <div class="input-group">
				            <textarea id="pro_descricao" name="pro_descricao" minlength="20" maxlength="250" type="text" class="form-control controle_cnpj" placeholder="Descrição sobre a produto" rows="3" required><?=$_produto->pro_descricao?></textarea>
				            <div class="invalid-feedback" style="width: 100%;">
				              Descreva a produto
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

				<?php if ( !is_null($_produto->pro_id) ): ?>
					<div id="tab_imgproduto" class="tab-pane" role="tabpanel">

						<div class="row pl-3 pr-3 pt-0 mb-3">
							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(1)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 1</button>
									<button onclick="delete_imagem( 1, 'pro_ambiente1' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(1)" type="button" class="btn btn-success btn-sm send_hide send_ambiente1"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="pro_ambiente1-<?=$_produto->pro_id?>" name="pro_ambiente1-<?=$_produto->pro_id?>" class="file_ambiente" img_id="1" type="file" hidden>
									<input id="pro_ambiente1_name" name="pro_ambiente1_name" type="text" hidden>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(2)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 2</button>
									<button onclick="delete_imagem( 2, 'pro_ambiente2' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(2)" type="button" class="btn btn-success btn-sm send_hide send_ambiente2"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="pro_ambiente2-<?=$_produto->pro_id?>" name="pro_ambiente2-<?=$_produto->pro_id?>" class="file_ambiente" img_id="2" type="file" hidden>
									<input id="pro_ambiente2_name" name="pro_ambiente2_name" type="text" hidden>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(3)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 3</button>
									<button onclick="delete_imagem( 3, 'pro_ambiente3' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(3)" type="button" class="btn btn-success btn-sm send_hide send_ambiente3"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="pro_ambiente3-<?=$_produto->pro_id?>" name="pro_ambiente3-<?=$_produto->pro_id?>" class="file_ambiente" img_id="3" type="file" hidden>
									<input id="pro_ambiente3_name" name="pro_ambiente3_name" type="text" hidden>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="btn-group">
									<button onclick="upload_imagem(4)" type="button" class="btn btn-secondary btn-sm" title="Selecione uma imagem com proporção 500x500"><i class="far fa-image"></i> Imagem 4</button>
									<button onclick="delete_imagem( 4, 'pro_ambiente4' )" type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
									<button onclick="save_imagem(4)" type="button" class="btn btn-success btn-sm send_hide send_ambiente4"><i class="far fa-paper-plane"></i></button>
									<!-- Importante -->
									<input id="pro_ambiente4-<?=$_produto->pro_id?>" name="pro_ambiente4-<?=$_produto->pro_id?>" class="file_ambiente" img_id="4" type="file" hidden>
									<input id="pro_ambiente4_name" name="pro_ambiente4_name" type="text" hidden>
								</div>
							</div>
						</div>

						<div class="row pl-3 pr-3 pt-0">
							<div class="col-md-12">
								
								<div class="slick_ambiente">

									<div>
										<div class="div_ambiente bg-secondary shadow ml-2 mr-2">
											<div class="img_ambiente">
												<?php if ( file_exists('page-sistema/produto/media/'.$_produto->pro_ambiente1) && !is_null($_produto->pro_ambiente1) ): ?>
													<img id="img_ambiente1" src="page-sistema/produto/media/<?=$_produto->pro_ambiente1?>" class="img-fluid img_ambiente1" alt="Imagem do ambiente da produto">
												<?php else: ?>
													<img id="img_ambiente1" src="page-sistema/produto/media/pro_ambiente1.png" class="img-fluid img_ambiente1" alt="Imagem 1 do ambiente da produto">
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
												<?php if ( file_exists('page-sistema/produto/media/'.$_produto->pro_ambiente2) && !is_null($_produto->pro_ambiente2) ): ?>
													<img id="img_ambiente2" src="page-sistema/produto/media/<?=$_produto->pro_ambiente2?>" class="img-fluid img_ambiente2" alt="Imagem do ambiente da produto">
												<?php else: ?>
													<img id="img_ambiente2" src="page-sistema/produto/media/pro_ambiente2.png" class="img-fluid img_ambiente2" alt="Imagem 2 do ambiente da produto">
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
												<?php if ( file_exists('page-sistema/produto/media/'.$_produto->pro_ambiente3) && !is_null($_produto->pro_ambiente3) ): ?>
													<img id="img_ambiente3" src="page-sistema/produto/media/<?=$_produto->pro_ambiente3?>" class="img-fluid img_ambiente3" alt="Imagem do ambiente da produto">
												<?php else: ?>
													<img id="img_ambiente3" src="page-sistema/produto/media/pro_ambiente3.png" class="img-fluid img_ambiente3" alt="Imagem 3 do ambiente da produto">
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
												<?php if ( file_exists('page-sistema/produto/media/'.$_produto->pro_ambiente4) && !is_null($_produto->pro_ambiente4) ): ?>
													<img id="img_ambiente4" src="page-sistema/produto/media/<?=$_produto->pro_ambiente4?>" class="img-fluid img_ambiente4" alt="Imagem do ambiente da produto">
												<?php else: ?>
													<img id="img_ambiente4" src="page-sistema/produto/media/pro_ambiente4.png" class="img-fluid img_ambiente4" alt="Imagem 4 do ambiente da produto">
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

		<?php if ( !isset($_GET['pro_id']) && $_GET['pro_id']=="" ): ?>
			// desativando os campos para formulário vazio
				if ( $('#pro_id').val()=="" ) {
					$('.controle_cnpj').attr('disabled', true);
					setTimeout(function(){
			            $('#pro_cnpj').focus();
			        }, 1500);
				}
		<?php else: ?>
			// click automático whatsapp
			<?php if ( $_produto->pro_whatsapp==1 ): ?>
				setTimeout(function(){
		            $('#pro_whatsapp').click();
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
			$('#pro_cnpj').mask("99.999.999/9999-99");

		// hides
			$('.open_cnpj, .send_hide').hide();

		// controle upload imagem
			$(".file_ambiente").change(function(){
				var fileName = $(this).val().split("\\").pop();
				$('#pro_logo_progress').html('<button id="btn_enviarlogo" type="button" class="btn btn-sm btn-outline-primary nolink">Enviar  '+fileName+' <i class="far fa-paper-plane"></i></button>');
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
			$('#cadastro_produto a').on('click', function (e) {
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

		// Salvar produto
			$("#form_produto").submit(function(event) {
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
				$('#form_produto').find("input,select,textarea").attr("disabled", false);
				var form = $('#form_produto').serialize();
				submitForm('salvarproduto', form);
			});

		// CNPJ valido
			$('#btn_novaproduto').click(function(event) {
				$(this).hide();
				$('#pro_cnpj').attr('disabled', true);
				$('.controle_cnpj').attr('disabled', false);
				$('#pro_disponibilidade').focus();
			});

		// CNPJ valido
			$('#btn_continuar').click(function(event) {
				$("#form_novaproduto").submit();
			});

		setInterval(function(){ 
			if ( $('#pro_cnpj').val().length>10 ) {
				if ( validarCNPJ( $('#pro_cnpj').val() ) ) {
					if ( $('#pro_validacao').attr('validacao')=="" ) {
						$('#pro_validacao').html(' - <span class="text-success"> Válido! <span id="text_cnpj" class="text-secondary">Aguarde...</span></span>');
						validarcampo('cnpj');
					}
				} else {
					$('#pro_validacao').attr('validacao', '');
					$('#pro_validacao').html(' - <span class="text-danger"> inválido!</span>');
					$('.open_cnpj').hide();
					$('.controle_cnpj').attr('disabled', true);
				}
			}else{
				$('.open_cnpj').hide();
				$('#pro_validacao').attr('validacao', '');
				$('.controle_cnpj').attr('disabled', true);
			}
			if ( $('#pro_razaosocial').val().length>4 ) {
				validarcampo('razaosocial');
			}
		}, 100);
	}); // fim do ready

	function upload_imagem(img_id) {
		$('#pro_ambiente'+img_id+'-<?=$_produto->pro_id?>').click();
	}

	function save_imagem(img_id) {
		var progressoHtml = '<div id="pro_logo_progress" class="pro_logo_progress small text-secondary pt-2"></div><div id="pro_logo_progressBar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>';

		$('#pro_ambiente'+img_id+'-<?=$_produto->pro_id?>').simpleUpload("page-sistema/produto/controller/controledeimagem.php", {

			start: function(file){
				//upload started
				aguarde('', file.name+' carregada, por favor aguarde...<br>'+progressoHtml);
			},

			progress: function(progress){
				//received progress
				$('#pro_logo_progress').html("Progress: " + Math.round(progress) + "%");
				$('#pro_logo_progressBar').width(progress + "%");
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
				$('#pro_logo_progress').html("Failure!<br>" + error.name + ": " + error.message);
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
            url:    'page-sistema/produto/view/modal_regiao_produto.php',
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
					url:    'page-sistema/produto/controller/produto.php',
					type:   'POST',
					data:   'acao=deletarimagem&pro_id=<?=$_produto->pro_id?>&campo='+campo,
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
			url:    'page-sistema/produto/controller/produto.php',
			type:   'POST',
			data:   'acao=validarcampo&pro_id='+$("#pro_id").val()+'&campo='+$('#pro_'+campo).attr("id")+'&valor='+$('#pro_'+campo).val(),
			success: function(retorno){
				var arrRetorno = retorno.split('||');
				// console.log(retorno);
				// return false;
				if ( campo=="cnpj" ) {
					$('#pro_validacao').attr('validacao', arrRetorno[0]);
					if ( arrRetorno[0]=="DISPONIVEL" ) {
						$('#text_'+campo).html('<span class="text-success"> - Disponível</span>');
						$('#btn_editarproduto').hide();
						$('#btn_novaproduto').fadeIn();
					} else {
						$('#text_'+campo).html('<span class="text-danger"> - Indisponível</span>');
						$('.controle_cnpj').attr('disabled', true);
						$('#btn_novaproduto').hide();
						$('#btn_editarproduto').fadeIn();
						$('#btn_editarproduto').attr('href', 'produto?view=formproduto&pro_id='+arrRetorno[2]);
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
			url:    'page-sistema/produto/controller/produto.php',
			type:   'POST',
			data:   'acao='+acao+'&pro_id='+$("#pro_id").val()+'&end_id='+$("#end_id").val()+'&'+form,
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
	                    if (acao="salvarproduto") {
                    		setTimeout(function(){
		                        location.replace('produto?view=formproduto&pro_id='+arrRetorno[2]);
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