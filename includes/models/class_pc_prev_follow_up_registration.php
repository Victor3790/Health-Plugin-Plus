<?php
/**
 *
 */
class Pc_Prev_Follow_Up_Registration
{

  public function __construct()
  {
    add_action( 'wp_ajax_pc_register_prev_follow_up', array($this, 'pc_register_prev_follow_up') );
    add_action( 'wp_ajax_nopriv_pc_register_prev_follow_up', array($this, 'pc_register_prev_follow_up') );
  }

  public function pc_register_prev_follow_up(){
      global $wpdb;

      $json_weights = $_POST['json_array'];
      $weights = json_decode($json_weights, );
      $values = count($weights);
      $query  = 'INSERT INTO ' . $wpdb->prefix . 'pc_follow_up_tbl(`user_id`,`week`,`weight`) ';
      $query_place_holders = 'VALUES ';
      $query_values = array();

      for ($i=0; $i < $values; $i++) { 
        $query_place_holders .= '(';
        for ($j=0; $j < 3; $j++) { 
          $query_place_holders .= '%d';
          array_push($query_values, $weights[$i][$j]);
          if( $j < 2 ){
            $query_place_holders .= ',';
          }
        }
        $query_place_holders .= ')';
        if( $i < ($values - 1) ){
          $query_place_holders .= ',';
        }
      }

      $query .= $query_place_holders;

      $wpdb->query(
        $wpdb->prepare($query, $query_values)
      );


      if($output == false){
        $json_output = 'Error, intentelo más tarde';
      }else{
        $json_output = 'Avance registrado';
      }

      wp_send_json( $json_output );

  }
}
