SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+02:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `game` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`slug` varchar(255) NOT NULL,
	`description` text NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `match` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`tournament_id` int(10) unsigned DEFAULT NULL,
	`team_id` int(10) unsigned NOT NULL,
	`opponent_id` int(10) unsigned NOT NULL,
	`start` int(10) unsigned NOT NULL,
	`result_home` int(10) unsigned DEFAULT NULL,
	`result_opponent` int(10) unsigned DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `tournament_id` (`tournament_id`),
	KEY `opponent_id` (`opponent_id`),
	KEY `team_id` (`team_id`),
	CONSTRAINT `match_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE,
	CONSTRAINT `match_ibfk_2` FOREIGN KEY (`opponent_id`) REFERENCES `opponent` (`id`) ON DELETE CASCADE,
	CONSTRAINT `match_ibfk_4` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `opponent` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`shortcut` varchar(255) NOT NULL,
	`website` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `team` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`game_id` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `game_id` (`game_id`),
	CONSTRAINT `team_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `team_user` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`team_id` int(10) unsigned NOT NULL,
	`user_id` int(10) unsigned NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`nick` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`role` varchar(255) NOT NULL,
	`order` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `team_id` (`team_id`),
	KEY `user_id` (`user_id`),
	CONSTRAINT `team_user_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
	CONSTRAINT `team_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tournament` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`website` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `user` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`nick` varchar(255) NOT NULL,
	`password` char(60) NOT NULL,
	`email` varchar(255) NOT NULL,
	`role` varchar(255) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `nick` (`nick`),
	UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
