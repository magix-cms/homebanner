CREATE TABLE IF NOT EXISTS `mc_homebanner` (
  `id_slide` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `img_slide` varchar(25) NOT NULL,
  `order_slide` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_slide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `mc_homebanner_content` (
  `id_slide_content` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_slide` smallint(5) unsigned NOT NULL,
  `id_lang` smallint(3) unsigned NOT NULL,
  `link_url_slide` varchar(125) DEFAULT NULL,
  `link_label_slide` varchar(125) DEFAULT NULL,
  `link_title_slide` varchar(125) DEFAULT NULL,
  `blank_slide` smallint(1) unsigned NOT NULL default 0,
  `title_slide` varchar(125) NOT NULL,
  `desc_slide` text,
  `published_slide` smallint(1) unsigned NOT NULL default 0,
  PRIMARY KEY (`id_slide_content`),
  KEY `id_lang` (`id_lang`),
  KEY `id_slide` (`id_slide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `mc_homebanner_content`
  ADD CONSTRAINT `mc_homebanner_content_ibfk_1` FOREIGN KEY (`id_slide`) REFERENCES `mc_homebanner` (`id_slide`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mc_homebanner_content_ibfk_2` FOREIGN KEY (`id_lang`) REFERENCES `mc_lang` (`id_lang`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `mc_config_img` (`id_config_img`, `module_img`, `attribute_img`, `width_img`, `height_img`, `type_img`, `prefix_img`, `resize_img`) VALUES
    (null, 'homebanner', 'homebanner', '480', '192', 'small', 's', 'adaptive'),
    (null, 'homebanner', 'homebanner', '960', '384', 'medium', 'm', 'adaptive'),
    (null, 'homebanner', 'homebanner', '1920', '768', 'large', 'l', 'adaptive');
