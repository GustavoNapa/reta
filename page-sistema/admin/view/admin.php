<?php
    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }
?>

<div class="main-body-content w-100 ets-pt">

    <h1 class="text-secondary">Página inicial do sistema</h1>

    
</div>