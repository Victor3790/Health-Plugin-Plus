<?php
/*
** This function will get the user info for both the admin view and the user view
** The $id argument is either the user id or the customer id, this will depend on
**  whether the function is called from the admin view or the user view
** The $request argument will be 1 if the request comes from the admin view or
**  2 if the request comes from the user view
*/
class Pc_Customer
{

  private $customer_id;

  private $request;

  function __construct( $customer_id, $request )
  {
    $this->customer_id = $customer_id;
    $this->request = $request;

    if( $request == 2 ){
      $this->customer_id = $this->pc_transform_id();
    }
  }

  private function pc_transform_id(){
    global $wpdb;

    $query = 'SELECT
               `pc_customer_id`
               FROM `' . $wpdb->prefix . 'pc_customers_tbl`
               WHERE `pc_user_id` = ' . $this->customer_id;

    $row = $wpdb->get_results( $query, 'ARRAY_A' );
    $output = $row[0]['pc_customer_id'];

    return $output;
  }

  public function pc_get_customer_raw_info(){
    global $wpdb;

    $query = 'SELECT * FROM '. $wpdb->prefix . 'pc_customers_tbl WHERE pc_customer_id = %d';

    $output = $wpdb->get_results(
      $wpdb->prepare($query, [$this->customer_id]),
      'ARRAY_A'
    );

    return $output;

  }

  public function pc_get_customer_info(){
    global $wpdb;

    $query = 'SELECT
                c.pc_customer_id,
                c.name,
                c.mail,
                c.phone,
                p.country,
                c.city,
                c.age,
                c.weight,
                c.height,
                a.activity,
                g.goal,
                c.percent,
                e.training,
                c.days_week,
                t.area,
                c.sports,
                d.diet,
                c.calories,
                c.meals,
                c.intolerances,
                c.supplementation,
                c.user_photo_id,
                c.start_date,
                c.notes
               FROM `' . $wpdb->prefix . 'pc_customers_tbl` c
               JOIN `' . $wpdb->prefix . 'pc_countries_tbl` p
               ON p.id = c.country
               JOIN `' . $wpdb->prefix . 'pc_physical_activities_tbl` a
               ON a.id = c.physical_activity
               JOIN `' . $wpdb->prefix . 'pc_goals_tbl` g
               ON g.id = c.goal
               JOIN `' . $wpdb->prefix . 'pc_trainings_tbl` e
               ON e.id = c.training
               JOIN `' . $wpdb->prefix . 'pc_training_areas_tbl` t
               ON t.id = c.training_area
               JOIN `' . $wpdb->prefix . 'pc_diets_tbl` d
               ON d.id = c.diet ';

    //Admin view checks pc_customer_id
    if( $this->request == 1 ){

      $where_query = 'WHERE c.pc_customer_id = %d';

      $query = $query . $where_query;

      $output = $wpdb->get_results(
        $wpdb->prepare($query, [$this->customer_id]),
        'ARRAY_A'
      );

      $user_photo = $this->pc_get_user_image( $output[0]['user_photo_id'] );

      $output[0]['user_photo'] = $user_photo;

      $formatted_date = $this->pc_format_date( $output[0]['start_date'] );

      $output[0]['start_date_formatted'] = $formatted_date;

      $current_week = $this->pc_get_current_week( $output[0]['start_date'] );

      $output[0]['current_week'] = $current_week;

      return $output;

    //Customer view checks pc_user_id
    }elseif ( $this->request == 2 ) {

      $where_query = 'WHERE c.pc_customer_id = ' . $this->customer_id;

      $query = $query . $where_query;

      $output = $wpdb->get_results( $query, 'ARRAY_A' );

      $user_photo = $this->pc_get_user_image( $output[0]['user_photo_id'] );

      $output[0]['user_photo'] = $user_photo;

      $formatted_date = $this->pc_format_date( $output[0]['start_date'] );

      $output[0]['start_date_formatted'] = $formatted_date;

      $current_week = $this->pc_get_current_week( $output[0]['start_date'] );

      $output[0]['current_week'] = $current_week;

      return $output;
    }

  }

  public function pc_get_customer_progress(){

      global $wpdb;

      $query = 'SELECT
                 `week`,
                 `weight`
                 FROM `' . $wpdb->prefix . 'pc_follow_up_tbl`
                 WHERE `user_id` = ' . $this->customer_id;

      $output = $wpdb->get_results( $query, 'ARRAY_A' );

      return $output;

  }

  public function pc_get_max_follow_up_week(){
    global $wpdb;

    $query = 'SELECT
                MAX(`week`) AS most_recent
                FROM `' . $wpdb->prefix . 'pc_follow_up_tbl`
                WHERE `user_id` = ' . $this->customer_id;

    $output = $wpdb->get_results( $query, 'ARRAY_A' );

    $max_follow_up_week = $output[0]['most_recent'];

    return $max_follow_up_week;
  }

  private function pc_get_user_image( $user_photo_id ){

    $user_photo = wp_get_attachment_image(
                      $user_photo_id,
                      array ( '400', '400' ),
                      "",
                      array ( 'class'=>'personal__photo' )
                  );

    return $user_photo;

  }

  private function pc_format_date( $date ){

    $unix_time = strtotime( $date );

    $formatted_date = strftime( '%e/%m/%Y', $unix_time );

    return $formatted_date;

  }

  public static function pc_get_current_week( $start_date ){

    $unix_time = strtotime( $start_date );
    $start_week = date( 'W', $unix_time );
    $current_year_week = date( 'W' );
    $start_year = date( 'o', $unix_time );
    $current_year = date( 'o' );

    if( $start_year == $current_year ){
      if( $start_week >= $current_year_week ){
        $current_customer_week = 1;
      }else{
        $current_customer_week = ( $current_year_week - $start_week ) + 1;
      }
    }elseif( $start_year < $current_year ){
      $customer_full_years = ( $current_year - $start_year ) - 1;
      $customer_full_year_weeks = $customer_full_years * 52;
      $customer_first_year_weeks = ( 52 - $start_week ) + 1;

      $current_customer_week = $customer_full_year_weeks + $customer_first_year_weeks + $current_year_week;
    }elseif( $start_year > $current_year ){
      $current_customer_week = 1;
    }

    return $current_customer_week;

  }
}
