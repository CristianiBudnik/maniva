-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/08/2026 às 23:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `maniva`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_produtos_busca` (IN `p_busca` VARCHAR(150), IN `p_categoria_id` INT, IN `p_limit` INT, IN `p_offset` INT)   BEGIN
    SET @busca = CONCAT('%', IFNULL(p_busca, ''), '%');
    SET @categoria_id = p_categoria_id;
    SET @limit_val = IFNULL(p_limit, 10);
    SET @offset_val = IFNULL(p_offset, 0);

    SET @sql = 'SELECT * FROM vw_produtos_analitico
                 WHERE nome LIKE ?
                   AND (? IS NULL OR categoria_id = ?)
                 ORDER BY nome
                 LIMIT ? OFFSET ?';

    PREPARE stmt FROM @sql;
    EXECUTE stmt USING @busca, @categoria_id, @categoria_id, @limit_val, @offset_val;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

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
(20, 6, 'Areia Higiênica', 'Areia higiênica granulada para gatos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `grupo`
--

INSERT INTO `grupo` (`id`, `nome`, `descricao`) VALUES
(4, 'Mandioca', 'Produtos derivados da mandioca: farinhas, polvilhos, féculas, tapioca, sagu e pão de queijo'),
(5, 'Milho', 'Produtos derivados do milho'),
(6, 'Linha para Animais', 'Linha de produtos para animais de estimação - marca GatoMan');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `imagem_url`, `disponivel`) VALUES
(10, 'Farinha de Mandioca Branca Fina', 'Farinha de mandioca branca, classe fina', NULL, 1),
(11, 'Farinha de Mandioca Torrada Fina', 'Farinha de mandioca torrada, classe fina', NULL, 1),
(12, 'Farinha de Mandioca Grossa Crocante', 'Farinha de mandioca grossa e crocante', NULL, 1),
(13, 'Farinha de Mandioca Torrada e Temperada', 'Farinha de mandioca torrada e temperada, sabor tradicional', NULL, 1),
(14, 'Farinha de Mandioca Amarela Fina', 'Farinha de mandioca amarela, classe fina, linha premium', NULL, 1),
(15, 'Farinha Biju de Mandioca', 'Farinha de mandioca tipo biju', NULL, 1),
(16, 'Farinha de Mandioca Branca Média (Peneira 10)', 'Farinha de mandioca branca, peneira 10, classe média, a granel', NULL, 1),
(17, 'Farinha de Mandioca Branca Grossa (Peneira 06)', 'Farinha de mandioca branca, peneira 06, classe grossa, a granel', NULL, 1),
(18, 'Farinha de Mandioca Amarela Média (Peneira 10)', 'Farinha de mandioca amarela, peneira 10, classe média, a granel', NULL, 1),
(19, 'Farinha de Mandioca Amarela Grossa (Peneira 06)', 'Farinha de mandioca amarela, peneira 06, classe grossa, a granel', NULL, 1),
(20, 'Farinha de Mandioca Branca Fina a Granel (Peneira 18)', 'Farinha de mandioca branca, peneira 18, classe fina, a granel', NULL, 1),
(21, 'Farinha de Mandioca Torrada Fina a Granel (Peneira 18)', 'Farinha de mandioca torrada, peneira 18, classe fina, a granel', NULL, 1),
(22, 'Farinha de Mandioca Branca a Granel', 'Farinha de mandioca branca, saco a granel', NULL, 1),
(23, 'Farinha de Mandioca Torrada a Granel', 'Farinha de mandioca torrada, saco a granel', NULL, 1),
(24, 'Farinha de Mandioca Amarela a Granel', 'Farinha de mandioca amarela, saco a granel', NULL, 1),
(25, 'Farofa Pronta Tradicional', 'Farofa pronta sabor tradicional', NULL, 1),
(26, 'Farofa Pronta Suave', 'Farofa pronta sabor suave', NULL, 1),
(27, 'Polvilho Doce', 'Polvilho doce de mandioca', NULL, 1),
(28, 'Polvilho Azedo', 'Polvilho azedo de mandioca', NULL, 1),
(29, 'Fécula de Mandioca', 'Fécula de mandioca / amido de goma', NULL, 1),
(30, 'Massa Pronta para Tapioca', 'Massa pronta para tapioca, goma de mandioca hidratada', NULL, 1),
(31, 'Massa Pronta para Tapioca Granulada', 'Massa pronta para tapioca em versão granulada, sem glúten', NULL, 1),
(32, 'Sagu', 'Sagu de mandioca', NULL, 1),
(33, 'Mistura para Pão de Queijo', 'Mistura pronta e prática para preparo de pão de queijo', NULL, 1),
(34, 'ManiMix - Polvilho Especial para Pão de Queijo', 'Polvilho de mandioca especial para pão de queijo, não necessita escaldar', NULL, 1),
(35, 'Farinha de Milho Flocada', 'Farinha de milho flocada (flocão)', NULL, 1),
(36, 'Milho para Pipoca', 'Milho para pipoca, grãos de primeira qualidade', NULL, 1),
(37, 'Amido de Milho', 'Amido de milho', NULL, 1),
(38, 'Fubá Mimoso', 'Fubá mimoso, farinha de milho fina', NULL, 1),
(39, 'Areia Higiênica para Gatos - GatoMan', 'Areia higiênica granulada para gatos, controle de odor, descarte prático', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_categoria`
--

CREATE TABLE `produto_categoria` (
  `produto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto_categoria`
--

INSERT INTO `produto_categoria` (`produto_id`, `categoria_id`) VALUES
(10, 9),
(11, 9),
(12, 9),
(13, 9),
(14, 9),
(15, 9),
(16, 9),
(17, 9),
(18, 9),
(19, 9),
(20, 9),
(21, 9),
(22, 9),
(23, 9),
(24, 9),
(25, 10),
(26, 10),
(27, 11),
(28, 11),
(29, 12),
(30, 13),
(31, 13),
(32, 14),
(33, 15),
(34, 15),
(35, 16),
(36, 17),
(37, 18),
(38, 19),
(39, 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reclamacao`
--

CREATE TABLE `reclamacao` (
  `id` int(11) NOT NULL,
  `tipo` enum('reclamacao','elogio') NOT NULL DEFAULT 'reclamacao',
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `produto` varchar(150) DEFAULT NULL,
  `data_fabricacao` date DEFAULT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `status` enum('pendente','em_analise','resolvido') NOT NULL DEFAULT 'pendente',
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

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

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `cpf`, `salario`, `datanascimento`, `ativo`) VALUES
(1, 'Administrador', 'admin@gmail.com', '$2y$10$UlRENRQON2SjaSYAxmYs4OydOa5NkiJTqdZMbKiJbH75yZ5Xfebom', '094.650.100-90', 3500, '1980-07-22', 'Sim'),
(2, 'Bill Gates', 'teste@teste.com', '$2y$10$ineMFivFCCHdP3gGGWfoR.RRqt.3jYDbIi.mXDPLjIM0vvYps9j7G', '424.454.180-20', 3500, '2000-10-20', 'Sim');

--
-- Acionadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `trg_usuario_salario_positivo` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
    IF NEW.salario < 0 THEN
        SET NEW.salario = ABS(NEW.salario);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `variacao_produto`
--

CREATE TABLE `variacao_produto` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `peso` varchar(20) NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `variacao_produto`
--

INSERT INTO `variacao_produto` (`id`, `produto_id`, `peso`, `disponivel`) VALUES
(21, 10, '1kg - Embalagem Plás', 1),
(22, 10, '500g - Embalagem Plá', 1),
(23, 10, '1kg - Embalagem Pape', 1),
(24, 10, '500g - Embalagem Pap', 1),
(25, 10, '500g - Garrafa Pet P', 1),
(26, 11, '1kg - Embalagem Plás', 1),
(27, 11, '500g - Embalagem Plá', 1),
(28, 11, '1kg - Embalagem Pape', 1),
(29, 11, '500g - Embalagem Pap', 1),
(30, 11, '500g - Garrafa Pet P', 1),
(31, 12, '1kg - Embalagem Plás', 1),
(32, 12, '500g - Embalagem Plá', 1),
(33, 13, '500g - Embalagem Met', 1),
(34, 13, '500g - Garrafa Pet P', 1),
(35, 14, '500g - Garrafa Pet P', 1),
(36, 15, '500g - Embalagem Plá', 1),
(37, 15, '25kg - Saco (Torrada', 1),
(38, 16, '50kg - Saco', 1),
(39, 17, '50kg - Saco', 1),
(40, 17, '25kg - Saco', 1),
(41, 18, '50kg - Saco', 1),
(42, 19, '50kg - Saco', 1),
(43, 20, '25kg - Saco', 1),
(44, 21, '25kg - Saco', 1),
(45, 22, '50kg - Saco', 1),
(46, 23, '50kg - Saco', 1),
(47, 24, '50kg - Saco', 1),
(48, 25, '250g - Embalagem Met', 1),
(49, 26, '250g - Embalagem Met', 1),
(50, 27, '1kg - Embalagem Plás', 1),
(51, 27, '500g - Embalagem Plá', 1),
(52, 27, '25kg - Embalagem Pap', 1),
(53, 27, '1kg - Embalagem Pape', 1),
(54, 28, '1kg - Embalagem Plás', 1),
(55, 28, '500g - Embalagem Plá', 1),
(56, 28, '25kg - Embalagem Pap', 1),
(57, 28, '1kg - Embalagem Pape', 1),
(58, 29, '1kg - Embalagem Plás', 1),
(59, 29, '25kg - Embalagem Pap', 1),
(60, 30, '1kg - Embalagem Plás', 1),
(61, 30, '500g - Embalagem Plá', 1),
(62, 31, '500g - Embalagem Plá', 1),
(63, 32, '500g - Embalagem Plá', 1),
(64, 33, '1kg - Embalagem Plás', 1),
(65, 33, '500g - Embalagem Plá', 1),
(66, 34, '1kg - Embalagem Plás', 1),
(67, 34, '25kg - Embalagem Pap', 1),
(68, 35, '500g - Embalagem Plá', 1),
(69, 36, '500g - Embalagem Plá', 1),
(70, 37, '500g - Embalagem Plá', 1),
(71, 37, '25kg - Embalagem Pap', 1),
(72, 38, '500g - Embalagem Plá', 1),
(73, 39, '4kg - Pacote', 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_produtos_analitico`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_produtos_analitico` (
`id` int(11)
,`nome` varchar(150)
,`descricao` text
,`imagem_url` varchar(255)
,`disponivel` tinyint(1)
,`categoria_id` int(11)
,`categoria` varchar(100)
,`grupo_id` int(11)
,`grupo` varchar(100)
,`total_variacoes` bigint(21)
,`variacoes_disponiveis` decimal(22,0)
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_produtos_analitico`
--
DROP TABLE IF EXISTS `vw_produtos_analitico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_produtos_analitico`  AS WITH produto_variacoes AS (SELECT `variacao_produto`.`produto_id` AS `produto_id`, count(0) AS `total_variacoes`, sum(case when `variacao_produto`.`disponivel` = 1 then 1 else 0 end) AS `variacoes_disponiveis` FROM `variacao_produto` GROUP BY `variacao_produto`.`produto_id`)  SELECT `p`.`id` AS `id`, `p`.`nome` AS `nome`, `p`.`descricao` AS `descricao`, `p`.`imagem_url` AS `imagem_url`, `p`.`disponivel` AS `disponivel`, `c`.`id` AS `categoria_id`, `c`.`nome` AS `categoria`, `g`.`id` AS `grupo_id`, `g`.`nome` AS `grupo`, coalesce(`pv`.`total_variacoes`,0) AS `total_variacoes`, coalesce(`pv`.`variacoes_disponiveis`,0) AS `variacoes_disponiveis` FROM ((((`produto` `p` left join `produto_categoria` `pc` on(`pc`.`produto_id` = `p`.`id`)) left join `categoria` `c` on(`c`.`id` = `pc`.`categoria_id`)) left join `grupo` `g` on(`g`.`id` = `c`.`grupo_id`)) left join `produto_variacoes` `pv` on(`pv`.`produto_id` = `p`.`id`)))  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_grupo` (`grupo_id`);

--
-- Índices de tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD PRIMARY KEY (`produto_id`,`categoria_id`),
  ADD KEY `fk_produto_categoria_categoria` (`categoria_id`);

--
-- Índices de tabela `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `variacao_produto`
--
ALTER TABLE `variacao_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_variacao_produto` (`produto_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `reclamacao`
--
ALTER TABLE `reclamacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `variacao_produto`
--
ALTER TABLE `variacao_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD CONSTRAINT `fk_produto_categoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produto_categoria_produto` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `variacao_produto`
--
ALTER TABLE `variacao_produto`
  ADD CONSTRAINT `fk_variacao_produto` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
