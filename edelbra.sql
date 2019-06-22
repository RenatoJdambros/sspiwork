-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jun-2019 às 21:52
-- Versão do servidor: 10.3.15-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `edelbra`
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
(27, 36, 7, '');

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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` int(11) NOT NULL DEFAULT 1,
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
  `status` int(11) NOT NULL DEFAULT 1,
  `origem` varchar(255) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `proposito` varchar(5000) NOT NULL,
  `consequencia` varchar(5000) NOT NULL,
  `brainstorming` varchar(5000) NOT NULL,
  `data_gerada` datetime NOT NULL,
  `data_finalizada` datetime DEFAULT NULL,
  `numero_op` int(11) DEFAULT NULL,
  `id_rnc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sacp`
--

INSERT INTO `sacp` (`id`, `setor_origem`, `setor_destino`, `status`, `origem`, `descricao`, `proposito`, `consequencia`, `brainstorming`, `data_gerada`, `data_finalizada`, `numero_op`, `id_rnc`) VALUES
(36, 2, 7, 1, 'relatorio', 'a', 'a', 'a', 'a', '2019-06-19 20:26:54', NULL, 90, NULL);

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
(48, 36, 21);

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
(19, 'usuário A', 2, 'usuarioA@edelbra.com.br', 'usuarioA', '$2a$08$dMoCrtIiDZl4KWU1H3PI1e2ccGF9j2PFYoTTds5nPpN8XaKsi1gka', 3, 'j1dvpb03ti22d9umpac3itbl38'),
(20, 'usuário B', 6, 'usuarioB@edelbra.com.br', 'usuarioB', '$2a$08$aJFwqAflqJahcDAObDPis.pxwH/dUIr73FUh29vX6GPH4o9Hseqf2', 3, 'moo6rofuvkksv197qifti1is0c'),
(21, 'usuário C', 5, 'usuarioC@edelbra.com.br', 'usuarioC', '$2a$08$BtEveze.8u3z7fCzXs13Gu8TpCMGDUji26i02xzxsW3MnV31h.UEy', 3, '7nsqcpgfr12ih9tens9qakg8ei'),
(22, 'Administrador', 2, 'administrador@edelbra.com.br', 'admin', '$2a$08$vfXLeWf8sxOPX36Ioo0tX.PQlpSAtegW2MdvngEY88UElveO4GDs2', 1, 'vc0csgpjvtelraguc3p87ed1kv'),
(23, 'Qualidade', 2, 'qualidade@edelbra.combr', 'qualidade', '$2a$08$FFtkqoNn0p.U4R5FJ3nLPOfas66V57LZGi7/wa3XYt4IDknBVPQKC', 2, '23h7p2h9721bl7fc29p51ne29e'),
(24, 'usuário D', 5, 'usuarioD@edelbra.com.br', 'usuarioD', '$2a$08$kSOs1zk3Ax5O.yr96GWNFOQtmxdBvcm7SF4cHGMwqk4ZVHErf.44q', 3, NULL),
(25, 'maria aparecida da silva sauro teu cu ', 7, 'ghjc2@zdv', 'maria', '$2a$08$s19dKGMjrQMOY9ufiLopq.TQ1AgGZjyZuGiQ8YuFc5jMQ62cOqFoW', 3, 'haertdnpru1as1md5tcbiqtnio');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `espinha_peixe`
--
ALTER TABLE `espinha_peixe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sacp` (`id_sacp`),
  ADD KEY `id_tipo_plano_acao` (`id_tipo_plano_acao`);

--
-- Índices para tabela `planos_acao`
--
ALTER TABLE `planos_acao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sacp` (`id_sacp`),
  ADD KEY `id_tipo_plano` (`id_tipo_plano`),
  ADD KEY `quem` (`quem`),
  ADD KEY `onde` (`onde`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `rnc`
--
ALTER TABLE `rnc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `id_origem` (`id_origem`),
  ADD KEY `id_destino` (`id_destino`);

--
-- Índices para tabela `sacp`
--
ALTER TABLE `sacp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setor_origem` (`setor_origem`),
  ADD KEY `setor_destino` (`setor_destino`),
  ADD KEY `id_rnc` (`id_rnc`),
  ADD KEY `fk_sacp_status` (`status`);

--
-- Índices para tabela `sacp_participantes`
--
ALTER TABLE `sacp_participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sacp` (`id_sacp`),
  ADD KEY `id_participante` (`id_participante`);

--
-- Índices para tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsavel` (`responsavel`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo_plano_acao`
--
ALTER TABLE `tipo_plano_acao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_usuario` (`tipo_usuario`),
  ADD KEY `setor` (`setor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `espinha_peixe`
--
ALTER TABLE `espinha_peixe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `planos_acao`
--
ALTER TABLE `planos_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rnc`
--
ALTER TABLE `rnc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `sacp`
--
ALTER TABLE `sacp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `sacp_participantes`
--
ALTER TABLE `sacp_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_plano_acao`
--
ALTER TABLE `tipo_plano_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
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
  ADD CONSTRAINT `fk_onde` FOREIGN KEY (`onde`) REFERENCES `setores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sacp` FOREIGN KEY (`id_sacp`) REFERENCES `sacp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_status_plano_acao` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_plano` FOREIGN KEY (`id_tipo_plano`) REFERENCES `tipo_plano_acao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
