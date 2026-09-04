"use strict";
//função assíncrona para carregar os dados do dashboard
async function carregarDashboard() {
    try {
        const resposta = await fetch('../api/dashboard.php');
        if (!resposta.ok) {
            throw new Error(`Erro na requisição: Status ${resposta.status}`);
        }
        const dados = await resposta.json();
        atualizarCards(dados);
        exibirTabela(dados.produtos);
        exibirTabelaCategoria(dados.categorias);
        exibirTabelaGrupos(dados.grupos);
    }
    catch (erro) {
        console.error('Falha ao carregar produtos:', erro);
    }
}
//filtro de produtos disponíveis
const totalProdutosDisponiveis = (dados) => {
    const estaDisponiveis = dados.produtos.filter((produto) => Number(produto.disponivel) === 1)
        .reduce((acumulador) => acumulador + 1, 0);
    return estaDisponiveis;
};
//conta de total de categorias
const totalCategorias = (dados) => {
    const categorias = dados.categorias
        .map((categoria) => categoria.nome);
    return categorias.length;
};
//conta de total de grupos
const totalGrupos = (dados) => {
    const grupos = dados.grupos
        .map((grupo) => grupo.nome);
    return grupos.length;
};
function atualizarCards(dados) {
    const pegaTotal = document.getElementById('card-total');
    const pegaGrupo = document.getElementById('card-grupo');
    const pegaCategoria = document.getElementById('card-categoria');
    const pegaDisponiveis = document.getElementById('card-produto-disponivel');
    // Card total de produtos
    if (pegaTotal) {
        pegaTotal.innerText = dados.totalProdutos.toString();
    }
    // Card produtos disponíveis
    if (pegaDisponiveis) {
        pegaDisponiveis.innerText = totalProdutosDisponiveis(dados).toString();
    }
    // Card grupos
    if (pegaGrupo) {
        pegaGrupo.innerText = totalGrupos(dados).toString();
    }
    // Card categorias
    if (pegaCategoria) {
        pegaCategoria.innerText = totalCategorias(dados).toString();
    }
}
//exibindo os produtos
function exibirTabela(produtos) {
    const tbody = document.getElementById('tabela-produtos-body');
    if (!tbody)
        return;
    tbody.innerHTML = '';
    if (produtos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nenhum produto cadastrado.</td></tr>';
        return;
    }
    const executaLinhas = produtos.map((item) => {
        const tr = document.createElement('tr');
        const statusBadge = Number(item.disponivel) === 1
            ? '<span class="badge bg-success">Disponível</span>'
            : '<span class="badge bg-danger">Indisponível</span>';
        tr.innerHTML = `
            <td>${item.id}</td>
            <td>${item.nome}</td>
            <td>${item.grupo ?? '—'}</td>
            <td>${item.categoria ?? '—'}</td>
            <td>${statusBadge}</td>
        `;
        return tr;
    });
    executaLinhas.forEach((tr) => tbody.appendChild(tr));
}
function exibirTabelaCategoria(categorias) {
    const tbody = document.getElementById('tabela-categorias-body');
    if (!tbody)
        return;
    tbody.innerHTML = '';
    if (categorias.length === 0) {
        tbody.innerHTML = '<tr><td colspan="2" class="text-center">Nenhuma categoria cadastrada.</td></tr>';
        return;
    }
    const executaLinhas = categorias.map((item) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.id}</td>
            <td>${item.nome}</td>
        `;
        return tr;
    });
    executaLinhas.forEach((tr) => tbody.appendChild(tr));
}
function exibirTabelaGrupos(grupos) {
    const tbody = document.getElementById('tabela-grupos-body');
    if (!tbody)
        return;
    tbody.innerHTML = '';
    if (grupos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="2" class="text-center">Nenhum grupo cadastrado.</td></tr>';
        return;
    }
    const executaLinhas = grupos.map((item) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.id}</td>
            <td>${item.nome}</td>
        `;
        return tr;
    });
    executaLinhas.forEach((tr) => tbody.appendChild(tr));
}
document.addEventListener('DOMContentLoaded', () => {
    carregarDashboard();
});
