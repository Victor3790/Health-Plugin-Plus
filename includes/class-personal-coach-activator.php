<?php

/**
 * Fired during plugin activation
 *
 * @link       victorcrespo.net
 * @since      1.0.0
 *
 * @package    Personal_Coach
 * @subpackage Personal_Coach/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Personal_Coach
 * @subpackage Personal_Coach/includes
 * @author     Victor Crespo <hola@victorcrespo.net>
 */
class Personal_Coach_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if( version_compare( get_bloginfo( 'version' ), '5.4', '<' ) ){
			wp_die('You must update Wordpress to use this plugin');
		}

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global  $wpdb;

		$createSQL = "
			CREATE TABLE `" . $wpdb->prefix . "pc_physical_activities_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`activity` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";"."

			INSERT INTO `" . $wpdb->prefix . "pc_physical_activities_tbl` (`id`, `activity`) VALUES
				(NULL, 'Sedentario'),
				(NULL, 'Poco activo'),
				(NULL, 'Moderadamente activo'),
				(NULL, 'Ligeramente activo'),
				(NULL, 'Activo');

			CREATE TABLE `" . $wpdb->prefix . "pc_goals_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`goal` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";"."

			INSERT INTO `" . $wpdb->prefix . "pc_goals_tbl` (`id`, `goal`) VALUES
				(NULL, 'Perder grasa'),
				(NULL, 'Ganar masa muscular'),
				(NULL, 'Mejorar el rendimiento'),
				(NULL, 'Mejorar su salud');

			CREATE TABLE `" . $wpdb->prefix . "pc_training_areas_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`area` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";"."

			INSERT INTO `" . $wpdb->prefix . "pc_training_areas_tbl` (`id`, `area`) VALUES
				(NULL, 'Casa'),
				(NULL, 'Gimnasio'),
				(NULL, 'Crossfit'),
				(NULL, 'Otro');

			CREATE TABLE `" . $wpdb->prefix . "pc_diets_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`diet` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";"."

			INSERT INTO `" . $wpdb->prefix . "pc_diets_tbl` (`id`, `diet`) VALUES
				(NULL, 'Mediterranea'),
				(NULL, 'Vegetariana'),
				(NULL, 'Cetogénica'),
				(NULL, 'Ayuno intermitente');

			CREATE TABLE `" . $wpdb->prefix . "pc_countries_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`country` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";"."

			INSERT INTO `" . $wpdb->prefix . "pc_countries_tbl` (`id`, `country`) VALUES
				(NULL, 'España'),
				(NULL, 'México'),
				(NULL, 'Argentina'),
				(NULL, 'Estados Unidos'),
				(NULL, 'Colombia'),
				(NULL, 'Perú'),
				(NULL, 'Chile'),
				(NULL, 'Bolivia'),
				(NULL, 'Alemania'),
				(NULL, 'Noruega'),
				(NULL, 'Italia'),
				(NULL, 'Ecuador');

			CREATE TABLE `" . $wpdb->prefix . "pc_trainings_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`training` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";"."

			INSERT INTO `" . $wpdb->prefix . "pc_trainings_tbl` (`id`, `training`) VALUES
				(NULL, 'Full body'),
				(NULL, 'Torso pierna'),
				(NULL, 'Phat'),
				(NULL, 'Personalizada');


			CREATE TABLE `" . $wpdb->prefix . "pc_customers_tbl` (
				`pc_customer_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
				`pc_user_id` BIGINT(20) UNSIGNED NOT NULL UNIQUE,
				`name` VARCHAR(128) NOT NULL ,
				`mail` VARCHAR(128) NOT NULL ,
				`phone` VARCHAR(128) NOT NULL ,
				`country` INT UNSIGNED NOT NULL,
				`city` VARCHAR(128) NOT NULL ,
				`age` TINYINT UNSIGNED NOT NULL ,
				`sex` CHAR(1) NOT NULL ,
				`weight` DECIMAL(5,2) UNSIGNED NOT NULL ,
				`height` SMALLINT UNSIGNED NOT NULL ,
				`physical_activity` INT UNSIGNED NOT NULL ,
				`goal` INT UNSIGNED NOT NULL ,
				`percent` TINYINT UNSIGNED NOT NULL ,
				`training` INT UNSIGNED NOT NULL ,
				`days_week` TINYINT UNSIGNED NOT NULL ,
				`training_area` INT UNSIGNED NOT NULL ,
				`sports` VARCHAR(128) NOT NULL ,
				`diet` INT UNSIGNED NOT NULL ,
				`calories` SMALLINT UNSIGNED NOT NULL ,
				`meals` TINYINT UNSIGNED NOT NULL ,
				`intolerances` VARCHAR(255) NOT NULL ,
				`supplementation` VARCHAR(255) NOT NULL ,
				`user_photo_id` BIGINT UNSIGNED NOT NULL ,
				`start_date` DATE NOT NULL ,
				`active` BOOLEAN NOT NULL ,
				`notes` TEXT NOT NULL ,
				PRIMARY KEY (`pc_customer_id`) ,
				FOREIGN KEY (`country`)
					REFERENCES `" . $wpdb->prefix . "pc_countries_tbl`(`id`)
					ON DELETE CASCADE,
				FOREIGN KEY (`physical_activity`)
					REFERENCES `" . $wpdb->prefix . "pc_physical_activities_tbl`(`id`)
					ON DELETE CASCADE,
				FOREIGN KEY (`training`)
					REFERENCES `" . $wpdb->prefix . "pc_trainings_tbl`(`id`)
					ON DELETE CASCADE,
				FOREIGN KEY (`goal`)
					REFERENCES `" . $wpdb->prefix . "pc_goals_tbl`(`id`)
					ON DELETE CASCADE,
				FOREIGN KEY (`training_area`)
					REFERENCES `" . $wpdb->prefix . "pc_training_areas_tbl`(`id`)
					ON DELETE CASCADE,
				FOREIGN KEY (`diet`)
					REFERENCES `" . $wpdb->prefix . "pc_diets_tbl`(`id`)
					ON DELETE CASCADE
				)
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";

				CREATE TABLE `" . $wpdb->prefix . "pc_follow_up_tbl` (
					`user_id` BIGINT(20) UNSIGNED NOT NULL ,
					`week` TINYINT UNSIGNED NOT NULL ,
					`weight` DECIMAL(5,2) UNSIGNED NOT NULL,
					`answer_1` TEXT NOT NULL ,
					`answer_2` TEXT NOT NULL ,
					`answer_3` TEXT NOT NULL ,
					`answer_4` TEXT NOT NULL ,
					`photo_id` BIGINT UNSIGNED NOT NULL ,

					FOREIGN KEY (`user_id`)
						REFERENCES `" . $wpdb->prefix . "pc_customers_tbl`(`pc_customer_id`)
						ON DELETE CASCADE
					)
					ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";
			";

		$table = $wpdb->prefix . 'pc_customers_tbl';
		$result = $wpdb->get_var( 'SHOW TABLES LIKE "' . $wpdb->prefix . 'pc_customers_tbl"' );

		if( $result != $table  ){
			dbDelta( $createSQL );
		}
	}

}
