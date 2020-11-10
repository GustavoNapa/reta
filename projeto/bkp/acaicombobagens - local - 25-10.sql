-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25-Out-2020 às 14:35
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
  `end_estado` varchar(10) DEFAULT NULL,
  `end_pais` varchar(50) DEFAULT NULL,
  `end_googlemaps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `end_referencia` varchar(100) DEFAULT NULL,
  `end_dtcad` datetime DEFAULT NULL,
  `end_dtalter` datetime DEFAULT NULL,
  `end_usualter` int(11) DEFAULT NULL,
  PRIMARY KEY (`end_id`),
  UNIQUE KEY `end_id` (`end_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_endereco`
--

INSERT INTO `acb_endereco` (`end_id`, `end_cep`, `end_logradouro`, `end_numero`, `end_complemento`, `end_bairro`, `end_cidade`, `end_estado`, `end_pais`, `end_googlemaps`, `end_referencia`, `end_dtcad`, `end_dtalter`, `end_usualter`) VALUES
(3, '32110-110', 'Rua Ipaussu', 99, 'adsadasdsadsd sad sadasd', 'Jardim Pérola', 'Contagem', 'MG', 'BRASIL', '', NULL, '2020-09-02 22:38:20', '2020-09-02 22:38:20', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_estadocivil`
--

DROP TABLE IF EXISTS `acb_estadocivil`;
CREATE TABLE IF NOT EXISTS `acb_estadocivil` (
  `ecv_id` int(11) NOT NULL AUTO_INCREMENT,
  `ecv_status` int(11) NOT NULL,
  `ecv_nome` varchar(50) NOT NULL,
  `ecv_dtcad` datetime NOT NULL,
  `ecv_dtalter` datetime NOT NULL,
  `ecv_usualter` int(11) NOT NULL,
  PRIMARY KEY (`ecv_id`),
  UNIQUE KEY `ecv_id` (`ecv_id`),
  UNIQUE KEY `ecv_nome` (`ecv_nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_estadocivil`
--

INSERT INTO `acb_estadocivil` (`ecv_id`, `ecv_status`, `ecv_nome`, `ecv_dtcad`, `ecv_dtalter`, `ecv_usualter`) VALUES
(1, 1, 'CASADO', '2020-08-31 00:00:00', '2020-09-03 17:48:58', 2),
(2, 1, 'SOLTEIRO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1),
(3, 0, 'VIUVO(A)', '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_loja`
--

DROP TABLE IF EXISTS `acb_loja`;
CREATE TABLE IF NOT EXISTS `acb_loja` (
  `loj_id` int(11) NOT NULL AUTO_INCREMENT,
  `loj_status` int(11) NOT NULL,
  `loj_disponibilidade` int(11) NOT NULL,
  `loj_cnpj` varchar(20) NOT NULL,
  `loj_razaosocial` varchar(100) NOT NULL,
  `loj_nomefantasia` varchar(100) DEFAULT NULL,
  `loj_im` varchar(50) DEFAULT NULL,
  `loj_ie` varchar(50) DEFAULT NULL,
  `loj_telefone` varchar(20) DEFAULT NULL,
  `loj_celular` varchar(20) DEFAULT NULL,
  `loj_whatsapp` int(11) DEFAULT NULL,
  `loj_email` varchar(100) DEFAULT NULL,
  `loj_idendereco` int(11) DEFAULT NULL,
  `loj_ambiente1` varchar(100) DEFAULT NULL,
  `loj_ambiente2` varchar(100) DEFAULT NULL,
  `loj_ambiente3` varchar(100) DEFAULT NULL,
  `loj_ambiente4` varchar(100) DEFAULT NULL,
  `loj_descricao` mediumtext,
  `loj_dtcad` datetime NOT NULL,
  `loj_dtalter` datetime NOT NULL,
  `loj_usualter` int(11) NOT NULL,
  PRIMARY KEY (`loj_id`),
  UNIQUE KEY `loj_id` (`loj_id`),
  UNIQUE KEY `loj_cnpj` (`loj_cnpj`),
  UNIQUE KEY `loj_razaosocial` (`loj_razaosocial`),
  KEY `fk_acb_loja_acb_endereco1` (`loj_idendereco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_page`
--

INSERT INTO `acb_page` (`pge_id`, `pge_status`, `pge_urlnome`, `pge_diretorio`, `pge_controlelogin`, `pge_favicon`, `pge_description`, `pge_title`, `pge_keywords`, `pge_framework`, `pge_tema`, `pge_menu`, `pge_rodape`, `pge_idpwa`, `pge_dtcreated`, `pge_dtalter`, `pge_usualter`) VALUES
(1, 1, 'inicio', 'site', 0, 'favicon.ico', 'Açaí com Bobagens: Cremoso, gostoso, o melhor! Compre agora! Açai, Cupuaçu, Sorvete, picolés e muito mais. Lojas no Vale do Jatobá Região do Barreiro, no bairro Havaí em Belo Horizonte e também em Ibirité. Vendas para atacado e varejo!', 'Açaí com Bobagens - (31) 3032-7001', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'acaicomtema.php', 'menuprincipal.php', 'rodapeprincipal.php', NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
(2, 1, 'login', 'site', 0, 'favicon.ico', 'Página de login', 'Açaí com Bobagens - Login', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'acaicomtema.php', NULL, NULL, NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
(3, 1, 'erro', 'site', 0, 'favicon.ico', 'Página de erro', 'Página de erro', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, NULL, NULL, NULL, NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
(4, 1, 'admin', 'sistema', 1, 'favicon.ico', 'Página inicial do sistema', 'Açaí com Bobagens - Sistema de Gestão', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-08-19 00:00:00', '2020-08-19 00:00:00', NULL),
(5, 1, 'usuario', 'sistema', 1, 'favicon.ico', 'ACB - Cadastro de usuário', 'Açaí com Bobagens - Cadastro de usuário', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-09-01 00:00:00', '2020-09-01 00:00:00', NULL),
(6, 1, 'creampurple', 'site', 0, 'logo_cp100x100.png', 'Cream Purple, fabrica de açai', 'Cream Purple - (31) 9 9532-6524', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'acaicomtema.php', 'menuprincipal.php', 'rodapeprincipal.php', NULL, '2020-09-01 00:00:00', '2020-09-01 00:00:00', NULL),
(7, 1, 'cadastrobasico', 'sistema', 1, 'favicon.ico', 'Cadastro básico do sistema', 'Açaí com Bobagens - Cadastro básico', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-09-02 00:00:00', '2020-09-02 00:00:00', NULL),
(8, 1, 'loja', 'sistema', 1, 'favicon.ico', 'Cadastro de loja ACB', 'Açaí com Bobagens - Cadastro de Loja', 'Açaí;Bobagens;Cremoso;gostoso;melhor;Compre;agora;Cupuaçu;Sorvete;picolés;Lojas;Vale do Jatobá;Barreiro;Havaí;Belo Horizonte;Ibirité;Vendas;atacado;varejo;', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php\r\n', NULL, '2020-10-14 00:00:00', '2020-10-14 00:00:00', 1);

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
-- Estrutura da tabela `acb_setor`
--

DROP TABLE IF EXISTS `acb_setor`;
CREATE TABLE IF NOT EXISTS `acb_setor` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT,
  `set_status` int(11) NOT NULL,
  `set_nome` varchar(50) NOT NULL,
  `set_comissao` int(11) NOT NULL,
  `set_valor` float DEFAULT NULL,
  `set_percentual` int(11) DEFAULT NULL,
  `set_dtcad` datetime NOT NULL,
  `set_dtalter` datetime NOT NULL,
  `set_usualter` int(11) NOT NULL,
  PRIMARY KEY (`set_id`),
  UNIQUE KEY `set_id` (`set_id`),
  UNIQUE KEY `set_nome` (`set_nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_setor`
--

INSERT INTO `acb_setor` (`set_id`, `set_status`, `set_nome`, `set_comissao`, `set_valor`, `set_percentual`, `set_dtcad`, `set_dtalter`, `set_usualter`) VALUES
(1, 1, 'Vendas', 0, NULL, NULL, '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1),
(2, 1, 'Gerente de loja', 0, NULL, NULL, '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1),
(3, 0, 'Administrativo', 0, NULL, NULL, '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_sexo`
--

DROP TABLE IF EXISTS `acb_sexo`;
CREATE TABLE IF NOT EXISTS `acb_sexo` (
  `sex_id` int(11) NOT NULL AUTO_INCREMENT,
  `sex_status` int(11) NOT NULL,
  `sex_nome` varchar(50) NOT NULL,
  `sex_dtcad` datetime NOT NULL,
  `sex_dtalter` datetime NOT NULL,
  `sex_usualter` int(11) NOT NULL,
  PRIMARY KEY (`sex_id`),
  UNIQUE KEY `sex_id` (`sex_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_sexo`
--

INSERT INTO `acb_sexo` (`sex_id`, `sex_status`, `sex_nome`, `sex_dtcad`, `sex_dtalter`, `sex_usualter`) VALUES
(1, 1, 'FEMININO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1),
(2, 1, 'MASCULINO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1),
(3, 1, 'OUTRO(A)', '2020-08-31 00:00:00', '2020-09-03 17:49:13', 2),
(4, 1, 'INDEFINIDO', '2020-09-03 17:49:38', '2020-09-03 17:49:38', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acb_usuario`
--

DROP TABLE IF EXISTS `acb_usuario`;
CREATE TABLE IF NOT EXISTS `acb_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_status` int(11) NOT NULL,
  `usu_idnivelacesso` int(11) DEFAULT NULL,
  `usu_cpf` varchar(50) DEFAULT NULL,
  `usu_nome` varchar(100) NOT NULL,
  `usu_dtnasc` date NOT NULL,
  `usu_email` varchar(50) NOT NULL,
  `usu_emailacb` varchar(50) DEFAULT NULL,
  `usu_cargo` varchar(50) DEFAULT NULL,
  `usu_corporativo` varchar(20) DEFAULT NULL,
  `usu_telefone` varchar(20) DEFAULT NULL,
  `usu_celular` varchar(20) DEFAULT NULL,
  `usu_whatsapp` int(11) NOT NULL,
  `usu_idsexo` int(11) NOT NULL,
  `usu_idestadocivil` int(11) NOT NULL,
  `usu_idsetor` int(11) NOT NULL,
  `usu_remuneracao` float DEFAULT NULL,
  `usu_idendereco` int(11) DEFAULT NULL,
  `usu_username` varchar(20) DEFAULT NULL,
  `usu_senha` varchar(255) DEFAULT NULL,
  `usu_codigo` varchar(20) DEFAULT NULL,
  `usu_perfil` varchar(50) DEFAULT NULL,
  `usu_ultimoacesso` datetime DEFAULT NULL,
  `usu_dtcad` datetime NOT NULL,
  `usu_dtalter` datetime NOT NULL,
  `usu_usualter` int(11) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_id` (`usu_id`),
  UNIQUE KEY `usu_email` (`usu_email`),
  UNIQUE KEY `usu_cpf` (`usu_cpf`),
  UNIQUE KEY `usu_idendereco` (`usu_idendereco`),
  UNIQUE KEY `usu_username` (`usu_username`),
  KEY `fk_hsa_usuario_hsa_nivelacesso1` (`usu_idnivelacesso`),
  KEY `fk_acb_usuario_acb_sexo1` (`usu_idsexo`),
  KEY `fk_acb_usuario_acb_estadocivil1` (`usu_idestadocivil`),
  KEY `fk_acb_usuario_acb_setor1` (`usu_idsetor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acb_usuario`
--

INSERT INTO `acb_usuario` (`usu_id`, `usu_status`, `usu_idnivelacesso`, `usu_cpf`, `usu_nome`, `usu_dtnasc`, `usu_email`, `usu_emailacb`, `usu_cargo`, `usu_corporativo`, `usu_telefone`, `usu_celular`, `usu_whatsapp`, `usu_idsexo`, `usu_idestadocivil`, `usu_idsetor`, `usu_remuneracao`, `usu_idendereco`, `usu_username`, `usu_senha`, `usu_codigo`, `usu_perfil`, `usu_ultimoacesso`, `usu_dtcad`, `usu_dtalter`, `usu_usualter`) VALUES
(2, 1, 1, '110.245.656-02', 'ADM ACB', '1992-12-27', 'pedro.hsa92@gmail.com', 'adm@acb.com', 'Suporte', '(31) 9 9999-6524', '(31)  3333-3333', '(31) 9 7342-3128', 1, 2, 2, 1, 2000, NULL, 'admin', 'acb123', NULL, NULL, '2020-10-25 10:28:09', '2020-08-31 00:00:00', '2020-08-31 00:00:00', 1),
(9, 1, 1, '874.772.620-20', 'Adm Cream Purple', '1992-12-27', 'pedro.hsa92@hsa.com', 'acb@spacezoom.com', 'Analista de sistema', '(31) 99999999', '(31) 3333-3333', '(31) 9 7342-3128', 1, 2, 2, 1, 2000, 3, 'phsa', '123123', NULL, NULL, NULL, '2020-09-02 22:38:20', '2020-09-02 22:38:20', 2);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acb_loja`
--
ALTER TABLE `acb_loja`
  ADD CONSTRAINT `fk_acb_loja_acb_endereco1` FOREIGN KEY (`loj_idendereco`) REFERENCES `acb_endereco` (`end_id`);

--
-- Limitadores para a tabela `acb_page`
--
ALTER TABLE `acb_page`
  ADD CONSTRAINT `fk_acb_page_acb_pwainfo` FOREIGN KEY (`pge_idpwa`) REFERENCES `acb_pwainfo` (`pwa_id`);

--
-- Limitadores para a tabela `acb_usuario`
--
ALTER TABLE `acb_usuario`
  ADD CONSTRAINT `fk_acb_usuario_acb_estadocivil1` FOREIGN KEY (`usu_idestadocivil`) REFERENCES `acb_estadocivil` (`ecv_id`),
  ADD CONSTRAINT `fk_acb_usuario_acb_setor1` FOREIGN KEY (`usu_idsetor`) REFERENCES `acb_setor` (`set_id`),
  ADD CONSTRAINT `fk_acb_usuario_acb_sexo1` FOREIGN KEY (`usu_idsexo`) REFERENCES `acb_sexo` (`sex_id`),
  ADD CONSTRAINT `fk_acb_usuario_fd_endereco1` FOREIGN KEY (`usu_idendereco`) REFERENCES `acb_endereco` (`end_id`),
  ADD CONSTRAINT `fk_hsa_usuario_hsa_nivelacesso1` FOREIGN KEY (`usu_idnivelacesso`) REFERENCES `acb_nivelacesso` (`nva_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
