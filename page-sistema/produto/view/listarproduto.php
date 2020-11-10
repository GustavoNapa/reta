<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// // Carregar produtos
	// $getproduto = sc_getproduto( '', ' GROUP BY L.`loj_id` ORDER BY L.`loj_dtalter` DESC LIMIT 3 ' );

	// if ( $getproduto[0]!="SUCESSO" && $getproduto[1]!=1 ) {
	// 	fgb_erro( 'Empresa não encontrada', 'Não encontramos o produto com id: '.$_GET['loj_id'], 'formproduto.php', 'NOTFOUND' );
 //        exit;
	// }

	// $_produtos=$getproduto[2];

	// // var_dump($getproduto);
	
?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3>
							<b>Consulta de produto</b>
							<a href="produto?view=formproduto" class="float-right btn btn-sm btn-success" style="border-radius: 50px;">
								<i class="fas fa-box-open"></i>
								<span class="d-none d-sm-inline">NOVO</span>
								<span class="d-none d-md-inline">PRODUTO</span>
							</a>
						</h3>
					</div>
					<div class="col-sm-12 pt-3">
						<div class="input-group">
							<div class="input-group-prepend" style="background: transparent; border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
								<span class="input-group-text" style="background: transparent; border-top-left-radius: 50px; border-bottom-left-radius: 50px;"><i class="fas fa-search"></i></span>
							</div>
							<input id="loj_pesquisar" name="loj_pesquisar" type="text" class="form-control" placeholder="Pesquisar produto" autocomplete="none">
							<select id="loj_quantidade" class="form-control loj_quantidade" title="Total a pesquisar" style="max-width: 100px!important; border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
								<option value="1">1</option>
								<option value="5" selected>5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="500">500</option>
								<option value="1000">1000</option>								
							</select>
						</div>
						<span class="small small text-muted pl-5">Procura produto por CNPJ, Razão Social ou Nome Fantasia</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="div_ultimoscli" class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">

		<?php foreach ($_produtos as $key => $produto): ?>
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-circle text-<?=$produto->loj_status==1?'success':'dark'?>"></i>
					<b class="text-uppercase"><?=$produto->loj_nome==""?$produto->loj_razaosocial:$produto->loj_nome?></b>
					<a href="produto?view=formproduto&loj_id=<?=$produto->loj_id?>" class="btn btn-acb btn-sm float-right" style="border-radius: 50px;">
						<i class="fas fa-pencil-alt"></i>
						<span class="d-none d-md-inline">EDITAR</span>
					</a>
				</div>
				<div class="card-body">
					<div class="row text-secondary">
						<div class="col-4">
							<b>CNPJ:</b> <?=$produto->loj_cnpj?>
						</div>
						<div class="col-4">
							<b>Nome fantasia:</b> <?=$produto->loj_nomefantasia?>
						</div>
						<div class="col-4 text-right">
							<?=$produto->loj_disponibilidade==1?'Visivel no site':'Ocultado do site'?>
						</div>
					</div>
					<div class="row text-secondary">
						<div class="col-4">
							<b>Email:</b> <?=$produto->loj_email?>
						</div>
						<div class="col-4">
							<b>Telefone:</b> <?=$produto->loj_telefone?>
						</div>
						<div class="col-4 text-right">
							<b>Celular:</b> <?=$produto->loj_celular?>
						</div>
					</div>	
					<div class="row text-secondary">
						<div class="col-12">
							<b>Endereço:</b> <?=$produto->end_logradouro?>, Nº <?=$produto->end_numero?>. <?=$produto->end_complemento?>. <?=$produto->end_bairro?>, <?=$produto->end_cidade?>/<?=$produto->end_estado?>
						</div>
					</div>	
				</div>
				<div class="card-footer">
					<div class="row text-secondary small">
						<div class="col-4">
							<b>Cadastrado em:</b> <?=date('d/m/Y h:m', strtotime($produto->loj_dtcad))?>
						</div>
						<div class="col-8">
							<b>Ultima alteração:</b> <?=date('d/m/Y h:m', strtotime($produto->loj_dtalter))?>, por <?=$produto->usu_nome?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>

<div id="div_cliencontrados" class="row pl-3 pr-3 pt-0">
	<!-- CLI AQUI -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
        $('#loj_pesquisar').bind("keyup blur focus", function(){
            if($(this).val().length > 1){
                // dispara o ajax depois de 1milisegundo
                setTimeout(function(){
                    // salvar dador pessoais
                    $.ajax({
                        url:    'page-sistema/produto/controller/produto.php',
                        type:   'POST',
                        data:   'acao=pesquisarproduto&loj_pesquisar='+$("#loj_pesquisar").val()+'&loj_quantidade='+$("#loj_quantidade").val(),
                        success: function(retorno){
                        	var arrRetorno = retorno.split('||');
							// console.log(retorno);
							if (arrRetorno[0]=="SUCESSO") {
			                    // toastr["success"]("Confira os campos obrigatórios!");
			                    $('#div_cliencontrados').html(arrRetorno[1]);
			                    $('#div_ultimoscli').hide();
                				$('#div_cliencontrados').fadeIn(500);
			                } else {
			                    toastr["error"](arrRetorno[1]);
			                    console.log(retorno);
			                }
                        } // fim da function
                    }); // fim do ajax   
                }, 100);
            }else{
                $('#div_cliencontrados').hide();
                $('#div_ultimoscli').fadeIn(500);
            }
        });
	});
</script>