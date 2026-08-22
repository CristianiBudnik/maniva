<section class="contato" id="contato">
  <div class="container">
    <div class="row g-5">

      <div class="col-lg-5">
        <span class="contato-eyebrow">FALE CONOSCO</span>

        <h2 class="contato-title">
          Sua voz é
          <em>importante</em>
          pra gente.
        </h2>

        <p class="contato-text">
          Quer registrar uma reclamação ou compartilhar um elogio? Nossa equipe analisa cada mensagem com atenção e
          carinho.
        </p>

        <div class="contato-logo-box text-center">
          <img src="img/manivinhaescritorio.png" alt="Logo Maniva Alimentos">
        </div>
      </div>

      <div class="col-lg-7">
        <div class="form-card">

          <div class="tab-toggle">
            <button type="button" id="tabReclamacao" class="tab-btn active-red" onclick="selecionarTipo('reclamacao')">⚠
              Reclamação</button>
            <button type="button" id="tabElogio" class="tab-btn inactive" onclick="selecionarTipo('elogio')">★
              Elogio</button>
          </div>

          <form id="formContato">
            <input type="hidden" id="tipoSelecionado" name="tipo" value="reclamacao">

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label-maniva">Nome *</label>
                <input type="text" id="campoNome" name="nome" class="form-control-maniva" placeholder="Seu nome"
                  required>
              </div>
              <div class="col-sm-6">
                <label class="form-label-maniva">E-mail *</label>
                <input type="email" id="campoEmail" name="email" class="form-control-maniva" placeholder="seu@email.com"
                  required>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label-maniva">Telefone</label>
                <input type="tel" id="campoTelefone" name="telefone" class="form-control-maniva"
                  placeholder="(00) 00000-0000">
              </div>
              <div class="col-sm-6">
                <label class="form-label-maniva">Produto *</label>
                <select id="campoProduto" name="produto" class="form-control-maniva" required>
                  <option value="">Selecione...</option>
                  <option>Farinha de Mandioca</option>
                  <option>Polvilho Doce</option>
                  <option>Polvilho Azedo</option>
                  <option>Fubá de Milho</option>
                </select>
              </div>
            </div>

            <div id="loteBox" class="lote-box mb-3">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label class="form-label-maniva alert">Data de Fabricação *</label>
                  <input type="date" id="campoDataFabricacao" name="data_fabricacao" class="form-control-maniva">
                </div>
                <div class="col-sm-6">
                  <label class="form-label-maniva alert">Número do Lote *</label>
                  <input type="text" id="campoLote" name="lote" class="form-control-maniva" placeholder="Ex: L2026-001">
                </div>
              </div>
              <p class="lote-warning">⚠ Encontre a data de fabricação e o lote na embalagem do produto. São
                obrigatórios.</p>
            </div>

            <div class="mb-4">
              <label id="msgLabel" class="form-label-maniva">Descreva a reclamação *</label>
              <textarea id="msgInput" name="mensagem" class="form-control-maniva" rows="4"
                placeholder="Descreva o problema..." required></textarea>
            </div>

            <div id="feedbackEnvio" class="mb-3" style="display:none;"></div>

            <button type="submit" id="submitBtn" class="btn-enviar">Enviar Reclamação</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>