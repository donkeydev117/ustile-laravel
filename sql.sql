ALTER TABLE `products` ADD `colors` TEXT NOT NULL AFTER `user_id`, ADD `shade` VARCHAR(255) NOT NULL AFTER `colors`, ADD `room` TEXT NOT NULL AFTER `shade`, ADD `material` INT(11) NOT NULL AFTER `room`, ADD `finish` INT(1) NOT NULL AFTER `material`, ADD `look_trend` INT(1) NOT NULL AFTER `finish`, ADD `shape` VARCHAR(255) NOT NULL AFTER `look_trend`, ADD `made_in_usa` INT(1) NOT NULL AFTER `shape`, ADD `width` INT(11) NOT NULL AFTER `made_in_usa`, ADD `length` INT(11) NOT NULL AFTER `width`, ADD `box_size` INT(11) NOT NULL AFTER `length`, ADD `specialty` TEXT NOT NULL AFTER `box_size`, ADD `keyword` TEXT NOT NULL AFTER `specialty`;

ALTER TABLE `products` DROP `colors`, DROP `shade`, DROP `material`, DROP `finish`, DROP `look_trend`, DROP `shape`, DROP `width`, DROP `length`, DROP `box_size`, DROP `specialty`, DROP `keyword`;

ALTER TABLE `products` ADD `material` INT(11) NOT NULL DEFAULT '0' AFTER `made_in_usa`;

ALTER TABLE `products` ADD `application` TEXT NOT NULL AFTER `material`;