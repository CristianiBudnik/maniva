function selecionarTipo(tipo) {
    const tipoInput = document.getElementById('tipoSelecionado');
    const tabReclamacao = document.getElementById('tabReclamacao');
    const tabElogio = document.getElementById('tabElogio');
    const loteBox = document.getElementById('loteBox');
    const msgLabel = document.getElementById('msgLabel');
    const submitBtn = document.getElementById('submitBtn');

    tipoInput.value = tipo;

    if (tipo === 'reclamacao') {
        tabReclamacao.classList.add('active-red');
        tabReclamacao.classList.remove('inactive');
        tabElogio.classList.add('inactive');
        tabElogio.classList.remove('active-red');
        loteBox.style.display = '';
        msgLabel.innerText = 'Descreva a reclamação *';
        submitBtn.innerText = 'Enviar Reclamação';
    } else {
        tabElogio.classList.add('active-red');
        tabElogio.classList.remove('inactive');
        tabReclamacao.classList.add('inactive');
        tabReclamacao.classList.remove('active-red');
        loteBox.style.display = 'none';
        msgLabel.innerText = 'Escreva seu elogio *';
        submitBtn.innerText = 'Enviar Elogio';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formContato');
    if (!form) return;

    form.addEventListener('submit', async (evento) => {
        evento.preventDefault();

        const feedback = document.getElementById('feedbackEnvio');
        const dados = {
            tipo: document.getElementById('tipoSelecionado').value,
            nome: document.getElementById('campoNome').value.trim(),
            email: document.getElementById('campoEmail').value.trim(),
            telefone: document.getElementById('campoTelefone').value.trim(),
            produto: document.getElementById('campoProduto').value,
            data_fabricacao: document.getElementById('campoDataFabricacao').value,
            lote: document.getElementById('campoLote').value.trim(),
            mensagem: document.getElementById('msgInput').value.trim()
        };

        try {
            const resposta = await fetch('api/reclamacao.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dados)
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                throw new Error(resultado.erro || 'Não foi possível enviar sua mensagem.');
            }

            feedback.className = 'alert alert-success mb-3';
            feedback.innerText = 'Mensagem enviada com sucesso! Obrigado pelo contato.';
            feedback.style.display = '';
            form.reset();
            selecionarTipo('reclamacao');

        } catch (erro) {
            feedback.className = 'alert alert-danger mb-3';
            feedback.innerText = erro.message;
            feedback.style.display = '';
        }
    });
});