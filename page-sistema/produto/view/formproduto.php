<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar produto
	if ( isset($_GET['pro_id']) && $_GET['pro_id']!="" ) {
		$retorno = fgb_executemyquery('SP', 'SELECT * FROM  rtv_produto p
												 	WHERE pro_id='.$_GET['pro_id']);

		// var_dump($retorno);

		$_produto = $retorno->objeto[0];

	}
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
							<!-- <li class="nav-item">
								<a class="nav-link tab_imgproduto" href="#tab_imgproduto" role="tab" aria-controls="tab_imgproduto" aria-selected="false">Imagens da produto</a>
							</li>

							<li class="nav-item">
								<a class="nav-link tab_regiao" href="#tab_regiao" role="tab" aria-controls="tab_regiao" aria-selected="false">Região de Entrega</a>
							</li> -->
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
						<div class="col-12">
					        <div class="col-md-12">
					            </label><label for="btn_bem_pretendido" class="control-label"></label>
					            <button id="btn_bem_pretendido" type="button" class="btn btn-block btn-info btn-sel-page">
					                <span id="span_bem_pretendido"><b><i class="fas fa-car"></i> </b>Carro</span>
					                <input id="bem_pretendido" name="bem_pretendido" type="checkbox" class="invisible">
					            </button>
					        </div>
					        <HR />	
						</div>
						<div class="col-md-3 mb-3">
					        <label for="pro_modelo" class="small text-dark">Modelo</label>
					        <div class="input-group">
					            <input id="pro_modelo" name="pro_modelo" type="text" class="form-control" placeholder="Modelo" required minlength="4" maxlength="50" value="<?=$_produto->pro_modelo?>">
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe o nome da produto</span>
					            </div>
					        </div>
					    </div>
						<div class="col-md-3">
						    <div class="form-group">
							    <label for="pro_tipo" class="small text-dark">Marca</label>
							    <select id="pro_tipo" class="form-control">
							        <option>Chevrolet</option>
							        <option>Fiat</option>
							        <option>Ford</option>
							        <option>Honda</option>
							        <option>Hyundai</option>
							        <option>Jeep</option>
							        <option>Nissan</option>
							        <option>Renault</option>
							        <option>Toyota</option>
							        <option>Volkswagen</option>
							    </select>
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
					            <select id="pro_disponibilidade" name="pro_disponibilidade" class="custom-select d-block w-100" required>
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
						<div class="col-md-3 mb-3">
					        <label for="pro_versao" class="small text-dark">Versão</label>
					        <div class="input-group">
					            <input id="pro_versao" name="pro_versao" type="text" class="form-control" placeholder="Versão" value="<?=$_produto->pro_versao?>" required>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe a versão da produto
					            </div>
					        </div>
					    </div>
						<div class="col-md-3 mb-3">
							<label for="pro_cor" class="small text-dark">Cor</label>
							<div class="input-group">
								<input id="pro_cor" name="pro_cor" type="text" placeholder="Cor" class="form-control" minlength="2" required value="<?=$_produto->pro_cor?>">
								<div class="invalid-feedback" style="width: 100%;">
									Informe a cor da produto
								</div>
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="pro_km" class="small text-dark">KM</label>
							<div class="input-group">
								<input id="pro_km" name="pro_km" type="text" placeholder="KM" class="form-control numeros" minlength="2" required value="<?=$_produto->pro_km?>">
								<div class="invalid-feedback" style="width: 100%;">
									Informe o telefone da produto
								</div>
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="pro_celular" class="small text-dark">Celular</label>
							<div class="input-group">
								<input id="pro_celular" name="pro_celular" type="text" class="form-control celular" placeholder="Só números"  value="<?=$_produto->pro_celular?>" minlength="8" required>
								<div class="input-group-prepend">
									<div class="input-group-text">
										<div class="custom-control custom-checkbox">
											<input id="pro_whatsapp" name="pro_whatsapp" type="checkbox" class="custom-control-input">
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
					    <div class="col-md-4 mb-3">
					        <label for="pro_placa" class="small text-dark">Placa</label>
					        <div class="input-group">
					            <input id="pro_placa" name="pro_placa" type="text" class="form-control" placeholder="Placa" value="<?=$_produto->pro_placa?>" required>
					            <div class="invalid-feedback" style="width: 100%;">
					                Informe a Placa da produto
					            </div>
					        </div>
					    </div>
						<div class="col-md-4 mb-3">
							<label for="pro_ano" class="small text-dark">Ano/Modelo</label>
							<div class="input-group">
								<input id="pro_ano" name="pro_ano" type="text" placeholder="Ano/Modelo" class="form-control" minlength="2" required value="<?=$_produto->pro_ano?>">
								<div class="invalid-feedback" style="width: 100%;">
									Informe o telefone da produto
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="pro_acessorios" class="small text-dark">Acessórios</label>
							<div class="input-group">
								<input id="pro_acessorios" name="pro_acessorios" type="text" placeholder="Ano/Modelo" class="form-control" minlength="2" required value="<?=$_produto->pro_acessorios?>">
								<div class="invalid-feedback" style="width: 100%;">
									Informe o telefone da produto
								</div>
							</div>
						</div>
		            </div>

				    <div class="row pl-3 pr-3 pt-0">
				    	<div class="col-md-12 mb-3">
					    	<div class="form-group">
							    </label><label for="btn_troca" class="control-label"></label>
							    <button id="btn_troca" type="button" class="btn btn-block btn-danger">
							        <b>Você aceita troca? </b><span id="span_troca">NÃO</span>
							        <input id="troca" name="troca" type="checkbox" class="invisible">
							    </button>
							    </label><label for="btn_proprietario" class="control-label"></label>
							    <button id="btn_proprietario" type="button" class="btn btn-block btn-danger">
							        <b>Você é o primeiro proprietário? </b><span id="span_proprietario">NÃO</span>
							        <input id="proprietario" name="proprietario" type="checkbox" class="invisible">
							    </button>
							    </label><label for="btn_mancha" class="control-label"></label>
							    <button id="btn_mancha" type="button" class="btn btn-block btn-danger">
							        <b>O estofamento possui mancha? </b><span id="span_mancha">NÃO</span>
							        <input id="mancha" name="mancha" type="checkbox" class="invisible">
							    </button>
							    </label><label for="btn_seguro" class="control-label"></label>
							    <button id="btn_seguro" type="button" class="btn btn-block btn-danger">
							        <b>O seu veiculo possui seguro? </b><span id="span_seguro">NÃO</span>
							        <input id="seguro" name="seguro" type="checkbox" class="invisible">
							    </button>
							    </label><label for="btn_recuperado" class="control-label"></label>
							    <button id="btn_recuperado" type="button" class="btn btn-block btn-danger">
							        <b>O veiculo já foi recuperado de roubo? </b><span id="span_recuperado">NÃO</span>
							        <input id="recuperado" name="recuperado" type="checkbox" class="invisible">
							    </button>
							</div>
						</div>
				    </div>

				    <div class="row pl-3 pr-3 pt-0">
				        <div class="col-md-12 mb-3">
				          <label for="pro_descricao">Descrição</label>
				          <div class="input-group">
				            <textarea id="pro_descricao" name="pro_descricao" minlength="20" maxlength="250" type="text" class="form-control" placeholder="Descrição sobre a produto" rows="3" required><?=$_produto->pro_descricao?></textarea>
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
		$('.numeros').mask('####');

		// BOTAO TROCA ENTRE CARRO E IMOVEL --------------------------------------------------------------------------------------------
		// $('#btn_bem_pretendido').click(function(){
  //           if(document.getElementById("bem_pretendido").checked == true){
  //               document.getElementById("bem_pretendido").checked = false;
  //               $('#btn_bem_pretendido').removeClass('btn-warning').addClass('btn-info');
  //               $('#span_bem_pretendido').html('<b><i class="fas fa-car"></i> </b>Automovel');
  //           }else{
  //               document.getElementById("bem_pretendido").checked = true;
  //               $('#btn_bem_pretendido').removeClass('btn-info').addClass('btn-warning');
  //               $('#span_bem_pretendido').html('<b><i class="fas fa-home"></i> </b>Imovel');              
  //           }
  //       });

        $('#btn_troca').click(function(){
            if(document.getElementById("troca").checked == true){
                document.getElementById("troca").checked = false;
                $('#btn_troca').removeClass('btn-success').addClass('btn-danger');
                $('#span_troca').html('NÃO');
            }else{
                document.getElementById("troca").checked = true;
                $('#btn_troca').removeClass('btn-danger').addClass('btn-success');
                $('#span_troca').html('SIM');              
            }
        });

        $('#btn_proprietario').click(function(){
            if(document.getElementById("proprietario").checked == true){
                document.getElementById("proprietario").checked = false;
                $('#btn_proprietario').removeClass('btn-success').addClass('btn-danger');
                $('#span_proprietario').html('NÃO');
            }else{
                document.getElementById("proprietario").checked = true;
                $('#btn_proprietario').removeClass('btn-danger').addClass('btn-success');
                $('#span_proprietario').html('SIM');              
            }
        });

        $('#btn_mancha').click(function(){
            if(document.getElementById("mancha").checked == true){
                document.getElementById("mancha").checked = false;
                $('#btn_mancha').removeClass('btn-success').addClass('btn-danger');
                $('#span_mancha').html('NÃO');
            }else{
                document.getElementById("mancha").checked = true;
                $('#btn_mancha').removeClass('btn-danger').addClass('btn-success');
                $('#span_mancha').html('SIM');              
            }
        });

        $('#btn_seguro').click(function(){
            if(document.getElementById("seguro").checked == true){
                document.getElementById("seguro").checked = false;
                $('#btn_seguro').removeClass('btn-success').addClass('btn-danger');
                $('#span_seguro').html('NÃO');
            }else{
                document.getElementById("seguro").checked = true;
                $('#btn_seguro').removeClass('btn-danger').addClass('btn-success');
                $('#span_seguro').html('SIM');              
            }
        });

        $('#btn_recuperado').click(function(){
            if(document.getElementById("recuperado").checked == true){
                document.getElementById("recuperado").checked = false;
                $('#btn_recuperado').removeClass('btn-success').addClass('btn-danger');
                $('#span_recuperado').html('NÃO');
            }else{
                document.getElementById("recuperado").checked = true;
                $('#btn_recuperado').removeClass('btn-danger').addClass('btn-success');
                $('#span_recuperado').html('SIM');              
            }
        });

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
			<?php if ( $_produto->pro_troca==1 ): ?>
				setTimeout(function(){
		            $('#btn_troca').click();
		        }, 1000);
			<?php endif ?>
			<?php if ( $_produto->pro_proprietario==1 ): ?>
				setTimeout(function(){
		            $('#btn_proprietario').click();
		        }, 1000);
			<?php endif ?>
			<?php if ( $_produto->pro_mancha==1 ): ?>
				setTimeout(function(){
		            $('#btn_mancha').click();
		        }, 1000);
			<?php endif ?>
			<?php if ( $_produto->pro_seguro==1 ): ?>
				setTimeout(function(){
		            $('#btn_seguro').click();
		        }, 1000);
			<?php endif ?>
			<?php if ( $_produto->pro_recuperado==1 ): ?>
				setTimeout(function(){
		            $('#btn_recuperado').click();
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
				console.log(retorno);
				return false;
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