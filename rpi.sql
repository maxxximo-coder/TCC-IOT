-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 31-Out-2020 às 17:57
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rpi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `rg`, `telefone`, `email`, `senha`) VALUES
(1, 'Administrador', '2147483647', '556677889', '2147483647', 'administrador@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'João das Couves', '14796325832', '237896542', '21999998888', 'joãodascouves@gmail.com', 'e10adc3949ba59abbe56'),
(5, 'Maxnilsomom', '12365434578', '409872134', '21972779378', 'maxnilsonmon@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'jose', '123456', '1234567', '12345678', 'jose@hotmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'Thiago', '2345678921', '234567890', '21972779378', 'thiago@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dash`
--

DROP TABLE IF EXISTS `dash`;
CREATE TABLE IF NOT EXISTS `dash` (
  `id_dash` int NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id_dash`),
  KEY `fk_id_cliente` (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `dash`
--

INSERT INTO `dash` (`id_dash`, `endereco`, `id_cliente`) VALUES
(4, 'http://www.google.com.br', 6),
(3, 'http://www.google.com.br', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos_sensor`
--

DROP TABLE IF EXISTS `equipamentos_sensor`;
CREATE TABLE IF NOT EXISTS `equipamentos_sensor` (
  `id_equipamento` int NOT NULL AUTO_INCREMENT,
  `id_moradia` int DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `informacoes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id_equipamento`),
  KEY `fk_id_moradia` (`id_moradia`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `equipamentos_sensor`
--

INSERT INTO `equipamentos_sensor` (`id_equipamento`, `id_moradia`, `nome`, `informacoes`) VALUES
(1, 1, 'Lampada 1', 'conectada ao rele 1'),
(2, 1, 'Lampada 2', 'conectada ao rele 2'),
(3, 1, 'Lampada 3', 'conectada ao rele 3'),
(4, 1, 'Lampada 4', 'conectada ao rele 4'),
(5, 4, 'sensor temperatura', 'blablabla'),
(6, 4, '', ''),
(7, 8, 'Lampada Sala', 'lampada que fica no comodo sala');

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitura_registro`
--

DROP TABLE IF EXISTS `leitura_registro`;
CREATE TABLE IF NOT EXISTS `leitura_registro` (
  `id_leitura` int NOT NULL AUTO_INCREMENT,
  `id_equipamento` int DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `valor` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_leitura`),
  KEY `fk_id_equipamento` (`id_equipamento`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `leitura_registro`
--

INSERT INTO `leitura_registro` (`id_leitura`, `id_equipamento`, `data_hora`, `valor`, `status`) VALUES
(1, 1, '2020-10-29 13:06:54', 1, 1),
(2, 1, '2020-10-29 14:41:00', 0, 0),
(3, 4, '2020-10-31 13:11:16', 0, 1),
(4, 4, '2020-10-31 13:12:54', 0, 0),
(5, 4, '2020-10-31 13:13:43', 0, 1),
(6, 4, '2020-10-31 13:13:52', 0, 0),
(7, 4, '2020-10-31 13:13:53', 0, 1),
(8, 1, '2020-10-31 13:13:54', 0, 1),
(9, 1, '2020-10-31 13:13:55', 0, 0),
(10, 1, '2020-10-31 13:14:06', 0, 1),
(11, 1, '2020-10-31 13:14:14', 0, 0),
(12, 1, '2020-10-31 13:14:21', 0, 1),
(13, 1, '2020-10-31 13:14:24', 0, 0),
(14, 1, '2020-10-31 13:14:49', 0, 1),
(15, 1, '2020-10-31 13:14:57', 0, 0),
(16, 1, '2020-10-31 13:14:58', 0, 1),
(17, 1, '2020-10-31 13:15:00', 0, 0),
(18, 1, '2020-10-31 13:15:08', 0, 1),
(19, 1, '2020-10-31 13:15:23', 0, 0),
(20, 1, '2020-10-31 13:15:41', 0, 1),
(21, 1, '2020-10-31 13:15:58', 0, 0),
(22, 1, '2020-10-31 13:16:08', 0, 1),
(23, 1, '2020-10-31 13:16:39', 0, 0),
(24, 1, '2020-10-31 13:18:44', 0, 1),
(25, 1, '2020-10-31 13:18:48', 0, 0),
(26, 2, '2020-10-31 13:18:48', 0, 1),
(27, 3, '2020-10-31 13:18:49', 0, 1),
(28, 4, '2020-10-31 13:18:50', 0, 0),
(29, 4, '2020-10-31 13:18:50', 0, 1),
(30, 4, '2020-10-31 13:18:51', 0, 1),
(31, 1, '2020-10-31 13:18:52', 0, 1),
(32, 2, '2020-10-31 13:18:57', 0, 1),
(33, 2, '2020-10-31 13:18:58', 0, 0),
(34, 3, '2020-10-31 13:18:58', 0, 0),
(35, 3, '2020-10-31 13:18:59', 0, 1),
(36, 4, '2020-10-31 13:18:59', 0, 0),
(37, 4, '2020-10-31 13:19:00', 0, 0),
(38, 4, '2020-10-31 13:19:01', 0, 1),
(39, 1, '2020-10-31 13:19:02', 0, 0),
(40, 1, '2020-10-31 13:19:38', 0, 1),
(41, 1, '2020-10-31 13:19:50', 0, 0),
(42, 1, '2020-10-31 13:20:41', 0, 1),
(43, 1, '2020-10-31 13:20:42', 0, 0),
(44, 1, '2020-10-31 13:20:42', 0, 1),
(45, 1, '2020-10-31 13:20:42', 0, 1),
(46, 1, '2020-10-31 13:20:42', 0, 1),
(47, 1, '2020-10-31 13:20:43', 0, 1),
(48, 1, '2020-10-31 13:20:43', 0, 0),
(49, 1, '2020-10-31 13:20:44', 0, 0),
(50, 1, '2020-10-31 13:23:28', 0, 1),
(51, 4, '2020-10-31 13:23:32', 0, 0),
(52, 3, '2020-10-31 13:23:33', 0, 0),
(53, 3, '2020-10-31 13:23:34', 0, 1),
(54, 1, '2020-10-31 13:23:35', 0, 0),
(55, 1, '2020-10-31 13:23:36', 0, 1),
(56, 1, '2020-10-31 13:23:36', 0, 0),
(57, 1, '2020-10-31 13:23:37', 0, 0),
(58, 1, '2020-10-31 13:23:37', 0, 1),
(59, 1, '2020-10-31 13:24:46', 0, 1),
(60, 1, '2020-10-31 13:24:47', 0, 0),
(61, 1, '2020-10-31 13:26:19', 0, 1),
(62, 1, '2020-10-31 13:26:21', 0, 0),
(63, 1, '2020-10-31 13:26:34', 0, 1),
(64, 1, '2020-10-31 13:27:48', 0, 0),
(65, 1, '2020-10-31 13:31:44', 0, 1),
(66, 1, '2020-10-31 13:31:53', 0, 0),
(67, 1, '2020-10-31 13:32:07', 0, 1),
(68, 1, '2020-10-31 13:32:20', 0, 0),
(69, 1, '2020-10-31 13:33:11', 0, 1),
(70, 1, '2020-10-31 13:33:31', 0, 0),
(71, 1, '2020-10-31 13:33:44', 0, 1),
(72, 1, '2020-10-31 13:35:12', 0, 0),
(73, 1, '2020-10-31 13:35:33', 0, 1),
(74, 1, '2020-10-31 13:35:35', 0, 0),
(75, 1, '2020-10-31 13:35:58', 0, 1),
(76, 1, '2020-10-31 13:36:07', 0, 0),
(77, 1, '2020-10-31 13:36:12', 0, 1),
(78, 1, '2020-10-31 13:36:20', 0, 0),
(79, 1, '2020-10-31 13:36:44', 0, 1),
(80, 1, '2020-10-31 13:37:21', 0, 0),
(81, 1, '2020-10-31 13:37:22', 0, 1),
(82, 1, '2020-10-31 13:37:32', 0, 0),
(83, 1, '2020-10-31 13:37:38', 0, 1),
(84, 1, '2020-10-31 13:37:42', 0, 0),
(85, 1, '2020-10-31 13:37:52', 0, 1),
(86, 1, '2020-10-31 13:38:17', 0, 0),
(87, 1, '2020-10-31 13:38:32', 0, 1),
(88, 2, '2020-10-31 13:38:35', 0, 1),
(89, 1, '2020-10-31 13:38:36', 0, 0),
(90, 3, '2020-10-31 13:38:37', 0, 0),
(91, 4, '2020-10-31 13:38:37', 0, 1),
(92, 1, '2020-10-31 13:38:40', 0, 1),
(93, 1, '2020-10-31 13:38:54', 0, 0),
(94, 1, '2020-10-31 13:38:56', 0, 1),
(95, 1, '2020-10-31 13:39:11', 0, 0),
(96, 1, '2020-10-31 13:39:12', 0, 1),
(97, 1, '2020-10-31 13:39:33', 0, 0),
(98, 1, '2020-10-31 13:39:35', 0, 1),
(99, 1, '2020-10-31 13:39:46', 0, 0),
(100, 1, '2020-10-31 13:39:47', 0, 1),
(101, 1, '2020-10-31 13:39:48', 0, 0),
(102, 1, '2020-10-31 13:39:48', 0, 1),
(103, 1, '2020-10-31 13:39:48', 0, 1),
(104, 1, '2020-10-31 13:39:48', 0, 1),
(105, 1, '2020-10-31 13:39:49', 0, 1),
(106, 1, '2020-10-31 13:39:49', 0, 0),
(107, 1, '2020-10-31 13:39:49', 0, 0),
(108, 1, '2020-10-31 13:39:49', 0, 0),
(109, 1, '2020-10-31 13:39:49', 0, 0),
(110, 1, '2020-10-31 13:40:29', 0, 0),
(111, 1, '2020-10-31 13:40:31', 0, 1),
(112, 4, '2020-10-31 13:40:32', 0, 1),
(113, 4, '2020-10-31 13:40:41', 0, 0),
(114, 4, '2020-10-31 13:40:48', 0, 1),
(115, 4, '2020-10-31 13:40:50', 0, 0),
(116, 4, '2020-10-31 13:40:57', 0, 1),
(117, 4, '2020-10-31 13:41:04', 0, 0),
(118, 4, '2020-10-31 13:41:25', 0, 1),
(119, 2, '2020-10-31 13:41:29', 0, 0),
(120, 2, '2020-10-31 13:41:43', 0, 1),
(121, 2, '2020-10-31 13:42:15', 0, 0),
(122, 1, '2020-10-31 13:42:33', 0, 0),
(123, 1, '2020-10-31 13:42:35', 0, 1),
(124, 1, '2020-10-31 13:42:35', 0, 0),
(125, 1, '2020-10-31 13:42:39', 0, 0),
(126, 1, '2020-10-31 13:43:44', 0, 1),
(127, 1, '2020-10-31 13:43:50', 0, 0),
(128, 1, '2020-10-31 13:43:55', 0, 1),
(129, 1, '2020-10-31 13:44:00', 0, 0),
(130, 1, '2020-10-31 13:44:08', 0, 1),
(131, 1, '2020-10-31 13:44:26', 0, 0),
(132, 1, '2020-10-31 13:44:34', 0, 1),
(133, 1, '2020-10-31 13:44:40', 0, 0),
(134, 1, '2020-10-31 13:44:48', 0, 1),
(135, 1, '2020-10-31 13:44:58', 0, 0),
(136, 1, '2020-10-31 13:45:21', 0, 1),
(137, 1, '2020-10-31 13:46:49', 0, 0),
(138, 1, '2020-10-31 13:47:00', 0, 1),
(139, 1, '2020-10-31 13:47:06', 0, 0),
(140, 1, '2020-10-31 13:47:34', 0, 1),
(141, 1, '2020-10-31 13:47:46', 0, 0),
(142, 1, '2020-10-31 13:47:56', 0, 1),
(143, 1, '2020-10-31 13:48:06', 0, 0),
(144, 1, '2020-10-31 13:48:19', 0, 1),
(145, 1, '2020-10-31 13:48:28', 0, 0),
(146, 1, '2020-10-31 13:48:35', 0, 1),
(147, 1, '2020-10-31 13:49:02', 0, 0),
(148, 1, '2020-10-31 13:49:31', 0, 1),
(149, 1, '2020-10-31 13:49:52', 0, 0),
(150, 1, '2020-10-31 13:51:04', 0, 1),
(151, 1, '2020-10-31 13:51:17', 0, 0),
(152, 1, '2020-10-31 13:51:19', 0, 1),
(153, 1, '2020-10-31 13:51:22', 0, 0),
(154, 1, '2020-10-31 13:51:28', 0, 1),
(155, 2, '2020-10-31 13:51:35', 0, 1),
(156, 3, '2020-10-31 13:51:38', 0, 1),
(157, 3, '2020-10-31 13:53:06', 0, 0),
(158, 1, '2020-10-31 13:53:09', 0, 0),
(159, 2, '2020-10-31 13:53:11', 0, 0),
(160, 2, '2020-10-31 13:53:52', 0, 1),
(161, 1, '2020-10-31 13:53:54', 0, 1),
(162, 1, '2020-10-31 13:53:55', 0, 0),
(163, 1, '2020-10-31 13:53:55', 0, 1),
(164, 1, '2020-10-31 13:54:00', 0, 1),
(165, 1, '2020-10-31 13:54:01', 0, 0),
(166, 1, '2020-10-31 13:54:01', 0, 1),
(167, 1, '2020-10-31 13:54:02', 0, 1),
(168, 1, '2020-10-31 13:54:03', 0, 0),
(169, 1, '2020-10-31 13:54:47', 0, 1),
(170, 1, '2020-10-31 13:54:48', 0, 0),
(171, 1, '2020-10-31 13:55:55', 0, 1),
(172, 1, '2020-10-31 13:55:57', 0, 0),
(173, 1, '2020-10-31 13:56:21', 0, 1),
(174, 1, '2020-10-31 13:56:22', 0, 0),
(175, 1, '2020-10-31 13:56:24', 0, 1),
(176, 1, '2020-10-31 13:56:44', 0, 0),
(177, 1, '2020-10-31 13:56:47', 0, 1),
(178, 2, '2020-10-31 13:56:51', 0, 0),
(179, 2, '2020-10-31 13:56:55', 0, 1),
(180, 1, '2020-10-31 13:57:16', 0, 0),
(181, 1, '2020-10-31 13:57:18', 0, 1),
(182, 1, '2020-10-31 13:57:26', 0, 0),
(183, 1, '2020-10-31 13:57:35', 0, 1),
(184, 1, '2020-10-31 13:58:46', 0, 0),
(185, 1, '2020-10-31 13:58:47', 0, 1),
(186, 1, '2020-10-31 13:59:48', 0, 0),
(187, 1, '2020-10-31 13:59:48', 0, 1),
(188, 1, '2020-10-31 14:01:12', 0, 1),
(189, 1, '2020-10-31 14:01:15', 0, 0),
(190, 1, '2020-10-31 14:01:16', 0, 1),
(191, 1, '2020-10-31 14:04:15', 0, 0),
(192, 1, '2020-10-31 14:04:17', 0, 1),
(193, 1, '2020-10-31 14:04:19', 0, 0),
(194, 1, '2020-10-31 14:04:31', 0, 1),
(195, 1, '2020-10-31 14:04:36', 0, 0),
(196, 1, '2020-10-31 14:12:57', 0, 1),
(197, 1, '2020-10-31 14:16:25', 0, 0),
(198, 1, '2020-10-31 14:17:18', 0, 1),
(199, 1, '2020-10-31 14:17:21', 0, 0),
(200, 1, '2020-10-31 14:17:24', 0, 1),
(201, 1, '2020-10-31 14:20:28', 0, 0),
(202, 1, '2020-10-31 14:20:34', 0, 1),
(203, 1, '2020-10-31 14:21:45', 0, 0),
(204, 1, '2020-10-31 14:22:12', 0, 1),
(205, 1, '2020-10-31 14:22:18', 0, 0),
(206, 1, '2020-10-31 14:22:24', 0, 1),
(207, 1, '2020-10-31 14:42:58', 0, 0),
(208, 2, '2020-10-31 15:38:13', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `moradia`
--

DROP TABLE IF EXISTS `moradia`;
CREATE TABLE IF NOT EXISTS `moradia` (
  `id_moradia` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_moradia`),
  KEY `fk_id_cliente` (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `moradia`
--

INSERT INTO `moradia` (`id_moradia`, `id_cliente`, `numero`, `rua`, `municipio`, `UF`) VALUES
(1, 2, 10, 'Rua de Ninguém', 'Seropédica', 'RJ'),
(2, 2, 0, '', '', ''),
(3, 1, 0, '', '', ''),
(4, 5, 10, 'Dr Romão', 'Seropa', 'RJ'),
(5, 5, 0, '', '', ''),
(6, 5, 10, 'Dr Romão', 'Seropa', 'RJ'),
(7, 5, 20, 'MAx', 'Seropedica', 'MG'),
(8, 6, 23, 'João Pedro', 'Seropedica', 'RJ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
