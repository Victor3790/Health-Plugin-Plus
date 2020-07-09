<?php
/*
**
*/
class Pc_Plan_Registration
{
    public function __construct(){
        add_action( 'wp_ajax_pc_register_plan', array($this, 'pc_register_plan') );
    }

    public function pc_register_plan(){
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        if( !current_user_can('administrator')){
          $output = 'Error, not enough permission level';
          wp_send_json($output);
        }
  
        if( empty($_FILES) ){
          $json_output['message'] = 'Por favor selecciona una archivo';
          $json_output['code'] = 0;
          wp_send_json( $json_output );
        }
    
        $file_type = wp_check_filetype( $_FILES['plan']['name'] );
        $MIME_type = $file_type['type'];
    
        if( $MIME_type != 'application/pdf' ){
          $json_output['message'] = 'Hay un error con el formato del archivo';
          $json_output['code'] = 0;
          wp_send_json( $json_output );
        }
    
        $plan_id = media_handle_upload( 'plan', 0 );
    
        if( is_wp_error( $plan_id ) ) {
          $json_output['message'] = $plan_id->get_error_message();
          $json_output['code'] = 0;
          wp_send_json( $json_output );
        }

        global $wpdb;

        $customer_id  = $_POST['customer_id'];
        $comments     = $_POST['comments'];
        $plan         = $plan_id;

        /*$delete = $this->pc_delete_old_plan( $customer_id );
        if($delete === 0){
          $json_output['message'] = 'Ha habido un error grave, contacte al administrador';
          $json_output['code']    = 0;
          wp_send_json($json_output);
        }*/

        $output = $wpdb->insert(
          $wpdb->prefix . 'pc_plan_tbl',
          [
            'user_id'   => $customer_id,
            'comments'  => $comments,
            'file_id'   => $plan
          ],
          [
            '%d','%s','%d'
          ]
        );

        if($output === false){
          $json_output['message'] = 'Error, intentelo más tarde';
          $json_output['code'] = 0;
        }else{
          $json_output['message'] = 'Plan registrado correctamente.';
          $json_output['code'] = 1;
        }
    
        wp_send_json( $json_output );
    }

    private function pc_delete_old_plan( $customer_id ){
      global $wpdb;

      $query = 'SELECT
                COUNT(*)
                FROM `' . $wpdb->prefix . 'pc_plan_tbl`
                WHERE `user_id` = ' . $customer_id;

      $plan_count = $wpdb->get_results( $query, 'ARRAY_A' );

      if( $plan_count !== 0 ){

        $output = $wpdb->delete(
          $wpdb->prefix . 'pc_plan_tbl',
          array( 'user_id' => $customer_id ),
          array( '%d' )
        );

        if( $output === false ){
          $output = 0;
        }elseif ( $output === 0 ) {
          $output = 1;
        }else{
          $output = 1;
        }

      }else{
        $output = 1;
      }
  
      return $output;
    }
    
}
