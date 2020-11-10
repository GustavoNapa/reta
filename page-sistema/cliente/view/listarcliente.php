<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar clienteS
	$getCliente = fd_getCliente( '', ' WHERE C.`cli_iddependente` is null ORDER BY C.`cli_dtalter` DESC LIMIT 3 ' );

	if ( $getCliente[0]!="SUCESSO" && $getCliente[1]!=1 ) {
		fgb_erro( 'Cliente não encontrado', 'Não encontramos o cliente com id: '.$_GET['cli_id'], 'formcliente.php', 'NOTFOUND' );
        exit;
	}

	$_clientes=$getCliente[2];
	
?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3>
							<b>Consulta de cliente</b>
							<a href="cliente?view=formcliente" class="float-right btn btn-sm btn-success" style="border-radius: 50px;">
								<i class="fas fa-user-plus"></i> 
								<span class="d-none d-sm-inline">NOVO</span>
								<span class="d-none d-md-inline">CLIENTE</span>
							</a>
						</h3>
					</div>
					<div class="col-sm-12 pt-3">
						<div class="input-group">
							<div class="input-group-prepend" style="background: transparent; border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
								<span class="input-group-text" style="background: transparent; border-top-left-radius: 50px; border-bottom-left-radius: 50px;"><i class="fas fa-search"></i></span>
							</div>
							<input id="cli_pesquisar" name="cli_pesquisar" type="text" class="form-control" placeholder="Pesquisar cliente" autocomplete="none">
							<select id="cli_quantidade" class="form-control cli_quantidade" title="Total a pesquisar" style="max-width: 100px!important; border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
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
						<span class="small small text-muted pl-5">Procura cliente por nome, CPF ou Nº contrato</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="div_ultimoscli" class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">

		<?php foreach ($_clientes as $key => $cliente): ?>
			<div class="card mb-3">
				<div class="card-header">
					<b class="text-uppercase"><?=$cliente->cli_nome?></b>
					<a href="cliente?view=formcliente&cli_id=<?=$cliente->cli_id?>" class="btn btn-primary btn-sm float-right" style="border-radius: 50px;">
						<i class="fas fa-user-edit"></i> 
						<span class="d-none d-md-inline">EDITAR</span>
					</a>
				</div>
				<div class="card-body">
					<div class="row text-secondary">
						<div class="col-6">
							<b><?=strlen($cliente->cli_cpfcnpj)<15?'CPF':'CNPJ'?>:</b> <?=$cliente->cli_cpfcnpj?>
						</div>
						<div class="col-6 float-right text-right">
							<b>Nº CONTRATO:</b> &nbsp;<?=$cliente->cli_id?>&nbsp;&nbsp;&nbsp;
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="row text-secondary">
						<div class="col-6">
							<b>Contato:</b> <?=$cliente->cli_telefone?>
						</div>
						<div class="col-6 float-right text-right">
							<b>EMAIL:</b> <?=$cliente->cli_email?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="row" >
						<div class="col-12 text-secondary">
							<p align="justify">
								<b class="text-left">Observação:</b>&nbsp;&nbsp;<?=$cliente->cli_observacao?>
							</p>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="row mt-3 float-right" hidden>
						<div class="col-12">
							<button class="btn btn-secondary btn-sm">
								<i class="far fa-eye"></i>&nbsp;&nbsp;
								Mais detalhes
							</button>
							<!-- <a href="#" class="card-link text-danger">Mais detalhes</a> -->
							<!-- <a href="#" class="card-link text-danger">Book a Trip</a> -->
						</div>
						<div class="clearfix"></div>
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
        $('#cli_pesquisar').bind("keyup blur focus", function(){
            if($(this).val().length > 1){
                // dispara o ajax depois de 1milisegundo
                setTimeout(function(){
                    // salvar dador pessoais
                    $.ajax({
                        url:    'page-sistema/cliente/controller/cliente.php',
                        type:   'POST',
                        data:   'acao=pesquisarcliente&cli_pesquisar='+$("#cli_pesquisar").val()+'&cli_quantidade='+$("#cli_quantidade").val(),
                        success: function(retorno){
                        	var arrRetorno = retorno.split('||');
							console.log(retorno);
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