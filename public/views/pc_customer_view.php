<?php
      if( current_user_can( 'subscriber' ) ){
        $user_id        = get_current_user_id();
        $customer       = new Pc_Customer( $user_id, 2 );
        $user_info      = $customer->pc_get_customer_info();
        $user_weights   = $customer->pc_get_customer_progress();
        $user_plans      = $customer->pc_get_customer_plan();
      } elseif( current_user_can( 'administrator' ) ) {
        $user_info = array();
        $user_info[0]['user_photo'] = '';
        $user_info[0]['height'] = '';
        $user_info[0]['weight'] = '';
        $user_info[0]['name'] = '';
        $user_info[0]['mail'] = '';
        $user_info[0]['phone'] = '';
        $user_info[0]['country'] = '';
        $user_info[0]['city'] = '';
        $user_info[0]['goal'] = '';
        $user_info[0]['age'] = '';
        $user_info[0]['start_date_formatted'] = '';
        $user_info[0]['training'] = '';
        $user_info[0]['days_week'] = '';
        $user_info[0]['area'] = '';
        $user_info[0]['activity'] = '';
        $user_info[0]['sports'] = '';
        $user_info[0]['notes'] = '';
        $user_info[0]['diet'] = '';
        $user_info[0]['calories'] = '';
        $user_info[0]['meals'] = '';
        $user_info[0]['intolerances'] = '';
        $user_info[0]['supplementation'] = '';
        $user_info[0]['current_week'] = '';
        $user_info[0]['percent'] = '';
        $user_weights = array();
        $user_plans = array();
      }else{
        wp_die( 'Fatal error, contact the admin.' );
      }
?>
<h1>Información de usuario</h1>
<div class="pc_container_main_div">
<div class="pc_main_div">
  <div class="container">

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
                if( current_user_can( 'subscriber' ) ){
                  $most_recent = $customer->pc_get_max_follow_up_week();
                }else{
                  $most_recent = '';
                }
                $current     = $user_info[0]['current_week'];
              ?>
              <?php if( $current == $most_recent ): ?>
                <p>Ya has registrado tu avance para esta semana.</p>
              <?php else: ?>
                  <form id="follow-up_form">

                    <input id="customer_id" type="hidden" name="customer_id" value="<?php echo $user_info[0]['pc_customer_id']; ?>">

                    <label class="follow-up__label" for="current_weight">Peso actual en ayunas</label>
                    <input id="weight" class="follow-up__input--short" type="float" name="current_weight" value="" required>
                    <p class="follow-up__input-units">Kg.</p>

                    <label class="follow-up__label" for="answer_1">¿Has tenido dificultades para seguir el plan? ¿Cuáles?</label><br>
                    <textarea id="answer_1" name="answer_1" rows="4" cols="50"></textarea>

                    <label class="follow-up__label" for="answer_2">¿Algo que te gustaría añadir o cambiar?</label><br>
                    <textarea id="answer_2" name="answer_2" rows="4" cols="50"></textarea>

                    <label class="follow-up__label" for="answer_3">¿Sientes especial dificultad en algún ejercicio? ¿Cuál y por qué?</label><br>
                    <textarea id="answer_3" name="answer_3" rows="4" cols="50"></textarea>

                    <label class="follow-up__label" for="answer_3">Otras observaciones</label><br>
                    <textarea id="answer_4" name="answer_3" rows="4" cols="50"></textarea><br>

                    <label class="follow-up__label" for="photo">Adjuntar foto</label>
                    <input id="photo" type="file" name="photo" value="">

                    <button id="pc_customer_follow_up_reg" class="form__button" type="submit" name="send">Registrar</button>

                  </form>

                  <div id="follow_up_reg_status"></div>
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

            <h3 id="pc_chart_accordion_container" class="training__header">PLAN</h3>
                <div class="training">
                <?php foreach($user_plans as $plan): ?>
                    <table>
                      <thead>
                        <tr>
                          <th>
                            Descarga tu plan
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <?php 
                              echo $plan['comments']; 
                            ?>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                        <td>
                          <a href="
                            <?php 
                              echo wp_get_attachment_url( $plan['file_id'] );
                            ?>
                          ">click para descargar plan</a>
                        </td>
                        </tr>
                      </tfoot>
                    </table>
                <?php endforeach; ?>
                </div><!-- End training -->


          </div><!-- End accordion -->

        </div><!-- End training__container -->

      </div><!-- End col -->


    </div><!-- End row -->
    
  </div><!-- End Bootstrap container -->
</div><!-- End main div -->
</div><!-- End container main div -->
