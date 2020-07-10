<?php

/**
 * Controller for the user view shortcode
 */
if(!class_exists('Personal_Coach_Customer_View'))
{
  class Personal_Coach_Customer_View extends Pc_Loader
  {
    private $plugin_name;

    private $url_file;

    private $follow_up_registration;

    public function __construct( $url_file_view, $plugin_name )
    {
      $this->follow_up_registration = new Pc_follow_Up_Registration;
      $this->plugin_name = $plugin_name;
      $this->url_file = $url_file_view;
    }

    public function pc_create_customer_view(){

      wp_enqueue_style( $this->plugin_name . '_bootstrap' );
      wp_enqueue_style( $this->plugin_name . '_admin_view' );
      wp_enqueue_style( $this->plugin_name . '_customer_view' );
      wp_enqueue_style( $this->plugin_name . '_tab_theme' );

      wp_enqueue_script( $this->plugin_name . '_accordion' );
      wp_enqueue_script( $this->plugin_name . '_form_validator' );
      wp_enqueue_script( $this->plugin_name . '_pc_form_validator' );
      wp_enqueue_script( $this->plugin_name . '_google_charts' );
      wp_enqueue_script( $this->plugin_name . '_pc_charts' );
      wp_enqueue_script( $this->plugin_name . '_customer_follow_up_registration' );

      $user_view = $this->load_view( $this->url_file);

      return $user_view;
    }
  }
}
