<?php

/**
 *
 */
class Pc_Ajax_Customer extends Customer_Data
{

  private $customer;

  private $customer_id;

  public function __construct()
  {
    add_action( 'wp_ajax_pc_get_customer', array($this, 'pc_get_customer') );

    add_action( 'wp_ajax_pc_get_customer_raw_info', array($this, 'pc_get_customer_raw_info') );

    add_action( 'wp_ajax_pc_get_ajax_progress', array($this, 'pc_get_ajax_progress') );
  }

  public function pc_get_customer(){
    if( !current_user_can('administrator')){
      $output = 'Error, not enough permission level';
      wp_send_json($output);
    }

    if( !$this::check_id('pc_customer_id') ){
      $output = 'Error, contacte al administrador';
      wp_send_json($output);
    }

    $this->customer_id = $_POST['pc_customer_id'];
    $this->customer = new Pc_Customer ( $this->customer_id, 1 );
    $json_output = $this->customer->pc_get_customer_info();

    wp_send_json( $json_output );

  }

  public function pc_get_customer_raw_info(){
    if( !current_user_can('administrator')){
      $output = 'Error, not enough permission level';
      wp_send_json($output);
    }

    if( !$this::check_id('pc_customer_id') ){
      $output = 'Error, contacte al administrador';
      wp_send_json($output);
    }

    $this->customer_id = $_POST['pc_customer_id'];
    $this->customer = new Pc_Customer ( $this->customer_id, 1 );
    $json_output = $this->customer->pc_get_customer_raw_info();

    wp_send_json( $json_output );

  }

  public function pc_get_ajax_progress(){
    if( !current_user_can('administrator')){
      $output = 'Error, not enough permission level';
      wp_send_json($output);
    }

    $this->customer_id = $_POST['pc_customer_id'];
    $this->customer = new Pc_Customer ( $this->customer_id, 1 );
    $json_output = $this->customer->pc_get_customer_progress();

    wp_send_json( $json_output );

  }
}
