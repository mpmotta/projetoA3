-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jul-2024 às 01:11
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `atendimentos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimento`
--

CREATE TABLE `atendimento` (
  `idAtendimento` int(11) NOT NULL,
  `idFormaAtendimento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` enum('S','N') NOT NULL,
  `respostaAtendimento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `atendimento`
--

INSERT INTO `atendimento` (`idAtendimento`, `idFormaAtendimento`, `idUsuario`, `dataCadastro`, `ativo`, `respostaAtendimento`) VALUES
(1, 1, 2, '2024-07-13 21:07:49', 'S', 'agora vai que vai que vai'),
(3, 2, 1, '2024-07-13 22:58:56', 'S', 'agora sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formaatendimento`
--

CREATE TABLE `formaatendimento` (
  `idFormaAtendimento` int(11) NOT NULL,
  `nomeAtendimento` varchar(255) DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `formaatendimento`
--

INSERT INTO `formaatendimento` (`idFormaAtendimento`, `nomeAtendimento`, `dataCadastro`) VALUES
(1, 'Presencial', '2024-07-13 20:14:45'),
(2, 'Whatsapp', '2024-07-13 20:14:54'),
(3, 'Ligação', '2024-07-13 20:15:07'),
(4, 'E-mail', '2024-07-13 20:15:18'),
(5, 'Redes Sociais', '2024-07-13 20:15:33'),
(6, 'TEAMS', '2024-07-13 20:15:43'),
(7, 'Outros', '2024-07-13 20:15:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL,
  `emailUsuario` varchar(255) NOT NULL,
  `loginUsuario` varchar(255) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `telefoneCelular` varchar(45) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `loginUsuario`, `senhaUsuario`, `dataCadastro`, `telefoneCelular`, `ativo`) VALUES
(1, 'Stefany Severo', 'stefanysevero@gmail.com', 'stefany', 'e8d95a51f3af4a3b134bf6bb680a213a', '2024-07-13 05:05:14', '(51) 998407-4070', 'S'),
(2, 'Márcio Motta', 'mpmotta@hotmail.com', 'mpmotta', 'e8d95a51f3af4a3b134bf6bb680a213a', '2024-07-13 05:06:12', '(51) 99966-6661', 'S'),
(5, 'Flavio Deivith', 'flavio.deivith@gmail.com', 'flavio', 'e10adc3949ba59abbe56e057f20f883e', '2024-07-13 19:59:05', '(51) 99966-6666', 'N'),
(7, 'Pedro Juquinha', 'pedro.juquinha@gmail.com', 'juquinha', '03844797885514ceae153662883487fd', '2024-07-13 21:00:00', '(51) 99966-6662', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atendimento`
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`idAtendimento`),
  ADD KEY `idFormaAtendimento` (`idFormaAtendimento`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `formaatendimento`
--
ALTER TABLE `formaatendimento`
  ADD PRIMARY KEY (`idFormaAtendimento`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `idAtendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `formaatendimento`
--
ALTER TABLE `formaatendimento`
  MODIFY `idFormaAtendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atendimento`
--
ALTER TABLE `atendimento`
  ADD CONSTRAINT `atendimento_ibfk_1` FOREIGN KEY (`idFormaAtendimento`) REFERENCES `formaatendimento` (`idFormaAtendimento`),
  ADD CONSTRAINT `atendimento_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
