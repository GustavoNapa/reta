<div class="form-group">
    <label for="nome">Marca</label>
    <select class="form-control">
        <option>Chevrolet</option>
        <option>Fiat</option>
        <option>Ford</option>
        <option>Honda</option>
        <option>Hyundai</option>
        <option>Jeep</option>
        <option>Nissan</option>
        <option>Renault</option>
        <option>Toyota</option>
        <option>Volkswagen</option>
    </select>
</div>
<div class="form-group">
    <label for="nome">Modelo</label>
    <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo">
</div>
<div class="form-group">
    <label for="nome">Ano</label>
    <input type="number" class="form-control" value="2000" min="1900" max="2021" name="nome" id="nome" aria-describedby="emailHelp" placeholder="Nome do cliente">
</div>
<div class="form-group">
    <label for="nome">Faixa de Preço</label>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Min R$</span>
                </div>
                <input type="text" class="form-control" name="preco" id="preco" placeholder="10.000,00">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Max R$</span>
                </div>
                <input type="text" class="form-control" name="preco" id="preco" placeholder="20.000,00">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="nome">Observações extras</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>            
<div class="form-group">
    <button id="salvar_interesse" class="btn btn-success btn-block p-2"><i class="fas fa-save"></i> Salvar</button>
</div>