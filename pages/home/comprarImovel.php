<div class="form-group">
    <label for="nome">Marca</label>
    <select class="form-control">
        <option>Casa</option>
        <option>Apartamento</option>
        <option>Sitio</option>
        <option>Chacara</option>
    </select>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label class="control-label" for="end_cep"  readonly>CEP:</label>
        <input type="hidden" name="end_id" id="end_id">
        <input id="end_cep" name="end_cep" type="text" placeholder="99999-999" class="form-control upper cep"  autocomplete="NOPE" required>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label" for="end_logradouro">Logradouro:</label>
        <div class="input-group">
            <input id="end_logradouro" name="end_logradouro" type="text" class="form-control upper" placeholder="Digite o sua rua" min="5" max="100" required>
            <div class="input-group-append">
                <button id="block_logradouro" type="button" class="btn btn-outline-dark btn-block">
                    <i class="fas fa-lock-open"></i> 
                </button>
            </div>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label class="control-label" for="end_numero">Numero:</label>
        <input id="end_numero" name="end_numero" type="text" class="form-control upper" placeholder="Numero da casa" pattern="[\d,.?!]*" title="Somente números" min="1" max="7" autocomplete="NOPE" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label class="control-label" for="end_complemento">Complemento:</label>
        <input id="end_complemento" name="end_complemento" type="text" class="form-control upper" placeholder="Complemento *" min="1" max="45" autocomplete="NOPE" required>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label" for="end_bairro">Bairro:</label>
        <div class="input-group">
            <input id="end_bairro" name="end_bairro" type="text" class="form-control upper" placeholder="Bairro" min="3" max="45" autocomplete="NOPE" required>
            <div class="input-group-append">
                <button id="block_bairro"type="button" class="btn btn-outline-dark btn-block">
                    <i class="fas fa-lock-open"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label class="control-label" for="end_cidade">Cidade:</label>
        <input id="end_cidade" name="end_cidade" type="text" class="form-control upper" placeholder="Cidade" min="3" max="45" autocomplete="NOPE" required >
    </div>
    <div class="form-group col-md-2">
        <label class="control-label" for="end_uf">Estado:</label>
        <input id="end_uf" name="end_uf" type="text" class="form-control upper" placeholder="UF" min="2" max="2" required pattern="[\wà-úÀ-Ú]*" title="Somente letras" autocomplete="NOPE">
    </div>
    <div class="form-group col-md-4">
        <label class="control-label" for="end_pais">Pais:</label>
        <input id="end_pais" name="end_pais" type="text" class="form-control upper" value="Brasil" min="3" max="100" required readonly pattern="[\wà-úÀ-Ú]*" title="Somente letras" autocomplete="NOPE">
    </div>
</div>
<div class="form-group">
    <label for="nome">Preço</label>
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