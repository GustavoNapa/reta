<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'frameworks.php'; ?>
</head>
<body>
    <button id="btn_showNovoCarro" class="btn btn-success btn-block mb-4">Novo</button>
    <hr>
    <div id="form_cadCarro">
        <form class="p-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Dono</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Marca</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Modelo</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ano</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
        </form>
    </div>
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Dono</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Detalhes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td class="text-center"><button class="badge badge-info p-2"><i class="fas fa-info"></i></button></td>
            </tr>
            <tr>
            <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td class="text-center"><button class="badge badge-info p-2"><i class="fas fa-info"></i></button></td>
            </tr>
            <tr>
            <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td class="text-center"><button class="badge badge-info p-2"><i class="fas fa-info"></i></button></td>
            </tr>
        </tbody>
    </table>
</body>
<script>
    $('#form_cadCarro').hide();
    $(document).ready(function(err) {
        $('#btn_showNovoCarro').click(function() {
            $('#btn_showNovoCarro').hide(300);
            $('#form_cadCarro').show(600);
        });
    });
</script>
</html>