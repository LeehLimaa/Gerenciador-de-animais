-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jun-2024 às 00:24
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gerenciador_animais`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animais`
--

CREATE TABLE `animais` (
  `ID_animal` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `data_nasc` date NOT NULL,
  `altura` float NOT NULL,
  `peso` float NOT NULL,
  `especie` int(11) NOT NULL,
  `raca` int(11) NOT NULL,
  `cor` varchar(15) NOT NULL,
  `porte` varchar(25) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `habitat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `ID_atendimento` int(11) NOT NULL,
  `data` date NOT NULL,
  `cliente` int(11) NOT NULL,
  `banho_tosa` int(11) DEFAULT NULL,
  `consulta` int(11) DEFAULT NULL,
  `exames` int(11) DEFAULT NULL,
  `medicamentos` int(11) DEFAULT NULL,
  `vacinas` int(11) DEFAULT NULL,
  `qtde_banho_tosa` int(11) DEFAULT NULL,
  `qtde_consulta` int(11) DEFAULT NULL,
  `qtde_exames` int(11) DEFAULT NULL,
  `qtde_medicamentos` int(11) DEFAULT NULL,
  `qtde_vacinas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atendimentos`
--

INSERT INTO `atendimentos` (`ID_atendimento`, `data`, `cliente`, `banho_tosa`, `consulta`, `exames`, `medicamentos`, `vacinas`, `qtde_banho_tosa`, `qtde_consulta`, `qtde_exames`, `qtde_medicamentos`, `qtde_vacinas`) VALUES
(39, '2023-06-15', 2, 4, 2, 1, 1, 1, 2, 2, 1, 3, 1),
(40, '2023-06-15', 2, 4, 0, 0, 0, 0, 3, 0, 0, 0, 0),
(42, '2023-06-15', 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banho_tosa`
--

CREATE TABLE `banho_tosa` (
  `ID_banho_tosa` int(11) NOT NULL,
  `procedimento` varchar(20) NOT NULL,
  `preco` float NOT NULL,
  `funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banho_tosa`
--

INSERT INTO `banho_tosa` (`ID_banho_tosa`, `procedimento`, `preco`, `funcionario`) VALUES
(4, 'Banho e Tosa', 80, 5),
(5, 'Banho', 50, 5),
(6, 'Tosa', 40, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `ID_cliente` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nasc` date NOT NULL,
  `rua` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `num` int(11) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`ID_cliente`, `nome`, `email`, `telefone`, `cpf`, `data_nasc`, `rua`, `bairro`, `num`, `cidade`, `estado`) VALUES
(2, 'Letícia', 'leticia@gmail.com', '(35) 9 9999-9999', '123.123.123-12', '2023-06-13', 'ABC', 'DEF', 123, 'Muzambinho', 'Minas Gerais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `consulta`
--

CREATE TABLE `consulta` (
  `ID_consulta` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `preco` float NOT NULL,
  `funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `consulta`
--

INSERT INTO `consulta` (`ID_consulta`, `tipo`, `preco`, `funcionario`) VALUES
(1, 'Simples', 120, 3),
(2, 'Especializada', 250, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `ID_contato` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensagem` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`ID_contato`, `nome`, `email`, `mensagem`) VALUES
(2, 'Letícia', 'leticia@gmail.com', 'Olá, Bom Dia! Tudo Bem?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `especies`
--

CREATE TABLE `especies` (
  `ID_especie` int(11) NOT NULL,
  `especie` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exames`
--

CREATE TABLE `exames` (
  `ID_exame` int(11) NOT NULL,
  `exame` varchar(20) NOT NULL,
  `preco` float NOT NULL,
  `observacoes` varchar(100) NOT NULL,
  `funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `exames`
--

INSERT INTO `exames` (`ID_exame`, `exame`, `preco`, `observacoes`, `funcionario`) VALUES
(1, 'sangue', 20, 'Comparecer no dia marcado, de jejum de no mínimo 12 horas.', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `ID_funcionario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `data_nasc` date NOT NULL,
  `rua` varchar(50) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `num` int(11) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `salario` float NOT NULL,
  `funcao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`ID_funcionario`, `nome`, `email`, `telefone`, `cpf`, `data_nasc`, `rua`, `bairro`, `num`, `cidade`, `estado`, `salario`, `funcao`) VALUES
(1, 'Maria', 'maria@gmail.com', '(35) 9 9999-9999', '123.123.123-12', '2023-06-13', 'ABC', 'DEF', 123, 'Muzambinho', 'Minas Gerais', 1200, 'Administrador'),
(3, 'Ana', 'ana@gmail.com', '(35) 9 9999-9999', '123.123.123-12', '2023-06-13', 'ABC', 'DEF', 123, 'Muzambinho', 'Minas Gerais', 1500, 'Veterinário'),
(4, 'Laura', 'laura@gmail.com', '(35) 9 9999-9999', '123.123.123-12', '2023-06-13', 'ABC', 'DEF', 123, 'Muzambinho', 'Minas Gerais', 1000, 'Vendedor'),
(5, 'Sophia', 'sophia@gmail.com', '(35) 9 9999-9999', '123.123.123-12', '2023-06-13', 'ABC', 'DEF', 123, 'Muzambinho', 'Minas Gerais', 1600, 'Banhista e Tosador'),
(6, 'Lavínia', 'lavinia@gmail.com', '(35) 9 9999-9999', '123.123.123-12', '2023-06-13', 'ABC', 'DEF', 123, 'Muzambinho', 'Minas Gerais', 900, 'Recepcionista');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `ID_medicamentos` int(11) NOT NULL,
  `medicamento` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modo_uso` varchar(30) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `preco` float NOT NULL,
  `funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medicamentos`
--

INSERT INTO `medicamentos` (`ID_medicamentos`, `medicamento`, `marca`, `modo_uso`, `descricao`, `preco`, `funcionario`) VALUES
(1, 'Antipulgas e Carrapa', 'NexGard', 'Dar para o seu cão um tablete ', 'Para cães de 10 a 25Kg; Sabor Carne.', 80, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `racas`
--

CREATE TABLE `racas` (
  `ID_raca` int(11) NOT NULL,
  `raca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`) VALUES
(3, 'Leeh', '$2y$10$Ol9dddsiKTh9yPy6.rbZv.GBf5qeDvnPjHRx/1Yl1CFTSp8k7yRoS', 'Letícia de Lima Batista'),
(4, 'teste', '$2y$10$4BcLAZhSn1pkSYam0U2pAuu8pq0ssY/A234.sI4xPh5cTZ1GsBof.', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vacinas`
--

CREATE TABLE `vacinas` (
  `ID_vacina` int(11) NOT NULL,
  `vacina` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `lote` varchar(20) NOT NULL,
  `funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vacinas`
--

INSERT INTO `vacinas` (`ID_vacina`, `vacina`, `marca`, `lote`, `funcionario`) VALUES
(1, 'Gripe Canina', 'Boehringer Ingelheim', 'GJ9239', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animais`
--
ALTER TABLE `animais`
  ADD PRIMARY KEY (`ID_animal`),
  ADD KEY `ID_especie` (`especie`),
  ADD KEY `ID_raca` (`raca`);

--
-- Índices para tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`ID_atendimento`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `banho_tosa` (`banho_tosa`),
  ADD KEY `consulta` (`consulta`),
  ADD KEY `exame` (`exames`),
  ADD KEY `medicamento` (`medicamentos`),
  ADD KEY `vacinas` (`vacinas`);

--
-- Índices para tabela `banho_tosa`
--
ALTER TABLE `banho_tosa`
  ADD PRIMARY KEY (`ID_banho_tosa`),
  ADD KEY `ID_funcionario` (`funcionario`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_cliente`),
  ADD KEY `ID_cidade` (`cidade`);

--
-- Índices para tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`ID_consulta`),
  ADD KEY `ID_funcionario` (`funcionario`);

--
-- Índices para tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`ID_contato`);

--
-- Índices para tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`ID_especie`);

--
-- Índices para tabela `exames`
--
ALTER TABLE `exames`
  ADD PRIMARY KEY (`ID_exame`),
  ADD KEY `ID_funcionario` (`funcionario`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`ID_funcionario`);

--
-- Índices para tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`ID_medicamentos`),
  ADD KEY `ID_funcionario` (`funcionario`);

--
-- Índices para tabela `racas`
--
ALTER TABLE `racas`
  ADD PRIMARY KEY (`ID_raca`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vacinas`
--
ALTER TABLE `vacinas`
  ADD PRIMARY KEY (`ID_vacina`),
  ADD KEY `ID_funcionario` (`funcionario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animais`
--
ALTER TABLE `animais`
  MODIFY `ID_animal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `ID_atendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `banho_tosa`
--
ALTER TABLE `banho_tosa`
  MODIFY `ID_banho_tosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `ID_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `ID_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `especies`
--
ALTER TABLE `especies`
  MODIFY `ID_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exames`
--
ALTER TABLE `exames`
  MODIFY `ID_exame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `ID_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `ID_medicamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `racas`
--
ALTER TABLE `racas`
  MODIFY `ID_raca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `vacinas`
--
ALTER TABLE `vacinas`
  MODIFY `ID_vacina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
