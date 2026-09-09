type DashboardResponse = {
    totalProdutos: number;
    produtosDisponiveis?: number;
    produtos: Produto[];
    categorias: Categoria[];
    grupos: Grupo[];
};

type Destaque = {
    nome: string;
    total: number;
}

type Produto = {
    id: number;
    nome: string;
    descricao: string | null;
    imagem_url: string | null;
    peso: string;
    tipo_embalagem: string;
    disponivel: boolean | number;
    categoria: string | null;
    grupo: string | null;
};

type Categoria = {
    id: number;
    nome: string;
};

type Grupo = {
    id: number;
    nome: string;
};