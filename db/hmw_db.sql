-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 17-Jan-2021 às 17:02
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id7506591_hmw_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ajuda`
--

CREATE TABLE `ajuda` (
  `id_pedido` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(254) COLLATE utf8_bin DEFAULT NULL,
  `mensagem` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `resposta` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `cancelado` int(1) DEFAULT NULL,
  `respondido` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `ajuda`
--

INSERT INTO `ajuda` (`id_pedido`, `nome`, `email`, `mensagem`, `resposta`, `data_pedido`, `cancelado`, `respondido`) VALUES
(1, 'JB', 'test@test.io', 'Hello Word', 'Hello JB', '2018-12-18', 0, 0),
(2, 'Test1', 'test@test.test', 'test1', 'test', '2018-12-28', 0, 1),
(5, 'teste', 'fgfgfg@cfhc.vom', 'teteteteteteteste', 'nbnbnbnbnb', '2019-11-06', 0, 1),
(6, 'este contactenos', 'nazarslim@gmail.com', 'zero', 'teste', '2020-01-13', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `apartamento`
--

CREATE TABLE `apartamento` (
  `id_apartamento` int(11) NOT NULL,
  `identificacao` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `categoria_apartamento` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `cidade_apartamento` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `titulo_apartamento` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `preco_apartamento` int(11) DEFAULT NULL,
  `capacidade_apartamento` int(11) DEFAULT NULL,
  `tipo_apartamento` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `aprovado` int(1) DEFAULT NULL,
  `cancelado` int(1) DEFAULT NULL,
  `contactado` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `apartamento`
--

INSERT INTO `apartamento` (`id_apartamento`, `identificacao`, `data_pedido`, `categoria_apartamento`, `cidade_apartamento`, `titulo_apartamento`, `preco_apartamento`, `capacidade_apartamento`, `tipo_apartamento`, `aprovado`, `cancelado`, `contactado`) VALUES
(1, 'flavius1f', '2018-12-18', 'T1', 'Vila Nova de Gaia', 'Melhor\r\ncasa', 228, 10, 'Moradia', 1, 0, 0),
(2, 'test1', '2018-12-27', 'T4', 'Faro', 'Room in Historic Building', 35, 4, 'Apartamento', 0, 0, 0),
(3, 'PS12121', '2018-12-18', 'T1', 'Vila Nova de Gaia', 'Melhor\r\ncasa', 228, 10, 'Moradia', 0, 1, 0),
(4, '000TESTE000', '2019-01-14', 'T5+', 'São Romão do Coronado', 'Room in Historic Building', 10, 2, 'Apartamento', 1, 0, 1),
(6, 'SP123345123123', '2019-02-03', 'T0', 'Porto', 'Aparatmento teste', 99, 4, 'Apartamento', 1, 0, 1),
(8, 'PS12121', '2020-01-13', 'T0', 'Porto', NULL, NULL, NULL, NULL, 0, 1, 0),
(9, 'PS12121', '2020-01-13', 'T0', 'Penafiel', NULL, NULL, NULL, NULL, 0, 1, 0),
(10, 'PS12121', '2018-12-18', 'T1', 'Vila Nova de Gaia', 'Melhor\r\ncasa', 228, 10, 'Moradia', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_apartamento` int(11) DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `mensagem` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `aprovado` int(1) DEFAULT NULL,
  `cancelado` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_apartamento`, `nome`, `mensagem`, `aprovado`, `cancelado`) VALUES
(1, 1, 'JB', 'E melhor apartamento', 1, 0),
(2, 1, 'Joao', 'E melhor apartamento', 0, 0),
(3, 6, 'Gangi', 'Fazer testes é bom', 1, 0),
(4, 1, 'Tomas', 'Melhor casa de sempre', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

CREATE TABLE `dados` (
  `id` varchar(13) NOT NULL,
  `data_o` datetime NOT NULL,
  `data_f` datetime DEFAULT NULL,
  `natureza` varchar(500) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `distrito` varchar(100) NOT NULL,
  `cncelho` varchar(100) NOT NULL,
  `freguesia` varchar(100) NOT NULL,
  `localidade` varchar(100) NOT NULL,
  `latitude` varchar(11) NOT NULL,
  `longitude` varchar(11) NOT NULL,
  `rec_hum_ter` int(11) NOT NULL,
  `rec_tec_ter` int(11) NOT NULL,
  `rec_hum_aer` int(11) NOT NULL,
  `rec_tec_aer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_apartamento` int(11) DEFAULT NULL,
  `identificacao` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nacionalidade` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `telefone` int(9) DEFAULT NULL,
  `email` varchar(254) COLLATE utf8_bin DEFAULT NULL,
  `mensagem` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `metodo_comunicacao` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `numero_pessoas` int(11) DEFAULT NULL,
  `data_checkin` date DEFAULT NULL,
  `data_checkout` date DEFAULT NULL,
  `aprovado` int(1) DEFAULT NULL,
  `cancelado` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_apartamento`, `identificacao`, `nome`, `data_nascimento`, `nacionalidade`, `pais`, `cidade`, `telefone`, `email`, `mensagem`, `metodo_comunicacao`, `data_pedido`, `numero_pessoas`, `data_checkin`, `data_checkout`, `aprovado`, `cancelado`) VALUES
(1, 1, 'PS12121', 'Karabas Barabas', '2018-03-01', 'Russo', 'Russia', 'Moscovo', 123456789, 'for@mother.russia', 'Vodka', 'telefone', '2015-01-10', 10, '2019-01-01', '2019-01-10', 0, 0),
(2, 1, 'PS12121', 'Karabas Barabas', '2018-03-01', 'Russo', 'Russia', 'Moscovo', 123456789, 'for@mother.russia', 'Vodka', 'telefone', '2015-01-10', 10, '2019-01-23', '2019-01-30', 1, 0),
(3, 2, 'PS12121', 'Karabas Barabas', '2018-03-01', 'Russo', 'Russia', 'Moscovo', 123456789, 'for@mother.russia', 'Vodka', 'telefone', '2015-01-10', 10, '2019-01-23', '2019-01-30', 1, 0),
(6, 1, 'test1', 'test', '2019-01-12', 'test', 'test', 'test', 987654321, 'nazarslim@gmail.com', 'trest', 'Pelo telefone d', '2019-01-11', 5, '2019-02-01', '2019-02-28', 1, 0),
(7, 1, '000TESTE000', 'TESTE ', '2019-01-01', 'Ucraniano', 'UGANDA', 'gaya', 910000941, 'teste@russia.jafoste', 'JB', 'Pelo correio de', '2019-01-14', 10, '2019-01-11', '2019-01-11', 1, 0),
(8, 6, 'twitch.tv/xkato', 'Kato ', '2002-02-05', 'Portugues', 'Portugal', 'Maia', 911790660, 'kato@gmail.com', '', 'Pelo e-mail', '2020-01-13', 3, '2019-01-01', '2019-01-31', 1, 0),
(9, 4, 'teste2', '', '1998-01-24', 'Russo', 'Russia', 'Moskow', 321456987, 'flavio.olvieira.19@hotmail.com', 'um pedido de teste', 'Pelo e-mail', '2020-01-24', 2, '2019-02-01', '2019-02-28', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id_utilizador` int(11) NOT NULL,
  `identificacao` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nacionalidade` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `telefone` int(9) DEFAULT NULL,
  `email` varchar(254) COLLATE utf8_bin DEFAULT NULL,
  `pass` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `tipo_utilizador` varchar(10) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `identificacao`, `nome`, `data_nascimento`, `nacionalidade`, `pais`, `cidade`, `telefone`, `email`, `pass`, `tipo_utilizador`) VALUES
(2, 'PS12121', 'Karabas Barabas', '2000-12-12', 'Portugues', 'Portugal', 'Porto', 123456789, 'test@test.test', '202cb962ac59075b964b07152d234b70', 'user'),
(1, 'root', 'Rei dos root\'s', '0001-01-01', 'LinuxLand', 'LinuxLandia', 'Kali', 911111111, 'root', '63a9f0ea7bb98050796b649e85481845', 'root'),
(4, 'test1', 'JOJO', '2018-12-28', 'test', 'test1', 'test1', 123456789, 'test@test.io', '098f6bcd4621d373cade4e832627b4f6', 'user'),
(5, '000TESTE000', 'Joao Paulo', '0999-06-23', 'PORTUGUES', 'PORTUGAL', 'PORTO', 2147483647, 'flavio.oliveira.19@hotmail.com', 'df2f163465698380dd26f3ff6cff9519', 'user'),
(6, 'flavius1f', 'Flavio', '1997-06-23', 'Portuguesa', 'Portugal', 'Porto', 2147483647, 'teste1@teste.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(7, 'dasdasda123', 'Nazar', '1231-12-23', 'Portuguesa', 'Portugal', 'Porto', 2147483647, 'godisback.1f@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(8, 'teste', 'Leirosa', '2000-02-02', 'qqqq', 'qqqq', 'qqqq', 1234, 'ispg4225@ispgaya.pt', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(9, 'teste1123', 'Test123', '2020-01-24', 'Pt', 'pt', 'teste', 123456789, 'asdf@sapo.pt', '123', 'user');

--
-- Acionadores `utilizador`
--
DELIMITER $$
CREATE TRIGGER `ctrl_email` BEFORE INSERT ON `utilizador` FOR EACH ROW IF NEW.email NOT LIKE '_%@_%.__%' THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email invalido';
END IF
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ajuda`
--
ALTER TABLE `ajuda`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices para tabela `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`id_apartamento`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Índices para tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Índices para tabela `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_utilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ajuda`
--
ALTER TABLE `ajuda`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `apartamento`
--
ALTER TABLE `apartamento`
  MODIFY `id_apartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
