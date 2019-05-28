-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2019 às 16:41
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.0.27

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
(3, 8, 13, 'eu sou uma RNC BOLADONA', 'justificativa da rnc com id 3', 'correcao da rnc com id 3', 1, '2019-05-27 20:18:14', NULL, 8754, NULL, NULL, NULL, NULL, NULL),
(4, 8, 13, 'rnc com dados de clientes :D', 'abc', 'def', 1, '2019-05-27 20:44:36', NULL, 16987, NULL, 'nome do cliente', 'nome da obra', 'telefone do cliente', 'email@cliente');

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
(1, 'Atendimento', 13),
(2, 'Administrativo', NULL),
(3, 'Controladoria', NULL),
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
  `user_session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `setor`, `email`, `usuario`, `senha`, `tipo_usuario`, `user_session_id`) VALUES
(8, 'Luiz Comiran de Lima', 2, 'luizcomiran@gmail.comabcv', 'luizgdi', '$2a$08$5HcWAmaqqqxZL/90FHs25ujMV8cuS66U3Yo8Dbn/KHqg5/W6iO9H.', 1, '2b6ncrkgavru2ip8hss1su8831'),
(12, 'Administrador', 2, 'admin@admin.admin', 'admin', '$2a$08$5HcWAmaqqqxZL/90FHs25ujMV8cuS66U3Yo8Dbn/KHqg5/W6iO9H.', 1, 's7i6bj37ofpirjg3ufpkasribj'),
(13, 'Renato Dambros', 6, 'renato@gmail.com', 'renato', '$2a$08$95c6wKefs7LW.M1izf6I6e6v01vlrYko4hC8R2fsrsMeAfBcJDD2G', 1, 'l0caib0b523m0belbrcp9s1oe1'),
(14, 'Betinho', 3, 'beto@beto', 'betinho', '$2a$08$rfofusvJNmp7fcF1dUDZAOWsxJgr9Y6HoWCAd74D8SJr6mNn1k7sy', 3, ''),
(15, 'Guilherme', 4, 'guilherme@guilherme', 'guilherme', '$2a$08$uEfO5mEgGcwPiLHnIj0XjegOqdN3S08nn9fZVgQ2NubnvkgpWl2De', 3, ''),
(16, 'qualidade', 2, 'qualidade@qualidade', 'qualidade', '$2a$08$nyUoEFBeDnwtunqvQkbVSufRNS6g05Rd5fhVHnsbAbwWcWrcLoCvW', 2, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rnc`
--
ALTER TABLE `rnc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `id_origem` (`id_origem`),
  ADD KEY `id_destino` (`id_destino`);

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
-- AUTO_INCREMENT for table `rnc`
--
ALTER TABLE `rnc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `rnc`
--
ALTER TABLE `rnc`
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_destino` FOREIGN KEY (`id_destino`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_origem` FOREIGN KEY (`id_origem`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
