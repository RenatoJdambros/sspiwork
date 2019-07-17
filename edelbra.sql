-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jul-2019 às 14:20
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
  `status` int(11) NOT NULL DEFAULT 2
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
  `cliente_nome` varchar(255) DEFAULT NULL,
  `cliente_obra` varchar(255) DEFAULT NULL,
  `cliente_telefone` varchar(255) DEFAULT NULL,
  `cliente_email` varchar(255) DEFAULT NULL,
  `sacp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `rnc_dados_fk`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `rnc_dados_fk` (
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

CREATE TABLE `sacp` (
  `id` int(11) NOT NULL,
  `setor_origem` int(11) NOT NULL,
  `setor_destino` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 2,
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacp_participantes`
--

CREATE TABLE `sacp_participantes` (
  `id` int(11) NOT NULL,
  `id_sacp` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` varchar(255) NOT NULL DEFAULT 'ativo',
  `user_session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `setor`, `email`, `usuario`, `senha`, `tipo_usuario`, `status`, `user_session_id`) VALUES
(19, 'usuário A', 2, 'usuarioA@edelbra.com.br', 'usuarioA', '$2a$08$dLgjH2m5c8emE66pjdExmgep47BAdKTrCJ7Tw5jtS38n2tVEGigka', 3, 'ativo', 'ngahqj389r0r7p5pkj4o106g4a'),
(20, 'usuário B', 6, 'usuarioB@edelbra.com.br', 'usuarioB', '$2a$08$aJFwqAflqJahcDAObDPis.pxwH/dUIr73FUh29vX6GPH4o9Hseqf2', 3, 'ativo', 'cru55ft6murvd672j68vv85101'),
(21, 'usuário C', 5, 'usuarioC@edelbra.com.br', 'usuarioC', '$2a$08$BtEveze.8u3z7fCzXs13Gu8TpCMGDUji26i02xzxsW3MnV31h.UEy', 3, 'ativo', 'duapj69lscauiakh6k5r0spkp5'),
(22, 'Administrador', 2, 'administrador@edelbra.com.br', 'admin', '$2a$08$vfXLeWf8sxOPX36Ioo0tX.PQlpSAtegW2MdvngEY88UElveO4GDs2', 1, 'ativo', 'm5ofc7213dqlj8etgdtel4uqne'),
(23, 'Qualidade', 2, 'qualidade@edelbra.combr', 'qualidade', '$2a$08$FFtkqoNn0p.U4R5FJ3nLPOfas66V57LZGi7/wa3XYt4IDknBVPQKC', 2, 'ativo', '23h7p2h9721bl7fc29p51ne29e'),
(25, 'maria aparecida da silva sauro teu cu ', 7, 'ghjc2@zdv', 'maria', '$2a$08$s19dKGMjrQMOY9ufiLopq.TQ1AgGZjyZuGiQ8YuFc5jMQ62cOqFoW', 3, 'ativo', 'haertdnpru1as1md5tcbiqtnio');

-- --------------------------------------------------------

--
-- Estrutura para vista `rnc_dados_fk`
--
DROP TABLE IF EXISTS `rnc_dados_fk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rnc_dados_fk`  AS  select `rnc`.`id` AS `id`,`rnc`.`id_origem` AS `id_origem`,`rnc`.`id_destino` AS `id_destino`,`rnc`.`descricao` AS `descricao`,`rnc`.`justificativa` AS `justificativa`,`rnc`.`correcao` AS `correcao`,`rnc`.`data_gerada` AS `data_gerada`,`rnc`.`data_finalizada` AS `data_finalizada`,`rnc`.`numero_op` AS `numero_op`,`rnc`.`sacp` AS `sacp`,`rnc`.`cliente_nome` AS `cliente_nome`,`rnc`.`cliente_obra` AS `cliente_obra`,`rnc`.`cliente_telefone` AS `cliente_telefone`,`rnc`.`cliente_email` AS `cliente_email`,`status`.`nome` AS `status`,`usro`.`nome` AS `nome_origem`,`usrd`.`nome` AS `nome_destino` from (((`rnc` join `status` on(`rnc`.`status` = `status`.`id`)) join `usuarios` `usro` on(`rnc`.`id_origem` = `usro`.`id`)) join `usuarios` `usrd` on(`rnc`.`id_destino` = `usrd`.`id`)) ;

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
  ADD KEY `id_destino` (`id_destino`),
  ADD KEY `sacp` (`sacp`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `planos_acao`
--
ALTER TABLE `planos_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `rnc`
--
ALTER TABLE `rnc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `sacp`
--
ALTER TABLE `sacp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `sacp_participantes`
--
ALTER TABLE `sacp_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

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
