-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 08/09/2023 às 00:40
-- Versão do servidor: 10.4.21-MariaDB
-- Versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `conveniencia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `convenio`
--

CREATE TABLE `convenio` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `total_devido` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `convenio`
--

INSERT INTO `convenio` (`id`, `nome`, `cpf`, `endereco`, `telefone`, `total_devido`) VALUES
(1, 'Joao Vitor dos Santos', '11253809933', 'Rua David Cota, 1013 Pereque', '47997125592', '3.5'),
(2, 'Gustavo Pereira', '11428150994', 'Rua 266, 136', '47996783796', '0'),
(3, 'Gabriel de Paula Cirilo', '15122074976', 'Rua Servidao Jose De Oliveira, 35', '47996119014', '1094.9'),
(4, 'Carlos Eduardo Pucci Silva \r\n', '08160950942', 'Rua Ida Ceni Lorenzi, 11', '47997285706', '1706'),
(5, 'Arthur Bauer', '06505788131', 'Rua Romeu da silva 10, Casa 2', '47988766662', '5'),
(6, 'Cleber Mendes Matos', '11740902947', 'Rua 410, 1710', '47988791803', '221'),
(7, 'Nicolas Pedro Rodrigues', '12919924990', 'Rua 239, 69', '47992936000', '3947'),
(8, 'Emerson Luiz de Lara Oliveira', '06954013943', 'Rua 428, 599', '47999546778', '66'),
(9, 'Matheus Ricardo Vilczak', '11031322965', 'Rua 218, N 42, Ap 205', '47991934972', '0'),
(10, 'Gabriel Wesley Camargo Rovaris', '13556906929', 'Rua 448, N 448', '47992045357', '1230'),
(11, 'Joao Guilherme Turnes Ribeiro Bustamante Freire de Andrade', '12204488933', 'Rua Sebastiao Goncalves Filho, 123, Vila Nova', '48998107773', ' 1363'),
(12, 'Ruderson Santos ', '00408118911', 'Rua 264, 119', '47988607040', '379'),
(13, 'Lucas Veadrigo de Lima ', '12112502964', 'Rua 258C, N 341', '47992175329', '1144'),
(14, 'Wanderllan Lucas Dos Santos Silva Shibukawa', '11348748946', 'Rua 238, N 614', '47991017522', '1444,35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entrada_estoque`
--

CREATE TABLE `entrada_estoque` (
  `id` int(11) UNSIGNED NOT NULL,
  `cod_barra` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `entrada_estoque`
--

INSERT INTO `entrada_estoque` (`id`, `cod_barra`, `quantity`, `data_hora`, `nome`) VALUES
(1, '070847022015', 1, '2023-04-30 02:19:47', 'Energetico Monster 473ml'),
(2, '070847022015', 1, '2023-04-30 02:23:34', 'Energetico Monster 473ml'),
(3, '03', 8, '2023-05-02 04:07:38', '1x Gudang Garam ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `cod_barra` varchar(100) NOT NULL,
  `valor_unitario` varchar(100) NOT NULL,
  `valor_fornecedor` varchar(100) DEFAULT NULL,
  `data_validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `nome`, `quantity`, `cod_barra`, `valor_unitario`, `valor_fornecedor`, `data_validade`) VALUES
(1, 'Cerveja Amstel 350ml', '0', '7896045504831', '6', '3.69', '2024-03-04'),
(2, 'Cerveja Brahma 350ml', '3', '7891149010509', '5', '3.38', '2023-03-30'),
(4, 'Cerveja Original 350ml', '1', '7891991015493', '6', '3.79', NULL),
(5, 'Cerveja Schin 350ml', '6', '7896052605279', '5', '2.58', NULL),
(6, 'Cerveja Brahma Malzbier 350ml', '11', '7891149101528', '6', '4.69', NULL),
(7, 'Energetico Monster 473ml', '5', '070847022015', '12', '7.49', NULL),
(8, 'Cerveja Heineken 330ml', '9', '78936683', '10', '5.99', NULL),
(9, 'Cerveja Sol 330ml', '-2', '78934115', '10', '5.39', NULL),
(10, 'Cerveja Heineken 0 Alcool 330ml', '2', '7896045506040', '10', '5.99', NULL),
(11, 'Tonica 350ml', '10', '7891991000840', '6', '3.19', NULL),
(12, 'Fanta Laranja 350ml', '1', '7894900030013', '5', '2.99', NULL),
(13, 'Coca Cola 350ml', '4', '7894900010015', '5', '2.89', NULL),
(14, 'Sprite 600ml', '5', '7894900681246', '8', '3.29', NULL),
(15, 'Fanta Laranja 600ml', '6', '7894900031607', '8', '3.29', NULL),
(16, 'Coca Cola 600ml', '1', '7894900011609', '8', '4.19', NULL),
(17, 'Suco de Uva Vitaki 1L ', '1', '7898608070104', '12', '5.17', NULL),
(18, 'Agua de Coco do Vale 1L', '3', '7898370103550', '12', '6.99', NULL),
(19, 'Suco de Uva Prats 900ml', '11', '7898953148220', '12', '7.59', NULL),
(20, 'Coca Cola Zero 2L', '2', '7894900701517', '15', '8.89', NULL),
(21, 'Coca Cola 2L', '2', '7894900027013', '15', '8.69', NULL),
(22, 'Energetico RedBull 250ml', '4', '611269991000', '15', '6.99', NULL),
(23, 'Suco de Laranja Purity 200ml', '2', '7897001050041', '5', '1.79', NULL),
(24, 'Agua de Coco Ducoco 200ml', '6', '7896016601972', '5', '2.79', NULL),
(25, 'Agua Font Life 510ml', '3', '08989127', '5', '0.91', NULL),
(26, 'Agua com Gas Font Life 510ml', '11', '7898912374028', '5', '0.99', NULL),
(27, 'Agua com Gas Imperatriz 500ml', '36', '7896806400105', '5', '0.99', NULL),
(28, 'Agua da Pedra 500ml', '9', '7896436100666', '5', '0.91', NULL),
(29, 'Rei do Mate 290ml', '1', '7898075290036', '8', '3.71', NULL),
(30, '1x Cigarro Branco', '6', '02', '1', '0.60', NULL),
(31, 'Agua com Gas Imperatriz 1.5L', '65', '7896806400136', '8', '2.30', NULL),
(32, 'Agua com Gas Font Life 1.5L', '1', '08989127', '8', '2.30', NULL),
(33, 'Agua Imperatriz 1.5L', '2', '7896806400112', '8', '1.99', NULL),
(34, 'Agua Font Life 1.5L', '1', '08989127', '8', '1.99', NULL),
(35, 'Energetico Bally 2L', '2', '7898080662668', '15', '11.79', NULL),
(36, 'Gatorade Limao', '6', '7892840808037', '8', '4.49', NULL),
(37, '1x Cigarro Branco', '-9', '01', '0.50', '0.5', NULL),
(38, '1x Gudang Garam ', '-2', '03', '3', '1', NULL),
(39, '1x Seda G', '0', '04', '1', '0.19', NULL),
(40, '1x Seda P', '0', '05', '0.50', '0.25', NULL),
(41, '1x Caixa Fosforo', '62', '06', '1', '0.46', NULL),
(42, 'Saco de Gelo 3KG', '1', '07', '8', '5.10', NULL),
(43, '1x Gelo De Coco', '3', '08', '5', '2.45', NULL),
(44, '1x Gelo De Maracuja', '18', '09', '5', '2.45', NULL),
(45, '1x Gelo De Morango', '0', '010', '5', '2.45', NULL),
(47, '1x Gelo De Melancia', '57', '011', '5', '2.45', NULL),
(48, '1x Dose Whisky Passaporte', '20', '012', '10', '0', NULL),
(49, '1x Dose Whisky WhiteHorse', '20', '013', '20', '0', NULL),
(50, '1x Dose Vodka Biloff', '20', '016', '10', '0', NULL),
(51, 'Vodka Intencion 900ml', '0', '7898080662330', '40', '0', NULL),
(52, 'vodka smirnoff 1L', '0', '7893218000473', '65', '0', NULL),
(53, 'Vodka Smirnoff Sabor 1L', '2', '7893218003733', '80', '0', NULL),
(54, 'Gin Intencion 900ML', '3', '7898080663771', '45', '0', NULL),
(55, 'Bala Gomets', '0', '7896058506105', '2', '0', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `financeiro`
--

CREATE TABLE `financeiro` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `tipo_pagamento` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `financeiro`
--

INSERT INTO `financeiro` (`id`, `tipo`, `descricao`, `valor_total`, `data_entrada`, `data_saida`, `data_pagamento`, `tipo_pagamento`, `status`) VALUES
(1, 'Entrada', '30 reais do joao', '30.00', '2023-05-01', NULL, '2023-05-01', 'PIX', 'Pago');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_vendidos`
--

CREATE TABLE `itens_vendidos` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `quantidade_produto` int(11) NOT NULL,
  `valor_unitario_produto` decimal(10,2) NOT NULL,
  `valor_total_produto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `itens_vendidos`
--

INSERT INTO `itens_vendidos` (`id`, `id_venda`, `nome_produto`, `quantidade_produto`, `valor_unitario_produto`, `valor_total_produto`) VALUES
(1, 1, 'Energetico Monster 473ml', 1, '12.00', '12.00'),
(2, 2, '1x Cigarro Branco', 1, '1.00', '1.00'),
(3, 2, 'Cerveja Heineken 330ml', 1, '10.00', '10.00'),
(4, 3, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(5, 4, 'Cerveja Heineken 330ml', 1, '10.00', '10.00'),
(6, 5, '1x Gudang Garam ', 4, '3.00', '12.00'),
(7, 6, 'Cerveja Heineken 330ml', 4, '10.00', '40.00'),
(8, 7, 'Agua com Gas Imperatriz 500ml', 1, '5.00', '5.00'),
(9, 8, '1x Cigarro Branco', 1, '1.00', '1.00'),
(10, 9, '1x Dose Vodka Biloff', 1, '10.00', '10.00'),
(11, 10, '1x Cigarro Branco', 4, '0.50', '2.00'),
(12, 11, 'Cerveja Brahma 350ml', 1, '5.00', '5.00'),
(13, 12, 'Energetico Monster 473ml', 1, '12.00', '12.00'),
(14, 13, 'Cerveja Original 350ml', 2, '6.00', '12.00'),
(15, 14, '1x Cigarro Branco', 2, '1.00', '2.00'),
(16, 14, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(17, 15, 'Cerveja Brahma 350ml', 2, '5.00', '10.00'),
(18, 16, '1x Cigarro Branco', 2, '1.00', '2.00'),
(19, 17, 'Cerveja Original 350ml', 5, '6.00', '30.00'),
(20, 18, 'Cerveja Original 350ml', 1, '6.00', '6.00'),
(21, 19, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(22, 20, 'Agua com Gas Imperatriz 500ml', 1, '5.00', '5.00'),
(23, 21, 'Cerveja Original 350ml', 1, '6.00', '6.00'),
(24, 22, '1x Dose Whisky Passaporte', 1, '10.00', '10.00'),
(25, 23, 'Coca Cola 350ml', 1, '5.00', '5.00'),
(26, 24, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(27, 25, 'Cerveja Sol 330ml', 1, '10.00', '10.00'),
(28, 26, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(29, 27, 'Cerveja Brahma 350ml', 2, '5.00', '10.00'),
(30, 28, 'Cerveja Original 350ml', 1, '6.00', '6.00'),
(31, 29, 'Agua Font Life 510ml', 1, '5.00', '5.00'),
(32, 30, '1x Gudang Garam ', 1, '3.00', '3.00'),
(33, 30, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(34, 30, '1x Cigarro Branco', 1, '1.00', '1.00'),
(35, 31, 'Energetico Bally 2L', 1, '15.00', '15.00'),
(36, 31, 'Vodka Intencion 900ml', 1, '40.00', '40.00'),
(37, 32, '1x Gelo De Coco', 1, '5.00', '5.00'),
(38, 33, 'Saco de Gelo 3KG', 1, '8.00', '8.00'),
(39, 34, 'Cerveja Amstel 350ml', 1, '6.00', '6.00'),
(40, 35, '1x Cigarro Branco', 1, '1.00', '1.00'),
(41, 35, '1x Gudang Garam ', 1, '3.00', '3.00'),
(42, 35, 'Cerveja Original 350ml', 1, '6.00', '6.00'),
(43, 36, 'Cerveja Original 350ml', 2, '6.00', '12.00'),
(44, 37, 'Cerveja Original 350ml', 1, '6.00', '6.00'),
(45, 37, '1x Cigarro Branco', 2, '1.00', '2.00'),
(46, 38, '1x Gudang Garam ', 4, '3.00', '12.00'),
(47, 39, '1x Gudang Garam ', 2, '3.00', '6.00'),
(48, 40, 'Cerveja Original 350ml', 1, '6.00', '6.00'),
(49, 41, 'Cerveja Original 350ml', 2, '6.00', '12.00'),
(50, 42, 'Cerveja Brahma 350ml', 1, '5.00', '5.00'),
(51, 43, 'Energetico Monster 473ml', 1, '12.00', '12.00'),
(52, 44, 'Saco de Gelo 3KG', 1, '8.00', '8.00'),
(53, 44, 'vodka smirnoff 1L', 1, '65.00', '65.00'),
(54, 44, 'Energetico Bally 2L', 1, '15.00', '15.00'),
(55, 45, 'Cerveja Brahma 350ml', 2, '5.00', '10.00'),
(56, 46, 'Cerveja Brahma 350ml', 1, '5.00', '5.00'),
(57, 47, 'Cerveja Heineken 330ml', 1, '10.00', '10.00'),
(58, 48, '1x Gudang Garam ', 1, '3.00', '3.00'),
(59, 49, '1x Gudang Garam ', 1, '3.00', '3.00'),
(60, 50, 'Cerveja Sol 330ml', 1, '10.00', '10.00'),
(61, 51, 'Cerveja Sol 330ml', 1, '10.00', '10.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'joao', 'joao@gmail.com', 'joao123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valor_total` varchar(100) DEFAULT NULL,
  `produtos_vendidos` text DEFAULT NULL,
  `forma_pagamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `data`, `valor_total`, `produtos_vendidos`, `forma_pagamento`) VALUES
(1, '2023-04-29 18:50:39', '12.00', 'Energetico Monster 473ml:1:12;', 'dinheiro'),
(2, '2023-04-29 19:45:39', '11.00', '1x Cigarro Branco:1:1;Cerveja Heineken 330ml:1:10;', 'cartao'),
(3, '2023-04-29 20:09:27', '6.00', 'Cerveja Amstel 350ml:1:6;', 'cartao'),
(4, '2023-04-29 20:24:52', '10.00', 'Cerveja Heineken 330ml:1:10;', 'pix'),
(5, '2023-04-29 20:48:37', '12.00', '1x Gudang Garam :4:3;', 'dinheiro'),
(6, '2023-04-29 21:21:56', '40.00', 'Cerveja Heineken 330ml:4:10;', 'cartao'),
(7, '2023-04-29 21:23:35', '5.00', 'Agua com Gas Imperatriz 500ml:1:5;', 'cartao'),
(8, '2023-04-29 22:21:32', '1.00', '1x Cigarro Branco:1:1;', 'cartao'),
(9, '2023-04-29 22:36:45', '10.00', '1x Dose Vodka Biloff:1:10;', 'dinheiro'),
(10, '2023-04-29 22:47:08', '2.00', '1x Cigarro Branco:4:0.50;', 'dinheiro'),
(11, '2023-04-29 23:24:49', '5.00', 'Cerveja Brahma 350ml:1:5;', 'dinheiro'),
(12, '2023-04-29 23:35:05', '12.00', 'Energetico Monster 473ml:1:12;', 'dinheiro'),
(13, '2023-04-29 23:41:34', '12.00', 'Cerveja Original 350ml:2:6;', 'cartao'),
(14, '2023-04-30 00:35:06', '8.00', '1x Cigarro Branco:2:1;Cerveja Amstel 350ml:1:6;', 'cartao'),
(15, '2023-04-30 00:52:27', '10.00', 'Cerveja Brahma 350ml:2:5;', 'cartao'),
(16, '2023-04-30 00:53:16', '2.00', '1x Cigarro Branco:2:1;', 'pix'),
(17, '2023-04-30 01:10:38', '30.00', 'Cerveja Original 350ml:5:6;', 'dinheiro'),
(18, '2023-04-30 01:10:52', '6.00', 'Cerveja Original 350ml:1:6;', 'cartao'),
(19, '2023-04-30 01:11:13', '6.00', 'Cerveja Amstel 350ml:1:6;', 'cartao'),
(20, '2023-04-30 01:14:54', '5.00', 'Agua com Gas Imperatriz 500ml:1:5;', 'cartao'),
(21, '2023-04-30 01:15:01', '6.00', 'Cerveja Original 350ml:1:6;', 'cartao'),
(22, '2023-04-30 01:24:03', '10.00', '1x Dose Whisky Passaporte:1:10;', 'cartao'),
(23, '2023-04-30 01:34:28', '5.00', 'Coca Cola 350ml:1:5;', 'dinheiro'),
(24, '2023-04-30 01:39:29', '6.00', 'Cerveja Amstel 350ml:1:6;', 'pix'),
(25, '2023-04-30 02:11:37', '10.00', 'Cerveja Sol 330ml:1:10;', 'cartao'),
(26, '2023-04-30 02:12:44', '6.00', 'Cerveja Amstel 350ml:1:6;', 'pix'),
(27, '2023-04-30 02:13:47', '10.00', 'Cerveja Brahma 350ml:2:5;', 'pix'),
(28, '2023-04-30 02:36:22', '6.00', 'Cerveja Original 350ml:1:6;', 'cartao'),
(29, '2023-04-30 02:39:04', '5.00', 'Agua Font Life 510ml:1:5;', 'dinheiro'),
(30, '2023-04-30 02:40:44', '10.00', '1x Gudang Garam :1:3;Cerveja Amstel 350ml:1:6;1x Cigarro Branco:1:1;', 'cartao'),
(31, '2023-04-30 02:45:35', '55.00', 'Energetico Bally 2L:1:15;Vodka Intencion 900ml:1:40;', 'cartao'),
(32, '2023-04-30 02:48:38', '5.00', '1x Gelo De Coco:1:5;', 'cartao'),
(33, '2023-04-30 02:54:00', '8.00', 'Saco de Gelo 3KG:1:8;', 'cartao'),
(34, '2023-04-30 02:55:06', '6.00', 'Cerveja Amstel 350ml:1:6;', 'cartao'),
(35, '2023-04-30 03:11:29', '10.00', '1x Cigarro Branco:1:1;1x Gudang Garam :1:3;Cerveja Original 350ml:1:6;', 'cartao'),
(36, '2023-04-30 03:23:14', '12.00', 'Cerveja Original 350ml:2:6;', 'cartao'),
(37, '2023-04-30 03:34:11', '8.00', 'Cerveja Original 350ml:1:6;1x Cigarro Branco:2:1;', 'cartao'),
(38, '2023-04-30 03:36:24', '12.00', '1x Gudang Garam :4:3;', 'dinheiro'),
(39, '2023-04-30 03:36:37', '6.00', '1x Gudang Garam :2:3;', 'dinheiro'),
(40, '2023-04-30 04:02:16', '6.00', 'Cerveja Original 350ml:1:6;', 'cartao'),
(41, '2023-04-30 04:11:21', '12.00', 'Cerveja Original 350ml:2:6;', 'dinheiro'),
(42, '2023-04-30 04:28:13', '5.00', 'Cerveja Brahma 350ml:1:5;', 'pix'),
(43, '2023-04-30 04:38:32', '12.00', 'Energetico Monster 473ml:1:12;', 'dinheiro'),
(44, '2023-04-30 04:45:48', '88.00', 'Saco de Gelo 3KG:1:8;vodka smirnoff 1L:1:65;Energetico Bally 2L:1:15;', 'dinheiro'),
(45, '2023-04-30 04:46:23', '10.00', 'Cerveja Brahma 350ml:2:5;', 'dinheiro'),
(46, '2023-04-30 04:51:07', '5.00', 'Cerveja Brahma 350ml:1:5;', 'cartao'),
(47, '2023-04-30 05:05:10', '10.00', 'Cerveja Heineken 330ml:1:10;', 'pix'),
(50, '2023-05-03 20:57:42', '10.00', 'Cerveja Sol 330ml:1:10;', 'dinheiro'),
(51, '2023-05-03 20:58:48', '10.00', 'Cerveja Sol 330ml:1:10;', 'dinheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_fiado`
--

CREATE TABLE `vendas_fiado` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `produtos_vendidos` text NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `vendas_fiado`
--

INSERT INTO `vendas_fiado` (`id`, `cliente_id`, `produtos_vendidos`, `valor_total`, `data_venda`) VALUES
(8, 1, '1x Gudang Garam :8:3;', '24.00', '2023-05-02 02:06:59'),
(9, 2, '1x Gudang Garam :1:3;', '3.00', '2023-05-02 02:11:03'),
(10, 2, '1x Gudang Garam :1:3;', '3.00', '2023-05-03 18:57:39'),
(11, 6, 'Bala Gomets:1:2;', '2.00', '2023-05-03 19:31:06');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `financeiro`
--
ALTER TABLE `financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_vendidos`
--
ALTER TABLE `itens_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venda` (`id_venda`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas_fiado`
--
ALTER TABLE `vendas_fiado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `convenio`
--
ALTER TABLE `convenio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `financeiro`
--
ALTER TABLE `financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `itens_vendidos`
--
ALTER TABLE `itens_vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `vendas_fiado`
--
ALTER TABLE `vendas_fiado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_vendidos`
--
ALTER TABLE `itens_vendidos`
  ADD CONSTRAINT `itens_vendidos_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`);

--
-- Restrições para tabelas `vendas_fiado`
--
ALTER TABLE `vendas_fiado`
  ADD CONSTRAINT `vendas_fiado_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `convenio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
