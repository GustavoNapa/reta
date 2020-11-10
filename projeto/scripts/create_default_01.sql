


# CREATE DATABASE acaicombobagens;
# USE acaicombobagens;

# Básico - GERAL
  -- -----------------------------------------------------
  -- Table `acb_categoria`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_categoria` ;

    CREATE TABLE IF NOT EXISTS `acb_categoria` (
      `ctg_id` INT UNIQUE AUTO_INCREMENT,
      `ctg_status` INT NOT NULL,
      `ctg_nome` VARCHAR(50) UNIQUE NOT NULL,
      `ctg_dtcad` DATETIME NOT NULL,
      `ctg_dtalter` DATETIME NOT NULL,
      `ctg_usualter` INT NOT NULL,
      PRIMARY KEY (`ctg_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_sexo`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_sexo` ;

    CREATE TABLE IF NOT EXISTS `acb_sexo` (
      `sex_id` INT UNIQUE AUTO_INCREMENT,
      `sex_status` INT NOT NULL,
      `sex_nome` VARCHAR(50) UNIQUE NOT NULL,
      `sex_dtcad` DATETIME NOT NULL,
      `sex_dtalter` DATETIME NOT NULL,
      `sex_usualter` INT NOT NULL,
      PRIMARY KEY (`sex_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_estadocivil`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_estadocivil` ;

    CREATE TABLE IF NOT EXISTS `acb_estadocivil` (
      `ecv_id` INT UNIQUE AUTO_INCREMENT,
      `ecv_status` INT NOT NULL,
      `ecv_nome` VARCHAR(50) UNIQUE NOT NULL,
      `ecv_dtcad` DATETIME NOT NULL,
      `ecv_dtalter` DATETIME NOT NULL,
      `ecv_usualter` INT NOT NULL,
      PRIMARY KEY (`ecv_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_setor`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_setor` ;

    CREATE TABLE IF NOT EXISTS `acb_setor` (
      `set_id` INT UNIQUE AUTO_INCREMENT,
      `set_status` INT NOT NULL,
      `set_nome` VARCHAR(50) UNIQUE NOT NULL,
      `set_comissao` INT NOT NULL, # 0 não, 1 sim(valor), 2 sim(porcentagem)
      `set_valor` FLOAT NULL, # valor da comissão
      `set_percentual` INT NULL, # percentual da comissão
      `set_dtcad` DATETIME NOT NULL,
      `set_dtalter` DATETIME NOT NULL,
      `set_usualter` INT NOT NULL,
      PRIMARY KEY (`set_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_estado`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_unidadedemedida` ;

    CREATE TABLE IF NOT EXISTS `acb_unidadedemedida` (
      `umd_id` INT UNIQUE AUTO_INCREMENT,
      `umd_status` INT NOT NULL,
      `umd_nome` VARCHAR(50) UNIQUE NOT NULL,
      `umd_abreviacao` VARCHAR(45) NOT NULL,
      `umd_dtcad` DATETIME NOT NULL,
      `umd_dtalter` DATETIME NOT NULL,
      `umd_usualter` INT NOT NULL,
      PRIMARY KEY (`umd_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_estado`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_estado` ;

    CREATE TABLE IF NOT EXISTS `acb_estado` (
      `est_id` INT UNIQUE AUTO_INCREMENT,
      `est_status` INT NOT NULL,
      `est_uf` VARCHAR(2) UNIQUE NOT NULL,
      `est_nome` VARCHAR(50) UNIQUE NOT NULL,
      `est_dtcad` DATETIME NOT NULL,
      `est_dtalter` DATETIME NOT NULL,
      `est_usualter` INT NOT NULL,
      PRIMARY KEY (`est_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_cidade`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_cidade` ;

    CREATE TABLE IF NOT EXISTS `acb_cidade` (
      `cid_id` INT UNIQUE AUTO_INCREMENT,
      `cid_idestado` INT NOT NULL,
      `cid_status` INT NOT NULL,
      `cid_nome` VARCHAR(50) NOT NULL,
      `cid_dtcad` DATETIME NOT NULL,
      `cid_dtalter` DATETIME NOT NULL,
      `cid_usualter` INT NOT NULL,
      PRIMARY KEY (`cid_id`),
      CONSTRAINT `fk_acb_cidade_acb_estado1`
        FOREIGN KEY (`cid_idestado`)
        REFERENCES `acb_estado` (`est_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_bairro`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_bairro` ;

    CREATE TABLE IF NOT EXISTS `acb_bairro` (
      `bai_id` INT UNIQUE AUTO_INCREMENT,
      `bai_idcidade` INT NOT NULL,
      `bai_status` INT NOT NULL,
      `bai_nome` VARCHAR(50) NOT NULL,
      `bai_dtcad` DATETIME NOT NULL,
      `bai_dtalter` DATETIME NOT NULL,
      `bai_usualter` INT NOT NULL,
      PRIMARY KEY (`bai_id`),
      CONSTRAINT `fk_acb_bairro_acb_cidade1`
        FOREIGN KEY (`bai_idcidade`)
        REFERENCES `acb_cidade` (`cid_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;

# Estrutural
  -- -----------------------------------------------------
  -- Table `fd_pwainfo`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_pwainfo` ;

    CREATE TABLE IF NOT EXISTS `acb_pwainfo` (
      `pwa_id` INT UNIQUE AUTO_INCREMENT,
      `pwa_status` INT NOT NULL,
      `pwa_background_color` VARCHAR(50) NOT NULL,
      `pwa_description` VARCHAR(255) NOT NULL,
      `pwa_dir` VARCHAR(50) NOT NULL,
      `pwa_display` VARCHAR(50) NOT NULL,
      `pwa_lang` VARCHAR(50) NULL,
      `pwa_name` VARCHAR(100) NOT NULL,
      `pwa_orientation` VARCHAR(50) NOT NULL,
      `pwa_scope` VARCHAR(50) NOT NULL,
      `pwa_short_name` VARCHAR(50) NOT NULL,
      `pwa_start_url` VARCHAR(50) NOT NULL,
      `pwa_theme_color` VARCHAR(50) NOT NULL,
      `pwa_url` VARCHAR(100) NOT NULL,
      `pwa_categories` TEXT NULL,
      `pwa_iarc_rating_id` TEXT NULL,
      `pwa_related_applications` TEXT NULL,
      `pwa_prefer_related_applications` TEXT NULL,
      `pwa_shortcuts` MEDIUMTEXT NULL,
      `pwa_icons` MEDIUMTEXT NOT NULL,
      `pwa_screenshots` MEDIUMTEXT NULL,
      `pwa_serviceworker` TEXT NULL,
      `pwa_offline_enabled` VARCHAR(50) NULL,
      `pwa_version` FLOAT NOT NULL,
      `pwa_version_name` VARCHAR(50) NOT NULL,
      `pwa_manifest_version` FLOAT NULL,
      `pwa_dtcreated` DATETIME NOT NULL,
      `pwa_dtalter` DATETIME NOT NULL,
      `pwa_usualter` DATETIME NULL,
      PRIMARY KEY (`pwa_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_page`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_page` ;

    CREATE TABLE IF NOT EXISTS `acb_page` (
      `pge_id` INT UNIQUE AUTO_INCREMENT,
      `pge_status` INT NOT NULL,
      `pge_urlnome` VARCHAR(20) NOT NULL,
      `pge_diretorio` VARCHAR(20) NOT NULL,
      `pge_controlelogin` INT NOT NULL,
      `pge_favicon` VARCHAR(50) NULL,
      `pge_description` VARCHAR(255) NULL,
      `pge_title` VARCHAR(50) NULL,
      `pge_keywords` VARCHAR(255) NULL,
      `pge_framework` INT NULL,
      `pge_tema` VARCHAR(50) NULL,
      `pge_menu` VARCHAR(50) NULL,
      `pge_rodape` VARCHAR(50) NULL,
      `pge_idpwa` INT NULL,
      `pge_dtcreated` DATETIME NOT NULL,
      `pge_dtalter` DATETIME NOT NULL,
      `pge_usualter` INT NULL,
      PRIMARY KEY (`pge_id`),
      CONSTRAINT `fk_acb_page_acb_pwainfo`
        FOREIGN KEY (`pge_idpwa`)
        REFERENCES `acb_pwainfo` (`pwa_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;

# Sistema
  -- -----------------------------------------------------
  -- Table `acb_nivelacesso`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_nivelacesso` ;

    CREATE TABLE IF NOT EXISTS `acb_nivelacesso` (
      `nva_id` INT UNIQUE AUTO_INCREMENT,
      `nva_status` INT NOT NULL,
      `nva_nome` VARCHAR(50) UNIQUE NOT NULL,
      `nva_gerenciarbasico` INT NOT NULL,
      `nva_gerenciarconfiguracao` INT NOT NULL,
      `nva_gerenciarcliente` INT NOT NULL,
      `nva_gerenciarproduto` INT NOT NULL,
      `nva_gerenciarusuario` INT NOT NULL,
      `nva_gerenciarloja` INT NOT NULL,
      `nva_dtcad` DATETIME NOT NULL,
      `nva_dtalter` DATETIME NOT NULL,
      `nva_usualter` INT NOT NULL,
      PRIMARY KEY (`nva_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_endereco`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_endereco` ;

    CREATE TABLE IF NOT EXISTS `acb_endereco` (
      `end_id` INT UNIQUE AUTO_INCREMENT,
      `end_cep` VARCHAR(10) NOT NULL,
      `end_logradouro` VARCHAR(100) NULL,
      `end_numero` INT NULL,
      `end_complemento` VARCHAR(50) NULL,
      `end_bairro` VARCHAR(50) NULL,
      `end_cidade` VARCHAR(50) NULL,
      `end_estado` VARCHAR(10) NULL,
      `end_pais` VARCHAR(50) NULL,
      `end_referencia` VARCHAR(100) NULL,
      `end_googlemaps` VARCHAR(255) NULL,
      `end_dtcad` DATETIME NULL,
      `end_dtalter` DATETIME NULL,
      `end_usualter` INT NULL,
      PRIMARY KEY (`end_id`))
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_usuario`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_usuario` ;

    CREATE TABLE IF NOT EXISTS `acb_usuario` (
      `usu_id` INT UNIQUE AUTO_INCREMENT,
      `usu_status` INT NOT NULL,
      `usu_idnivelacesso` INT NOT NULL,
      `usu_cpf` VARCHAR(50) UNIQUE NULL,
      `usu_nome` VARCHAR(100) NOT NULL,
      `usu_dtnasc` DATE NOT NULL,
      `usu_email` VARCHAR(50) UNIQUE NOT NULL,
      `usu_emailacb` VARCHAR(50) NULL,
      `usu_cargo` VARCHAR(50) NULL,
      `usu_corporativo` VARCHAR(20) NULL,
      `usu_telefone` VARCHAR(20) NULL,
      `usu_celular` VARCHAR(20) NULL,
      `usu_whatsapp` INT NOT NULL,
      `usu_idsexo` INT NOT NULL,
      `usu_idestadocivil` INT NOT NULL,
      `usu_idsetor` INT NOT NULL,
      `usu_remuneracao` FLOAT NULL,
      `usu_idendereco` INT UNIQUE NULL,
      `usu_username` VARCHAR(20) UNIQUE NULL,
      `usu_senha` VARCHAR(255) NULL,
      `usu_codigo` VARCHAR(20) NULL,
      `usu_perfil` VARCHAR(50) NULL,
      `usu_ultimoacesso` DATETIME NULL,
      `usu_dtcad` DATETIME NOT NULL,
      `usu_dtalter` DATETIME NOT NULL,
      `usu_usualter` INT NULL,
      PRIMARY KEY (`usu_id`),
      CONSTRAINT `fk_hsa_usuario_hsa_nivelacesso1`
        FOREIGN KEY (`usu_idnivelacesso`)
        REFERENCES `acb_nivelacesso` (`nva_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_acb_usuario_acb_sexo1`
        FOREIGN KEY (`usu_idsexo`)
        REFERENCES `acb_sexo` (`sex_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_acb_usuario_acb_estadocivil1`
        FOREIGN KEY (`usu_idestadocivil`)
        REFERENCES `acb_estadocivil` (`ecv_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_acb_usuario_acb_setor1`
        FOREIGN KEY (`usu_idsetor`)
        REFERENCES `acb_setor` (`set_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_acb_usuario_fd_endereco1`
        FOREIGN KEY (`usu_idendereco`)
        REFERENCES `acb_endereco` (`end_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_loja`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_loja` ;

    CREATE TABLE IF NOT EXISTS `acb_loja` (
      `loj_id` INT UNIQUE AUTO_INCREMENT,
      `loj_status` INT NOT NULL,
      `loj_disponibilidade` INT NULL,
      `loj_cnpj` VARCHAR(20) UNIQUE NOT NULL,
      `loj_razaosocial` VARCHAR(100) UNIQUE NOT NULL,
      `loj_nomefantasia` VARCHAR(100) NULL,
      `loj_im` VARCHAR(50) NULL,
      `loj_ie` VARCHAR(50) NULL,
      `loj_email` VARCHAR(100) NULL,
      `loj_telefone` VARCHAR(20) NULL,
      `loj_celular` VARCHAR(20) NULL,
      `loj_whatsapp` INT NULL,
      `loj_idendereco` INT NULL,
      `loj_ambiente1` VARCHAR(100) NULL,
      `loj_ambiente2` VARCHAR(100) NULL,
      `loj_ambiente3` VARCHAR(100) NULL,
      `loj_ambiente4` VARCHAR(100) NULL,
      `loj_descricao` MEDIUMTEXT NULL,
      `loj_dtcad` DATETIME NOT NULL,
      `loj_dtalter` DATETIME NOT NULL,
      `loj_usualter` INT NOT NULL,
      PRIMARY KEY (`loj_id`),
      CONSTRAINT `fk_acb_loja_acb_endereco1`
        FOREIGN KEY (`loj_idendereco`)
        REFERENCES `acb_endereco` (`end_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `acb_regiao`
  -- -----------------------------------------------------
    DROP TABLE IF EXISTS `acb_regiao` ;

    CREATE TABLE IF NOT EXISTS `acb_regiao` (
      `reg_id` INT UNIQUE AUTO_INCREMENT,
      `reg_idloja` INT NOT NULL,
      `reg_idbairro` INT NOT NULL,
      `reg_status` INT NOT NULL,
      `reg_valordelivery` FLOAT NOT NULL,
      `reg_dtcad` DATETIME NOT NULL,
      `reg_dtalter` DATETIME NOT NULL,
      `reg_usualter` INT NOT NULL,
      PRIMARY KEY (`reg_id`),
      CONSTRAINT `fk_acb_regiao_acb_bairro1`
        FOREIGN KEY (`reg_idbairro`)
        REFERENCES `acb_bairro` (`bai_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_acb_regiao_acb_loja1`
        FOREIGN KEY (`reg_idloja`)
        REFERENCES `acb_loja` (`loj_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;