-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19-Jul-2019 às 18:04
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edelbra`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id_arquivo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `tamanho` varchar(100) DEFAULT NULL,
  `conteudo` mediumblob,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id_arquivo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `espinha_peixe`
--

DROP TABLE IF EXISTS `espinha_peixe`;
CREATE TABLE IF NOT EXISTS `espinha_peixe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sacp` int(11) NOT NULL,
  `id_tipo_plano_acao` int(11) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sacp` (`id_sacp`),
  KEY `id_tipo_plano_acao` (`id_tipo_plano_acao`)
) ENGINE=InnoDB AUTO_INCREMENT=519 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `espinha_peixe`
--

INSERT INTO `espinha_peixe` (`id`, `id_sacp`, `id_tipo_plano_acao`, `descricao`) VALUES
(108, 61, 7, ''),
(109, 62, 7, ''),
(110, 63, 7, ''),
(111, 64, 7, ''),
(112, 65, 7, ''),
(113, 66, 7, ''),
(114, 95, 7, ''),
(115, 96, 7, ''),
(116, 97, 7, ''),
(117, 98, 7, ''),
(118, 99, 7, ''),
(119, 100, 7, ''),
(120, 101, 7, ''),
(121, 102, 7, ''),
(122, 103, 7, ''),
(123, 104, 7, ''),
(124, 105, 7, ''),
(125, 116, 7, ''),
(126, 117, 7, ''),
(127, 118, 7, ''),
(128, 119, 7, ''),
(129, 120, 7, ''),
(130, 121, 7, ''),
(131, 122, 7, ''),
(132, 123, 7, ''),
(133, 124, 7, ''),
(134, 125, 7, ''),
(135, 126, 7, ''),
(136, 127, 7, ''),
(137, 140, 7, ''),
(138, 141, 7, ''),
(139, 142, 7, ''),
(140, 143, 7, ''),
(141, 144, 7, ''),
(142, 145, 7, ''),
(143, 146, 7, ''),
(144, 147, 7, ''),
(145, 148, 7, ''),
(146, 149, 7, ''),
(147, 150, 7, ''),
(148, 151, 7, ''),
(149, 152, 7, ''),
(150, 153, 7, ''),
(151, 154, 7, ''),
(152, 155, 7, ''),
(153, 156, 7, ''),
(154, 157, 7, ''),
(155, 158, 7, ''),
(156, 159, 7, ''),
(157, 160, 7, ''),
(158, 162, 7, ''),
(159, 165, 7, ''),
(160, 167, 7, ''),
(161, 168, 7, ''),
(162, 169, 7, ''),
(163, 170, 7, ''),
(164, 171, 7, ''),
(165, 172, 7, ''),
(166, 173, 7, ''),
(167, 174, 7, ''),
(168, 175, 7, ''),
(169, 176, 7, ''),
(391, 59, 7, '2019-07-31'),
(392, 59, 3, '123'),
(393, 59, 3, '123'),
(394, 59, 3, '123'),
(395, 59, 2, '123'),
(396, 59, 2, '123'),
(397, 59, 1, '123'),
(398, 59, 1, '123'),
(399, 59, 1, '123'),
(400, 59, 1, '123'),
(401, 59, 6, '123'),
(402, 59, 5, '123'),
(403, 59, 5, '123'),
(404, 59, 5, '123'),
(405, 59, 5, '123'),
(406, 59, 4, '123'),
(407, 59, 7, '2019-07-18'),
(408, 177, 7, ''),
(409, 178, 7, ''),
(410, 179, 7, ''),
(411, 180, 7, ''),
(412, 181, 7, ''),
(413, 182, 7, ''),
(414, 183, 7, ''),
(426, 184, 7, '2019-07-24'),
(427, 184, 7, '2019-07-31'),
(428, 185, 7, ''),
(448, 186, 7, '2019-07-25'),
(449, 186, 7, '2019-07-17'),
(451, 188, 7, ''),
(465, 189, 7, '2019-07-31'),
(466, 189, 7, '2019-07-24 00:00:00'),
(475, 187, 7, '2019-08-07'),
(476, 187, 7, '2019-08-07'),
(502, 190, 7, '2019-08-29'),
(503, 190, 7, '2019-08-31'),
(511, 191, 7, '2019-08-23'),
(512, 191, 7, ''),
(514, 192, 7, '2019-08-31'),
(515, 192, 7, ''),
(516, 193, 7, ''),
(517, 194, 7, ''),
(518, 195, 7, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos_acao`
--

DROP TABLE IF EXISTS `planos_acao`;
CREATE TABLE IF NOT EXISTS `planos_acao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sacp` int(11) NOT NULL,
  `id_tipo_plano` int(11) NOT NULL,
  `o_que` varchar(5000) NOT NULL,
  `como` varchar(5000) NOT NULL,
  `quem` int(11) NOT NULL,
  `quando` datetime NOT NULL,
  `onde` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `id_sacp` (`id_sacp`),
  KEY `id_tipo_plano` (`id_tipo_plano`),
  KEY `quem` (`quem`),
  KEY `onde` (`onde`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `planos_acao`
--

INSERT INTO `planos_acao` (`id`, `id_sacp`, `id_tipo_plano`, `o_que`, `como`, `quem`, `quando`, `onde`, `status`) VALUES
(15, 59, 1, 'definição de o que fazer', 'definição de como', 20, '2019-07-25 00:00:00', 2, 2),
(16, 189, 1, 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaa', 21, '2019-07-31 00:00:00', 5, 3),
(17, 188, 1, 'wfsdzgg', 'zdgsdfszdfsz', 19, '2019-07-23 00:00:00', 7, 2),
(18, 188, 1, 'wfsdzgg', 'zdgsdfszdfsz', 19, '2019-07-23 00:00:00', 7, 2),
(19, 188, 1, 'wfsdzgg', 'zdgsdfszdfsz', 19, '2019-07-23 00:00:00', 7, 2),
(20, 188, 1, 'wfsdzgg', 'zdgsdfszdfsz', 19, '2019-07-23 00:00:00', 7, 2),
(21, 188, 1, 'wfsdzgg', 'zdgsdfszdfsz', 19, '2019-07-23 00:00:00', 7, 2),
(22, 188, 1, 'wfsdzgg', 'zdgsdfszdfsz', 19, '2019-07-23 00:00:00', 7, 2),
(23, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(24, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(25, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(26, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(27, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(28, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(29, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(30, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(31, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(32, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(33, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(34, 188, 1, 'asdawd', 'wadwadawd', 19, '2019-07-24 00:00:00', 6, 2),
(35, 189, 1, '12323123', '123213211', 23, '2019-07-25 00:00:00', 4, 3),
(36, 192, 1, 'bbbbbbbbbbbbbbbbbbb', 'bbbbbbbbbbbbbbbbbbbbbbb', 23, '2019-07-31 00:00:00', 5, 2),
(37, 195, 1, 'qwdwqdwqdsdfsdfsdf', 'wdqwdqwdwqdsdfsdf', 19, '2019-07-25 00:00:00', 7, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rnc`
--

DROP TABLE IF EXISTS `rnc`;
CREATE TABLE IF NOT EXISTS `rnc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_origem` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `justificativa` varchar(5000) DEFAULT NULL,
  `correcao` varchar(5000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `data_gerada` datetime NOT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `numero_op` int(11) DEFAULT NULL,
  `cliente_nome` varchar(255) DEFAULT NULL,
  `cliente_obra` varchar(255) DEFAULT NULL,
  `cliente_telefone` varchar(255) DEFAULT NULL,
  `cliente_email` varchar(255) DEFAULT NULL,
  `sacp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `id_origem` (`id_origem`),
  KEY `id_destino` (`id_destino`),
  KEY `sacp` (`sacp`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `rnc`
--

INSERT INTO `rnc` (`id`, `id_origem`, `id_destino`, `descricao`, `justificativa`, `correcao`, `status`, `data_gerada`, `data_finalizada`, `numero_op`, `cliente_nome`, `cliente_obra`, `cliente_telefone`, `cliente_email`, `sacp`) VALUES
(29, 19, 21, '123', '123', '234', 3, '2019-07-15 09:48:38', '2019-07-18 10:23:14', 456, '', '', '', '', NULL),
(30, 22, 19, 'sdff', NULL, NULL, 1, '2019-07-19 11:37:28', NULL, 123, '', '', '', '', NULL),
(31, 22, 19, 'sdff', NULL, NULL, 1, '2019-07-19 11:38:14', NULL, 123, '', '', '', '', NULL),
(32, 23, 20, 'qwe', NULL, NULL, 1, '2019-07-19 12:25:34', NULL, 123, '', '', '', '', NULL),
(33, 23, 20, 'qwe', NULL, NULL, 1, '2019-07-19 12:31:37', NULL, 123, '', '', '', '', NULL),
(34, 23, 20, 'qwe', NULL, NULL, 1, '2019-07-19 12:31:46', NULL, 123, '', '', '', '', NULL),
(35, 23, 20, 'qwe', NULL, NULL, 1, '2019-07-19 12:32:15', NULL, 123, '', '', '', '', NULL),
(36, 22, 19, 'asd', NULL, NULL, 1, '2019-07-19 13:59:50', NULL, 123, '', '', '', '', NULL),
(37, 22, 19, '123', NULL, NULL, 1, '2019-07-19 14:52:38', NULL, 123, '', '', '', '', NULL),
(38, 22, 19, '123', NULL, NULL, 1, '2019-07-19 14:56:00', NULL, 123, '', '', '', '', NULL),
(39, 22, 19, '123', NULL, NULL, 1, '2019-07-19 14:58:20', NULL, 123, '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rnc_dados_fk`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `rnc_dados_fk`;
CREATE TABLE IF NOT EXISTS `rnc_dados_fk` (
`id` int(11)
,`id_origem` int(11)
,`id_destino` int(11)
,`descricao` varchar(5000)
,`justificativa` varchar(5000)
,`correcao` varchar(5000)
,`data_gerada` datetime
,`data_finalizada` datetime
,`numero_op` int(11)
,`sacp` int(11)
,`cliente_nome` varchar(255)
,`cliente_obra` varchar(255)
,`cliente_telefone` varchar(255)
,`cliente_email` varchar(255)
,`status` varchar(255)
,`nome_origem` varchar(255)
,`nome_destino` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacp`
--

DROP TABLE IF EXISTS `sacp`;
CREATE TABLE IF NOT EXISTS `sacp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setor_origem` int(11) NOT NULL,
  `setor_destino` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `origem` varchar(255) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `proposito` varchar(5000) NOT NULL,
  `consequencia` varchar(5000) NOT NULL,
  `brainstorming` varchar(5000) NOT NULL,
  `data_gerada` datetime NOT NULL,
  `data_prazo` datetime NOT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `numero_op` int(11) DEFAULT NULL,
  `id_rnc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setor_origem` (`setor_origem`),
  KEY `setor_destino` (`setor_destino`),
  KEY `id_rnc` (`id_rnc`),
  KEY `fk_sacp_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sacp`
--

INSERT INTO `sacp` (`id`, `setor_origem`, `setor_destino`, `status`, `origem`, `descricao`, `proposito`, `consequencia`, `brainstorming`, `data_gerada`, `data_prazo`, `data_finalizada`, `numero_op`, `id_rnc`) VALUES
(59, 6, 2, 2, 'outras informações', '123', '12', '123', '123', '2019-07-15 09:53:28', '2019-07-31 00:00:00', NULL, 456, 29),
(61, 2, 2, 3, 'relatorio', '1', '1', '1', '1', '2019-07-15 10:07:15', '2019-08-14 10:07:15', '2019-07-18 10:06:09', 1, NULL),
(62, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-15 10:07:36', '2019-08-14 10:07:36', NULL, 1, NULL),
(63, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-15 10:09:51', '2019-08-14 10:09:51', NULL, 1, NULL),
(64, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-15 10:25:11', '2019-08-14 10:25:11', NULL, 1, NULL),
(65, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-15 10:27:19', '2019-08-14 10:27:19', NULL, 1, NULL),
(66, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-15 10:30:37', '2019-08-14 10:30:37', NULL, 1, NULL),
(67, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-15 11:01:58', '2019-08-14 11:01:58', NULL, 1, NULL),
(68, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 08:22:55', '2019-08-15 08:22:55', NULL, 1, NULL),
(69, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 08:25:46', '2019-08-15 08:25:46', NULL, 1, NULL),
(70, 2, 2, 2, 'necessidade', '11', '1', '1', '1', '2019-07-16 08:26:14', '2019-08-15 08:26:14', NULL, 1, NULL),
(71, 2, 2, 2, 'necessidade', '11', '1', '1', '1', '2019-07-16 08:52:56', '2019-08-15 08:52:56', NULL, 1, NULL),
(72, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 08:53:31', '2019-08-15 08:53:31', NULL, 1, NULL),
(73, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 08:53:59', '2019-08-15 08:53:59', NULL, 1, NULL),
(74, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 08:56:50', '2019-08-15 08:56:50', NULL, 1, NULL),
(75, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 08:59:09', '2019-08-15 08:59:09', NULL, 1, NULL),
(76, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:01:01', '2019-08-15 09:01:01', NULL, 1, NULL),
(77, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:01:25', '2019-08-15 09:01:25', NULL, 1, NULL),
(78, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:02:13', '2019-08-15 09:02:13', NULL, 1, NULL),
(79, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:02:25', '2019-08-15 09:02:25', NULL, 1, NULL),
(80, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:02:56', '2019-08-15 09:02:56', NULL, 1, NULL),
(81, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:03:07', '2019-08-15 09:03:07', NULL, 1, NULL),
(82, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:03:29', '2019-08-15 09:03:29', NULL, 1, NULL),
(83, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:04:03', '2019-08-15 09:04:03', NULL, 1, NULL),
(84, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:04:14', '2019-08-15 09:04:14', NULL, 1, NULL),
(85, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:04:58', '2019-08-15 09:04:58', NULL, 1, NULL),
(86, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:05:11', '2019-08-15 09:05:11', NULL, 1, NULL),
(87, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:10:25', '2019-08-15 09:10:25', NULL, 1, NULL),
(88, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:10:32', '2019-08-15 09:10:32', NULL, 1, NULL),
(89, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:12:54', '2019-08-15 09:12:54', NULL, 1, NULL),
(90, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:13:34', '2019-08-15 09:13:34', NULL, 1, NULL),
(91, 7, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:15:43', '2019-08-15 09:15:43', NULL, 1, NULL),
(92, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:16:04', '2019-08-15 09:16:04', NULL, 1, NULL),
(93, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:16:29', '2019-08-15 09:16:29', NULL, 1, NULL),
(94, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:22:13', '2019-08-15 09:22:13', NULL, 1, NULL),
(95, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:29:01', '2019-08-15 09:29:01', NULL, 1, NULL),
(96, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:29:27', '2019-08-15 09:29:27', NULL, 1, NULL),
(97, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:30:24', '2019-08-15 09:30:24', NULL, 1, NULL),
(98, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:31:32', '2019-08-15 09:31:32', NULL, 1, NULL),
(99, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:31:39', '2019-08-15 09:31:39', NULL, 1, NULL),
(100, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:31:44', '2019-08-15 09:31:44', NULL, 1, NULL),
(101, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:32:19', '2019-08-15 09:32:19', NULL, 1, NULL),
(102, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:33:28', '2019-08-15 09:33:28', NULL, 1, NULL),
(103, 2, 2, 2, 'necessidade', 's', 's', 's', 's', '2019-07-16 09:33:51', '2019-08-15 09:33:51', NULL, 1, NULL),
(104, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 09:47:00', '2019-08-15 09:47:00', NULL, 12, NULL),
(105, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 09:48:44', '2019-08-15 09:48:44', NULL, 12, NULL),
(106, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 09:49:12', '2019-08-15 09:49:12', NULL, 12, NULL),
(107, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 09:49:25', '2019-08-15 09:49:25', NULL, 12, NULL),
(108, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 09:50:42', '2019-08-15 09:50:42', NULL, 12, NULL),
(109, 2, 2, 2, 'necessidade', '1', '1', '1', '1', '2019-07-16 09:51:20', '2019-08-15 09:51:20', NULL, 12, NULL),
(110, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:51:44', '2019-08-15 09:51:44', NULL, 1, NULL),
(111, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:52:07', '2019-08-15 09:52:07', NULL, 1, NULL),
(112, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:52:23', '2019-08-15 09:52:23', NULL, 1, NULL),
(113, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:52:37', '2019-08-15 09:52:37', NULL, 1, NULL),
(114, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:52:50', '2019-08-15 09:52:50', NULL, 1, NULL),
(115, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:52:57', '2019-08-15 09:52:57', NULL, 1, NULL),
(116, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:54:33', '2019-08-15 09:54:33', NULL, 1, NULL),
(117, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:55:13', '2019-08-15 09:55:13', NULL, 1, NULL),
(118, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:55:26', '2019-08-15 09:55:26', NULL, 1, NULL),
(119, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:55:55', '2019-08-15 09:55:55', NULL, 1, NULL),
(120, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:56:04', '2019-08-15 09:56:04', NULL, 1, NULL),
(121, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 09:58:02', '2019-08-15 09:58:02', NULL, 1, NULL),
(122, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:00:16', '2019-08-15 10:00:16', NULL, 1, NULL),
(123, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:01:43', '2019-08-15 10:01:43', NULL, 1, NULL),
(124, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:03:04', '2019-08-15 10:03:04', NULL, 1, NULL),
(125, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:04:05', '2019-08-15 10:04:05', NULL, 1, NULL),
(126, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:04:34', '2019-08-15 10:04:34', NULL, 1, NULL),
(127, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:05:17', '2019-08-15 10:05:17', NULL, 1, NULL),
(128, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:08:55', '2019-08-15 10:08:55', NULL, 1, NULL),
(129, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:09:14', '2019-08-15 10:09:14', NULL, 1, NULL),
(130, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:11:02', '2019-08-15 10:11:02', NULL, 1, NULL),
(131, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:11:19', '2019-08-15 10:11:19', NULL, 1, NULL),
(132, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:11:29', '2019-08-15 10:11:29', NULL, 1, NULL),
(133, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:11:31', '2019-08-15 10:11:31', NULL, 1, NULL),
(134, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:14:06', '2019-08-15 10:14:06', NULL, 1, NULL),
(135, 2, 2, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:14:27', '2019-08-15 10:14:27', NULL, 1, NULL),
(136, 2, 2, 2, 'relatorio', '2', '2', '2', '2', '2019-07-16 10:14:49', '2019-08-15 10:14:49', NULL, 2, NULL),
(137, 2, 2, 2, 'relatorio', '2', '2', '2', '2', '2019-07-16 10:15:23', '2019-08-15 10:15:23', NULL, 2, NULL),
(138, 2, 2, 2, 'relatorio', '2', '2', '2', '2', '2019-07-16 10:15:28', '2019-08-15 10:15:28', NULL, 2, NULL),
(139, 2, 2, 2, 'relatorio', '2', '2', '2', '2', '2019-07-16 10:15:41', '2019-08-15 10:15:41', NULL, 2, NULL),
(140, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:17:12', '2019-08-15 10:17:12', NULL, 1, NULL),
(141, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:17:48', '2019-08-15 10:17:48', NULL, 1, NULL),
(142, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:18:08', '2019-08-15 10:18:08', NULL, 1, NULL),
(143, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:18:22', '2019-08-15 10:18:22', NULL, 1, NULL),
(144, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:18:43', '2019-08-15 10:18:43', NULL, 1, NULL),
(145, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:19:08', '2019-08-15 10:19:08', NULL, 1, NULL),
(146, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:22:01', '2019-08-15 10:22:01', NULL, 1, NULL),
(147, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:23:00', '2019-08-15 10:23:00', NULL, 1, NULL),
(148, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:23:37', '2019-08-15 10:23:37', NULL, 1, NULL),
(149, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:23:46', '2019-08-15 10:23:46', NULL, 1, NULL),
(150, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:24:01', '2019-08-15 10:24:01', NULL, 1, NULL),
(151, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:24:11', '2019-08-15 10:24:11', NULL, 1, NULL),
(152, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:24:25', '2019-08-15 10:24:25', NULL, 1, NULL),
(153, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:25:43', '2019-08-15 10:25:43', NULL, 1, NULL),
(154, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:26:48', '2019-08-15 10:26:48', NULL, 1, NULL),
(155, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:33:52', '2019-08-15 10:33:52', NULL, 1, NULL),
(156, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:36:39', '2019-08-15 10:36:39', NULL, 1, NULL),
(157, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:36:57', '2019-08-15 10:36:57', NULL, 1, NULL),
(158, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:41:32', '2019-08-15 10:41:32', NULL, 123, NULL),
(159, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:44:00', '2019-08-15 10:44:00', NULL, 123, NULL),
(160, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:45:00', '2019-08-15 10:45:00', NULL, 123, NULL),
(161, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:50:00', '2019-08-15 10:50:00', NULL, 123, NULL),
(162, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 10:52:00', '2019-08-15 10:52:00', NULL, 123, NULL),
(163, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:03:00', '2019-08-15 11:03:00', NULL, 123, NULL),
(164, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:03:00', '2019-08-15 11:03:00', NULL, 123, NULL),
(165, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:05:00', '2019-08-15 11:05:00', NULL, 123, NULL),
(166, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:10:00', '2019-08-15 11:10:00', NULL, 123, NULL),
(167, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:13:00', '2019-08-15 11:13:00', NULL, 123, NULL),
(168, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:14:00', '2019-08-15 11:14:00', NULL, 123, NULL),
(169, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:14:00', '2019-08-15 11:14:00', NULL, 123, NULL),
(170, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 11:16:00', '2019-08-15 11:16:00', NULL, 123, NULL),
(171, 2, 6, 2, 'TESTE', '!!', '!!', '!!', '!!', '2019-07-16 11:19:00', '2019-08-15 11:19:00', NULL, 555, NULL),
(172, 2, 6, 2, 'TESTE', '1', '1', '1', 'S', '2019-07-16 11:21:00', '2019-08-15 11:21:00', NULL, 222, NULL),
(173, 2, 4, 2, 'indicador', 'w\\adghj,vhmgfeghj,khn', 'w', 'w', 'w', '2019-07-16 11:34:00', '2019-08-15 11:34:00', NULL, 123, NULL),
(174, 2, 4, 2, 'indicador', 'w\\adghj,vhmgfeghj,khn', 'w', 'w', 'w', '2019-07-16 11:35:00', '2019-08-15 11:35:00', NULL, 123, NULL),
(175, 2, 4, 2, 'indicador', 'w\\adghj,vhmgfeghj,khn', 'w', 'w', 'w', '2019-07-16 11:38:00', '2019-08-15 11:38:00', NULL, 123, NULL),
(176, 2, 4, 2, 'indicador', 'w\\adghj,vhmgfeghj,khn', 'w', 'w', 'w', '2019-07-16 11:40:00', '2019-08-15 11:40:00', NULL, 123, NULL),
(177, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 13:32:00', '2019-08-15 13:32:00', NULL, 12, NULL),
(178, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 14:05:00', '2019-08-15 00:00:00', NULL, 123, NULL),
(179, 7, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-16 00:00:00', '2019-08-15 00:00:00', NULL, 123, NULL),
(180, 2, 7, 2, 'relatorio', '2', '2', '2', '2', '2019-07-16 00:00:00', '2019-08-15 00:00:00', NULL, 2, NULL),
(181, 7, 7, 2, 'necessidade', '2', '2', '22', '2', '2019-07-16 00:00:00', '2019-08-15 00:00:00', NULL, 1, NULL),
(182, 2, 7, 2, 'relatorio', '1', '1', '1', '1', '2019-07-17 09:28:33', '2019-08-16 09:28:33', NULL, 11, NULL),
(183, 7, 7, 2, 'relatorio', 'qwe', 'qwe', 'qwe', 'qw', '2019-07-17 10:59:16', '2019-08-16 10:59:16', NULL, 123, NULL),
(184, 2, 2, 2, 'relatorio', '2', '2', '22', '2', '2019-07-17 11:46:04', '2019-07-24 00:00:00', NULL, 2, NULL),
(185, 7, 3, 2, 'relatorio', 'q', 'q', 'q', 'q', '2019-07-17 14:16:00', '2019-08-16 14:16:00', NULL, 123, NULL),
(186, 7, 3, 2, 'relatorio', '1', '1', '1', '1', '2019-07-17 00:00:00', '2019-07-25 00:00:00', NULL, 123, NULL),
(187, 2, 3, 2, 'relatorio', 'qwe', 'qwe', 'qwe', 'qwe', '2019-07-17 14:35:00', '2019-08-07 00:00:00', NULL, 123, NULL),
(188, 7, 6, 2, 'relatorio', '123', '123', '123', '123', '2019-07-17 14:37:08', '2019-08-16 14:37:08', NULL, 123, NULL),
(189, 3, 6, 2, 'relatorio', '12323423', '123254353', '12345665', '1235646546', '2019-07-17 14:38:35', '2019-07-31 00:00:00', NULL, 12312, NULL),
(190, 7, 7, 3, 'relatorio', 'rrr', 'rrr', 'rrr', 'rrr', '2019-07-17 14:47:28', '2019-08-29 00:00:00', '2019-07-18 10:23:45', 444, NULL),
(191, 7, 7, 3, 'relatorio', '123123123', '123123123', '123123123', '123123123', '2019-07-18 10:06:44', '2019-08-23 00:00:00', '2019-07-18 10:26:08', 123, NULL),
(192, 7, 7, 3, 'indicador', 'qwewqewqewqeqe', 'wqewqewewqewe', 'eqweqwewewqewq', 'ewqewqewqeqwe', '2019-07-18 11:53:12', '2019-08-31 00:00:00', '2019-07-18 11:54:26', 123123, NULL),
(193, 4, 5, 2, 'indicador', 'ewfefwqe', 'fwef\\ef\\sef', 'zsefzsefszef', 'szfszefszef', '2019-07-18 11:57:54', '2019-08-17 11:57:54', NULL, 99999, NULL),
(194, 7, 6, 2, 'indicador', 'wdwf', 'efsfsdf', 'sdfsdfsdf', 'sdfsdfsdfd', '2019-07-18 11:58:43', '2019-08-17 11:58:43', NULL, 12, NULL),
(195, 3, 6, 3, 'relatorio', 'ef\\efzef', 'szefsfzsef', 'szefszefsf', 'sefsfsef', '2019-07-18 11:59:49', '2019-08-17 11:59:49', '2019-07-18 12:01:47', 234234, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacp_participantes`
--

DROP TABLE IF EXISTS `sacp_participantes`;
CREATE TABLE IF NOT EXISTS `sacp_participantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sacp` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sacp` (`id_sacp`),
  KEY `id_participante` (`id_participante`)
) ENGINE=InnoDB AUTO_INCREMENT=745 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sacp_participantes`
--

INSERT INTO `sacp_participantes` (`id`, `id_sacp`, `id_participante`) VALUES
(190, 61, 23),
(191, 62, 23),
(192, 63, 23),
(193, 64, 23),
(194, 65, 23),
(195, 66, 23),
(196, 67, 23),
(197, 68, 23),
(198, 69, 23),
(199, 70, 19),
(200, 70, 23),
(201, 70, 20),
(202, 70, 21),
(203, 71, 19),
(204, 71, 23),
(205, 71, 20),
(206, 71, 21),
(207, 72, 23),
(208, 72, 20),
(209, 73, 19),
(210, 74, 19),
(211, 74, 23),
(212, 74, 20),
(213, 75, 19),
(214, 75, 23),
(215, 75, 20),
(216, 76, 19),
(217, 76, 23),
(218, 76, 20),
(219, 77, 19),
(220, 77, 23),
(221, 77, 20),
(222, 78, 19),
(223, 78, 23),
(224, 78, 20),
(225, 79, 19),
(226, 79, 23),
(227, 79, 20),
(228, 80, 19),
(229, 80, 23),
(230, 80, 20),
(231, 81, 19),
(232, 81, 23),
(233, 81, 20),
(234, 82, 19),
(235, 82, 23),
(236, 82, 20),
(237, 83, 19),
(238, 83, 23),
(239, 83, 20),
(240, 84, 19),
(241, 84, 23),
(242, 84, 20),
(243, 85, 19),
(244, 85, 23),
(245, 85, 20),
(246, 86, 19),
(247, 86, 23),
(248, 86, 20),
(249, 87, 19),
(250, 87, 23),
(251, 87, 20),
(252, 88, 19),
(253, 88, 23),
(254, 88, 20),
(255, 89, 19),
(256, 89, 23),
(257, 89, 20),
(258, 90, 19),
(259, 90, 23),
(260, 90, 20),
(261, 91, 19),
(262, 91, 23),
(263, 91, 20),
(264, 92, 19),
(265, 92, 23),
(266, 92, 20),
(267, 92, 21),
(268, 93, 19),
(269, 93, 23),
(270, 93, 20),
(271, 93, 21),
(272, 94, 19),
(273, 94, 23),
(274, 94, 20),
(275, 94, 21),
(276, 95, 19),
(277, 95, 23),
(278, 95, 20),
(279, 95, 21),
(280, 96, 19),
(281, 96, 23),
(282, 96, 20),
(283, 96, 21),
(284, 97, 19),
(285, 97, 23),
(286, 97, 20),
(287, 97, 21),
(288, 98, 19),
(289, 98, 23),
(290, 98, 20),
(291, 98, 21),
(292, 99, 19),
(293, 99, 23),
(294, 99, 20),
(295, 99, 21),
(296, 100, 19),
(297, 100, 23),
(298, 100, 20),
(299, 100, 21),
(300, 101, 19),
(301, 101, 23),
(302, 101, 20),
(303, 101, 21),
(304, 102, 19),
(305, 102, 23),
(306, 102, 20),
(307, 102, 21),
(308, 103, 19),
(309, 103, 23),
(310, 103, 20),
(311, 103, 21),
(312, 104, 19),
(313, 104, 23),
(314, 104, 20),
(315, 104, 21),
(316, 105, 19),
(317, 105, 23),
(318, 105, 20),
(319, 105, 21),
(320, 106, 19),
(321, 106, 23),
(322, 106, 20),
(323, 106, 21),
(324, 107, 19),
(325, 107, 23),
(326, 107, 20),
(327, 107, 21),
(328, 108, 19),
(329, 108, 23),
(330, 108, 20),
(331, 108, 21),
(332, 109, 19),
(333, 109, 23),
(334, 109, 20),
(335, 109, 21),
(336, 110, 19),
(337, 110, 23),
(338, 110, 20),
(339, 110, 21),
(340, 111, 19),
(341, 111, 23),
(342, 111, 20),
(343, 111, 21),
(344, 112, 19),
(345, 112, 23),
(346, 112, 20),
(347, 112, 21),
(348, 113, 19),
(349, 113, 23),
(350, 113, 20),
(351, 113, 21),
(352, 114, 19),
(353, 114, 23),
(354, 114, 20),
(355, 114, 21),
(356, 115, 19),
(357, 115, 23),
(358, 115, 20),
(359, 115, 21),
(360, 116, 19),
(361, 116, 23),
(362, 116, 20),
(363, 116, 21),
(364, 117, 19),
(365, 117, 23),
(366, 117, 20),
(367, 117, 21),
(368, 118, 19),
(369, 118, 23),
(370, 118, 20),
(371, 118, 21),
(372, 119, 19),
(373, 119, 23),
(374, 119, 20),
(375, 119, 21),
(376, 120, 19),
(377, 120, 23),
(378, 120, 20),
(379, 120, 21),
(380, 121, 19),
(381, 121, 23),
(382, 121, 20),
(383, 121, 21),
(384, 122, 19),
(385, 122, 23),
(386, 122, 20),
(387, 122, 21),
(388, 123, 19),
(389, 123, 23),
(390, 123, 20),
(391, 123, 21),
(392, 124, 19),
(393, 124, 23),
(394, 124, 20),
(395, 124, 21),
(396, 125, 19),
(397, 125, 23),
(398, 125, 20),
(399, 125, 21),
(400, 126, 19),
(401, 126, 23),
(402, 126, 20),
(403, 126, 21),
(404, 127, 19),
(405, 127, 23),
(406, 127, 20),
(407, 127, 21),
(408, 128, 19),
(409, 128, 23),
(410, 128, 20),
(411, 128, 21),
(412, 129, 19),
(413, 129, 23),
(414, 129, 20),
(415, 129, 21),
(416, 130, 19),
(417, 130, 23),
(418, 130, 20),
(419, 130, 21),
(420, 131, 19),
(421, 131, 23),
(422, 131, 20),
(423, 131, 21),
(424, 132, 19),
(425, 132, 23),
(426, 132, 20),
(427, 132, 21),
(428, 133, 19),
(429, 133, 23),
(430, 133, 20),
(431, 133, 21),
(432, 134, 19),
(433, 134, 23),
(434, 134, 20),
(435, 134, 21),
(436, 135, 19),
(437, 135, 23),
(438, 135, 20),
(439, 135, 21),
(440, 136, 19),
(441, 136, 23),
(442, 136, 20),
(443, 136, 21),
(444, 137, 19),
(445, 137, 23),
(446, 137, 20),
(447, 137, 21),
(448, 138, 19),
(449, 138, 23),
(450, 138, 20),
(451, 138, 21),
(452, 139, 19),
(453, 139, 23),
(454, 139, 20),
(455, 139, 21),
(456, 140, 19),
(457, 140, 23),
(458, 140, 20),
(459, 140, 21),
(460, 141, 19),
(461, 141, 23),
(462, 141, 20),
(463, 141, 21),
(464, 142, 19),
(465, 142, 23),
(466, 142, 20),
(467, 142, 21),
(468, 143, 19),
(469, 143, 23),
(470, 143, 20),
(471, 143, 21),
(472, 144, 19),
(473, 144, 23),
(474, 144, 20),
(475, 144, 21),
(476, 145, 19),
(477, 145, 23),
(478, 145, 20),
(479, 145, 21),
(480, 146, 19),
(481, 146, 23),
(482, 146, 20),
(483, 146, 21),
(484, 147, 19),
(485, 147, 23),
(486, 147, 20),
(487, 147, 21),
(488, 148, 19),
(489, 148, 23),
(490, 148, 20),
(491, 148, 21),
(492, 149, 19),
(493, 149, 23),
(494, 149, 20),
(495, 149, 21),
(496, 150, 19),
(497, 150, 23),
(498, 150, 20),
(499, 150, 21),
(500, 151, 19),
(501, 151, 23),
(502, 151, 20),
(503, 151, 21),
(504, 152, 19),
(505, 152, 23),
(506, 152, 20),
(507, 152, 21),
(508, 153, 19),
(509, 153, 23),
(510, 153, 20),
(511, 153, 21),
(512, 154, 19),
(513, 154, 23),
(514, 154, 20),
(515, 154, 21),
(516, 155, 19),
(517, 155, 23),
(518, 155, 20),
(519, 155, 21),
(520, 156, 19),
(521, 156, 23),
(522, 156, 20),
(523, 156, 21),
(524, 157, 19),
(525, 157, 23),
(526, 157, 20),
(527, 157, 21),
(528, 158, 19),
(529, 158, 20),
(530, 158, 21),
(531, 159, 19),
(532, 159, 20),
(533, 159, 21),
(534, 160, 19),
(535, 160, 20),
(536, 160, 21),
(537, 161, 19),
(538, 161, 20),
(539, 161, 21),
(540, 162, 19),
(541, 162, 20),
(542, 162, 21),
(543, 163, 19),
(544, 163, 20),
(545, 163, 21),
(546, 164, 19),
(547, 164, 20),
(548, 164, 21),
(549, 165, 19),
(550, 165, 20),
(551, 165, 21),
(552, 166, 19),
(553, 166, 20),
(554, 166, 21),
(555, 167, 19),
(556, 167, 20),
(557, 167, 21),
(558, 168, 19),
(559, 168, 20),
(560, 168, 21),
(561, 169, 19),
(562, 169, 20),
(563, 169, 21),
(564, 170, 19),
(565, 170, 20),
(566, 170, 21),
(567, 171, 19),
(568, 171, 20),
(569, 171, 21),
(570, 172, 19),
(571, 172, 23),
(572, 173, 19),
(573, 173, 23),
(574, 174, 19),
(575, 174, 23),
(576, 175, 19),
(577, 175, 23),
(578, 176, 19),
(579, 176, 23),
(619, 59, 19),
(620, 59, 20),
(621, 59, 21),
(622, 177, 19),
(623, 178, 19),
(624, 179, 19),
(625, 180, 19),
(626, 181, 23),
(627, 182, 23),
(628, 182, 20),
(629, 183, 19),
(636, 184, 19),
(637, 185, 23),
(650, 186, 23),
(652, 188, 19),
(679, 189, 19),
(680, 189, 23),
(681, 189, 20),
(682, 189, 21),
(687, 187, 23),
(688, 187, 20),
(689, 187, 21),
(714, 190, 19),
(715, 190, 23),
(716, 190, 20),
(717, 190, 21),
(725, 191, 19),
(726, 191, 23),
(727, 191, 20),
(728, 191, 21),
(731, 192, 19),
(732, 192, 23),
(733, 193, 19),
(734, 193, 23),
(735, 193, 20),
(736, 193, 21),
(737, 194, 19),
(738, 194, 23),
(739, 194, 20),
(740, 194, 21),
(741, 195, 19),
(742, 195, 23),
(743, 195, 20),
(744, 195, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

DROP TABLE IF EXISTS `setores`;
CREATE TABLE IF NOT EXISTS `setores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `responsavel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsavel` (`responsavel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `setores`
--

INSERT INTO `setores` (`id`, `nome`, `responsavel`) VALUES
(2, 'Administrativo', 22),
(3, 'Controladoria', 21),
(4, 'Produção', NULL),
(5, 'Logística', NULL),
(6, 'Financeiro', NULL),
(7, 'Almoxarifado', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `nome`) VALUES
(1, 'Novo'),
(2, 'Em progresso'),
(3, 'Finalizado'),
(4, 'Expirado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `permissoes` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id`, `nome`, `permissoes`) VALUES
(1, 'Administrador', '[\"any\"]'),
(2, 'Qualidade', '{\"home\":[\"visualizar\"],\"rnc\":[\"visualizar\",\"inserir\",\"editar\",\"excluir\"],\"sacp\":[\"visualizar\",\"inserir\",\"editar\",\"excluir\"]}'),
(3, 'Usuário comum', '{\"home\":[\"visualizar\"],\"rnc\":[\"visualizar\",\"inserir\",\"editar\"],\"sacp\":[\"visualizar\"]}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_plano_acao`
--

DROP TABLE IF EXISTS `tipo_plano_acao`;
CREATE TABLE IF NOT EXISTS `tipo_plano_acao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_plano_acao`
--

INSERT INTO `tipo_plano_acao` (`id`, `nome`) VALUES
(1, 'Mão de Obra'),
(2, 'Método'),
(3, 'Medida'),
(4, 'Meio Ambiente'),
(5, 'Materiais'),
(6, 'Máquina'),
(7, 'Descrição');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `setor` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ativo',
  `user_session_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_usuario` (`tipo_usuario`),
  KEY `setor` (`setor`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `setor`, `email`, `usuario`, `senha`, `tipo_usuario`, `status`, `user_session_id`) VALUES
(19, 'usuário A', 2, 'usuarioA@edelbra.com.br', 'usuarioA', '$2a$08$5Q1gVZfCN.7/Tkl31LHSt.jXP2v9ReuuXp7KlyXYFDishI1/iWFGG', 3, 'ativo', 'vno61kmcpoevbae314nv9ji5ft'),
(20, 'usuário B', 6, 'usuarioB@edelbra.com.br', 'usuarioB', '$2a$08$aJFwqAflqJahcDAObDPis.pxwH/dUIr73FUh29vX6GPH4o9Hseqf2', 3, 'ativo', 'njlneeh00f4f5nfe4vc0v9c5fu'),
(21, 'usuário C', 5, 'usuarioC@edelbra.com.br', 'usuarioC', '$2a$08$BtEveze.8u3z7fCzXs13Gu8TpCMGDUji26i02xzxsW3MnV31h.UEy', 3, 'ativo', 'v77ufbvo35u1h1frj1qingadfq'),
(22, 'Administrador', 2, 'administrador@edelbra.com.br', 'admin', '$2a$08$vfXLeWf8sxOPX36Ioo0tX.PQlpSAtegW2MdvngEY88UElveO4GDs2', 1, 'ativo', '2g53hdni55l3smnh4o3eg4nkbv'),
(23, 'Qualidade', 2, 'qualidade@edelbra.combr', 'qualidade', '$2a$08$FFtkqoNn0p.U4R5FJ3nLPOfas66V57LZGi7/wa3XYt4IDknBVPQKC', 2, 'ativo', 'fr9r460n3i57js095p3b42mddl');

-- --------------------------------------------------------

--
-- Structure for view `rnc_dados_fk`
--
DROP TABLE IF EXISTS `rnc_dados_fk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rnc_dados_fk`  AS  select `rnc`.`id` AS `id`,`rnc`.`id_origem` AS `id_origem`,`rnc`.`id_destino` AS `id_destino`,`rnc`.`descricao` AS `descricao`,`rnc`.`justificativa` AS `justificativa`,`rnc`.`correcao` AS `correcao`,`rnc`.`data_gerada` AS `data_gerada`,`rnc`.`data_finalizada` AS `data_finalizada`,`rnc`.`numero_op` AS `numero_op`,`rnc`.`sacp` AS `sacp`,`rnc`.`cliente_nome` AS `cliente_nome`,`rnc`.`cliente_obra` AS `cliente_obra`,`rnc`.`cliente_telefone` AS `cliente_telefone`,`rnc`.`cliente_email` AS `cliente_email`,`status`.`nome` AS `status`,`usro`.`nome` AS `nome_origem`,`usrd`.`nome` AS `nome_destino` from (((`rnc` join `status` on((`rnc`.`status` = `status`.`id`))) join `usuarios` `usro` on((`rnc`.`id_origem` = `usro`.`id`))) join `usuarios` `usrd` on((`rnc`.`id_destino` = `usrd`.`id`))) ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `espinha_peixe`
--
ALTER TABLE `espinha_peixe`
  ADD CONSTRAINT `fk_sacp_peixe` FOREIGN KEY (`id_sacp`) REFERENCES `sacp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_plano_peixe` FOREIGN KEY (`id_tipo_plano_acao`) REFERENCES `tipo_plano_acao` (`id`);

--
-- Limitadores para a tabela `planos_acao`
--
ALTER TABLE `planos_acao`
  ADD CONSTRAINT `fk_onde` FOREIGN KEY (`onde`) REFERENCES `setores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plano_quem` FOREIGN KEY (`quem`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sacp` FOREIGN KEY (`id_sacp`) REFERENCES `sacp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_status_plano_acao` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_plano` FOREIGN KEY (`id_tipo_plano`) REFERENCES `tipo_plano_acao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `rnc`
--
ALTER TABLE `rnc`
  ADD CONSTRAINT `fk_rnc_sacp` FOREIGN KEY (`sacp`) REFERENCES `sacp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_destino` FOREIGN KEY (`id_destino`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_origem` FOREIGN KEY (`id_origem`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sacp`
--
ALTER TABLE `sacp`
  ADD CONSTRAINT `fk_rnc_id` FOREIGN KEY (`id_rnc`) REFERENCES `rnc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sacp_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_setor_destino` FOREIGN KEY (`setor_destino`) REFERENCES `setores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_setor_origem` FOREIGN KEY (`setor_origem`) REFERENCES `setores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sacp_participantes`
--
ALTER TABLE `sacp_participantes`
  ADD CONSTRAINT `fk_id_participantes` FOREIGN KEY (`id_participante`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_id_sacp_participantes` FOREIGN KEY (`id_sacp`) REFERENCES `sacp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `setores`
--
ALTER TABLE `setores`
  ADD CONSTRAINT `fk_responsavel` FOREIGN KEY (`responsavel`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_setor` FOREIGN KEY (`setor`) REFERENCES `setores` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipos_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
