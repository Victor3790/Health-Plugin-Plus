<?php
/**
 * Controller for the admin view shortcode
 */
class Personal_Coach_Admin_View
{
  private $plugin_name;
  private $url_file;
  private $admin;
  private $customer_registration;
  private $user;
  private $follow_up;
  private $prev_follow_up_reg;
  private $customers;
  private $countries;
  private $physical_activities;
  private $goals;
  private $trainings;
  private $training_areas;
  private $diets;

  public function __construct( $url_file_view, $plugin_name )
  {
    $this->plugin_name = $plugin_name;
    $this->url_file = $url_file_view;
    $this->admin = new Pc_Admin;
    $this->customer_registration = new Pc_Customer_Registration;
    $this->customer_registration = new Pc_Customer_Update;
    $this->user = new Pc_Ajax_Customer;
    $this->follow_up = new Pc_Follow_Up;
    $this->prev_follow_up_reg = new Pc_Prev_Follow_Up_Registration;

    $this->customers =  $this->admin->get_pc_customers();
    $this->countries =  $this->admin->get_pc_countries();
    $this->physical_activities = $this->admin->get_pc_physical_activities();
    $this->goals = $this->admin->get_pc_goals();
    $this->trainings = $this->admin->get_pc_trainings();
    $this->training_areas = $this->admin->get_pc_training_areas();
    $this->diets = $this->admin->get_pc_diets();
  }

  public function pc_create_admin_view(){

    wp_enqueue_style( $this->plugin_name . '_bootstrap' );
    wp_enqueue_style( $this->plugin_name . '_customer_view' );
    wp_enqueue_style( $this->plugin_name . '_admin_view' );
    wp_enqueue_style( $this->plugin_name . '_tab_theme' );

    wp_enqueue_script( $this->plugin_name . '_accordion' );
    wp_enqueue_script( $this->plugin_name . '_tabs' );
    wp_enqueue_script( $this->plugin_name . '_date_picker' );
    wp_enqueue_script( $this->plugin_name . '_form_validator' );
    wp_enqueue_script( $this->plugin_name . '_pc_form_validator' );
    wp_enqueue_script( $this->plugin_name . '_calory_calculator' );
    wp_enqueue_script( $this->plugin_name . '_google_charts' );
    wp_enqueue_script( $this->plugin_name . '_pc_charts' );
    wp_enqueue_script( $this->plugin_name . '_customer_registration' );
    wp_enqueue_script( $this->plugin_name . '_admin_view_customer_info' );
    wp_enqueue_script( $this->plugin_name . '_admin_view_customer_follow_up' );
    wp_enqueue_script( $this->plugin_name . '_get_customer_info' );
    wp_enqueue_script( $this->plugin_name . '_update_customer' );
    wp_enqueue_script( $this->plugin_name . '_admin_progress_registration' );

    //Customer info view

    $admin_view_template  = file_get_contents( $this->url_file, true );
    $pc_users             = $this->echo_pc_customers('pc_customer_info', 'user_registration_form');
    $admin_view_template  = str_replace( 'INFO_CUSTOMERS_IDS',
                                        $pc_users,
                                        $admin_view_template );
    $user_ids_info        = $this->echo_pc_user_ids();
    $admin_view_template  = str_replace( 'USER_IDS',
                                        $user_ids_info,
                                        $admin_view_template );
    $countries            = $this->echo_pc_countries('country', 'user_registration_form');
    $admin_view_template  = str_replace( 'REGISTER_CUSTOMER_COUNTRIES',
                                        $countries,
                                        $admin_view_template );
    $physical_activities  = $this->echo_pc_physical_activities('physical_activity', 'user_registration_form');
    $admin_view_template  = str_replace( 'REGISTER_CUSTOMER_PHYSICAL_ACTIVITIES',
                                        $physical_activities,
                                        $admin_view_template );
    $goals                = $this->echo_pc_goals('goal', 'user_registration_form');
    $admin_view_template  = str_replace( 'REGISTER_CUSTOMER_GOALS',
                                        $goals,
                                        $admin_view_template );
    $trainings            = $this->echo_pc_trainings('training', 'user_registration_form');
    $admin_view_template  = str_replace( 'REGISTER_CUSTOMER_TRAININGS',
                                        $trainings,
                                        $admin_view_template );
    $training_areas       = $this->echo_pc_training_areas('training_area', 'user_registration_form');
    $admin_view_template  = str_replace( 'REGISTER_CUSTOMER_TRAINING_AREAS',
                                        $training_areas,
                                        $admin_view_template );
    $diets                = $this->echo_pc_diets('diet', 'user_registration_form');
    $admin_view_template  = str_replace( 'REGISTER_CUSTOMER_DIETS',
                                        $diets,
                                        $admin_view_template );
    $pc_users_progress    = $this->echo_pc_users_progress();
    $admin_view_template  = str_replace( 'PC_USERS_PROGRESS',
                                        $pc_users_progress,
                                        $admin_view_template );
    $pc_update_users      = $this->echo_pc_customers('pc_update_customer_info', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMERS_IDS',
                                        $pc_update_users,
                                        $admin_view_template );
    $pc_update_countries  = $this->echo_pc_countries('update_country', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMER_COUNTRIES',
                                        $pc_update_countries,
                                        $admin_view_template );
    $pc_update_physical_activities  = $this->echo_pc_physical_activities('update_physical_activity', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMER_PHYSICAL_ACTIVITIES',
                                        $pc_update_physical_activities,
                                        $admin_view_template );
    $pc_update_goals                = $this->echo_pc_goals('update_goal', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMER_GOALS',
                                        $pc_update_goals,
                                        $admin_view_template );
    $pc_update_trainings            = $this->echo_pc_trainings('update_training', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMER_TRAININGS',
                                        $pc_update_trainings,
                                        $admin_view_template );
    $pc_update_training_areas       = $this->echo_pc_training_areas('update_training_area', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMER_TRAINING_AREAS',
                                        $pc_update_training_areas,
                                        $admin_view_template );
    $pc_update_diets                = $this->echo_pc_diets('update_diet', 'update_customer_form');
    $admin_view_template  = str_replace( 'UPDATE_CUSTOMER_DIETS',
                                        $pc_update_diets,
                                        $admin_view_template );


    return $admin_view_template;

  }

  //Get pc users from data base
  private function echo_pc_customers( $tab_id, $form_id ){

    ob_start();
    $pc_customers = $this->customers;
    ?>
    <label for="<?php echo $tab_id; ?>">Selecciona un cliente</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
      <option value="">Selecciona</option>
      <?php foreach( $pc_customers as $pc_customer ): ?>
        <option value="<?php echo $pc_customer->pc_customer_id; ?>">
          <?php echo $pc_customer->name; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <br>
    <?php

    return ob_get_clean();
  }

  //Get customer ids from data base
  private function echo_pc_user_ids(){

    ob_start();
    $user_ids = get_users( array( 'role'=>'subscriber', 'fields'=>array( 'ID','user_email' ) ) );
    ?>
    <label for="user">Usuario</label>
    <select id="pc_user_id_reg" name="user" required>
      <option value="">Selecciona</option>
      <?php foreach( $user_ids as $user ): ?>
        <option value="<?php echo $user->ID; ?>">
          <?php echo $user->user_email; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <br>
    <?php

    return ob_get_clean();
  }

  //Get countries from data base
  private function echo_pc_countries( $tab_id, $form_id ){

    ob_start();
    $countries = $this->countries;

    ?>
    <label for="<?php echo $tab_id; ?>" class="follow-up__label">País</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
    <option value="">Selecciona</option>
    <?php foreach( $countries as $country ): ?>
      <option value="<?php echo $country->id; ?>">
        <?php echo $country->country; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
    <?php

    return ob_get_clean();
  }

  //Get physical activities from data base
  private function echo_pc_physical_activities( $tab_id, $form_id ){

    ob_start();
    $physical_activities = $this->physical_activities;
    ?>

    <label for="<?php echo $tab_id; ?>" class="follow-up__label">Actividad física</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
    <option value="">Selecciona</option>
    <?php foreach( $physical_activities as $physical_activity ): ?>
      <option value="<?php echo $physical_activity->id; ?>">
        <?php echo $physical_activity->activity; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
    <?php

    return ob_get_clean();
  }

  //Get goals from data base
  private function echo_pc_goals( $tab_id, $form_id ){

    ob_start();
    $goals = $this->goals;
    ?>

    <label for="<?php echo $tab_id; ?>" class="follow-up__label">Objetivo</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
    <option value="">Selecciona</option>
    <?php foreach( $goals as $goal ): ?>
      <option value="<?php echo $goal->id; ?>">
        <?php echo $goal->goal; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
    <?php

    return ob_get_clean();
  }

  //Get trainings from data base
  private function echo_pc_trainings( $tab_id, $form_id ){

    global $wpdb;

    ob_start();
    $trainings = $this->trainings;
    ?>

    <label for="<?php echo $tab_id; ?>" class="follow-up__label">Tipo de entrenamiento</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
    <option value="">Selecciona</option>
    <?php foreach( $trainings as $training ): ?>
      <option value="<?php echo $training->id; ?>">
        <?php echo $training->training; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
    <?php

    return ob_get_clean();
  }

  //Get training areas from data base
  private function echo_pc_training_areas( $tab_id, $form_id ){

    ob_start();
    $training_areas = $this->training_areas;
    ?>

    <label for="<?php echo $tab_id; ?>" class="follow-up__label">Lugar de entrenamieto</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
    <option value="">Selecciona</option>
    <?php foreach( $training_areas as $training_area ): ?>
      <option value="<?php echo $training_area->id; ?>">
        <?php echo $training_area->area; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
    <?php

    return ob_get_clean();
  }

  //Get diets from data base
  private function echo_pc_diets( $tab_id, $form_id ){

    ob_start();
    $diets = $this->diets;
    ?>

    <label for="<?php echo $tab_id; ?>" class="follow-up__label">Tipo de dieta</label>
    <select id="<?php echo $tab_id; ?>" name="<?php echo $tab_id; ?>" form="<?php echo $form_id; ?>" required>
    <option value="">Selecciona</option>
    <?php foreach( $diets as $diet ): ?>
      <option value="<?php echo $diet->id; ?>">
        <?php echo $diet->diet; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
    <?php

    return ob_get_clean();
  }


  //Get pc users from data base
  private function echo_pc_users_progress(){

    global $wpdb;

    ob_start();
    $pc_users = $this->customers;
    ?>
    <label for="pc_user_follow_up">Selecciona un cliente</label>
    <select id="pc_user_follow_up" name="pc_user_follow_up">
      <option value="">Selecciona</option>
      <?php foreach( $pc_users as $pc_user ): ?>
        <option value="<?php echo $pc_user->pc_customer_id; ?>">
          <?php echo $pc_user->name; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <br>
    <?php

    return ob_get_clean();
  }

}
