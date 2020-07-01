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

		if(!self::table_exists('pc_physical_activities_tbl')){

			$physical_activies_q = "
			CREATE TABLE `" . $wpdb->prefix . "pc_physical_activities_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`activity` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";

			ALTER TABLE `" . $wpdb->prefix . "pc_physical_activities_tbl` AUTO_INCREMENT = 1;

			INSERT INTO `" . $wpdb->prefix . "pc_physical_activities_tbl` (`id`, `activity`) VALUES
				(NULL, 'Sedentario'),
				(NULL, 'Poco activo'),
				(NULL, 'Moderadamente activo'),
				(NULL, 'Ligeramente activo'),
				(NULL, 'Activo'); ";

			dbDelta( $physical_activies_q );
		}

		if(!self::table_exists('pc_goals_tbl')){

			$goals_q = "
			CREATE TABLE `" . $wpdb->prefix . "pc_goals_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`goal` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";

			ALTER TABLE `" . $wpdb->prefix . "pc_goals_tbl` AUTO_INCREMENT = 1;

			INSERT INTO `" . $wpdb->prefix . "pc_goals_tbl` (`id`, `goal`) VALUES
				(NULL, 'Perder grasa'),
				(NULL, 'Ganar masa muscular'),
				(NULL, 'Mejorar el rendimiento'),
				(NULL, 'Mejorar su salud');";

			dbDelta( $goals_q );
		}

		if(!self::table_exists('pc_training_areas_tbl')){

			$training_areas_q = "
			CREATE TABLE `" . $wpdb->prefix . "pc_training_areas_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`area` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";

			ALTER TABLE `" . $wpdb->prefix . "pc_training_areas_tbl` AUTO_INCREMENT = 1;

			INSERT INTO `" . $wpdb->prefix . "pc_training_areas_tbl` (`id`, `area`) VALUES
				(NULL, 'Casa'),
				(NULL, 'Gimnasio'),
				(NULL, 'Crossfit'),
				(NULL, 'Otro');";

			dbDelta( $training_areas_q );
		}

		if(!self::table_exists('pc_diets_tbl')){

			$diets_q = "
			CREATE TABLE `" . $wpdb->prefix . "pc_diets_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`diet` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";
			
			ALTER TABLE `" . $wpdb->prefix . "pc_diets_tbl` AUTO_INCREMENT = 1;

			INSERT INTO `" . $wpdb->prefix . "pc_diets_tbl` (`id`, `diet`) VALUES
				(NULL, 'Mediterranea'),
				(NULL, 'Vegetariana'),
				(NULL, 'Cetogénica'),
				(NULL, 'Ayuno intermitente');";

			dbDelta( $diets_q );
		}

		if(!self::table_exists('pc_countries_tbl')){

			$countries_q = "
			CREATE TABLE `" . $wpdb->prefix . "pc_countries_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`country` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";

			ALTER TABLE `" . $wpdb->prefix . "pc_countries_tbl` AUTO_INCREMENT = 1;

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
				(NULL, 'Ecuador');";

			dbDelta( $countries_q );
		}

		if(!self::table_exists('pc_trainings_tbl')){

			$trainings_q = "
			CREATE TABLE `" . $wpdb->prefix . "pc_trainings_tbl` (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`training` VARCHAR(128) NOT NULL ,
				PRIMARY KEY (`id`))
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";

			ALTER TABLE `" . $wpdb->prefix . "pc_trainings_tbl` AUTO_INCREMENT = 1;

			INSERT INTO `" . $wpdb->prefix . "pc_trainings_tbl` (`id`, `training`) VALUES
				(NULL, 'Full body'),
				(NULL, 'Torso pierna'),
				(NULL, 'Phat'),
				(NULL, 'Personalizada');";

			dbDelta( $trainings_q );
		}

		if(!self::table_exists('pc_customers_tbl')){

			$customers_q = "
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
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";";

			dbDelta( $customers_q );
		}

		if(!self::table_exists('pc_follow_up_tbl')){
			$follow_up_q = "
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
				ENGINE = InnoDB " . $wpdb->get_charset_collate() . ";";

				dbDelta( $follow_up_q );
		}

		$user_ids = get_users( array( 'role'=>'subscriber', 'fields'=>array( 'ID' ) ) );

		foreach ($user_ids as $user_id) {
			$meta_exists = get_user_meta( $user_id->ID, 'pc_reg' );
			if( empty( $meta_exists ) ){
				update_user_meta( $user_id->ID, 'pc_reg', 0 );	
			}
		}
	}

	public static function table_exists( $table_name ){
		global  $wpdb;

		$db_prefix = $wpdb->prefix;

		$table = $db_prefix . $table_name;
		$result = $wpdb->get_var( 'SHOW TABLES LIKE "' . $db_prefix . $table_name . '"' );

		if( $result === $table  ){
			return true;
		}else{
			return false;
		}
	}

}
