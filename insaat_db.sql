-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 10/03/2026 às 20:27
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `insaat_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adminler`
--

CREATE TABLE `adminler` (
  `id` int(11) NOT NULL,
  `kullanici` varchar(50) DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adminler`
--

INSERT INTO `adminler` (`id`, `kullanici`, `sifre`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(255) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `adres` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `telefon`, `adres`, `email`, `whatsapp`) VALUES
(1, 'Demir İnşaat Resmi Web Sitesi', '0555 123 45 67', NULL, NULL, '905551234567');

-- --------------------------------------------------------

--
-- Estrutura para tabela `hizmetler`
--

CREATE TABLE `hizmetler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `detay` text DEFAULT NULL,
  `ikon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mesaj` text DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `ad_soyad`, `email`, `mesaj`, `tarih`) VALUES
(1, 'has', 'has@gmail.com', 'merhaba 25 m² fayans isi icin fiyat istiyorum', '2026-03-05 19:50:46'),
(2, 'mehmet', 'meh@gmail.com', 'eu quero orçamento 39 m² ', '2026-03-05 22:29:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projeler`
--

CREATE TABLE `projeler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` text DEFAULT NULL,
  `resim` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `resim2` varchar(255) DEFAULT NULL,
  `resim3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projeler`
--

INSERT INTO `projeler` (`id`, `baslik`, `aciklama`, `resim`, `kategori`, `tarih`, `resim2`, `resim3`) VALUES
(1, 'Modern Villa Projesi', 'İstanbulda lüks bir villa inşaatı.', 'proje1.jpg', 'Konut', '2026-03-04 14:26:40', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adminler`
--
ALTER TABLE `adminler`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `hizmetler`
--
ALTER TABLE `hizmetler`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `projeler`
--
ALTER TABLE `projeler`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adminler`
--
ALTER TABLE `adminler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `hizmetler`
--
ALTER TABLE `hizmetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `projeler`
--
ALTER TABLE `projeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
