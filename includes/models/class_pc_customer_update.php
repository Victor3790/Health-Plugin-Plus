<?php

/**
 *
 */
class Pc_Customer_Update extends Customer_Data
{

  public function __construct()
  {
    add_action( 'wp_ajax_pc_customer_update', array($this, 'pc_customer_update') );
    add_action( 'wp_ajax_nopriv_pc_customer_update', array($this, 'pc_customer_update') );
  }

  public function pc_customer_update(){

    $valid = $this->validate_data( 2 );

    if(!$valid){
      $json_output['message'] = 'Error, verifique los datos';
      $json_output['code'] = 0;
      wp_send_json( $json_output );
    }

    global $wpdb;

    $user_id            = $_POST['pc_user_id'];
    $name               = $_POST['name'];
    $phone              = $_POST['phone'];
    $country            = $_POST['country'];
    $city               = $_POST['city'];
    $start_date         = $_POST['start_date'];
    $age                = $_POST['age'];
    $sex                = $_POST['sex'];
    $weight             = $_POST['weight'];
    $height             = $_POST['height'];
    $physical_activity  = $_POST['physical_activity'];
    $goal               = $_POST['goal'];
    $percent            = $_POST['percent'];
    $training           = $_POST['training'];
    $days_week          = $_POST['days_week'];
    $training_area      = $_POST['training_area'];
    $sports             = $_POST['sports'];
    $diet               = $_POST['diet'];
    $calories           = $_POST['calories'];
    $meals              = $_POST['meals'];
    $intolerances       = $_POST['intolerances'];
    $supplementation    = $_POST['supplementation'];
    $notes              = $_POST['notes'];

    $output = $wpdb->update(
      $wpdb->prefix . 'pc_customers_tbl',
      [
        'name'              => $name,
        'phone'             => $phone,
        'country'           => $country,
        'city'              => $city,
        'age'               => $age,
        'sex'               => $sex,
        'weight'            => $weight,
        'height'            => $height,
        'physical_activity' => $physical_activity,
        'goal'              => $goal,
        'percent'           => $percent,
        'training'          => $training,
        'days_week'         => $days_week,
        'training_area'     => $training_area,
        'sports'            => $sports,
        'diet'              => $diet,
        'calories'          => $calories,
        'meals'             => $meals,
        'intolerances'      => $intolerances,
        'supplementation'   => $supplementation,
        'start_date'        => $start_date,
        'notes'             => $notes
      ],
      [
        'pc_customer_id'    => $user_id ,
      ],
      [
        '%s', '%s', '%d', '%s' ,
        '%d', '%s', '%f', '%f', '%d' ,
        '%d', '%d', '%d', '%d', '%d' ,
        '%s', '%d', '%d', '%d', '%s' ,
        '%s', '%s', '%s', 
      ],
      [
        '%d'
      ]
    );

    if($output === false){
      $json_output['message'] = 'Error, intentelo más tarde';
      $json_output['code'] = 0;
    }elseif($output === 0){
      $json_output['message'] = 'No se ha modificado ningún dato, modifica algún campo';
      $json_output['code'] = 0;
    }else{
      $json_output['message'] = 'Información actualizada';
      $json_output['code'] = 1;
    }

    wp_send_json( $json_output );
  }

}
