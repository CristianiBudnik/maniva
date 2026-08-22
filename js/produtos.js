let filtroAtual = 'todos';

function filtrarCategoria(grupo, botao) {
    filtroAtual = grupo;

    document.querySelectorAll('.filtro-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    botao.classList.add('active');

    aplicarFiltros();
}

function filtrarBusca() {
    aplicarFiltros();
}

function aplicarFiltros() {
    const termoBusca = document.getElementById('buscaProduto').value.trim().toLowerCase();
    const itens = document.querySelectorAll('.produto-item');
    let visiveisTotal = 0;

    itens.forEach(item => {
        const categoria = item.dataset.categoria;
        const nome = item.dataset.nome || '';

        const combinaGrupo = filtroAtual === 'todos' || categoria === filtroAtual;
        const combinaBusca = termoBusca === '' || nome.includes(termoBusca);

        const visivel = combinaGrupo && combinaBusca;
        item.style.display = visivel ? '' : 'none';

        if (visivel) visiveisTotal++;
    });

    document.querySelectorAll('.grupo-secao').forEach(secao => {
        const temItemVisivel = secao.querySelectorAll('.produto-item:not([style*="display: none"])').length > 0;
        secao.style.display = temItemVisivel ? '' : 'none';
    });

    const contador = document.getElementById('contadorProdutos');
    contador.textContent = `${visiveisTotal} produto${visiveisTotal !== 1 ? 's' : ''}`;

    const semResultados = document.getElementById('semResultados');
    semResultados.style.display = visiveisTotal === 0 ? '' : 'none';
}