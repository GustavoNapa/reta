<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// Carregar usuarioS
	$getUsuario = acb_getUsuario( '', ' ORDER BY U.`usu_dtalter` DESC LIMIT 3 ' );

	if ( $getUsuario[0]!="SUCESSO" && $getUsuario[1]!=1 ) {
		fgb_erro( 'Usuário não encontrado', 'Não encontramos o usuário com id: '.$_GET['usu_id'], 'formusuario.php', 'NOTFOUND' );
        exit;
	}

	$_usuarios=$getUsuario[2];
	
?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<h3>
							<b>Consulta de usuário</b>
							<a href="usuario?view=formusuario" class="float-right btn btn-sm btn-success" style="border-radius: 50px;">
								<i class="fas fa-user-plus"></i> 
								<span class="d-none d-sm-inline">NOVO</span>
								<span class="d-none d-md-inline">USUÁRIO</span>
							</a>
						</h3>
					</div>
					<div class="col-sm-12 pt-3">
						<div class="input-group">
							<div class="input-group-prepend" style="background: transparent; border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
								<span class="input-group-text" style="background: transparent; border-top-left-radius: 50px; border-bottom-left-radius: 50px;"><i class="fas fa-search"></i></span>
							</div>
							<input id="usu_pesquisar" name="usu_pesquisar" type="text" class="form-control" placeholder="Pesquisar usuario" autocomplete="none">
							<select id="usu_quantidade" class="form-control usu_quantidade" title="Total a pesquisar" style="max-width: 100px!important; border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
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
						<span class="small small text-muted pl-5">Procura usuário por nome, email ou username</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="div_ultimosusu" class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">

		<?php foreach ($_usuarios as $key => $usuario): ?>
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-circle text-<?=$usuario->usu_status==1?'success':'dark'?>"></i>
					<b class="text-uppercase"><?=$usuario->usu_nome?></b>
					<a href="usuario?view=formusuario&usu_id=<?=$usuario->usu_id?>" class="btn btn-primary btn-sm float-right" style="border-radius: 50px;">
						<i class="fas fa-user-edit"></i> 
						<span class="d-none d-md-inline">EDITAR</span>
					</a>
				</div>
				<div class="card-body">
					<div class="row text-secondary mb-2">
						<div class="col-6">
							<b>EMAIL:</b> <?=$usuario->usu_email?> | <?=$usuario->usu_username?>
						</div>
						<div class="col-6 float-right text-right">
							<b>Nascido em:</b> &nbsp;<?=$usuario->usu_dtnasc?>&nbsp;&nbsp;&nbsp;
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="row text-secondary mb-3">
						<div class="col-6 small">
							<b>Cadastrado em:</b> <?=$usuario->usu_dtcad?>
						</div>
						<div class="col-6 float-right text-right small">
							<b>Ultimo acesso em::</b> &nbsp;<?=$usuario->usu_ultimoacesso?>&nbsp;&nbsp;&nbsp;
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

<div id="div_usuencontrados" class="row pl-3 pr-3 pt-0">
	<!-- USU AQUI -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
        $('#usu_pesquisar').bind("keyup blur focus", function(){
            if($(this).val().length > 1){
                // dispara o ajax depois de 1milisegundo
                setTimeout(function(){
                    // salvar dador pessoais
                    $.ajax({
                        url:    'page-sistema/usuario/controller/usuario.php',
                        type:   'POST',
                        data:   'acao=pesquisarusuario&usu_pesquisar='+$("#usu_pesquisar").val()+'&usu_quantidade='+$("#usu_quantidade").val(),
                        success: function(retorno){
                        	var arrRetorno = retorno.split('||');
							// console.log(retorno);
							if (arrRetorno[0]=="SUCESSO") {
			                    // toastr["success"]("Confira os campos obrigatórios!");
			                    $('#div_usuencontrados').html(arrRetorno[1]);
			                    $('#div_ultimosusu').hide();
                				$('#div_usuencontrados').fadeIn(500);
			                } else {
			                    toastr["error"](arrRetorno[1]);
			                    console.log(retorno);
			                }
                        } // fim da function
                    }); // fim do ajax   
                }, 100);
            }else{
                $('#div_usuencontrados').hide();
                $('#div_ultimosusu').fadeIn(500);
            }
        });
	});
</script>