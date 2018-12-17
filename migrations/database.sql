CREATE TABLE IF NOT EXISTS `task` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_email` (`email`)
);