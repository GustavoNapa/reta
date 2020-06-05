<?php
    include_once "../../config/database.php";

    $id = $_POST['idcliente'];

    $query = "SELECT * FROM CLIENTES WHERE ID = :idCliente";

    $resultado = $conexao->prepare($query);
    
    $resultado->bindParam(':idCliente', $id);

    $resultado->execute(); 

    $linha  = $resultado->fetchAll(PDO::FETCH_OBJ);
    $contar = $resultado->rowCount();

    $listar_cli = $linha[0];

    $query_tel = "SELECT * FROM TELEFONES";

    $resultado = $conexao->prepare($query_tel);
    
    $resultado->bindParam(':idCliente', $id);

    $resultado->execute(); 

    $linha  = $resultado->fetchAll(PDO::FETCH_OBJ);
    $contar = $resultado->rowCount();
?>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detalhes do cliente</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container-fluid modal-body">
	<div class="al-left col-md-12">
        <div class="row">
            <div class="col-md-12">
                <label>Nome: </label>
                <label id="cpf_cli_<?php echo $listar_cli->ID; ?>"><?php echo $listar_cli->NAME; ?></label>
            </div>
            <div class="col-md-12">
                <label>Interesse: </label>
                <label><?php echo $listar_cli->INTERESSE; ?></label>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="table_clietes" class="table table-dark">
                    <thead>
                        <tr>
                        <th colspan="4" style="text-align: center;">Telefones</th>
                        </tr>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Numero</th>
                        <th scope="col">É WPP?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($linha as $key => $cliente) { ?>
                            <tr>
                            <th scope="row"><?=$cliente->ID ?></th>
                                <td><?=$cliente->NUMBER ?></td>
                                <td><?=$cliente->WHATSAPP ?></td>
                                <td class="text-center"><button class="badge badge-info p-2 btn-block"><i class="fas fa-edit"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="table_clietes" class="table table-dark">
                    <thead>
                        <tr>
                        <th colspan="3" style="text-align: center;">Interesses</th>
                        </tr>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($linha as $key => $cliente) { ?>
                            <tr>
                            <th scope="row"><?=$cliente->ID ?></th>
                                <td>Automóvel</td>
                                <td class="text-center"><button class="badge badge-info p-2 btn-block"><i class="fas fa-info"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>	
        </div>
    </div>
</div>
<div class="modal-footer">
</div>
