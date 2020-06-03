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

  public function __construct( $url_file_view, $plugin_name )
  {
    $this->plugin_name = $plugin_name;
    $this->url_file = $url_file_view;
    $this->admin = new Pc_Admin;
    $this->customer_registration = new Pc_Customer_Registration;
    $this->user = new Pc_Ajax_Customer;
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

    //Customer info view

    $admin_view_template  = file_get_contents( $this->url_file, true );
    $pc_users             = $this->echo_pc_customers();
    $admin_view_template  = str_replace( 'PC_USERS_INFO',
                                        $pc_users,
                                        $admin_view_template );

    //Customer registration view
    $active_customers     = $this->echo_pc_active_customers();
    $admin_view_template  = str_replace( 'ACTIVE_CUSTOMERS',
                                        $active_customers,
                                        $admin_view_template );
    $user_ids_info        = $this->echo_pc_user_ids();
    $admin_view_template  = str_replace( 'USER_IDS',
                                        $user_ids_info,
                                        $admin_view_template );
    $countries            = $this->echo_pc_countries();
    $admin_view_template  = str_replace( 'COUNTRIES',
                                        $countries,
                                        $admin_view_template );
    $physical_activities  = $this->echo_pc_physical_activities();
    $admin_view_template  = str_replace( 'PHYSICAL_ACTIVITIES',
                                        $physical_activities,
                                        $admin_view_template );
    $goals                = $this->echo_pc_goals();
    $admin_view_template  = str_replace( 'GOALS',
                                        $goals,
                                        $admin_view_template );
    $trainings            = $this->echo_pc_trainings();
    $admin_view_template  = str_replace( 'TRAININGS',
                                        $trainings,
                                        $admin_view_template );
    $training_areas       = $this->echo_pc_training_areas();
    $admin_view_template  = str_replace( 'TRAINING_AREAS',
                                        $training_areas,
                                        $admin_view_template );
    $diets                = $this->echo_pc_diets();
    $admin_view_template  = str_replace( 'DIETS',
                                        $diets,
                                        $admin_view_template );

    $pc_users_progress    = $this->echo_pc_users_progress();
    $admin_view_template  = str_replace( 'PC_USERS_PROGRESS',
                                        $pc_users_progress,
                                        $admin_view_template );


    return $admin_view_template;

  }

  //Active users
  private function echo_pc_active_customers(){
    ob_start();

    $active_customers = $this->admin->get_pc_active_customers();
    ?>
    <table>
      <tr>
        <th>Nombre</th>
        <th>Mail</th>
        <th>Teléfono</th>

      </tr>
      <?php foreach( $active_customers as $active_customer ): ?>
        <tr>
          <td><?php echo $active_customer->name; ?></td>
          <td><?php echo $active_customer->mail; ?></td>
          <td><?php echo $active_customer->phone; ?></td>
          <td>
            <button class="inactive_customer" type="button" value="<?php echo $active_customer->pc_customer_id; ?>">
              Inactivar
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php

    return ob_get_clean();
  }

  //Get pc users from data base
  private function echo_pc_customers(){

    ob_start();
    $pc_customers = $this->admin->get_pc_customers();
    ?>
    <label for="pc_customer_info">Selecciona un cliente</label>
    <select id="pc_customer_info" name="pc_customer_info" form="pc_customer_select" required>
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

  //Get user ids from data base
  private function echo_pc_user_ids(){

    ob_start();
    $user_ids = get_users( array( 'role'=>'subscriber', 'fields'=>array( 'ID','user_email' ) ) );
    ?>
    <label for="user">Usuario</label>
    <select id="pc_user_id_reg" name="user" form="user_registration_form" required>
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
  private function echo_pc_countries(){

    ob_start();
    $countries = $this->admin->get_pc_countries();

    ?>
    <label for="countries" class="follow-up__label">País</label>
    <select id="country" name="country" form="user_registration_form" required>
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
  private function echo_pc_physical_activities(){

    ob_start();
    $physical_activities = $this->admin->get_pc_physical_activities();
    ?>

    <label for="physical_activities" class="follow-up__label">Actividad física</label>
    <select id="physical_activity" name="physical_activity" form="user_registration_form" required>
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
  private function echo_pc_goals(){

    ob_start();
    $goals = $this->admin->get_pc_goals();
    ?>

    <label for="goals" class="follow-up__label">Objetivo</label>
    <select id="goal" name="goal" form="user_registration_form" required>
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
  private function echo_pc_trainings(){

    global $wpdb;

    ob_start();
    $trainings = $this->admin->get_pc_trainings();
    ?>

    <label for="trainings" class="follow-up__label">Tipo de entrenamiento</label>
    <select id="training" name="training" form="user_registration_form" required>
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
  private function echo_pc_training_areas(){

    ob_start();
    $training_areas = $this->admin->get_pc_training_areas();
    ?>

    <label for="training_area" class="follow-up__label">Lugar de entrenamieto</label>
    <select id="training_area" name="training_area" form="user_registration_form" required>
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
  private function echo_pc_diets(){

    ob_start();
    $diets = $this->admin->get_pc_diets();
    ?>

    <label for="diet" class="follow-up__label">Tipo de dieta</label>
    <select id="diet" name="diet" form="user_registration_form" required>
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
    $pc_users = $this->admin->get_pc_users_progress();
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
