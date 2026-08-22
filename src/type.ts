/**
 * ====================================================================
 * DEFINIÇÃO DE TIPOS (TypeScript)
 * ====================================================================
 * O TypeScript nos permite definir a estrutura ("contrato") dos dados
 * que a API PHP retorna. Isso traz segurança ao código e ajuda o editor
 * a autocompletar os campos.
 */

// Type que representa o formato de um Produto vindo do banco de dados/API PHP
type Produto = {
    id: number;
    nome: string;
    descricao?: string;
    imagem_url?: string | null;
    disponivel: number | string;
    categoria?: string | null;
};