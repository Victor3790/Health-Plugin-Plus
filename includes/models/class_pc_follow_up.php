<?php
/**
 * Get the Weekly follow up for a user (Ajax)
 */
class Pc_Follow_Up extends Customer_Data
{
  private $customer_id;

  public function __construct()
  {
    add_action( 'wp_ajax_pc_get_follow_up', array($this, 'pc_get_follow_up') );
  }

  public function pc_get_follow_up(){

    if( !$this::check_id('pc_customer_id_follow_up') ){
      $output = 'Error, contacte al administrador';
      wp_send_json($output);
    }

    global $wpdb;

    $this->customer_id = $_POST['pc_customer_id_follow_up'];

    $query = 'SELECT
                f.week,
                f.weight,
                f.answer_1,
                f.answer_2,
                f.answer_3,
                f.answer_4,
                f.photo_id
                FROM `' . $wpdb->prefix . 'pc_follow_up_tbl` f
                WHERE f.user_id = %d';

    $rows = $wpdb->get_results(
                $wpdb->prepare($query, [$this->customer_id]),
                'ARRAY_A'
              );

    foreach ($rows as $index => $value) {
      $user_photo_id = $rows[$index]['photo_id'];

      $user_photo = wp_get_attachment_image(
                        $user_photo_id,
                        array ( '400', '400' ),
                        "",
                        array ( 'class'=>'personal__photo' )
                    );

      $rows[$index]['user_photo'] = $user_photo;
    }

    wp_send_json( $rows );
  }
}
