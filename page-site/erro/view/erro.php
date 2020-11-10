<?php


?>

<style type="text/css">
    body {
        background: 
            linear-gradient(
              rgba(0, 0, 0, 0.7), 
              rgba(0, 0, 0, 0.7)
            ),
            url(page-site/erro/media/erro.gif) fixed center center;
        background-size: cover;
        padding: 60px 0;
    }
    .transparent{
        background: rgba(255, 255, 255, 0.7);
    }
</style>

<section id="erro" class="container mt-5">
	<div class="row">
		<div class="col-12 text-light">
			<h1><i class="fas fa-exclamation"></i>  PÁGINA DE ERRO</h1>
		</div>
		<div class="clearfix"></div>

		<!-- 
			http://localhost/modelo/erro?mensagem=P%C3%A1gina%20about%20n%C3%A3o%20encontrada!
			&log=about%20n%C3%A3o%20encontrada%20na%20tabela%20de%20p%C3%A1ginas%20do%20banco%20de%20dados
			&origem=controledeurl.php
			&case=NOTFOUND
			&redirect=
		 -->

		<?php if (isset($_GET['mensagem'])): ?>
			<div class="col-12 text-light pt-2 mb-2">
				<h5 class="pt-2 mb-3">Mensagem:</h5>
				<code class="bg-light m-5 p-2">
					<?=$_GET['mensagem']?>
				</code>
			</div>
			<div class="clearfix"></div>
		<?php endif ?>

		<?php if (isset($_GET['origem'])): ?>
			<div class="col-12 text-light pt-2 mb-2">
				<h5 class="pt-2 mb-3">Origem:</h5>
				<code class="bg-light m-5 p-2">
					<?=$_GET['origem']?>
				</code>
			</div>
			<div class="clearfix"></div>
		<?php endif ?>

		<?php if ( $_SESSION[SS_PREFIX.'_LOGIN']==true ): ?>
			<div class="col-12 text-light pt-2 mb-2">
				<h5 class="pt-2 mb-3">Voltar para página inicial do sistema</h5>
				<div class="ml-5">
					<button class="btn btn-primary" href="admin" type="button">S4BIT SISTEMAS ®</button>
				</div>
			</div>
			<div class="clearfix"></div>
		<?php else: ?>
			<div class="col-12 text-light pt-2 mb-2">
				<h5 class="pt-2 mb-3">Fazer login no sistema</h5>
				<div class="ml-5">
					<button class="btn btn-primary" href="login" type="button">LOGIN - S4BIT SISTEMAS ®</button>
				</div>
			</div>
			<div class="clearfix"></div>
		<?php endif ?>
	</div>
</section>

<script type="text/javascript">
	<?php if (isset($_GET['log'])): ?>
		console.log('log: ');
		console.log('<?=$_GET['log']?>');
	<?php endif ?>
</script>