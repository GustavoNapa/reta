-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 31-Ago-2020 às 14:52
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `acaicombobagens`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_cliente`
--

DROP TABLE IF EXISTS `acb_cliente`;
CREATE TABLE IF NOT EXISTS `acb_cliente` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_status` int(11) NOT NULL,
  `cli_cpfcnpj` varchar(50) NOT NULL,
  `cli_nome` varchar(100) NOT NULL,
  `cli_dtnasc` date NOT NULL,
  `cli_email` varchar(50) NOT NULL,
  `cli_telefone` varchar(20) DEFAULT NULL,
  `cli_celular` varchar(20) DEFAULT NULL,
  `cli_whatsapp` int(11) NOT NULL,
  `cli_dtcad` datetime NOT NULL,
  `cli_dtalter` datetime DEFAULT NULL,
  PRIMARY KEY (`cli_id`),
  UNIQUE KEY `cli_id` (`cli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_endereco`
--

DROP TABLE IF EXISTS `acb_endereco`;
CREATE TABLE IF NOT EXISTS `acb_endereco` (
  `end_id` int(11) NOT NULL AUTO_INCREMENT,
  `end_cep` varchar(10) NOT NULL,
  `end_logradouro` varchar(100) DEFAULT NULL,
  `end_numero` int(11) DEFAULT NULL,
  `end_complemento` varchar(50) DEFAULT NULL,
  `end_bairro` varchar(50) DEFAULT NULL,
  `end_cidade` varchar(50) DEFAULT NULL,
  `end_uf` varchar(10) DEFAULT NULL,
  `end_pais` varchar(50) DEFAULT NULL,
  `end_referencia` varchar(100) DEFAULT NULL,
  `end_dtalter` datetime DEFAULT NULL,
  `end_usualter` int(11) DEFAULT NULL,
  PRIMARY KEY (`end_id`),
  UNIQUE KEY `end_id` (`end_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_nivelacesso`
--

DROP TABLE IF EXISTS `acb_nivelacesso`;
CREATE TABLE IF NOT EXISTS `acb_nivelacesso` (
  `nva_id` int(11) NOT NULL AUTO_INCREMENT,
  `nva_status` int(11) NOT NULL,
  `nva_nome` varchar(50) NOT NULL,
  `nva_dtcad` datetime NOT NULL,
  `nva_dtalter` datetime NOT NULL,
  `nva_usuario` int(11) NOT NULL,
  PRIMARY KEY (`nva_id`),
  UNIQUE KEY `nva_id` (`nva_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_nivelacesso`
--

INSERT INTO `acb_nivelacesso` (`nva_id`, `nva_status`, `nva_nome`, `nva_dtcad`, `nva_dtalter`, `nva_usuario`) VALUES
(1, 1, 'Administrador', '2020-08-03 10:14:27', '2020-08-03 10:14:27', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_page`
--

DROP TABLE IF EXISTS `acb_page`;
CREATE TABLE IF NOT EXISTS `acb_page` (
  `pge_id` int(11) NOT NULL AUTO_INCREMENT,
  `pge_status` int(11) NOT NULL,
  `pge_urlnome` varchar(20) NOT NULL,
  `pge_diretorio` varchar(20) NOT NULL,
  `pge_controlelogin` int(11) NOT NULL,
  `pge_favicon` varchar(50) DEFAULT NULL,
  `pge_description` varchar(255) DEFAULT NULL,
  `pge_title` varchar(50) DEFAULT NULL,
  `pge_keywords` varchar(255) DEFAULT NULL,
  `pge_framework` int(11) DEFAULT NULL,
  `pge_tema` varchar(50) DEFAULT NULL,
  `pge_menu` varchar(50) DEFAULT NULL,
  `pge_rodape` varchar(50) DEFAULT NULL,
  `pge_idpwa` int(11) DEFAULT NULL,
  `pge_dtcreated` datetime NOT NULL,
  `pge_dtalter` datetime NOT NULL,
  `pge_usualter` int(11) DEFAULT NULL,
  PRIMARY KEY (`pge_id`),
  UNIQUE KEY `pge_id` (`pge_id`),
  KEY `fk_acb_page_acb_pwainfo` (`pge_idpwa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_page`
--

INSERT INTO `acb_page` (`pge_id`, `pge_status`, `pge_urlnome`, `pge_diretorio`, `pge_controlelogin`, `pge_favicon`, `pge_description`, `pge_title`, `pge_keywords`, `pge_framework`, `pge_tema`, `pge_menu`, `pge_rodape`, `pge_idpwa`, `pge_dtcreated`, `pge_dtalter`, `pge_usualter`) VALUES
(1, 1, 'inicio', 'site', 0, NULL, 'Página inicial', 'Página inicial', 'Página; inicial;', 1, 'acaicomtema.php', 'menuprincipal.php', 'rodapeprincipal.php', NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
(2, 1, 'login', 'site', 0, NULL, 'Página de login', 'Página de login', 'página;login;', 1, 'acaicomtema.php', NULL, NULL, NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
(3, 1, 'erro', 'site', 0, NULL, 'Página de erro', 'Página de erro', 'Página;erro;', 1, NULL, NULL, NULL, NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
(4, 1, 'admin', 'sistema', 1, NULL, NULL, NULL, NULL, 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-08-19 00:00:00', '2020-08-19 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_pwainfo`
--

DROP TABLE IF EXISTS `acb_pwainfo`;
CREATE TABLE IF NOT EXISTS `acb_pwainfo` (
  `pwa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pwa_status` int(11) NOT NULL,
  `pwa_background_color` varchar(50) NOT NULL,
  `pwa_description` varchar(255) NOT NULL,
  `pwa_dir` varchar(50) NOT NULL,
  `pwa_display` varchar(50) NOT NULL,
  `pwa_lang` varchar(50) DEFAULT NULL,
  `pwa_name` varchar(100) NOT NULL,
  `pwa_orientation` varchar(50) NOT NULL,
  `pwa_scope` varchar(50) NOT NULL,
  `pwa_short_name` varchar(50) NOT NULL,
  `pwa_start_url` varchar(50) NOT NULL,
  `pwa_theme_color` varchar(50) NOT NULL,
  `pwa_url` varchar(100) NOT NULL,
  `pwa_categories` text,
  `pwa_iarc_rating_id` text,
  `pwa_related_applications` text,
  `pwa_prefer_related_applications` text,
  `pwa_shortcuts` mediumtext,
  `pwa_icons` mediumtext NOT NULL,
  `pwa_screenshots` mediumtext,
  `pwa_serviceworker` text,
  `pwa_offline_enabled` varchar(50) DEFAULT NULL,
  `pwa_version` float NOT NULL,
  `pwa_version_name` varchar(50) NOT NULL,
  `pwa_manifest_version` float DEFAULT NULL,
  `pwa_dtcreated` datetime NOT NULL,
  `pwa_dtalter` datetime NOT NULL,
  `pwa_usualter` datetime DEFAULT NULL,
  PRIMARY KEY (`pwa_id`),
  UNIQUE KEY `pwa_id` (`pwa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_pwainfo`
--

INSERT INTO `acb_pwainfo` (`pwa_id`, `pwa_status`, `pwa_background_color`, `pwa_description`, `pwa_dir`, `pwa_display`, `pwa_lang`, `pwa_name`, `pwa_orientation`, `pwa_scope`, `pwa_short_name`, `pwa_start_url`, `pwa_theme_color`, `pwa_url`, `pwa_categories`, `pwa_iarc_rating_id`, `pwa_related_applications`, `pwa_prefer_related_applications`, `pwa_shortcuts`, `pwa_icons`, `pwa_screenshots`, `pwa_serviceworker`, `pwa_offline_enabled`, `pwa_version`, `pwa_version_name`, `pwa_manifest_version`, `pwa_dtcreated`, `pwa_dtalter`, `pwa_usualter`) VALUES
(1, 1, 'blue', 'Descrição do pwa', 'ltr', 'fullscreen', 'pt-br', 'PWA Modelo', 'landscape', '/', 'PWA', '/', 'red', '/', NULL, NULL, NULL, NULL, NULL, 'NADA AINDA', NULL, NULL, NULL, 1, 'beta', 1, '2020-07-31 00:00:00', '2020-07-31 00:00:00', '2020-07-31 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_usuario`
--

DROP TABLE IF EXISTS `acb_usuario`;
CREATE TABLE IF NOT EXISTS `acb_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_dtcad` datetime NOT NULL,
  `usu_status` int(11) NOT NULL,
  `usu_idnivelacesso` int(11) NOT NULL,
  `usu_nome` varchar(100) DEFAULT NULL,
  `usu_email` varchar(50) NOT NULL,
  `usu_username` varchar(20) DEFAULT NULL,
  `usu_senha` varchar(255) DEFAULT NULL,
  `usu_codigo` varchar(20) DEFAULT NULL,
  `usu_perfil` varchar(50) DEFAULT NULL,
  `usu_ultimoacesso` datetime DEFAULT NULL,
  `usu_dtalter` datetime DEFAULT NULL,
  `usu_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_id` (`usu_id`),
  UNIQUE KEY `usu_email` (`usu_email`),
  UNIQUE KEY `usu_username` (`usu_username`),
  KEY `fk_acb_usuario_acb_nivelacesso1` (`usu_idnivelacesso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_usuario`
--

INSERT INTO `acb_usuario` (`usu_id`, `usu_dtcad`, `usu_status`, `usu_idnivelacesso`, `usu_nome`, `usu_email`, `usu_username`, `usu_senha`, `usu_codigo`, `usu_perfil`, `usu_ultimoacesso`, `usu_dtalter`, `usu_usuario`) VALUES
(1, '2020-08-03 10:14:27', 1, 1, 'Adm ACB', 'adm@acb.com', 'admin', 'acb123', NULL, '', '2020-08-27 12:14:42', '2020-08-03 10:14:27', 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acb_page`
--
ALTER TABLE `acb_page`
  ADD CONSTRAINT `fk_acb_page_acb_pwainfo` FOREIGN KEY (`pge_idpwa`) REFERENCES `acb_pwainfo` (`pwa_id`);

--
-- Limitadores para a tabela `acb_usuario`
--
ALTER TABLE `acb_usuario`
  ADD CONSTRAINT `fk_acb_usuario_acb_nivelacesso1` FOREIGN KEY (`usu_idnivelacesso`) REFERENCES `acb_nivelacesso` (`nva_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
