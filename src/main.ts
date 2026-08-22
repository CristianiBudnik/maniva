async function carregarDashboard(): Promise<void> {
    try {
        const resposta = await fetch('../api/produtos.php');

        if (!resposta.ok) {
            throw new Error(`Erro na requisição: Status ${resposta.status}`);
        }

        const produtos: Produto[] = await resposta.json();

        atualizarCards(produtos);
        exibirTabela(produtos);

    } catch (erro) {
        console.error('Falha ao carregar produtos:', erro);
    }
}

function atualizarCards(produtos: Produto[]): void {
    const elTotal = document.getElementById('card-total-produtos');
    const elAtivos = document.getElementById('card-produtos-ativos');

    if (produtos.length === 0) {
        if (elTotal) elTotal.innerText = '0';
        if (elAtivos) elAtivos.innerText = 'Nenhum produto registrado';
        return;
    }

    const totalProdutos: number = produtos.length;

    const resumoStatus = produtos.reduce((acc, p) => {
        if (Number(p.disponivel) === 1) {
            acc.disponiveis++;
        } else {
            acc.indisponiveis++;
        }
        return acc;
    }, { disponiveis: 0, indisponiveis: 0 });

    if (elTotal) {
        elTotal.innerText = totalProdutos.toString();
    }

    if (elAtivos) {
        elAtivos.innerText = `${resumoStatus.disponiveis} disponíveis / ${resumoStatus.indisponiveis} indisponíveis`;
    }
}

function exibirTabela(produtos: Produto[]): void {
    const tbody = document.getElementById('tabela-produtos-body');
    if (!tbody) return;

    tbody.innerHTML = '';

    if (produtos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center">Nenhum produto cadastrado.</td></tr>';
        return;
    }

    produtos.forEach((item) => {
        const tr = document.createElement('tr');
        const statusBadge = Number(item.disponivel) === 1
            ? '<span class="badge bg-success">Disponível</span>'
            : '<span class="badge bg-danger">Indisponível</span>';

        tr.innerHTML = `
            <td class="text-center">${item.id}</td>
            <td><strong>${item.nome}</strong></td>
            <td class="text-center">${item.categoria ?? 'Sem categoria'}</td>
            <td class="text-center">${statusBadge}</td>
        `;

        tbody.appendChild(tr);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    carregarDashboard();
});