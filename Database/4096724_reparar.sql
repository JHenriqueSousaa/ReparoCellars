-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: fdb34.awardspace.net
-- Generation Time: May 23, 2022 at 04:21 PM
-- Server version: 5.7.20-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4096724_reparar`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telemovel` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nome`, `morada`, `telemovel`, `email`, `obs`) VALUES
(1, 'Joao Sousa', 'Rua Antonio Baarbosa 127', 995671231, 'joao.guardar.depois@teste1.com', 'Gordo, nepias! Ossos largos!'),
(2, 'Rita Saramago', 'Rua das Pedras Novas', 912223334, 'Ritasaramo@gmail.pt', 'ssRita Saramago ï¿½ um texto daquelassss'),
(3, 'Tiago Pistolas', 'Rua Albufeira do Carmo', 92311321, 'carmotiagoo@hotmail.sapo', 'Teste dos Testes'),
(4, 'Daniel dos Brandos', 'Rua dos Fixolas', 2147483647, 'tiago.loypes@epbjc.pt', 'Okay!');

-- --------------------------------------------------------

--
-- Table structure for table `Reparacoes`
--

CREATE TABLE `Reparacoes` (
  `idReparacao` int(11) NOT NULL,
  `CodigoReparacao` varchar(255) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `Equipamento` varchar(255) NOT NULL,
  `IMEI` int(15) NOT NULL,
  `Obs` varchar(255) NOT NULL,
  `EstadoReparacao` int(11) NOT NULL,
  `DescricaoEstado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reparacoes`
--

INSERT INTO `Reparacoes` (`idReparacao`, `CodigoReparacao`, `idCliente`, `Equipamento`, `IMEI`, `Obs`, `EstadoReparacao`, `DescricaoEstado`) VALUES
(11, 'PYFjz', 1, 'Samsung', 1123654987, 'Fixolas', 2, 'Nao funfa'),
(14, 'chB1X', 3, 'Nokia Tijolo', 2147483647, 'Novo', 6, 'Nada'),
(15, 'FWh2s', 1, 'Relogio da Asus dddddd Ã©', 2147483647, 'teste 2', 3, 'aaaFeito!'),
(40, 'oOmvG', 1, 'Xiaomi Redmi Note 9', 123, 'Xiaomi Redmi Note 9', 1, 'Xiaomi Redmi Note 9'),
(41, 'peiBi', 3, 'Tetse', 123, '123', 4, '123');

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `username`, `password`, `email`, `data_criacao`) VALUES
(1, 'admin', '$2y$10$UorNtvCoIape65A5gan4JuchfaAqFnGK7bCvkbEvwsgDw7G87A9ZC', 'admin@reparocellars.pt', '2022-05-22 10:48:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `Reparacoes`
--
ALTER TABLE `Reparacoes`
  ADD PRIMARY KEY (`idReparacao`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Reparacoes`
--
ALTER TABLE `Reparacoes`
  MODIFY `idReparacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Reparacoes`
--
ALTER TABLE `Reparacoes`
  ADD CONSTRAINT `Reparacoes_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
