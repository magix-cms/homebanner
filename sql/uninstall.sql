TRUNCATE TABLE `mc_homebanner_content`;
DROP TABLE `mc_homebanner_content`;
TRUNCATE TABLE `mc_homebanner`;
DROP TABLE `mc_homebanner`;

DELETE FROM `mc_config_img` WHERE `module_img` = 'homebanner' AND `attribute_img` = 'homebanner';

DELETE FROM `mc_admin_access` WHERE `id_module` IN (
    SELECT `id_module` FROM `mc_module` as m WHERE m.name = 'homebanner'
);