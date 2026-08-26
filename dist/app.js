"use strict";
async function carregarDashboard() {
    try {
        const resposta = await fetch('../api/dashboard.php');
        if (!resposta.ok) {
            throw new Error(`Erro na requisição: Status ${resposta.status}`);
        }
        const dados = await resposta.json();
        atualizarCards(dados);
        exibirTabela(dados.produtos);
    }
    catch (erro) {
        console.error('Falha ao carregar produtos:', erro);
    }
}
function atualizarCards(dados) {
    const elTotal = document.getElementById('card-total');
    const elGrupo = document.getElementById('card-grupo');
    const elCategoria = document.getElementById('card-categoria');
    if (elTotal)
        elTotal.innerText = dados.totalProdutos.toString();
    if (dados.produtos.length === 0) {
        if (elGrupo)
            elGrupo.innerText = '—';
        if (elCategoria)
            elCategoria.innerText = '—';
        return;
    }
    // Conta quantos produtos cada grupo/categoria tem, usando reduce
    const contagemGrupo = dados.produtos.reduce((acc, p) => {
        const chave = p.grupo ?? 'Sem grupo';
        acc[chave] = (acc[chave] ?? 0) + 1;
        return acc;
    }, {});
    const contagemCategoria = dados.produtos.reduce((acc, p) => {
        const chave = p.categoria ?? 'Sem categoria';
        acc[chave] = (acc[chave] ?? 0) + 1;
        return acc;
    }, {});
    const grupoTop = Object.entries(contagemGrupo).sort((a, b) => b[1] - a[1])[0];
    const categoriaTop = Object.entries(contagemCategoria).sort((a, b) => b[1] - a[1])[0];
    if (elGrupo)
        elGrupo.innerText = `${grupoTop[0]} (${grupoTop[1]})`;
    if (elCategoria)
        elCategoria.innerText = `${categoriaTop[0]} (${categoriaTop[1]})`;
}
function exibirTabela(produtos) {
    const tbody = document.getElementById('tabela-produtos-body');
    if (!tbody)
        return;
    tbody.innerHTML = '';
    if (produtos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nenhum produto cadastrado.</td></tr>';
        return;
    }
    produtos.forEach((item) => {
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
        tbody.appendChild(tr);
    });
}
document.addEventListener('DOMContentLoaded', () => {
    carregarDashboard();
});
