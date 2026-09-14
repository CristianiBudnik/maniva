async function carregarDashboard(busca?: string): Promise<void> {
    try {

        const url = busca ? `../api/dashboard.php?busca=${encodeURIComponent(busca)}` : '../api/dashboard.php';
        const resposta = await fetch(url);

        if (!resposta.ok) {
            throw new Error(`Erro na requisição: Status ${resposta.status}`);
        }

        const dados: DashboardResponse = await resposta.json();

        atualizarCards(dados);
        exibirTabela(dados.produtos);
        exibirTabelaCategoria(dados.categorias);
        exibirTabelaGrupos(dados.grupos);

    } catch (erro) {
        console.error('Falha ao carregar produtos:', erro);
    }
}


const totalProdutosDisponiveis = (produtos: Produto[]): number => {
    return produtos
        .filter((produto) => Number(produto.disponivel) === 1)
        .reduce((acumulador, _) => acumulador + 1, 0);
};

const totalCategorias = (dados: DashboardResponse): number => {
    const categorias = dados.categorias
        .map((categoria) => categoria.nome);

    return categorias.length;
};

const totalGrupos = (dados: DashboardResponse): number => {
    const grupos = dados.grupos
        .map((grupo) => grupo.nome);

    return grupos.length;
};



function formataTabela(produtos: Produto[]): formataProduto[] {
    return produtos.map((produto) => {
        return {
            id: produto.id,
            nome: produto.nome,
            grupo: produto.grupo || '—',
            categoria: produto.categoria || '—',
            statusBadge: Number(produto.disponivel) === 1
                ? '<span class="badge bg-success">Disponível</span>'
                : '<span class="badge bg-danger">Indisponível</span>',
        };
    });
}



function atualizarCards(dados: DashboardResponse): void {

    const pegaTotal = document.getElementById('card-total');
    const pegaGrupo = document.getElementById('card-grupo');
    const pegaCategoria = document.getElementById('card-categoria');
    const pegaDisponiveis = document.getElementById('card-produto-disponivel');
    const pegaCategoriaMaisProdutos = document.getElementById('card-categoria-destaque');
    const pegaGrupoMaisProdutos = document.getElementById('card-grupo-destaque');

    if (pegaTotal) {
        pegaTotal.innerText = dados.totalProdutos.toString();
    }
    if (pegaDisponiveis) {
        pegaDisponiveis.innerText = totalProdutosDisponiveis(dados.produtos).toString();
    }
    if (pegaGrupo) {
        pegaGrupo.innerText = totalGrupos(dados).toString();
    }
    if (pegaCategoria) {
        pegaCategoria.innerText = totalCategorias(dados).toString();
    }

    if (pegaCategoriaMaisProdutos) {
        const destaque = destaqueCategoria(dados.produtos);
        pegaCategoriaMaisProdutos.innerText = `${destaque.nome}`;
    }

    if (pegaGrupoMaisProdutos) {
        const destaque = destaqueGrupo(dados.produtos);
        pegaGrupoMaisProdutos.innerText = `${destaque.nome}`;
    }
}



function exibirTabela(produtos: Produto[]): void {
    const tbody = document.getElementById('tabela-produtos-body');
    if (!tbody) return;

    tbody.innerHTML = '';

    if (produtos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nenhum produto cadastrado.</td></tr>';
        return;
    }

    const formatados = formataTabela(produtos);

    formatados.forEach((item) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.id}</td>
            <td>${item.nome}</td>
            <td>${item.grupo}</td>
            <td>${item.categoria}</td>
            <td>${item.statusBadge}</td>
        `;
        tbody.appendChild(tr);
    });
}


function exibirTabelaCategoria(categorias: Categoria[]): void {
    const tbody = document.getElementById('tabela-categorias-body');
    if (!tbody) return;

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




function exibirTabelaGrupos(grupos: Grupo[]): void {
    const tbody = document.getElementById('tabela-grupos-body');
    if (!tbody) return;
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

    const buscar = document.getElementById('filtro-busca') as HTMLInputElement | null;
    buscar?.addEventListener('input', () => {
        carregarDashboard(buscar.value.trim());
    });
});



const destaqueCategoria = (produtos: Produto[]): Destaque => {
    if (produtos.length === 0) {
        return { nome: 'Não existe nenhum registro!', total: 0 };
    }
    const disponiveis: Record<string, number> = {};
    for (const produto of produtos) {
        const categoria = produto.categoria || 'Não tem categoria';
        disponiveis[categoria] = (disponiveis[categoria] || 0) + 1;
    }
    let categoriaComMaisProdutos = 'Não tem categoria';
    let categoriaComMaisQuantidade = 0;
    for (const [categoria, quantidade] of Object.entries(disponiveis)) {
        if (quantidade > categoriaComMaisQuantidade) {
            categoriaComMaisProdutos = categoria;
            categoriaComMaisQuantidade = quantidade;
        }
    }
    return {
        nome: categoriaComMaisProdutos,
        total: categoriaComMaisQuantidade,
    };
};



const destaqueGrupo = (produtos: Produto[]): Destaque => {
    if (produtos.length === 0) {
        return { nome: 'Não existe nenhum registro!', total: 0 };
    }

    const disponiveis: Record<string, number> = {};
    for (const produto of produtos) {
        const grupo = produto.grupo || 'Não tem grupo';
        disponiveis[grupo] = (disponiveis[grupo] || 0) + 1;
    }

    let grupoComMaisProdutos = 'Não tem grupo';
    let grupoComMaisQuantidade = 0;

    for (const [grupo, quantidade] of Object.entries(disponiveis)) {
        if (quantidade > grupoComMaisQuantidade) {
            grupoComMaisProdutos = grupo;
            grupoComMaisQuantidade = quantidade;
        }
    }

    return {
        nome: grupoComMaisProdutos,
        total: grupoComMaisQuantidade,
    };
};
