ALTER TABLE `courses` ADD `vdocipher_tag` VARCHAR(255) NULL DEFAULT NULL AFTER `accreditation_text`;
CREATE TABLE `igtsserv_laravel`.`posts` ( `id` INT(12) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `courseincludes` ADD `included_course_title` VARCHAR(255) NULL DEFAULT NULL AFTER `included_course`;
ALTER TABLE `courseincludes` CHANGE `position` `position` INT(12) NULL DEFAULT NULL;
ALTER TABLE `courseincludes` CHANGE `position` `position` INT(12) NULL DEFAULT '0';


CREATE TABLE `igts-laravel`.`paymentmethods` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `logo` VARCHAR(255) NOT NULL , `status` INT(1) NOT NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `orders` ADD `paypalorderid` INT(12) NULL AFTER `fawryRefNumber`;
ALTER TABLE `orders` CHANGE `paypalorderid` `paypalorderid` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `paymentmethods` ADD `action` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `updated_at`;

ALTER TABLE `paymentmethods` ADD `class` VARCHAR(50) NULL AFTER `action`;
ALTER TABLE `courseenrollment` ADD `certificate` VARCHAR(255) NULL AFTER `courses_id`;
ALTER TABLE `courses` ADD `webinar_url` VARCHAR(255) NULL AFTER `vdocipher_tag`;



ALTER TABLE `careers` CHANGE `description` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
ALTER TABLE `careers` ADD `link` VARCHAR(255) NULL AFTER `updated_at`;


////////////////// OFFLINE ORDERS ////////////////////////////////
ALTER TABLE `orders` ADD `emp_id` INT(12) NULL AFTER `accept_status`;
ALTER TABLE `orders` ADD `type` INT(12) NOT NULL DEFAULT '1' AFTER `emp_id`;


/////////////////// DIRECTPAY //////////////////////////////////
CREATE TABLE `directpayauth` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `orders_id` INT NOT NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

######################### Show Hide Certificates ####################
ALTER TABLE `certificates` ADD `visible` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;


################## POST AFFILIATE PRO ####################
ALTER TABLE `orders` ADD `aff_id` VARCHAR(255) NULL AFTER `type`;
ALTER TABLE `orders` ADD `aff_channel` VARCHAR(255) NULL AFTER `aff_id`;


##################### 22/3/2022 Ramadan Free Course ##################
ALTER TABLE `categories` ADD `courses_id` INT(12) NULL AFTER `class`, ADD `end_time` DATE NULL AFTER `courses_id`, ADD `enable_free` TINYINT(1) NULL DEFAULT '0' AFTER `end_time`;

##################### Re-branding ########################
ALTER TABLE `categories` CHANGE `class` `color_code` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
