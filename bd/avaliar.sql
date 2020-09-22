-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2020 at 06:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avaliar`
--

-- --------------------------------------------------------

--
-- Table structure for table `avaliacao`
--

CREATE TABLE `avaliacao` (
  `idavaliar` int(11) NOT NULL,
  `nome_usuario` varchar(255) DEFAULT NULL,
  `idtradeFK` int(11) NOT NULL,
  `idcategoriaFK` int(11) NOT NULL,
  `nota_limpeza` double(3,1) NOT NULL,
  `nota_atendimento` double(3,1) NOT NULL,
  `nota_localizacao` double(3,1) NOT NULL,
  `nota_qualidade` double(3,1) NOT NULL,
  `pros` text DEFAULT NULL,
  `contra` text DEFAULT NULL,
  `sugestao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avaliacao`
--

INSERT INTO `avaliacao` (`idavaliar`, `nome_usuario`, `idtradeFK`, `idcategoriaFK`, `nota_limpeza`, `nota_atendimento`, `nota_localizacao`, `nota_qualidade`, `pros`, `contra`, `sugestao`) VALUES
(1, '', 1, 1, 6.0, 4.0, 2.0, 8.0, '', '', ''),
(2, '', 2, 1, 10.0, 10.0, 6.0, 10.0, '', '', ''),
(3, '', 2, 1, 2.0, 2.0, 2.0, 4.0, 'Tem uma qualidade muito boa.', 'O preço, a higiene deixa a desejar.', 'Rever todos esses pontos. Se não, pode fechar.'),
(4, '', 2, 1, 10.0, 8.0, 6.0, 10.0, 'Possui uma ótima higienização e uma qualidade de serviço imensa.', 'A localização e a forma de tratamento dos funcionários poderia ser melhor', 'Coloquem degustação de vinhos!'),
(5, '', 20, 2, 10.0, 10.0, 10.0, 10.0, 'Essa padaria me satisfaz em todos os sentidos!', '', 'Um estabelecimento maior. Aquelas filas que se formam nos caixas chegam até a panificadora.'),
(6, '', 13, 2, 10.0, 10.0, 10.0, 6.0, 'Próximo a onde moro e serve muito bem as pessoas que moram em torno.', 'Os salgados e alguns doces que estão na vitrine me fizeram mal e muitas vezes estão fora da validade. Bom verificar', 'Uma maior segurança no local.');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nome_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nome_categoria`) VALUES
(1, 'Supermercado'),
(2, 'Padaria'),
(3, 'Petshop'),
(4, 'Salão de Beleza'),
(5, 'Farmácia');

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `idtrade` int(11) NOT NULL,
  `nome_trade` varchar(255) NOT NULL,
  `idcategoriaFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`idtrade`, `nome_trade`, `idcategoriaFK`) VALUES
(1, 'COMETA SUPERMERCADO', 1),
(2, 'Pão de Açúcar', 1),
(3, 'Carrefour', 1),
(4, 'Walmart', 1),
(5, 'Ceconsud', 1),
(6, 'Zaffari', 1),
(7, 'Irmãos Muffato', 1),
(8, 'Condor Super Center', 1),
(9, 'Supermercados BH', 1),
(10, 'Sonda Supermercados', 1),
(11, 'Romana', 2),
(12, 'Portugália', 2),
(13, 'Lisboa', 2),
(14, 'Pão Bom', 2),
(15, 'KiPãozinho', 2),
(16, 'Estação do Pão', 2),
(17, 'MixPão', 2),
(18, 'Novo Colonial', 2),
(19, 'Água na Boca', 2),
(20, 'Sales', 2),
(21, 'Pet Shower', 3),
(22, 'Cão Cuidado', 3),
(23, 'Dog Shower', 3),
(24, 'Pet Feliz', 3),
(25, 'Petinhos Cães e Gatos', 3),
(26, 'Mimo Canino', 3),
(27, 'Petinhos Cães e Gatos', 3),
(28, 'Cãopeão', 3),
(29, 'Pet e Repet', 3),
(30, 'Pet & Gatô', 3),
(31, 'Mademoiselle', 4),
(32, 'Essência', 4),
(33, 'Maxi Hair', 4),
(34, 'Espelho Meu', 4),
(35, 'Wonder Hair', 4),
(36, 'BellaDonna', 4),
(37, 'Tutti Belli', 4),
(38, 'Salão Cia da Beleza', 4),
(39, 'Salão Companhia da Beleza', 4),
(40, 'Salão Belíssima', 4),
(41, 'Pague Menos', 5),
(42, 'Pague Mais', 5),
(43, 'Vital', 5),
(44, 'Santa Branca', 5),
(45, 'Lemos', 5),
(46, 'Master', 5),
(47, 'Remediando', 5),
(48, 'URL', 5),
(49, 'Dose Certa', 5),
(50, 'Terra', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`idavaliar`),
  ADD KEY `idtradeFK` (`idtradeFK`),
  ADD KEY `idcategoriaFK` (`idcategoriaFK`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`idtrade`),
  ADD KEY `idcategoriaFK` (`idcategoriaFK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `idavaliar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `idtrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`idtradeFK`) REFERENCES `trades` (`idtrade`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`idcategoriaFK`) REFERENCES `categorias` (`idcategoria`);

--
-- Constraints for table `trades`
--
ALTER TABLE `trades`
  ADD CONSTRAINT `trades_ibfk_1` FOREIGN KEY (`idcategoriaFK`) REFERENCES `categorias` (`idcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
