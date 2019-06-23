-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jun-2019 às 01:17
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

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
-- Estrutura da tabela `espinha_peixe`
--

CREATE TABLE `espinha_peixe` (
  `id` int(11) NOT NULL,
  `id_sacp` int(11) NOT NULL,
  `id_tipo_plano_acao` int(11) NOT NULL,
  `descricao` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `espinha_peixe`
--

INSERT INTO `espinha_peixe` (`id`, `id_sacp`, `id_tipo_plano_acao`, `descricao`) VALUES
(65, 55, 7, '2'),
(66, 58, 7, ''),
(75, 37, 7, ''),
(80, 36, 7, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos_acao`
--

CREATE TABLE `planos_acao` (
  `id` int(11) NOT NULL,
  `id_sacp` int(11) NOT NULL,
  `id_tipo_plano` int(11) NOT NULL,
  `o_que` varchar(5000) NOT NULL,
  `como` varchar(5000) NOT NULL,
  `quem` int(11) NOT NULL,
  `quando` datetime NOT NULL,
  `onde` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `planos_acao`
--

INSERT INTO `planos_acao` (`id`, `id_sacp`, `id_tipo_plano`, `o_que`, `como`, `quem`, `quando`, `onde`, `status`) VALUES
(5, 37, 5, 'fazer sei la oqeaseas', 'seilaeaseaseas', 20, '2020-08-01 00:00:00', 6, 1),
(6, 37, 1, 'fazer sei la oq', 'matar um pombo na base da marretada', 24, '2050-08-01 00:00:00', 6, 1),
(9, 38, 5, 'materiais1', 'materiais1', 23, '0101-01-01 00:00:00', 3, 1),
(10, 38, 5, 'materiais2', 'materiais2', 23, '0001-01-01 00:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rnc`
--

CREATE TABLE `rnc` (
  `id` int(11) NOT NULL,
  `id_origem` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `justificativa` varchar(5000) DEFAULT NULL,
  `correcao` varchar(5000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `data_gerada` datetime NOT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `numero_op` int(11) DEFAULT NULL,
  `sacp` int(11) DEFAULT NULL,
  `cliente_nome` varchar(255) DEFAULT NULL,
  `cliente_obra` varchar(255) DEFAULT NULL,
  `cliente_telefone` varchar(255) DEFAULT NULL,
  `cliente_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `rnc`
--

INSERT INTO `rnc` (`id`, `id_origem`, `id_destino`, `descricao`, `justificativa`, `correcao`, `status`, `data_gerada`, `data_finalizada`, `numero_op`, `sacp`, `cliente_nome`, `cliente_obra`, `cliente_telefone`, `cliente_email`) VALUES
(19, 19, 21, 'de user A para user C', NULL, NULL, 3, '2019-06-04 12:08:21', '2019-06-19 20:16:21', NULL, NULL, '', '', '', ''),
(20, 20, 21, 'de user B para user C', NULL, NULL, 1, '2019-06-04 12:09:07', NULL, 2, NULL, '', '', '', ''),
(21, 21, 19, 'de user C para user A', NULL, NULL, 3, '2019-06-04 12:09:49', '2019-06-06 12:28:00', 3, NULL, '', '', '', ''),
(22, 22, 20, '123', 'dasdas', 'dasda', 3, '2019-06-05 20:28:46', '2019-06-05 20:37:19', NULL, NULL, '', '', '', ''),
(23, 22, 23, 'dadas', NULL, NULL, 1, '2019-06-19 20:05:07', NULL, NULL, NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacp`
--

CREATE TABLE `sacp` (
  `id` int(11) NOT NULL,
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
  `id_rnc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sacp`
--

INSERT INTO `sacp` (`id`, `setor_origem`, `setor_destino`, `status`, `origem`, `descricao`, `proposito`, `consequencia`, `brainstorming`, `data_gerada`, `data_prazo`, `data_finalizada`, `numero_op`, `id_rnc`) VALUES
(36, 2, 3, 1, 'arroba teu cu', 'a', 'a', 'a', 'a', '2019-06-19 20:26:54', '0000-00-00 00:00:00', NULL, 90, NULL),
(37, 2, 6, 1, 'relatorio', 'a', 'a', 'a', 'a', '2019-06-22 18:52:48', '0000-00-00 00:00:00', NULL, 123, NULL),
(38, 3, 3, 1, 'recebida', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 19:47:59', '0000-00-00 00:00:00', NULL, 123, NULL),
(39, 7, 2, 1, 'relatorio', 's', 's', 's', 'a', '2019-06-22 20:07:01', '2019-07-22 20:07:01', NULL, NULL, NULL),
(40, 3, 6, 1, 'relatorio', 'dadas', 'eaeas', 'easeas', 'easeas', '2019-06-22 20:41:31', '2019-07-22 20:41:31', NULL, 123, 23),
(41, 7, 6, 1, 'relatorio', 'de user A para user C', 'easeas', 'easeas', 'easeas', '2019-06-22 20:47:42', '2019-07-22 20:47:42', NULL, NULL, 19),
(42, 3, 5, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:48:11', '2019-07-22 20:48:11', NULL, 2312321, NULL),
(43, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:49:55', '2019-07-22 20:49:55', NULL, 123, NULL),
(44, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:50:20', '2019-07-22 20:50:20', NULL, 123, NULL),
(45, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:50:59', '2019-07-22 20:50:59', NULL, NULL, NULL),
(46, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:51:25', '2019-07-22 20:51:25', NULL, NULL, NULL),
(47, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:52:37', '2019-07-22 20:52:37', NULL, NULL, NULL),
(48, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:53:06', '2019-07-22 20:53:06', NULL, NULL, NULL),
(49, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:53:21', '2019-07-22 20:53:21', NULL, NULL, NULL),
(50, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:53:33', '2019-07-22 20:53:33', NULL, NULL, NULL),
(51, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:53:41', '2019-07-22 20:53:41', NULL, NULL, NULL),
(52, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:54:03', '2019-07-22 20:54:03', NULL, NULL, NULL),
(53, 7, 6, 1, 'relatorio', 'easeas', 'easeas', 'easeas', 'easeas', '2019-06-22 20:54:32', '2019-07-22 20:54:32', NULL, NULL, NULL),
(54, 3, 6, 1, 'riscos', 'de user A para user C', 'easesae', 'easeas', 'easeas', '2019-06-22 20:57:10', '2019-07-22 20:57:10', NULL, NULL, 19),
(55, 3, 6, 1, 'riscos', 'de user A para user C', 'easesae', 'easeas', 'easeas', '2019-06-22 20:57:26', '2019-07-22 20:57:26', NULL, NULL, 19),
(56, 7, 5, 1, 'relatorio', 'de user A para user C', 'a', 'a', 'a', '2019-06-22 21:02:16', '2019-07-22 21:02:16', NULL, NULL, 19),
(57, 7, 7, 2, 'relatorio', 'de user A para user C', 'easeaseas', 'easeas', 'easeaseas', '2019-06-22 21:06:57', '2019-07-22 21:06:57', NULL, NULL, 19),
(58, 7, 7, 2, 'relatorio', 'de user A para user C', 'easeaseas', 'easeas', 'easeaseas', '2019-06-22 21:07:29', '2019-07-22 21:07:29', NULL, NULL, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacp_participantes`
--

CREATE TABLE `sacp_participantes` (
  `id` int(11) NOT NULL,
  `id_sacp` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sacp_participantes`
--

INSERT INTO `sacp_participantes` (`id`, `id_sacp`, `id_participante`) VALUES
(55, 38, 23),
(56, 39, 23),
(57, 40, 23),
(58, 40, 20),
(59, 40, 24),
(60, 41, 25),
(61, 41, 20),
(62, 41, 21),
(65, 43, 25),
(66, 44, 25),
(67, 45, 23),
(68, 45, 21),
(69, 46, 23),
(70, 46, 21),
(71, 47, 23),
(72, 47, 21),
(73, 48, 23),
(74, 48, 21),
(75, 49, 23),
(76, 49, 21),
(77, 50, 23),
(78, 50, 21),
(79, 51, 23),
(80, 51, 21),
(81, 52, 23),
(82, 52, 21),
(83, 53, 23),
(84, 53, 21),
(91, 42, 25),
(92, 42, 21),
(93, 54, 20),
(94, 54, 24),
(95, 55, 20),
(96, 55, 24),
(97, 56, 25),
(98, 57, 23),
(99, 58, 23),
(132, 37, 23),
(133, 37, 25),
(134, 37, 20),
(135, 37, 24),
(144, 36, 19),
(145, 36, 23),
(146, 36, 25),
(147, 36, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

CREATE TABLE `setores` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `responsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tipos_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `permissoes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tipo_plano_acao` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `setor` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `user_session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `setor`, `email`, `usuario`, `senha`, `tipo_usuario`, `user_session_id`) VALUES
(19, 'usuário A', 2, 'usuarioA@edelbra.com.br', 'usuarioA', '$2a$08$dMoCrtIiDZl4KWU1H3PI1e2ccGF9j2PFYoTTds5nPpN8XaKsi1gka', 3, 'pv35u8bgo7apk497iu8roij3s5'),
(20, 'usuário B', 6, 'usuarioB@edelbra.com.br', 'usuarioB', '$2a$08$aJFwqAflqJahcDAObDPis.pxwH/dUIr73FUh29vX6GPH4o9Hseqf2', 3, 'sm22028bmm2aeipbgvsgju4jmj'),
(21, 'usuário C', 5, 'usuarioC@edelbra.com.br', 'usuarioC', '$2a$08$BtEveze.8u3z7fCzXs13Gu8TpCMGDUji26i02xzxsW3MnV31h.UEy', 3, '7nsqcpgfr12ih9tens9qakg8ei'),
(22, 'Administrador', 2, 'administrador@edelbra.com.br', 'admin', '$2a$08$vfXLeWf8sxOPX36Ioo0tX.PQlpSAtegW2MdvngEY88UElveO4GDs2', 1, '54bofl7nmbjhdp3isab93ui5qp'),
(23, 'Qualidade', 2, 'qualidade@edelbra.combr', 'qualidade', '$2a$08$FFtkqoNn0p.U4R5FJ3nLPOfas66V57LZGi7/wa3XYt4IDknBVPQKC', 2, '23h7p2h9721bl7fc29p51ne29e'),
(24, 'usuário D', 5, 'usuarioD@edelbra.com.br', 'usuarioD', '$2a$08$kSOs1zk3Ax5O.yr96GWNFOQtmxdBvcm7SF4cHGMwqk4ZVHErf.44q', 3, NULL),
(25, 'maria aparecida da silva sauro teu cu ', 7, 'ghjc2@zdv', 'maria', '$2a$08$s19dKGMjrQMOY9ufiLopq.TQ1AgGZjyZuGiQ8YuFc5jMQ62cOqFoW', 3, 'haertdnpru1as1md5tcbiqtnio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `espinha_peixe`
--
ALTER TABLE `espinha_peixe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sacp` (`id_sacp`),
  ADD KEY `id_tipo_plano_acao` (`id_tipo_plano_acao`);

--
-- Indexes for table `planos_acao`
--
ALTER TABLE `planos_acao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sacp` (`id_sacp`),
  ADD KEY `id_tipo_plano` (`id_tipo_plano`),
  ADD KEY `quem` (`quem`),
  ADD KEY `onde` (`onde`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `rnc`
--
ALTER TABLE `rnc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `id_origem` (`id_origem`),
  ADD KEY `id_destino` (`id_destino`);

--
-- Indexes for table `sacp`
--
ALTER TABLE `sacp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setor_origem` (`setor_origem`),
  ADD KEY `setor_destino` (`setor_destino`),
  ADD KEY `id_rnc` (`id_rnc`),
  ADD KEY `fk_sacp_status` (`status`);

--
-- Indexes for table `sacp_participantes`
--
ALTER TABLE `sacp_participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sacp` (`id_sacp`),
  ADD KEY `id_participante` (`id_participante`);

--
-- Indexes for table `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsavel` (`responsavel`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_plano_acao`
--
ALTER TABLE `tipo_plano_acao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_usuario` (`tipo_usuario`),
  ADD KEY `setor` (`setor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `espinha_peixe`
--
ALTER TABLE `espinha_peixe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `planos_acao`
--
ALTER TABLE `planos_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rnc`
--
ALTER TABLE `rnc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sacp`
--
ALTER TABLE `sacp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sacp_participantes`
--
ALTER TABLE `sacp_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `setores`
--
ALTER TABLE `setores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_plano_acao`
--
ALTER TABLE `tipo_plano_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
