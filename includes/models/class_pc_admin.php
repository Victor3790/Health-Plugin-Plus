<?php
/**
 * Gets all the information that the admin needs
 */
class Pc_Admin extends Customer_Data
{

  public function __construct()
  {
    add_action( 'wp_ajax_pc_get_active_customers', array($this, 'get_pc_active_customers') );

    add_action( 'wp_ajax_pc_inactivate_customer', array($this, 'pc_inactivate_customer') );

    add_action( 'wp_ajax_pc_get_inactive_customers', array($this, 'get_pc_inactive_customers') );

    add_action( 'wp_ajax_pc_activate_customer', array($this, 'pc_activate_customer') );

    add_action( 'wp_ajax_pc_delete_customer', array($this, 'pc_delete_customer') );
  }

  public function pc_delete_customer(){

    if( !current_user_can('administrator')){
      $output = 'Error, not enough permission level';
      wp_send_json($output);
    }

    if( !$this::check_id('pc_customer_id') ){
      $output = 'Error, contacte al administrador';
      wp_send_json($output);
    }

    global $wpdb;

    $customer_id = $_POST['pc_customer_id'];
    $output = $wpdb->delete(
                              $wpdb->prefix . 'pc_customers_tbl',
                              array( 'pc_customer_id' => $customer_id ),
                              array( '%d' )
                           );

    if( $output === false ){
      $output = 'Error, contacte al administrador';
    }elseif ( $output === 0 ) {
      $output = 'El cliente no existe o ya fue eliminado';
    }else{
      $output = 'Cliente eliminado';
    }

    wp_send_json($output);
  }

  public function get_pc_inactive_customers(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT
            `pc_customer_id`,
            `name`,
            `mail`,
            `phone`
       FROM `' . $wpdb->prefix . 'pc_customers_tbl`
       WHERE `active` = false'
    );

    wp_send_json( $output );
  }

  public function pc_inactivate_customer(){
    if( !current_user_can('administrator')){
      $output = 'Error, not enough permission level';
      wp_send_json($output);
    }

    if( !$this::check_id('pc_customer_id') ){
      $output = 'Error, contacte al administrador';
      wp_send_json($output);
    }

    global $wpdb;

    $customer_id = $_POST['pc_customer_id'];
    $update = $wpdb->update(
            $wpdb->prefix . 'pc_customers_tbl',
            array('active' => false),
            array('pc_customer_id' => $customer_id),
            array('%d'), array('%d')
           );

    if( $update === false ){
      $output = 'Error, contacte al administrador';
    }elseif ( $update === 0 ) {
      $output = 'El cliente no existe o ya fue inactivado';
    }else{
      $output = 'Cliente inactivado';
    }

    wp_send_json($output);
  }

  public function pc_activate_customer(){
    if( !current_user_can('administrator')){
      $output = 'Error, not enough permission level';
      wp_send_json($output);
    }

    if( !$this::check_id('pc_customer_id') ){
      $output = 'Error, contacte al administrador';
      wp_send_json($output);
    }

    global $wpdb;

    $customer_id = $_POST['pc_customer_id'];
    $update = $wpdb->update(
            $wpdb->prefix . 'pc_customers_tbl',
            array('active' => true),
            array('pc_customer_id' => $customer_id),
            array('%d'), array('%d')
           );

    if( $update === false ){
      $output = 'Error, contacte al administrador';
    }elseif ( $update === 0 ) {
      $output = 'El cliente no existe o ya fue inactivado';
    }else{
      $output = 'Cliente activado';
    }

    wp_send_json($output);
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

    wp_send_json( $output );
  }

  public function get_pc_customers(){
    global $wpdb;

    $output = $wpdb->get_results(
      'SELECT
            `pc_customer_id`,
            `name`
       FROM `' . $wpdb->prefix . 'pc_customers_tbl`
       WHERE `active` = true'
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

}
