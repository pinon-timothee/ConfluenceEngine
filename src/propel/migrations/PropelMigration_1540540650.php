<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1540540650.
 * Generated on 2018-10-26 09:57:30 by timotheepinon
 */
class PropelMigration_1540540650
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `module_breadcrumb`;

DROP TABLE IF EXISTS `module_cluster`;

DROP TABLE IF EXISTS `module_cms`;

DROP TABLE IF EXISTS `module_cms_i18n`;

DROP TABLE IF EXISTS `module_contact_field`;

DROP TABLE IF EXISTS `module_contact_field_i18n`;

DROP TABLE IF EXISTS `module_contact_request`;

DROP TABLE IF EXISTS `module_estimate_field`;

DROP TABLE IF EXISTS `module_estimate_field_catalog`;

DROP TABLE IF EXISTS `module_estimate_field_catalog_i18n`;

DROP TABLE IF EXISTS `module_estimate_field_i18n`;

DROP TABLE IF EXISTS `module_estimate_request`;

DROP TABLE IF EXISTS `module_interest_sector`;

DROP TABLE IF EXISTS `module_interest_sector_i18n`;

DROP TABLE IF EXISTS `module_interest_sector_picture`;

DROP TABLE IF EXISTS `module_lead_field`;

DROP TABLE IF EXISTS `module_lead_field_catalog`;

DROP TABLE IF EXISTS `module_lead_field_catalog_i18n`;

DROP TABLE IF EXISTS `module_lead_field_i18n`;

DROP TABLE IF EXISTS `module_lead_request`;

DROP TABLE IF EXISTS `module_legal_i18n`;

DROP TABLE IF EXISTS `module_meilleurs_agents`;

DROP TABLE IF EXISTS `module_menu`;

DROP TABLE IF EXISTS `module_menu_i18n`;

DROP TABLE IF EXISTS `module_newsletter_request`;

DROP TABLE IF EXISTS `module_picture`;

DROP TABLE IF EXISTS `module_picture_i18n`;

DROP TABLE IF EXISTS `module_search_field`;

DROP TABLE IF EXISTS `module_search_field_catalog`;

DROP TABLE IF EXISTS `module_search_field_catalog_i18n`;

DROP TABLE IF EXISTS `module_search_field_i18n`;

DROP TABLE IF EXISTS `module_search_order_catalog`;

DROP TABLE IF EXISTS `module_search_order_catalog_i18n`;

DROP TABLE IF EXISTS `module_search_order_i18n`;

DROP TABLE IF EXISTS `module_slider`;

DROP TABLE IF EXISTS `module_slider_i18n`;

DROP TABLE IF EXISTS `module_social_menu`;

DROP TABLE IF EXISTS `module_structured_cms`;

DROP TABLE IF EXISTS `module_structured_cms_i18n`;

DROP TABLE IF EXISTS `module_user`;

ALTER TABLE `website` DROP FOREIGN KEY `website_fk_d518db`;

ALTER TABLE `website` ADD CONSTRAINT `website_fk_d518db`
    FOREIGN KEY (`step_id`)
    REFERENCES `step` (`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT;

DROP INDEX `name` ON `website_domain`;

CREATE INDEX `name` ON `website_domain` (`name`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `website` DROP FOREIGN KEY `website_fk_d518db`;

ALTER TABLE `website` ADD CONSTRAINT `website_fk_d518db`
    FOREIGN KEY (`step_id`)
    REFERENCES `step` (`id`)
    ON UPDATE CASCADE;

DROP INDEX `name` ON `website_domain`;

CREATE INDEX `name` ON `website_domain` (`name`(191));

CREATE TABLE `module_breadcrumb`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_module_id` INTEGER,
    `rank` INTEGER NOT NULL,
    `field` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `module_breadcrumb_fi_2316eb` (`website_module_id`),
    CONSTRAINT `module_breadcrumb_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_cluster`
(
    `website_module_id` INTEGER NOT NULL,
    `target_website_module_id` INTEGER NOT NULL,
    `rank` INTEGER NOT NULL,
    PRIMARY KEY (`website_module_id`,`target_website_module_id`,`rank`),
    INDEX `fi_get_website_module` (`target_website_module_id`),
    CONSTRAINT `target_website_module`
        FOREIGN KEY (`target_website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `website_module`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_cms`
(
    `id` INTEGER NOT NULL,
    `picture` VARCHAR(2048),
    `background` VARCHAR(2048),
    PRIMARY KEY (`id`),
    CONSTRAINT `module_cms_fk_5acc8f`
        FOREIGN KEY (`id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_cms_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) DEFAULT \'en_US\' NOT NULL,
    `title` VARCHAR(255),
    `subtitle` VARCHAR(255),
    `content` TEXT,
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_cms_i18n_fk_6a5669`
        FOREIGN KEY (`id`)
        REFERENCES `module_cms` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_contact_field`
(
    `website_module_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `required` TINYINT(1),
    `label_enable` TINYINT(1),
    `placeholder_enable` TINYINT(1),
    `rank` INTEGER,
    `enable` TINYINT(1) DEFAULT 1 NOT NULL,
    `select_height` INTEGER,
    `select_multiple` TINYINT(1),
    `select_default_enable` TINYINT(1),
    `select_mod` TINYINT,
    `zone` VARCHAR(255),
    PRIMARY KEY (`website_module_id`,`field`),
    CONSTRAINT `module_contact_field_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_contact_field_i18n`
(
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `label` VARCHAR(255),
    `placeholder` VARCHAR(255),
    PRIMARY KEY (`website_id`,`field`,`culture`),
    CONSTRAINT `module_contact_field_i18n_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_contact_request`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `date` DATETIME NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `state` INTEGER DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_contact_request_fi_c4560c` (`website_id`),
    CONSTRAINT `module_contact_request_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_estimate_field`
(
    `website_module_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `required` TINYINT(1),
    `label_enable` TINYINT(1),
    `placeholder_enable` TINYINT(1),
    `rank` INTEGER,
    `enable` TINYINT(1) DEFAULT 1 NOT NULL,
    `select_height` INTEGER,
    `select_multiple` TINYINT(1),
    `select_default_enable` TINYINT(1),
    `select_mod` TINYINT,
    `zone` VARCHAR(255),
    PRIMARY KEY (`website_module_id`,`field`),
    CONSTRAINT `module_estimate_field_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_estimate_field_catalog`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_estimate_field_catalog_fi_c4560c` (`website_id`),
    CONSTRAINT `module_estimate_field_catalog_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_estimate_field_catalog_i18n`
(
    `module_estimate_field_catalog_id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`module_estimate_field_catalog_id`,`culture`),
    CONSTRAINT `module_estimate_field_catalog_i18n_fk_947031`
        FOREIGN KEY (`module_estimate_field_catalog_id`)
        REFERENCES `module_estimate_field_catalog` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_estimate_field_i18n`
(
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `label` VARCHAR(255),
    `placeholder` VARCHAR(255),
    PRIMARY KEY (`website_id`,`field`,`culture`),
    CONSTRAINT `module_estimate_field_i18n_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_estimate_request`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `date` DATETIME NOT NULL,
    `type` INTEGER NOT NULL,
    `content` TEXT NOT NULL,
    `state` INTEGER DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_estimate_request_fi_c4560c` (`website_id`),
    CONSTRAINT `module_estimate_request_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_interest_sector`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER,
    `polygon` VARCHAR(1024),
    `geometry` geometry,
    PRIMARY KEY (`id`),
    INDEX `module_interest_sector_fi_c4560c` (`website_id`),
    CONSTRAINT `module_interest_sector_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_interest_sector_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) DEFAULT \'en_US\' NOT NULL,
    `title` TEXT,
    `content` TEXT,
    `content2` TEXT,
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_interest_sector_i18n_fk_e0cec2`
        FOREIGN KEY (`id`)
        REFERENCES `module_interest_sector` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_interest_sector_picture`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `sector_id` INTEGER,
    `rank` INTEGER,
    `url` VARCHAR(2048),
    PRIMARY KEY (`id`),
    INDEX `module_interest_sector_picture_fi_e62034` (`sector_id`),
    CONSTRAINT `module_interest_sector_picture_fk_e62034`
        FOREIGN KEY (`sector_id`)
        REFERENCES `module_interest_sector` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_lead_field`
(
    `website_module_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `required` TINYINT(1),
    `label_enable` TINYINT(1),
    `placeholder_enable` TINYINT(1),
    `rank` INTEGER,
    `enable` TINYINT(1) DEFAULT 1 NOT NULL,
    `select_height` INTEGER,
    `select_multiple` TINYINT(1),
    `select_default_enable` TINYINT(1),
    `select_mod` TINYINT,
    `zone` VARCHAR(255),
    PRIMARY KEY (`website_module_id`,`field`),
    CONSTRAINT `module_lead_field_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_lead_field_catalog`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_lead_field_catalog_fi_c4560c` (`website_id`),
    CONSTRAINT `module_lead_field_catalog_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_lead_field_catalog_i18n`
(
    `module_lead_field_catalog_id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`module_lead_field_catalog_id`,`culture`),
    CONSTRAINT `module_lead_field_catalog_i18n_fk_0d24c1`
        FOREIGN KEY (`module_lead_field_catalog_id`)
        REFERENCES `module_lead_field_catalog` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_lead_field_i18n`
(
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `label` VARCHAR(255),
    `placeholder` VARCHAR(255),
    PRIMARY KEY (`website_id`,`field`,`culture`),
    CONSTRAINT `module_lead_field_i18n_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_lead_request`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `date` DATETIME NOT NULL,
    `type` INTEGER NOT NULL,
    `content` TEXT NOT NULL,
    `state` INTEGER DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_lead_request_fi_c4560c` (`website_id`),
    CONSTRAINT `module_lead_request_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_legal_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `content` TEXT,
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_legal_i18n_fk_5acc8f`
        FOREIGN KEY (`id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_meilleurs_agents`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_module_id` INTEGER NOT NULL,
    `agency_id` VARCHAR(255) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_meilleurs_agents_fi_2316eb` (`website_module_id`),
    CONSTRAINT `module_meilleurs_agents_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_menu`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_module_id` INTEGER NOT NULL,
    `inter_left` INTEGER NOT NULL,
    `inter_right` INTEGER NOT NULL,
    `target_website_routing_id` INTEGER,
    `anchor` VARCHAR(255),
    `target_mod` VARCHAR(255) DEFAULT \'_self\' NOT NULL,
    `icon` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `module_menu_fi_2316eb` (`website_module_id`),
    INDEX `module_menu_fi_188f69` (`target_website_routing_id`),
    CONSTRAINT `module_menu_fk_188f69`
        FOREIGN KEY (`target_website_routing_id`)
        REFERENCES `website_routing` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `module_menu_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_menu_i18n`
(
    `module_menu_id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`module_menu_id`,`culture`),
    CONSTRAINT `module_menu_i18n_fk_f9d234`
        FOREIGN KEY (`module_menu_id`)
        REFERENCES `module_menu` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_newsletter_request`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `date` DATETIME NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `state` INTEGER DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_newsletter_request_fi_c4560c` (`website_id`),
    CONSTRAINT `module_newsletter_request_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_picture`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_module_id` INTEGER,
    `src` VARCHAR(255) NOT NULL,
    `rank` INTEGER,
    `target_website_routing_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `module_picture_fi_2316eb` (`website_module_id`),
    INDEX `module_picture_fi_188f69` (`target_website_routing_id`),
    CONSTRAINT `module_picture_fk_188f69`
        FOREIGN KEY (`target_website_routing_id`)
        REFERENCES `website_routing` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `module_picture_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_picture_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) DEFAULT \'en_US\' NOT NULL,
    `alt` VARCHAR(255),
    `title` VARCHAR(255),
    `content` TEXT,
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_picture_i18n_fk_4fe440`
        FOREIGN KEY (`id`)
        REFERENCES `module_picture` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_field`
(
    `website_module_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `required` TINYINT(1),
    `label_enable` TINYINT(1),
    `placeholder_enable` TINYINT(1),
    `rank` INTEGER,
    `enable` TINYINT(1) DEFAULT 1 NOT NULL,
    `select_multiple` TINYINT(1),
    `select_default_enable` TINYINT(1),
    `select_mod` INTEGER,
    `zone` VARCHAR(255) DEFAULT \'basic\',
    PRIMARY KEY (`website_module_id`,`field`),
    CONSTRAINT `module_search_field_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_field_catalog`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_search_field_catalog_fi_c4560c` (`website_id`),
    CONSTRAINT `module_search_field_catalog_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_field_catalog_i18n`
(
    `module_search_field_catalog_id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`module_search_field_catalog_id`,`culture`),
    CONSTRAINT `module_search_field_catalog_i18n_fk_60c6e7`
        FOREIGN KEY (`module_search_field_catalog_id`)
        REFERENCES `module_search_field_catalog` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_field_i18n`
(
    `website_id` INTEGER NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `label` VARCHAR(255),
    `placeholder` VARCHAR(255),
    PRIMARY KEY (`website_id`,`field`,`culture`),
    CONSTRAINT `module_search_field_i18n_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_order_catalog`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_module_id` INTEGER NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_search_order_catalog_fi_2316eb` (`website_module_id`),
    CONSTRAINT `module_search_order_catalog_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_order_catalog_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) DEFAULT \'en_US\' NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_search_order_catalog_i18n_fk_36d659`
        FOREIGN KEY (`id`)
        REFERENCES `module_search_order_catalog` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_search_order_i18n`
(
    `website_module_id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `label` VARCHAR(255),
    `placeholder` VARCHAR(255),
    PRIMARY KEY (`website_module_id`,`culture`),
    CONSTRAINT `module_search_order_i18n_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_slider`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_module_id` INTEGER NOT NULL,
    `rank` INTEGER,
    `picture_url` VARCHAR(2048),
    `target_website_routing_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `module_slider_fi_2316eb` (`website_module_id`),
    INDEX `module_slider_fi_188f69` (`target_website_routing_id`),
    CONSTRAINT `module_slider_fk_188f69`
        FOREIGN KEY (`target_website_routing_id`)
        REFERENCES `website_routing` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `module_slider_fk_2316eb`
        FOREIGN KEY (`website_module_id`)
        REFERENCES `website_module` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_slider_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) DEFAULT \'en_US\' NOT NULL,
    `title` VARCHAR(255),
    `alt` VARCHAR(255),
    `comment` TEXT,
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_slider_i18n_fk_43b86f`
        FOREIGN KEY (`id`)
        REFERENCES `module_slider` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_social_menu`
(
    `website_id` INTEGER NOT NULL,
    `facebook` VARCHAR(255),
    `instagram` VARCHAR(255),
    `google_plus` VARCHAR(255),
    `twitter` VARCHAR(255),
    `youtube` VARCHAR(255),
    `linkedin` VARCHAR(255),
    `dailymotion` VARCHAR(255),
    `pinterest` VARCHAR(255),
    PRIMARY KEY (`website_id`),
    CONSTRAINT `module_social_menu_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_structured_cms`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `target_routing_id` INTEGER,
    `namespaces` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `published_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `publish` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_structured_cms_fi_c4560c` (`website_id`),
    INDEX `module_structured_cms_fi_6ac223` (`target_routing_id`),
    CONSTRAINT `module_structured_cms_fk_6ac223`
        FOREIGN KEY (`target_routing_id`)
        REFERENCES `website_routing` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT `module_structured_cms_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_structured_cms_i18n`
(
    `id` INTEGER NOT NULL,
    `culture` VARCHAR(5) NOT NULL,
    `title` VARCHAR(255),
    `subtitle` VARCHAR(255),
    `content` LONGTEXT,
    `picture` VARCHAR(255),
    `alt` VARCHAR(255),
    `tags` VARCHAR(255),
    `meta_title` VARCHAR(255),
    `meta_description` VARCHAR(255),
    PRIMARY KEY (`id`,`culture`),
    CONSTRAINT `module_structured_cms_i18n_fk_555ed3`
        FOREIGN KEY (`id`)
        REFERENCES `module_structured_cms` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `module_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `website_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    `agency_id` INTEGER NOT NULL,
    `property_id` INTEGER NOT NULL,
    `phone` VARCHAR(32) NOT NULL,
    `mobile` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `module_user_fi_c4560c` (`website_id`),
    CONSTRAINT `module_user_fk_c4560c`
        FOREIGN KEY (`website_id`)
        REFERENCES `website` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}