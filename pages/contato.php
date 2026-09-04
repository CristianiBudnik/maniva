<section class="contato" id="contato">
  <div class="container">
    <div class="row g-5">

      <div class="col-lg-5">
        <span class="contato-eyebrow">FAÇA SEU PEDIDO</span>

        <h2 class="contato-title">
          É simples e rápido
          <em>fazer seu pedido</em>
        </h2>

        <p class="contato-text">
          Fale direto com um dos nossos vendedores selecionando a sua região no campo ao lado. 
        </p>

        <div class="contato-logo-box text-center">
          <img src="img/manivinhaescritorio.png" alt="Logo Maniva Alimentos">
        </div>
      </div>

      <div class="col-lg-7">
        <div class="form-card">
          <form id="formContato">
            <input type="hidden" id="tipoSelecionado" name="text" value="regiao">
            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label-maniva">Região</label>
                <select type="text" id="regiao" name="regiao" class="form-control-maniva" onchange="selecionarRegiao()">
                  <option value="">Selecione...</option>
                  <option value="AM">Amazonas</option>
                  <option value="SP">São Paulo</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="PA">Pará</option>
                  <option value="RO">Rondônia</option>
                  <option value="AC">Acre</option>
                  <option value="AP">Amapá</option>
                  <option value="RR">Roraima</option>
                  <option value="TO">Tocantins</option>
                  <option value="MA">Maranhão</option>
                  <option value="PI">Piauí</option>
                  <option value="CE">Ceará</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="PB">Paraíba</option>
                  <option value="PE">Pernambuco</option>
                  <option value="AL">Alagoas</option>
                  <option value="SE">Sergipe</option>
                  <option value="BA">Bahia</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="GO">Goiás</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="PR">Paraná</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="">Outro</option>
                </select>
              </div>
              <div class="col-sm-6">

              </div>
              <br>
              <div class="col-sm-6" id="vendas">
                <label for="form-label-maniva">Representante da Região<br> Selecione a região acima para visualizar o representante.</label>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>