<?php

/**
 * Controller for the user view shortcode
 */
class Personal_Coach_Customer_View
{

  private $url_file;

  public function __construct( $url_file_view )
  {
    $this->url_file = $url_file_view;
  }

  public function pc_create_customer_view(){
    $customer_view_template  = file_get_contents( $this->url_file, true );
    $pc_customer_info        = $this->echo_customer_info();
    $user_view_template      = str_replace( 'USER_INFO',
                                        $pc_customer_info,
                                        $customer_view_template );

    return $user_view_template;
  }

  private function echo_customer_info(){

    if( !is_user_logged_in() ){
      wp_die( 'You are not logged in' );
    }

    $user_id     = get_current_user_id();

    $customer    = new Pc_Customer( $user_id, 2 );

    $user_info   = $customer->pc_get_customer_info();

    $user_weights = $customer->pc_get_customer_progress();

    ob_start();
    ?>
    <div class="row">
      <div class="col-12 col-lg-5">

        <div class="personal__container container">

          <div class="personal row">
            <div class="col-12">
              <?php echo $user_info[0]['user_photo']; ?>
            </div>
          </div>

          <div class="personal row">
            <div class="col-12">
              <h3 class="personal__header">DATOS PERSONALES</h3>
                <ul class="personal__info">
                  <li>Edad : <?php echo $user_info[0]['age']; ?> años</li>
                  <li>Peso inicial : <?php echo $user_info[0]['weight']; ?> Kg.</li>
                  <li>Altura : <?php echo $user_info[0]['height']; ?> cm.</li>
                  <li>País : <?php echo $user_info[0]['country']; ?></li>
                  <li>Ciudad : <?php echo $user_info[0]['city']; ?></li>
                  <li>Porcentaje de grasa estimado : <?php echo $user_info[0]['percent']; ?> %</li>
                </ul>
            </div>
          </div>

          <div class="personal row">
            <div class="col-12">
              <h3 class="personal__header">CONTACTO</h3>
                <ul class="personal__info">
                  <li>Teléfono : <?php echo $user_info[0]['phone']; ?></li>
                  <li>Mail : <?php echo $user_info[0]['mail']; ?></li>
                </ul>
            </div>
          </div>

          <div class="personal row">
            <div class="col-12">
              <h3 class="personal__header">FECHA DE INICIO</h3>
                <ul class="personal__info">
                  <li><?php echo $user_info[0]['start_date_formatted']; ?></li>
                </ul>
            </div>
          </div>

          <!--<div class="personal row">
            <div class="col-12">
              <h3 class="personal__header">FECHA DE RENOVACIÓN</h3>
                <ul class="personal__info">
                  <li><span>1/02/2020</span></li>
                </ul>
            </div>
          </div>-->

          <div class="personal row">
            <div class="col-12">
              <h3 class="personal__header">SEMANA ACTUAL</h3>
                <ul class="personal__info">
                  <li>Semana <span><?php echo $user_info[0]['current_week']; ?></span></li>
                </ul>
            </div>
          </div>

          <!--<div class="personal row">
            <div class="col-12">
              <h3 class="personal__header">PRÓXIMA VIDEOLLAMADA</h3>
                <ul class="personal__info">
                  <li><span>15/01/2020</span></li>
                </ul>
            </div>
          </div>-->

        </div><!-- End personal__container -->

      </div><!-- End col -->

      <div class="col-12 col-lg-7">

        <div class="training__container container">

          <div class="important-info row">
            <div class="col-12">
              <h1 class="important-info__name"><?php echo $user_info[0]['name']; ?></h1>
              <h2 >OBJETIVO: <?php echo $user_info[0]['goal']; ?></h2>
            </div>
          </div>


          <div id="accordion_user_info">

            <h3 class="training__header">ENTRENAMIENTO</h3>
            <div class="training">
              <div>
                <ul class="training__info">
                  <li>Tipo de entrenamiento : <?php echo $user_info[0]['training']; ?></li>
                  <li>Días a la semana : <?php echo $user_info[0]['days_week']; ?> días</li>
                  <li>Lugar de entrenamiento : <?php echo $user_info[0]['area']; ?></span></li>
                  <li>Actividad física : <?php echo $user_info[0]['activity']; ?></li>
                  <li>Otros deportes : <?php echo $user_info[0]['sports']; ?></li>
                  <li>Notas : <?php echo $user_info[0]['notes']; ?></li>
                </ul>
              </div>
            </div>

            <h3 class="training__header">DIETA</h3>
            <div class="training">
              <div>
                <ul class="training__info">
                  <li>Tipo de dieta : <?php echo $user_info[0]['diet']; ?></li>
                  <li>Calorías a consumir : <?php echo $user_info[0]['calories']; ?> Kcal</li>
                  <li>Número de comidas : <?php echo $user_info[0]['meals']; ?></li>
                  <li>Intolerancias : <?php echo $user_info[0]['intolerances']; ?></li>
                  <li>Suplementación : <?php echo $user_info[0]['supplementation']; ?></li>
                </ul>
              </div>
            </div>

            <h3 class="training__header">SEGUIMIENTO SEMANAL</h3>
            <div class="training">
              <?php
                $most_recent = $customer->pc_get_max_follow_up_week();
                $current     = $user_info[0]['current_week'];
              ?>
              <?php if( $current == $most_recent ): ?>
                <p>Ya has registrado tu avance para esta semana.</p>
              <?php else: ?>
                  <form id="follow-up_form">

                    <input id="customer_id" type="hidden" name="customer_id" value="<?php echo $user_info[0]['pc_customer_id']; ?>">

                    <label class="follow-up__label" for="current_weight">Peso actual en ayunas</label>
                    <input id="weight" class="follow-up__input--short" type="number" name="current_weight" value="" required>
                    <p class="follow-up__input-units">Kg.</p>

                    <label class="follow-up__label" for="answer_1">¿Has tenido dificultades para seguir el plan? ¿Cuáles?</label><br>
                    <textarea id="answer_1" name="answer_1" rows="4" cols="50" required></textarea>

                    <label class="follow-up__label" for="answer_2">¿Algo que te gustaría añadir o cambiar?</label><br>
                    <textarea id="answer_2" name="answer_2" rows="4" cols="50" required></textarea>

                    <label class="follow-up__label" for="answer_3">¿Sientes especial dificultad en algún ejercicio? ¿Cuál y por qué?</label><br>
                    <textarea id="answer_3" name="answer_3" rows="4" cols="50" required></textarea>

                    <label class="follow-up__label" for="answer_3">Otras observaciones</label><br>
                    <textarea id="answer_4" name="answer_3" rows="4" cols="50" required></textarea><br>

                    <label class="follow-up__label" for="photo">Adjuntar foto</label>
                    <input id="photo" type="file" name="photo" value="" required>

                    <button id="pc_send_button" class="form__button" type="submit" name="send">Registrar</button>

                  </form>
              <?php endif; ?>
            </div>

            <h3 class="training__header">PROGRESO</h3>
            <div class="training">
              <table>
                <tr>
                  <?php foreach ($user_weights as $user_weight): ?>
                    <td class="progress_weight"><?php echo $user_weight['weight']; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach ($user_weights as $week): ?>
                    <td class="progress_week"><?php echo $week['week']; ?></td>
                  <?php endforeach; ?>
                </tr>
              </table>
            </div>

            <h3 id="pc_chart_accordion_container" class="training__header">APTITUDES</h3>
            <div class="training">
              <div id="pc_chart" style="width: 100%;"></div>
            </div>

          </div><!-- End accordion -->

        </div><!-- End training__container -->

      </div><!-- End col -->


    </div><!-- End row -->

    <?php

    return ob_get_clean();

  }

}
