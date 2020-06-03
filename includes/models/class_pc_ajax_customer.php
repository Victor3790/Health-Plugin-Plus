<?php

/**
 *
 */
class Pc_Ajax_Customer
{

  private $customer;

  private $customer_id;

  public function __construct()
  {
    add_action( 'wp_ajax_pc_get_customer', array($this, 'pc_get_customer') );
    add_action( 'wp_ajax_nopriv_pc_get_customer', array($this, 'pc_get_customer') );

    add_action( 'wp_ajax_pc_get_ajax_progress', array($this, 'pc_get_ajax_progress') );
    add_action( 'wp_ajax_nopriv_pc_get_ajax_progress', array($this, 'pc_get_ajax_progress') );
  }

  public function pc_get_customer(){

    $this->customer_id = $_POST['pc_customer_id'];
    $this->customer = new Pc_Customer ( $this->customer_id, 1 );
    $json_output = $this->customer->pc_get_customer_info();

    wp_send_json( $json_output );

  }

  public function pc_get_ajax_progress(){

    $this->customer_id = $_POST['pc_customer_id'];
    $this->customer = new Pc_Customer ( $this->customer_id, 1 );
    $json_output = $this->customer->pc_get_customer_progress();

    wp_send_json( $json_output );

  }
}
