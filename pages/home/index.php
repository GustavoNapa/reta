<?php

$query = "SELECT * FROM CLIENTES";

$resultado = $conexao->prepare($query);
$resultado->execute(); 

$linha  = $resultado->fetchAll(PDO::FETCH_OBJ);
$contar = $resultado->rowCount();

?>

<button id="btn_showNovoCarro" class="btn btn-success btn-block mb-4">Novo</button>
    <hr>
    <div id="form_cadCarro">
        <form class="p-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome do cliente">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Interesse</label>
                
                
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Comprar
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                <label class="form-check-label" for="exampleRadios2">
                    Vender
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                <label class="form-check-label" for="exampleRadios3">
                    Comprar e vender
                </label>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Celular</label>
                <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Celular do cliente">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            <button id="btn_hideNovoCarro" type="button" class="btn btn-warning btn-block">Voltar</button>
        </form>
    </div>
    <table id="table_clietes" class="table table-dark">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Interesse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($linha as $key => $cliente) { ?>
                <tr>
                <th scope="row"><?=$cliente->ID ?></th>
                    <td><?=$cliente->NAME ?></td>
                    <td><?=$cliente->INTERESSE ?></td>
                    <td class="text-center"><button class="badge badge-info p-2"><i class="fas fa-info"></i></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    
<script>
    $('#form_cadCarro').hide();
    $(document).ready(function(err) {
        $('#btn_showNovoCarro').click(function() {
            openFormClient();
        });

        $('#btn_hideNovoCarro').click(function() {
            hideFormClient();
        });
    });

    function openFormClient() {
        $('#btn_showNovoCarro').hide(300);
        $('#table_clietes').hide(300);
        
        $('#form_cadCarro').show(600);
    }

    function hideFormClient() {
        $('#form_cadCarro').hide(300);

        $('#btn_showNovoCarro').show(600);
        $('#table_clietes').show(600);
    }
</script>