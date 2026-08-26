type DashboardResponse = {
    totalProdutos: number;
    produtos: Produto[];
};

type Produto = {
    id: number;
    nome: string;
    descricao: string | null;
    imagem_url: string | null;
    disponivel: boolean;
    categoria: string | null;
    grupo: string | null;
};