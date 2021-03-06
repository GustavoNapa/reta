

# DADOS SISTEMA
INSERT INTO `rtv_page` (`pge_id`, `pge_status`, `pge_urlnome`, `pge_diretorio`, `pge_controlelogin`, `pge_favicon`, `pge_description`, `pge_title`, `pge_keywords`, `pge_framework`, `pge_tema`, `pge_menu`, `pge_rodape`, `pge_idpwa`, `pge_dtcreated`, `pge_dtalter`, `pge_usualter`) VALUES
	(1, 1, 'inicio', 'site', 0, 'favicon.ico', 'Reta Veiculos', 'Reta Veiculos', 'Veiculos', 1, 'acaicomtema.php', 'menuprincipal.php', 'rodapeprincipal.php', NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
	(2, 1, 'login', 'site', 0, 'favicon.ico', 'Página de login', 'Reta Veiculos', 'Veiculos', 1, 'acaicomtema.php', NULL, NULL, NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
	(3, 1, 'erro', 'site', 0, 'favicon.ico', 'Página de erro', 'Página de erro', 'Veiculos', 1, NULL, NULL, NULL, NULL, '2020-07-31 00:00:00', '2020-07-31 00:00:00', NULL),
	(4, 1, 'admin', 'sistema', 1, 'favicon.ico', 'Página inicial do sistema', 'Reta Veiculos- Sistema de Gestão', 'Veiculos', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-08-19 00:00:00', '2020-08-19 00:00:00', NULL),
	(5, 1, 'usuario', 'sistema', 1, 'favicon.ico', 'RTV - Cadastro de usuário', 'Reta Veiculos- Cadastro de usuário', 'Veiculos', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-09-01 00:00:00', '2020-09-01 00:00:00', NULL),
	(6, 1, 'cadastrobasico', 'sistema', 1, 'favicon.ico', 'Cadastro básico do sistema', 'Reta Veiculos- Cadastro básico', 'Veiculos', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php', NULL, '2020-09-02 00:00:00', '2020-09-02 00:00:00', NULL),
	(7, 1, 'loja', 'sistema', 1, 'favicon.ico', 'Cadastro de loja RTV', 'Reta Veiculos- Cadastro de Loja', 'Veiculos', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php\r\n', NULL, '2020-10-14 00:00:00', '2020-10-14 00:00:00', 1),
	(8, 1, 'configuracoes', 'sistema', 1, 'favicon.ico', 'Configurações RTV', 'Reta Veiculos- Configurações RTV', 'Veiculos', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php\r\n', NULL, '2020-10-14 00:00:00', '2020-10-14 00:00:00', 1),
	(9, 1, 'produto', 'sistema', 1, 'favicon.ico', 'Produtos RTV', 'Reta Veiculos- Produtos RTV', 'Veiculos', 1, 'dashboard_acb.php', 'sidebar.php', 'rodapeprincipal.php\r\n', NULL, '2020-10-14 00:00:00', '2020-10-14 00:00:00', 1);

INSERT INTO `rtv_pwainfo` (`pwa_id`, `pwa_status`, `pwa_background_color`, `pwa_description`, 
	`pwa_dir`, `pwa_display`, `pwa_lang`, `pwa_name`, `pwa_orientation`, `pwa_scope`, `pwa_short_name`, 
	`pwa_start_url`, `pwa_theme_color`, `pwa_url`, `pwa_categories`, `pwa_iarc_rating_id`, 
	`pwa_related_applications`, `pwa_prefer_related_applications`, `pwa_shortcuts`, `pwa_icons`, 
	`pwa_screenshots`, `pwa_serviceworker`, `pwa_offline_enabled`, `pwa_version`, `pwa_version_name`, 
	`pwa_manifest_version`, `pwa_dtcreated`, `pwa_dtalter`, `pwa_usualter`) 
VALUES 
	(NULL, '1', 'blue', 'Descrição do pwa', 'ltr', 'fullscreen', 'pt-br', 'PWA Modelo', 
		'landscape', '/', 'PWA', '/', 'red', '/', NULL, NULL, NULL, NULL, NULL, 
		'NADA AINDA', NULL, NULL, NULL, '1.0.0', 'beta', '1.0.0', 
		'2020-07-31 00:00:00', '2020-07-31 00:00:00', '2020-07-31 00:00:00');

INSERT INTO `rtv_nivelacesso` (`nva_id`, `nva_status`, `nva_nome`, `nva_gerenciarbasico`, 
	`nva_gerenciarconfiguracao`, `nva_gerenciarcliente`, `nva_gerenciarproduto`, 
	`nva_gerenciarusuario`, `nva_gerenciarloja`, `nva_dtcad`, `nva_dtalter`, `nva_usualter`) 
VALUES 
	('1', '1', 'Administrador', '1', '1', '1', '1', '1', '1', 
		'2020-10-25 00:00:00', '2020-10-25 00:00:00', '1');

# DADOS BÁSICOS
INSERT INTO `rtv_estadocivil` (`ecv_id`, `ecv_status`, `ecv_nome`, 
	`ecv_dtcad`, `ecv_dtalter`, `ecv_usualter`) 
VALUES 
	(NULL, '1', 'CASADO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(NULL, '1', 'SOLTEIRO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(NULL, '0', 'VIUVO(A)', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1');

INSERT INTO `rtv_sexo` (`sex_id`, `sex_status`, `sex_nome`, 
	`sex_dtcad`, `sex_dtalter`, `sex_usualter`) 
VALUES 
	(NULL, '1', 'FEMININO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(NULL, '1', 'MASCULINO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(NULL, '0', 'OUTRO(A)', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1');

INSERT INTO `rtv_setor` (`set_id`, `set_status`, `set_nome`, `set_comissao`, 
	`set_valor`, `set_percentual`, `set_dtcad`, `set_dtalter`, `set_usualter`) 
VALUES 
	(NULL, '1', 'Gerente de loja', '0', NULL, NULL, '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(NULL, '1', 'Vendas', '0', NULL, NULL, '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(NULL, '0', 'Administrativo', '0', NULL, NULL, '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1');

INSERT INTO `rtv_estado` (`est_id`, `est_status`, `est_uf`, `est_nome`, 
	`est_dtcad`, `est_dtalter`, `est_usualter`) 
VALUES 
	(1, '1', 'MG', 'MINAS GERAIS', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(2, '1', 'SP', 'SÃO PAULO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(3, '0', 'RJ', 'RIO DE JANEIRO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1');

INSERT INTO `rtv_cidade`(`cid_id`, `cid_idestado`, `cid_status`, `cid_nome`, 
	`cid_dtcad`, `cid_dtalter`, `cid_usualter`) 
VALUES 
	(1, 1, '1', 'BELO HORIZONTE', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(2, 1, '1', 'CONTAGEM', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(3, 1, '0', 'IBIRITÉ', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(4, 1, '0', 'BETIM', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1');

INSERT INTO `rtv_bairro`(`bai_id`, `bai_idcidade`, `bai_status`, `bai_nome`, 
	`bai_dtcad`, `bai_dtalter`, `bai_usualter`) 
VALUES 
	(1, 1, '1', 'BARREIRO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(2, 1, '1', 'VALE DO JATOBÁ', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(3, 1, '0', 'MINEIRÃO', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1'),
	(4, 1, '0', 'GUTIERREZ', '2020-08-31 00:00:00', '2020-08-31 00:00:00', '1');

# USUÁRIO ADMINISTRADOR
INSERT INTO `rtv_endereco` (`end_id`, `end_cep`, `end_logradouro`, `end_numero`, 
	`end_complemento`, `end_bairro`, `end_cidade`, `end_estado`, `end_pais`, 
	`end_referencia`, `end_googlemaps`, `end_dtcad`, `end_dtalter`, `end_usualter`) 
VALUES 
	('1', '32265-330', 'Rua apá', '26', 'B', 'Jardim Vera Cruz', 'Contagem', 'MG', 'Brasil', 
		'Uma rua acima do supermercado varejista', 'https://maps.app.goo.gl/kfyfYAStNKzHtYEC7',
		'2020-10-25 00:00:00', '2020-10-25 00:00:00', '1');

INSERT INTO `rtv_usuario` (`usu_id`, `usu_status`, `usu_idnivelacesso`, `usu_cpf`, `usu_nome`, 
	`usu_dtnasc`, `usu_email`, `usu_emailacb`, `usu_cargo`, `usu_corporativo`, `usu_telefone`, 
	`usu_celular`, `usu_whatsapp`, `usu_idsexo`, `usu_idestadocivil`, `usu_idsetor`, 
	`usu_remuneracao`, `usu_idendereco`, `usu_username`, `usu_senha`, `usu_codigo`, 
	`usu_perfil`, `usu_ultimoacesso`, `usu_dtcad`, `usu_dtalter`, `usu_usualter`) 
VALUES ('1', '1', '1', '000.000.000-00', 'Gustavo Napa', '1992-12-27', 'gustavosouzacco@gmail.com', 
	'suporte@acaicombobagens.com.br', 'Gerente de desenvolvimento', '(31) 9 9532-6524', 
	'(31) 73423128', '(31) 9 7342-3128', '1', '2', '2', '3', '5.000', '1', 'napa', 'napa', 
	NULL, NULL, NULL, '2020-10-25 00:00:00', '2020-10-25 00:00:00', '1');