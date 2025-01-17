<?php
/**
 *
 */
class Pc_follow_Up_Registration extends Customer_Data
{

  public function __construct()
  {
    add_action( 'wp_ajax_pc_register_follow_up', array($this, 'pc_register_follow_up') );
  }

  public function pc_register_follow_up(){
      if( !current_user_can('subscriber')){
        $json_output['message'] = 'Error, contacte al administrador';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( ! isset($_POST['customer_form']) ){
        $json_output['message'] = 'Nonce error 001, contacte al administrador';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( ! wp_verify_nonce( $_POST['customer_form'], 'pc_register_follow_up' ) ){
        $json_output['message'] = 'Nonce error 002, contacte al administrador';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      $photo_id = ' ';

      if( !empty($_FILES) ){
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $file_type = wp_check_filetype( $_FILES['photo']['name'] );
        $MIME_type = $file_type['type'];
    
        if( $MIME_type != 'image/jpeg' && $MIME_type != 'image/png' ){
          $json_output['message'] = 'Hay un error con el formato de la imagen';
          $json_output['code'] = 0;
          wp_send_json( $json_output );
        }
    
        $photo_id = media_handle_upload( 'photo', 0 );
    
        if( is_wp_error( $photo_id ) ) {
          $json_output['message'] = $photo_id->get_error_message();
          $json_output['code'] = 0;
          wp_send_json( $json_output );
        }
      }

      if( !$this::check_id('customer_id') ){
        $json_output['message'] = 'Error 001, intentelo más tarde';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( !$this::in_range( 'weight', 9, 200 ) ){
        $json_output['message'] = 'Error 002, intentelo más tarde';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( !$this::check_text_no_strict( 'answer_1' ) ){
        $json_output['message'] = 'Error 003, intentelo más tarde';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( !$this::check_text_no_strict( 'answer_2' ) ){
        $json_output['message'] = 'Error 004, intentelo más tarde';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( !$this::check_text_no_strict( 'answer_3' ) ){
        $json_output['message'] = 'Error 005, intentelo más tarde';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      if( !$this::check_text_no_strict( 'answer_4' ) ){
        $json_output['message'] = 'Error 006, intentelo más tarde';
        $json_output['code'] = 0;
        wp_send_json($json_output);
      }

      global $wpdb;

      $user_id            = $_POST['customer_id'];
      $weight             = $_POST['weight'];
      $answer_1           = $_POST['answer_1'];
      $answer_2           = $_POST['answer_2'];
      $answer_3           = $_POST['answer_3'];
      $answer_4           = $_POST['answer_4'];
      $photo              = $photo_id;

      $week = $this->pc_get_current_follow_up_week( $user_id );

      $output = $wpdb->insert(
        $wpdb->prefix . 'pc_follow_up_tbl',
        [
          'user_id'   => $user_id,
          'week'      => $week,
          'weight'    => $weight,
          'answer_1'  => $answer_1,
          'answer_2'  => $answer_2,
          'answer_3'  => $answer_3,
          'answer_4'  => $answer_4,
          'photo_id'  => $photo,
        ],
        [
          '%d','%d','%f','%s','%s','%s','%s','%d'
        ]
      );

      if($output == false){
        $json_output['message'] = 'Error, intentelo más tarde';
        $json_output['code'] = 0;
      }else{
        $json_output['message'] = 'Gracias por registrar tu avance semanal.';
        $json_output['code'] = 1;
      }

      wp_send_json( $json_output );

  }

  private function pc_get_current_follow_up_week( $customer_id ){
      global $wpdb;

      $query = 'SELECT
                  c.start_date
                  FROM `' . $wpdb->prefix . 'pc_customers_tbl` c
                  WHERE c.pc_customer_id = ' . $customer_id;

      $output = $wpdb->get_results( $query, 'ARRAY_A' );

      $start_date = $output[0]['start_date'];

      $current_customer_week = Pc_Customer::pc_get_current_week( $start_date );

      return $current_customer_week;
  }
}
