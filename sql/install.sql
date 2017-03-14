
SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `alert_types`
-- ----------------------------
DROP TABLE IF EXISTS `alert_types`;
CREATE TABLE `alert_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `alert_types`
-- ----------------------------
BEGIN;
INSERT INTO `alert_types` VALUES ('1', 'Correction Notice', '2016-03-01 09:01:06', '2016-03-01 09:01:06'), ('2', 'Subs', '2016-03-01 09:01:10', '2016-03-01 09:01:06'), ('3', 'Footwear Product Launch', '2016-03-01 09:01:14', '2016-03-01 09:01:06'), ('4', 'Hardgoods Product Launch', '2016-03-01 09:01:17', '2016-03-01 09:01:06'), ('5', 'Recalls', '2016-03-01 09:01:21', '2016-03-01 09:01:06'), ('6', 'Regroups', '2016-03-01 09:01:25', '2016-03-01 09:01:06'), ('7', 'Retickets', '2016-03-01 09:01:29', '2016-03-01 09:01:06'), ('8', 'RTV', '2016-03-01 09:01:33', '2016-03-01 09:01:06');
COMMIT;

-- ----------------------------
--  Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_type_id` int(10) unsigned NOT NULL,
  `update_window_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `banners`
-- ----------------------------
BEGIN;
INSERT INTO `banners` VALUES ('1', 'Sport Chek', 'Sport Chek', '', 'Banner1~01904_minibaseballgame_1440x900_jpg_2769e26d7dc6251c4d342222b6da7bb1f4d5285f.jpg', '0000-00-00 00:00:00', '2016-03-18 12:55:21', '2', '5'), ('2', 'Atmosphere', '', '', 'atmo-bg.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '10');
COMMIT;

-- ----------------------------
--  Table structure for `communication_types`
-- ----------------------------
DROP TABLE IF EXISTS `communication_types`;
CREATE TABLE `communication_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `communication_type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `communication_types_banner_id_foreign` (`banner_id`),
  CONSTRAINT `communication_types_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `communication_types`
-- ----------------------------
BEGIN;
INSERT INTO `communication_types` VALUES ('1', 'no category', '', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('13', 'DM Update', 'info', '1', '2016-03-23 14:57:29', '2016-03-16 09:40:53', '2016-03-23 14:57:29'), ('14', 'Jumpstart', 'danger', '1', null, '2016-03-16 09:41:00', '2016-03-16 09:41:00'), ('15', 'General', 'inverse', '1', null, '2016-03-16 09:41:12', '2016-03-16 09:41:12');
COMMIT;

-- ----------------------------
--  Table structure for `event_types`
-- ----------------------------
DROP TABLE IF EXISTS `event_types`;
CREATE TABLE `event_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `event_types_banner_id_foreign` (`banner_id`),
  CONSTRAINT `event_types_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `event_types`
-- ----------------------------
BEGIN;
INSERT INTO `event_types` VALUES ('1', 'SC Event', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('19', 'ATMO Event', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('20', 'FW', '1', null, '2016-03-10 22:38:08', '2016-03-10 22:38:08'), ('21', 'HG', '1', null, '2016-03-10 22:38:12', '2016-03-10 22:38:12'), ('22', 'SG', '1', null, '2016-03-10 22:38:17', '2016-03-10 22:38:17'), ('23', 'All', '1', null, '2016-03-10 22:38:21', '2016-03-10 22:38:21'), ('24', 'HR', '1', null, '2016-03-10 22:38:25', '2016-03-10 22:38:25');
COMMIT;

-- ----------------------------
--  Table structure for `feature_latest_update_types`
-- ----------------------------
DROP TABLE IF EXISTS `feature_latest_update_types`;
CREATE TABLE `feature_latest_update_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `feature_latest_update_types`
-- ----------------------------
BEGIN;
INSERT INTO `feature_latest_update_types` VALUES ('1', 'By Days', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'By Document Count', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `quicklinks_types`
-- ----------------------------
DROP TABLE IF EXISTS `quicklinks_types`;
CREATE TABLE `quicklinks_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `quicklinks_types`
-- ----------------------------
BEGIN;
INSERT INTO `quicklinks_types` VALUES ('1', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', 'document', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('3', 'external', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `urgent_notice_attachment_types`
-- ----------------------------
DROP TABLE IF EXISTS `urgent_notice_attachment_types`;
CREATE TABLE `urgent_notice_attachment_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `urgent_notice_attachment_types`
-- ----------------------------
BEGIN;
INSERT INTO `urgent_notice_attachment_types` VALUES ('1', 'Folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Document', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `approval_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_group_id_foreign` (`group_id`),
  CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('3', 'Brent', 'Garner', 'brent.garner@fglsports.com', '$2y$10$BGSXvZRXl9LCtcscaK288u9WpzzFv3O79lttw6/hDAf3n.y4l3B/m', '1', '', '1', '1', '1', '0000-00-00 00:00:00', 'Q5xHJOhMtJuyp6466sE08gVm29ijKXZabZdlO9ONW7iRyfv0E9NVEYHpAYSm', '0000-00-00 00:00:00', '2016-04-07 15:42:48'), ('4', 'Muhammad', 'Gagan', 'Muhammad.Gagan@fglsports.com', '$2y$10$ssP6iKRQX6SMevNqBaOZFOYkhceWZ2O83Mt0./EeFFClc76yNE.ZW', '2', '', '1', '1', '1', '0000-00-00 00:00:00', null, '2016-05-02 13:13:26', '2016-05-02 13:13:26');
COMMIT;

-- ----------------------------
--  Table structure for `user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `user_groups`
-- ----------------------------
BEGIN;
INSERT INTO `user_groups` VALUES ('1', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'users', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `banner_user`
-- ----------------------------
DROP TABLE IF EXISTS `banner_user`;
CREATE TABLE `banner_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_user_banner_id_foreign` (`banner_id`),
  KEY `banner_user_user_id_foreign` (`user_id`),
  CONSTRAINT `banner_user_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `banner_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `banner_user`
-- ----------------------------
BEGIN;
INSERT INTO `banner_user` VALUES ('1', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', '2', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `communication_importance_levels`
-- ----------------------------
DROP TABLE IF EXISTS `communication_importance_levels`;
CREATE TABLE `communication_importance_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `communication_importance_levels`
-- ----------------------------
BEGIN;
INSERT INTO `communication_importance_levels` VALUES ('1', 'High', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Normal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'Low', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `quicklinks_types`
-- ----------------------------
DROP TABLE IF EXISTS `quicklinks_types`;
CREATE TABLE `quicklinks_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `quicklinks_types`
-- ----------------------------
BEGIN;
INSERT INTO `quicklinks_types` VALUES ('1', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', 'document', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('3', 'external', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;




SET FOREIGN_KEY_CHECKS = 1;