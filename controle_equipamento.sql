-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Set-2020 às 19:05
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle_equipamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `definitivo_interior`
--

CREATE TABLE `definitivo_interior` (
  `def_num_serie` varchar(30) NOT NULL,
  `unidade` varchar(30) NOT NULL,
  `responsavel` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `descricao` text DEFAULT NULL,
  `titulo_locador` char(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `protocolo` char(9) NOT NULL,
  `federacao` int(11) DEFAULT NULL,
  `dt_prazo` date DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `dt_lotacao` date DEFAULT NULL,
  `titulo_locador` char(14) DEFAULT NULL,
  `unipto` varchar(30) NOT NULL,
  `responsavel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`protocolo`, `federacao`, `dt_prazo`, `descricao`, `dt_lotacao`, `titulo_locador`, `unipto`, `responsavel`) VALUES
('200128582', 0, '2020-01-15', 'foi e nao vota mais', '2020-01-13', '0329 7173 2275', 'SEGED', 'JULIA'),
('200128926', 1, '2020-04-08', '', '2020-01-21', '0329 7173 2275', '03ª ZE', 'ERIC'),
('200186246', 0, '2020-01-21', '', '2020-01-21', '0329 7173 2275', 'COINF', 'ERIC'),
('200222199', 0, '2020-08-17', 'asdfasfd', '2020-08-17', '0329 7173 2275', 'SAWEB', 'LEANDERSON'),
('200272953', 0, '2020-01-15', '', '2020-01-13', '0329 7173 2275', 'COEDE', 'JULIA'),
('200279345', 0, '2020-01-21', '', '2020-01-20', '0329 7173 2275', 'COEDE', 'RICARDO'),
('200321464', 0, '2020-01-23', 'dsfsdfsdfsdf', '2020-01-20', '0329 7173 2275', 'COEDE', 'RICARDO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `num_serie` varchar(30) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `status` int(11) DEFAULT 0,
  `condicao_entrada` int(11) NOT NULL,
  `marca` varchar(15) NOT NULL,
  `modelo` varchar(15) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`num_serie`, `tipo`, `status`, `condicao_entrada`, `marca`, `modelo`, `descricao`) VALUES
('000001', 'Monitor', 1, 0, 'AVAYA', 'j51', 'teste para monitores'),
('1213213123', 'Telefone', 1, 0, 'AVAYA', 'B7050', 'teste de 10'),
('1ghfghgf', 'Gabinete', 0, 0, 'HP', 'e5457', ''),
('222222', 'Notebook', 1, 0, 'Dell', 'e5457', ''),
('2222223', 'Monitor', 0, 0, 'AOC', 'GOLD', 'novos '),
('24875412', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('333333', 'Notebook', 0, 0, 'Dell', 'e5457', 'esses equipamentos foram comprados recentemente na data x sdflnkasdfjalkdsfnadsj alksdfakjlsdf jalsdkjfaskljd f asdfasdfasdfasdfasdf asdfasdfasdfa adsfasdfasdfasdf'),
('444444', 'Notebook', 0, 0, 'Dell', 'e5457', 'esses equipamentos foram comprados recentemente na data x'),
('45454545', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('45454548', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('455747', 'Injetor', 0, 0, 'AOC', 'd45757', ''),
('5456457', 'Monitor', 0, 0, 'AOC', 'GOLD', 'novos '),
('546545454', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('555555', 'Notebook', 0, 0, 'Dell', 'e5457', 'esses equipamentos foram comprados recentemente na data x'),
('56411231', 'Minicomputador', 0, 0, 'Epson', 'cv', ''),
('56546464', 'Notebook', 0, 0, 'Samsung', 'w87sdfff', 'aasdf'),
('75465454', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('777777', 'Monitor', 0, 0, 'HP', 'j50', 'teste para monitores'),
('78787877', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('81848447', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('84545454', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('87878978', 'Telefone', 0, 0, 'AVAYA', 'B7050', 'teste de 10'),
('888888', 'Monitor', 0, 0, 'HP', 'j50', 'teste para monitores'),
('999999', 'Monitor', 0, 0, 'HP', 'j50', '\r\nesses equipamentos foram comprados recentemente na data x sdflnkasdfjalkdsfnadsj alksdfakjlsdf jalsdkjfaskljd f asdfasdfasdfasdfasdf asdfasdfasdfa adsfasdfasdfasdf'),
('dddd1212', 'Teclado', 0, 0, 'Logitech', 'k22', 'nada a declarar'),
('dddd2121', 'Teclado', 0, 0, 'Logitech', 'k22', 'nada a declarar'),
('dfgdgf4', 'Gabinete', 3, 0, 'HP', 'e5457', ''),
('ereereere', 'Webcam', 1, 0, 'HP', 'hj50', ''),
('m526bu1208001263', 'Bateria para Nobreak', 0, 0, 'Logitech', 'L5446', 'sdfaf'),
('qwerqerer', 'Webcam', 0, 0, 'HP', 'hj50', ''),
('qwerqew', 'Webcam', 0, 0, 'HP', 'hj50', ''),
('qwerqwer', 'Webcam', 0, 0, 'HP', 'hj50', ''),
('qwerwee', 'Webcam', 0, 0, 'HP', 'hj50', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento_emprestado`
--

CREATE TABLE `equipamento_emprestado` (
  `protocolo` char(9) NOT NULL,
  `num_serie` varchar(30) NOT NULL,
  `titulo_receptor` char(14) DEFAULT NULL,
  `lot_status` int(11) DEFAULT NULL,
  `dt_devolucao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `equipamento_emprestado`
--

INSERT INTO `equipamento_emprestado` (`protocolo`, `num_serie`, `titulo_receptor`, `lot_status`, `dt_devolucao`) VALUES
('200222199', '000001', NULL, 0, NULL),
('200222199', '222222', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome` varchar(30) DEFAULT NULL,
  `titulo` char(14) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `titulo`, `senha`, `nivel`) VALUES
('Leandro', '0329 7173 2275', '07b875ff4badca43816759d99bb9d7fdc36ae1c4', 2),
('Eric', '3333 3333 3333', 'adcd7048512e64b48da55b027577886ee5a36350', 2),
('teste', '9999 9999 9999', 'adcd7048512e64b48da55b027577886ee5a36350', 1),
('demilson', '2222 2222 2222', 'adcd7048512e64b48da55b027577886ee5a36350',2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `definitivo_interior`
--
ALTER TABLE `definitivo_interior`
  ADD PRIMARY KEY (`def_num_serie`),
  ADD KEY `titulo_locador` (`titulo_locador`);

--
-- Índices para tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`protocolo`),
  ADD KEY `titulo_locador` (`titulo_locador`);

--
-- Índices para tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`num_serie`);

--
-- Índices para tabela `equipamento_emprestado`
--
ALTER TABLE `equipamento_emprestado`
  ADD PRIMARY KEY (`protocolo`,`num_serie`),
  ADD KEY `titulo_receptor` (`titulo_receptor`),
  ADD KEY `num_serie` (`num_serie`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`titulo`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `definitivo_interior`
--
ALTER TABLE `definitivo_interior`
  ADD CONSTRAINT `definitivo_interior_ibfk_1` FOREIGN KEY (`titulo_locador`) REFERENCES `usuario` (`titulo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `definitivo_interior_ibfk_2` FOREIGN KEY (`def_num_serie`) REFERENCES `equipamento` (`num_serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`titulo_locador`) REFERENCES `usuario` (`titulo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `equipamento_emprestado`
--
ALTER TABLE `equipamento_emprestado`
  ADD CONSTRAINT `equipamento_emprestado_ibfk_1` FOREIGN KEY (`titulo_receptor`) REFERENCES `usuario` (`titulo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `equipamento_emprestado_ibfk_2` FOREIGN KEY (`protocolo`) REFERENCES `emprestimo` (`protocolo`),
  ADD CONSTRAINT `equipamento_emprestado_ibfk_3` FOREIGN KEY (`num_serie`) REFERENCES `equipamento` (`num_serie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
