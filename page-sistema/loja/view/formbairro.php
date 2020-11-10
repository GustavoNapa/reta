<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

	$getBairro = getCadastroBasicoLoja( 'bairro' );

	$getCidadeUF = getCadastroBasicoLoja( 'cidade c', '', ' INNER JOIN acb_estado e  ON c.`cid_idestado`=e.`est_id` ' );
	
?>

<div class="card shadow mb-3">
	<div class="card-header">
		<div class="row">
			<div class="col-12 h5">
				<i class="icofont-google-map"></i> CADASTRO DE BAIRROS

				<span class="float-right">
					<button onclick="abrirCadastroBasico('Estado', 'estado', 'est', 'estado')" type="button" class="btn btn-secondary btn-sm estado" style="border-radius: 50px;">
						<i class="fas fa-map-marked-alt"></i>
						<span class="d-none d-md-inline">ESTADO</span>
					</button>

					<button onclick="abrirCadastroBasico('Cidade', 'cidade', 'cid', 'cidade')" type="button" class="btn btn-secondary btn-sm cidade" style="border-radius: 50px;">
						<i class="fas fa-city"></i>
						<span class="d-none d-md-inline">CIDADE</span>
					</button>

					<button onclick="gerenciarBairro('0')" type="button" class="btn btn-success btn-sm" style="border-radius: 50px;">
						<i class="fas fa-building"></i>
						<span class="d-none d-md-inline">NOVO BAIRRO</span>
					</button>
				</span>
			</div>
		</div>
	</div>
	<div class="card-body pt-0">
		<table class="table table-striped">
			<thead>
				<tr class="row">
					<th class="col">
						<div class="row">
							<div class="col-sm-4 text-left">UF/CIDADE</div>
							<div class="col-sm-4 text-left">BAIRRO</div>
							<div class="col-sm-2 text-left">STATUS</div>
							<div class="col-sm-2 text-right">#</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>

				<?php if ( $getBairro[0]=="SUCESSO" ): ?>
					<?php if ( $getBairro[1]>0 ): ?>

						<?php foreach ($getBairro[2] as $key => $bairro): ?>
							<tr class="row">
								<td class="col">
									<div class="row">
										<?php foreach ($getCidadeUF[2] as $key => $estadoUF): ?>
											<?php if ($estadoUF->cid_id==$bairro->bai_idcidade): ?>

												<div class="col-sm-4 text-left" title="<?=$estadoUF->est_nome?>"><?=$estadoUF->est_uf?>/<?=$estadoUF->cid_nome?></div>

											<?php endif ?>
										<?php endforeach ?>
												
										<div class="col-sm-4 text-left"><?=$bairro->bai_nome?></div>
										<div class="col-sm-2 text-left"><?=$bairro->bai_status==1?'Ativo':'Inativo'?></div>
										<div class="col-sm-2 text-right">
											<button onclick="gerenciarBairro('<?=$bairro->bai_id?>')" class="btn btn-primary btn-sm">
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
								<h1 class="text-secondary">Nenhum bairro encontrado.</h1>
							</td>
						</tr>
					<?php endif ?>
				<?php else: ?>
					<tr class="row">
						<td class="col">
							<h1 class="text-danger">Ocorreu um erro ao buscar dados dos bairros</h1>
							<var>
								<?=$getBairro[2]?>
							</var>
						</td>
					</tr>
				<?php endif ?>
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		<?php if ( isset($_GET['tabela']) && $_GET['tabela']!="" ): ?>
			$(".<?=$_GET['tabela']?>").click();
		<?php endif ?>
	}); // fim do ready

	function abrirCadastroBasico(titulo, tabela, prefixo, modal="basico") {
        $.ajax({
            url:    'page-sistema/loja/view/modal_'+modal+'_loja.php',
            type:   'POST',
            data:   'titulo='+titulo+'&tabela='+tabela+'&prefixo='+prefixo+'&modal='+modal,
            success: function(retornoloadfile){
                abrirModalGlobal('<i class="fas fa-tools"></i> '+titulo, retornoloadfile, '&nbsp;');
                $("#modal_global_body").addClass('pt-0');
            } // fim da function
        }); // fim do ajax  
    }

    function gerenciarBairro(bai_id) {
        $.ajax({
            url:    'page-sistema/loja/view/modal_bairro_loja.php',
            type:   'POST',
            data:   'bai_id='+bai_id,
            success: function(retornoloadfile){
                abrirModalGlobal('<i class="fas fa-tools"></i> Bairro', retornoloadfile, '<button onclick="btn_salvarcadastro()" type="button" class="btn btn-success">Salvar</button>');
                $("#modal_global_body").addClass('pt-0');
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