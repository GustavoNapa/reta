<?php
// Reescrita de URL
$url = (isset($_GET['url'])) ? $_GET['url']:'';
// Criar um array com as palavras contidas na URL separadas por "/"
$url = array_filter(explode('/', $url));   

?>