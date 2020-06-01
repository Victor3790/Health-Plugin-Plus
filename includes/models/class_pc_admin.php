<?php
/**
 * Gets all the information that the admin needs
 */
class Pc_Admin
{

  public function __construct()
  {

  }

  public function get_pc_active_customers(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT
            `pc_customer_id`,
            `name`,
            `mail`,
            `phone`
       FROM `' . $wpdb->prefix . 'pc_customers_tbl`
       WHERE `active` = true'
    );

    return $output;
  }

  public function get_pc_customers(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT
            `pc_customer_id`,
            `name`
       FROM `' . $wpdb->prefix . 'pc_customers_tbl`'
    );

    return $output;

  }

  public function get_pc_countries(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT *
       FROM `' . $wpdb->prefix . 'pc_countries_tbl`');

    return $output;

  }

  public function get_pc_physical_activities(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT *
       FROM `' . $wpdb->prefix . 'pc_physical_activities_tbl`');

    return $output;

  }

  public function get_pc_goals(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT *
       FROM `' . $wpdb->prefix . 'pc_goals_tbl`');

    return $output;

  }

  public function get_pc_trainings(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT *
       FROM `' . $wpdb->prefix . 'pc_trainings_tbl`');

    return $output;

  }

  public function get_pc_training_areas(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT *
       FROM `' . $wpdb->prefix . 'pc_training_areas_tbl`');

    return $output;

  }

  public function get_pc_diets(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT *
       FROM `' . $wpdb->prefix . 'pc_diets_tbl`');

    return $output;

  }

  public function get_pc_users_progress(){
    global $wpdb;

    $output = $wpdb->get_results(
        'SELECT
          `pc_customer_id`,
          `name`
         FROM `' . $wpdb->prefix . 'pc_customers_tbl`');

    return $output;

  }

}
