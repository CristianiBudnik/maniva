CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `grupo` (`id`, `nome`, `descricao`) VALUES
(4, 'Mandioca', 'Produtos derivados da mandioca: farinhas, polvilhos, féculas, tapioca, sagu e pão de queijo'),
(5, 'Milho', 'Produtos derivados do milho'),
(6, 'Linha para Animais', 'Linha de produtos para animais de estimação - marca GatoMan'),
(7, 'teste', '<p>testando</p>');


CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categoria` (`id`, `grupo_id`, `nome`, `descricao`) VALUES
(9, 4, 'Farinha', 'Farinhas de mandioca em diversos tipos, granulações e embalagens'),
(10, 4, 'Farofa', 'Farofas prontas para servir'),
(11, 4, 'Polvilho', 'Polvilho doce e azedo, derivados da mandioca'),
(12, 4, 'Fécula', 'Fécula de mandioca (goma)'),
(13, 4, 'Tapioca', 'Massa pronta para tapioca e derivados'),
(14, 4, 'Sagu', 'Sagu de mandioca'),
(15, 4, 'Pão de Queijo', 'Linha especial de produtos para pão de queijo'),
(16, 5, 'Flocão', 'Farinha de milho flocada'),
(17, 5, 'Pipoca', 'Milho para pipoca'),
(18, 5, 'Amido de Milho', 'Amido de milho'),
(19, 5, 'Fubá', 'Fubá mimoso, farinha de milho fina'),
(20, 6, 'Areia Higiênica', 'Areia higiênica granulada para gatos'),
(21, 7, 'gatooooo', '<p>teste</p>');


CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL,
  `peso` varchar(20) NOT NULL,
  `tipo_embalagem` varchar(60) NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `produto` (`id`, `nome`, `descricao`, `imagem_url`, `peso`, `tipo_embalagem`, `disponivel`) VALUES
(1, 'Farinha de Mandioca Branca Fina', 'Farinha de mandioca branca, classe fina', NULL, '1kg', 'Embalagem Plástico', 1),
(2, 'Farinha de Mandioca Branca Fina', 'Farinha de mandioca branca, classe fina', NULL, '500g', 'Embalagem Plástico', 1),
(3, 'Farinha de Mandioca Branca Fina', 'Farinha de mandioca branca, classe fina', NULL, '1kg', 'Embalagem Papel', 1),
(4, 'Farinha de Mandioca Branca Fina', 'Farinha de mandioca branca, classe fina', NULL, '500g', 'Embalagem Papel', 1),
(5, 'Farinha de Mandioca Branca Fina', 'Farinha de mandioca branca, classe fina', NULL, '500g', 'Garrafa Pet P', 1),
(6, 'Farinha de Mandioca Torrada Fina', 'Farinha de mandioca torrada, classe fina', NULL, '1kg', 'Embalagem Plástico', 1),
(7, 'Farinha de Mandioca Torrada Fina', 'Farinha de mandioca torrada, classe fina', NULL, '500g', 'Embalagem Plástico', 1),
(8, 'Farinha de Mandioca Torrada Fina', 'Farinha de mandioca torrada, classe fina', NULL, '1kg', 'Embalagem Papel', 1),
(9, 'Farinha de Mandioca Torrada Fina', 'Farinha de mandioca torrada, classe fina', NULL, '500g', 'Embalagem Papel', 1),
(10, 'Farinha de Mandioca Torrada Fina', 'Farinha de mandioca torrada, classe fina', NULL, '500g', 'Garrafa Pet P', 1),
(11, 'Farinha de Mandioca Grossa Crocante', 'Farinha de mandioca grossa e crocante', NULL, '1kg', 'Embalagem Plástico', 1),
(12, 'Farinha de Mandioca Grossa Crocante', 'Farinha de mandioca grossa e crocante', NULL, '500g', 'Embalagem Plástico', 1),
(13, 'Farinha de Mandioca Torrada e Temperada', 'Farinha de mandioca torrada e temperada, sabor tradicional', NULL, '500g', 'Embalagem Met', 1),
(14, 'Farinha de Mandioca Torrada e Temperada', 'Farinha de mandioca torrada e temperada, sabor tradicional', NULL, '500g', 'Garrafa Pet P', 1),
(15, 'Farinha de Mandioca Amarela Fina', 'Farinha de mandioca amarela, classe fina, linha premium', NULL, '500g', 'Garrafa Pet P', 1),
(16, 'Farinha Biju de Mandioca', 'Farinha de mandioca tipo biju', NULL, '500g', 'Embalagem Plástico', 1),
(17, 'Farinha Biju de Mandioca', 'Farinha de mandioca tipo biju', NULL, '25kg', 'Saco (Torrada', 1),
(18, 'Farinha de Mandioca Branca Média (Peneira 10)', 'Farinha de mandioca branca, peneira 10, classe média, a granel', NULL, '50kg', 'Saco', 1),
(19, 'Farinha de Mandioca Branca Grossa (Peneira 06)', 'Farinha de mandioca branca, peneira 06, classe grossa, a granel', NULL, '50kg', 'Saco', 1),
(20, 'Farinha de Mandioca Branca Grossa (Peneira 06)', 'Farinha de mandioca branca, peneira 06, classe grossa, a granel', NULL, '25kg', 'Saco', 1),
(21, 'Farinha de Mandioca Amarela Média (Peneira 10)', 'Farinha de mandioca amarela, peneira 10, classe média, a granel', NULL, '50kg', 'Saco', 1),
(22, 'Farinha de Mandioca Amarela Grossa (Peneira 06)', 'Farinha de mandioca amarela, peneira 06, classe grossa, a granel', NULL, '50kg', 'Saco', 1),
(23, 'Farinha de Mandioca Branca Fina a Granel (Peneira 18)', 'Farinha de mandioca branca, peneira 18, classe fina, a granel', NULL, '25kg', 'Saco', 1),
(24, 'Farinha de Mandioca Torrada Fina a Granel (Peneira 18)', 'Farinha de mandioca torrada, peneira 18, classe fina, a granel', NULL, '25kg', 'Saco', 1),
(25, 'Farinha de Mandioca Branca a Granel', 'Farinha de mandioca branca, saco a granel', NULL, '50kg', 'Saco', 1),
(26, 'Farinha de Mandioca Torrada a Granel', 'Farinha de mandioca torrada, saco a granel', NULL, '50kg', 'Saco', 1),
(27, 'Farinha de Mandioca Amarela a Granel', 'Farinha de mandioca amarela, saco a granel', NULL, '50kg', 'Saco', 1),
(28, 'Farofa Pronta Tradicional', 'Farofa pronta sabor tradicional', NULL, '250g', 'Embalagem Metálica', 1),
(29, 'Farofa Pronta Suave', 'Farofa pronta sabor suave', NULL, '250g', 'Embalagem Metálica', 1),
(30, 'Polvilho Doce', 'Polvilho doce de mandioca', NULL, '1kg', 'Embalagem Plástico', 1),
(31, 'Polvilho Doce', 'Polvilho doce de mandioca', NULL, '500g', 'Embalagem Plástico', 1),
(32, 'Polvilho Doce', 'Polvilho doce de mandioca', NULL, '25kg', 'Embalagem Papel', 1),
(33, 'Polvilho Doce', 'Polvilho doce de mandioca', NULL, '1kg', 'Embalagem Papel', 1),
(34, 'Polvilho Azedo', 'Polvilho azedo de mandioca', NULL, '1kg', 'Embalagem Plástico', 1),
(35, 'Polvilho Azedo', 'Polvilho azedo de mandioca', NULL, '500g', 'Embalagem Plástico', 1),
(36, 'Polvilho Azedo', 'Polvilho azedo de mandioca', NULL, '25kg', 'Embalagem Papel', 1),
(37, 'Polvilho Azedo', 'Polvilho azedo de mandioca', NULL, '1kg', 'Embalagem Papel', 1),
(38, 'Fécula de Mandioca', 'Fécula de mandioca / amido de goma', NULL, '1kg', 'Embalagem Plástico', 1),
(39, 'Fécula de Mandioca', 'Fécula de mandioca / amido de goma', NULL, '25kg', 'Embalagem Papel', 1),
(40, 'Massa Pronta para Tapioca', 'Massa pronta para tapioca, goma de mandioca hidratada', NULL, '1kg', 'Embalagem Plástico', 1),
(41, 'Massa Pronta para Tapioca', 'Massa pronta para tapioca, goma de mandioca hidratada', NULL, '500g', 'Embalagem Plástico', 1),
(42, 'Massa Pronta para Tapioca Granulada', 'Massa pronta para tapioca em versão granulada, sem glúten', NULL, '500g', 'Embalagem Plástico', 1),
(43, 'Sagu', 'Sagu de mandioca', NULL, '500g', 'Embalagem Plástico', 1),
(44, 'Mistura para Pão de Queijo', 'Mistura pronta e prática para preparo de pão de queijo', NULL, '1kg', 'Embalagem Plástico', 1),
(45, 'Mistura para Pão de Queijo', 'Mistura pronta e prática para preparo de pão de queijo', NULL, '500g', 'Embalagem Plástico', 1),
(46, 'ManiMix - Polvilho Especial para Pão de Queijo', 'Polvilho de mandioca especial para pão de queijo, não necessita escaldar', NULL, '1kg', 'Embalagem Plástico', 1),
(47, 'ManiMix - Polvilho Especial para Pão de Queijo', 'Polvilho de mandioca especial para pão de queijo, não necessita escaldar', NULL, '25kg', 'Embalagem Papel', 1),
(48, 'Farinha de Milho Flocada', 'Farinha de milho flocada (flocão)', NULL, '500g', 'Embalagem Plástico', 1),
(49, 'Milho para Pipoca', 'Milho para pipoca, grãos de primeira qualidade', NULL, '500g', 'Embalagem Plástico', 1),
(50, 'Amido de Milho', 'Amido de milho', NULL, '500g', 'Embalagem Plástico', 1),
(51, 'Amido de Milho', 'Amido de milho', NULL, '25kg', 'Embalagem Papel', 1),
(52, 'Fubá Mimoso', 'Fubá mimoso, farinha de milho fina', NULL, '500g', 'Embalagem Plástico', 1),
(53, 'Areia Higiênica para Gatos - GatoMan', 'Areia higiênica granulada para gatos, controle de odor, descarte prático', NULL, '4kg', 'Pacote', 1);


CREATE TABLE `produto_categoria` (
  `produto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `produto_categoria` (`produto_id`, `categoria_id`) VALUES
(1, 9), (2, 9), (3, 9), (4, 9), (5, 9), (6, 9), (7, 9), (8, 9), (9, 9), (10, 9),
(11, 9), (12, 9), (13, 9), (14, 9), (15, 9), (16, 9), (17, 9), (18, 9), (19, 9), (20, 9),
(21, 9), (22, 9), (23, 9), (24, 9), (25, 9), (26, 9), (27, 9),
(28, 10), (29, 10),
(30, 11), (31, 11), (32, 11), (33, 11), (34, 11), (35, 11), (36, 11), (37, 11),
(38, 12), (39, 12),
(40, 13), (41, 13), (42, 13),
(43, 14),
(44, 15), (45, 15), (46, 15), (47, 15),
(48, 16),
(49, 17),
(50, 18), (51, 18),
(52, 19),
(53, 20);

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(30) NOT NULL,
  `salario` double NOT NULL,
  `datanascimento` date NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `cpf`, `salario`, `datanascimento`, `ativo`) VALUES
(1, 'Administrador', 'admin@gmail.com', '$2y$10$UlRENRQON2SjaSYAxmYs4OydOa5NkiJTqdZMbKiJbH75yZ5Xfebom', '094.650.100-90', 3500, '1980-07-22', 'Sim'),
(2, 'Bill Gates', 'teste@teste.com', '$2y$10$ineMFivFCCHdP3gGGWfoR.RRqt.3jYDbIi.mXDPLjIM0vvYps9j7G', '424.454.180-20', 3500, '2000-10-20', 'Sim');



ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_grupo` (`grupo_id`),
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;


ALTER TABLE `produto_categoria`
  ADD PRIMARY KEY (`produto_id`, `categoria_id`),
  ADD KEY `fk_produto_categoria_categoria` (`categoria_id`);


ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `produto_categoria`
  ADD CONSTRAINT `fk_produto_categoria_produto` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produto_categoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- View Analítica de Produtos (Dashboard), faz a junção das tabelas produto, categoria e grupo, para serem usadas na dashboard
CREATE OR REPLACE VIEW `vw_produtos_dashboard` AS
WITH cte_produtos_limpos AS (
    SELECT 
        p.id,
        TRIM(p.nome) AS nome,
        COALESCE(NULLIF(TRIM(p.descricao), ''), 'Sem descrição') AS descricao,
        COALESCE(p.imagem_url, 'sem-foto.png') AS imagem_url,
        TRIM(p.peso) AS peso,
        TRIM(p.tipo_embalagem) AS tipo_embalagem,
        p.disponivel,
        CASE WHEN p.disponivel = 1 THEN 'Disponível' ELSE 'Indisponível' END AS status_texto
    FROM produto p
)
SELECT  -- Seleciona os dados da tabela produto, categoria e grupo, faz a junção das tabelas produto, categoria e grupo, para serem usadas na dashboard, cp é um apelido para cte_produtos_limpos, pc é um apelido para produto_categoria, c é um apelido para categoria, g é um apelido para grupo
    cp.id,
    cp.nome,
    cp.descricao,
    cp.imagem_url,
    cp.peso,
    cp.tipo_embalagem,
    cp.disponivel,
    cp.status_texto,
    c.id AS categoria_id,
    COALESCE(c.nome, 'Sem Categoria') AS categoria, -- Seleciona o nome da categoria, se não tiver, mostra 'Sem Categoria'
    g.id AS grupo_id,
    COALESCE(g.nome, 'Sem Grupo') AS grupo
FROM cte_produtos_limpos cp
LEFT JOIN produto_categoria pc ON pc.produto_id = cp.id
LEFT JOIN categoria c ON c.id = pc.categoria_id
LEFT JOIN grupo g ON g.id = c.grupo_id;

-- View Analítica de Categorias (Dashboard), faz a junção das tabelas categoria e grupo, para serem usadas na dashboard
CREATE OR REPLACE VIEW `vw_categoria_dashboard` AS
WITH cte_categoria_dados AS (
    SELECT 
        pc.categoria_id,
        COUNT(p.id) AS total_produtos,
        SUM(CASE WHEN p.disponivel = 1 THEN 1 ELSE 0 END) AS produtos_disponiveis
    FROM produto_categoria pc
    INNER JOIN produto p ON p.id = pc.produto_id
    GROUP BY pc.categoria_id
)
SELECT 
    c.id,
    TRIM(c.nome) AS nome,
    COALESCE(NULLIF(TRIM(c.descricao), ''), 'Sem descrição') AS descricao,
    g.id AS grupo_id,
    COALESCE(g.nome, 'Sem Grupo') AS grupo,
    COALESCE(mc.total_produtos, 0) AS total_produtos,
    COALESCE(mc.produtos_disponiveis, 0) AS produtos_disponiveis
FROM categoria c
LEFT JOIN grupo g ON g.id = c.grupo_id
LEFT JOIN cte_categoria_dados mc ON mc.categoria_id = c.id;

-- View Analítica de Grupos (Dashboard), faz a junção das tabelas grupo, categoria e produto, para serem usadas na dashboard
CREATE OR REPLACE VIEW `vw_grupo_dashboard` AS
WITH cte_grupo_dados AS (
    SELECT 
        c.grupo_id,
        COUNT(DISTINCT c.id) AS total_categorias,
        COUNT(p.id) AS total_produtos,
        SUM(CASE WHEN p.disponivel = 1 THEN 1 ELSE 0 END) AS produtos_disponiveis
    FROM categoria c
    LEFT JOIN produto_categoria pc ON pc.categoria_id = c.id
    LEFT JOIN produto p ON p.id = pc.produto_id
    GROUP BY c.grupo_id
)
SELECT 
    g.id,
    TRIM(g.nome) AS nome,
    COALESCE(NULLIF(TRIM(g.descricao), ''), 'Sem descrição') AS descricao,
    COALESCE(mg.total_categorias, 0) AS total_categorias,
    COALESCE(mg.total_produtos, 0) AS total_produtos,
    COALESCE(mg.produtos_disponiveis, 0) AS produtos_disponiveis
FROM grupo g
LEFT JOIN cte_grupo_dados mg ON mg.grupo_id = g.id;


-- Procedure 1: Indicadores e Totais da Dashboard
/*faz a contagem de produtos, produtos disponiveis, categorias e grupos
e retorna o resultado para serem usados na dashboard*/
CREATE OR REPLACE PROCEDURE `sp_dashboard_geral`()
SELECT 
    (SELECT COUNT(id) FROM produto) AS total_produtos,
    (SELECT COUNT(id) FROM produto WHERE disponivel = 1) AS produtos_disponiveis,
    (SELECT COUNT(id) FROM categoria) AS total_categorias,
    (SELECT COUNT(id) FROM grupo) AS total_grupos;


-- Procedure 2: Busca, Filtros e Paginação de Produtos
/*faz a busca e filtra os produtos por categoria
recebe parametro de busca, categoria_id, limit e offset
retorna o resultado para serem usados na dashboard*/
CREATE OR REPLACE PROCEDURE `sp_produtos_dashboard`(
    IN `p_busca` VARCHAR(150),
    IN `p_categoria_id` INT,
    IN `p_limit` INT,
    IN `p_offset` INT
)
SELECT 
    id,
    nome,
    descricao,
    imagem_url,
    peso,
    tipo_embalagem,
    disponivel,
    status_texto,
    categoria_id,
    categoria,
    grupo_id,
    grupo
FROM vw_produtos_dashboard
WHERE (p_busca IS NULL OR nome LIKE CONCAT('%', p_busca, '%') OR descricao LIKE CONCAT('%', p_busca, '%'))
  AND (p_categoria_id IS NULL OR categoria_id = p_categoria_id)
ORDER BY nome ASC
LIMIT p_limit OFFSET p_offset;


-- Trigger para garantir salário positivo na ATUALIZAÇÃO (BEFORE UPDATE) com BEGIN e END
/* faz a verificação do salário do usuário antes de ser atualizado
 e garante que seja sempre positivo, caso seja negativo, converte para positivo
recebe como parametro o salário do usuário
retorna o salário do usuário
*/
CREATE OR REPLACE TRIGGER `trg_usuario_salario_positivo_update`
BEFORE UPDATE ON `usuario`
FOR EACH ROW
BEGIN
    IF NEW.salario < 0 THEN
        SET NEW.salario = ABS(NEW.salario);
    END IF;
END;

-- Trigger para garantir salário positivo no CADASTRO (BEFORE INSERT)
/* faz a verificação do salário do usuário antes de ser cadastrado
 e garante que seja sempre positivo, caso seja negativo, converte para positivo
recebe como parametro o salário do usuário
retorna o salário do usuário
*/
CREATE OR REPLACE TRIGGER `trg_usuario_salario_positivo_insert`
BEFORE INSERT ON `usuario`
FOR EACH ROW
BEGIN
    IF NEW.salario < 0 THEN
        SET NEW.salario = ABS(NEW.salario);
    END IF;
END;


-- Função que busca o total de produtos ativos de uma categoria
/*recebe como parametro o id da categoria
retorna o total de produtos ativos na categoria
*/
CREATE FUNCTION `fn_total_produtos_categoria`(
    `p_categoria_id` INT
)
RETURNS INT
READS SQL DATA -- READS SQL DATA indica que a função lê dados do banco
BEGIN
    DECLARE total INT;
    SELECT COUNT(p.id)
    INTO total
    FROM produto p
    INNER JOIN produto_categoria pc ON pc.produto_id = p.id
    WHERE pc.categoria_id = p_categoria_id AND p.disponivel = 1;
    RETURN total;
END;

-- View Centralizadora: Catálogo Geral de Produtos, Categorias e Grupos
/* Centraliza as informações mais importantes do catálogo espalhadas em tabelas distintas:
   - produto (detalhes, peso, embalagem, status)
   - categoria (nome e descrição da categoria)
   - grupo (linha/grupo principal)
   - produto_categoria (tabela associativa/relacionamento)
*/
CREATE OR REPLACE VIEW `vw_catalogo_completo` AS
SELECT 
    -- 1. Dados do Produto
    p.id AS produto_id,
    p.nome AS produto_nome,
    COALESCE(NULLIF(TRIM(p.descricao), ''), 'Sem descrição') AS produto_descricao,
    p.peso,
    p.tipo_embalagem,
    COALESCE(p.imagem_url, 'sem-foto.png') AS imagem_url,
    p.disponivel AS produto_disponivel,
    CASE 
        WHEN p.disponivel = 1 THEN 'Ativo' 
        ELSE 'Inativo' 
    END AS produto_status_texto,

    -- 2. Dados da Categoria (Tabela Distinta)
    c.id AS categoria_id,
    COALESCE(c.nome, 'Sem Categoria') AS categoria_nome,
    c.descricao AS categoria_descricao,

    -- 3. Dados do Grupo (Tabela Distinta)
    g.id AS grupo_id,
    COALESCE(g.nome, 'Sem Grupo') AS grupo_nome,
    g.descricao AS grupo_descricao

FROM produto p
INNER JOIN produto_categoria pc ON pc.produto_id = p.id
INNER JOIN categoria c ON c.id = pc.categoria_id
INNER JOIN grupo g ON g.id = c.grupo_id;

SELECT * FROM vw_categoria_dashboard;

SELECT id, nome, total_produtos, produtos_disponiveis FROM vw_categoria_dashboard;