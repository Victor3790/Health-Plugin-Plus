<div id="admin-tabs" style="max-width:100%; background-color:#fff;">
  <ul>
    <li><a href="#active_customers">Clientes activos</a></li>
    <li><a href="#customer_info">Información de clientes</a></li>
    <li><a href="#weekly_follow_up">Avance semanal</a></li>
    <li><a href="#add_customer">Nuevo cliente</a></li>
    <li><a href="#inactive_customers">Clientes inactivos</a></li>
  </ul>

  <div class="tab" id="active_customers">
    <table>
    </table>
    <div id="active_customers_loader" class="loader">
      <div class="lds-dual-ring"></div>
    </div>
  </div>

  <div class="tab" id="inactive_customers">
      <table>
      </table>
      <div id="inactive_customers_loader" class="loader">
        <div class="lds-dual-ring"></div>
      </div>
  </div>

  <div id="customer_info">
    <h1>Información de usuario</h1>
    <form id="pc_customer_select">
      PC_USERS_INFO
    </form>
    <div class="tab">
      <div id="info_customers_loader" class="loader clustomer_info_loader">
        <div class="lds-dual-ring"></div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-5">

            <div class="personal__container container">

              <div class="personal row">
                <div class="col-12">
                  <span id="pc_user_image"></span>
                </div>
              </div>

              <div class="personal row">
                <div class="col-12">
                  <h3 class="personal__header">DATOS PERSONALES</h3>
                    <ul class="personal__info">
                      <li>Edad : <span id="pc_user_age"></span> años</li>
                      <li>Peso inicial : <span id="pc_user_weight"></span> Kg.</li>
                      <li>Altura : <span id="pc_user_height"></span> cm.</li>
                      <li>País : <span id="pc_user_country"></span></li>
                      <li>Ciudad : <span id="pc_user_city"></span></li>
                      <li>Porcentaje de grasa estimado : <span id="pc_user_percent"></span> %</li>
                    </ul>
                </div>
              </div>

              <div class="personal row">
                <div class="col-12">
                  <h3 class="personal__header">CONTACTO</h3>
                    <ul class="personal__info">
                      <li>Teléfono : <span id="pc_user_phone"></span></li>
                      <li>Mail : <span id="pc_user_mail"></span></li>
                    </ul>
                </div>
              </div>

              <div class="personal row">
                <div class="col-12">
                  <h3 class="personal__header">FECHA DE INICIO</h3>
                    <ul class="personal__info">
                      <li><span id="pc_start_date"></span></li>
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
                      <li>Semana <span id="pc_current_week"></span></li>
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
                  <h1 id="pc_user_name" class="important-info__name"></h1>
                  <h2 >OBJETIVO: <span id="pc_user_goal"></span></h2>
                </div>
              </div>


              <div id="accordion_user_info">

                <h3 class="training__header">ENTRENAMIENTO</h3>
                <div class="training">
                  <div>
                    <ul class="training__info">
                      <li>Tipo de entrenamiento : <span id="pc_user_training"></span></li>
                      <li>Días a la semana : <span id="pc_user_days_week"></span> días</li>
                      <li>Lugar de entrenamiento : <span id="pc_user_training_area"></span></li>
                      <li>Actividad física : <span id="pc_user_activity"></span></li>
                      <li>Otros deportes : <span id="pc_user_sports"></span></li>
                      <li>Notas : <span id="pc_user_notes"></span></li>
                    </ul>
                  </div>
                </div>

                <h3 class="training__header">DIETA</h3>
                <div class="training">
                  <div>
                    <ul class="training__info">
                      <li>Tipo de dieta : <span id="pc_user_diet"></span></li>
                      <li>Calorías a consumir : <span id="pc_user_calories"></span> Kcal</li>
                      <li>Número de comidas : <span id="pc_user_meals"></span></li>
                      <li>Intolerancias : <span id="pc_user_intolerances"></span></li>
                      <li>Suplementación : <span id="pc_user_supplementation"></span></li>
                    </ul>
                  </div>
                </div>

                <h3 class="training__header">PROGRESO</h3>
                <div class="training">
                  <table>
                    <tr id="weights"></tr>
                    <tr id="weeks"></tr>
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
      </div><!-- End Bootstrap container -->
    </div>

  </div><!-- End customer_info -->

  <div id="add_customer">
    <form id="user_registration_form" enctype=”multipart/form-data” class="follow-up__form">

      USER_IDS

      <label for="name" class="follow-up__label">Nombre</label><br>
      <input id="name" class="follow-up__input" type="text" name="name" value="" required><br>

      <input id="mail" type="hidden" name="mail" value="">

      <label for="phone" class="follow-up__label">Teléfono</label><br>
      <input id="phone" class="follow-up__input" type="tel" name="phone" value=""required><br>

      COUNTRIES

      <label for="city" class="follow-up__label">Ciudad</label><br>
      <input id="city" class="follow-up__input" type="text" name="city" value=""required><br>

      <label for="start-date" class="follow-up__label">Fecha de inicio</label><br>
      <input id="start-date-view" class="follow-up__input" type="text" name="start-date-view" required><br>
      <input id="start-date" type="hidden" name="start-date">

      <fieldset class="follow-up__fieldset">

        <legend>Calcular calorías a consumir.</legend>

        <label for="age" class="follow-up__label">Edad</label><br>
        <input id="age" class="follow-up__input--short" type="number" name="age" value="" required>
        <p class="follow-up__input-units">años.</p>

        <label for="weight" class="follow-up__label">Peso</label><br>
        <input id="weight" class="follow-up__input--short" type="text" name="weight" value="" required>
        <p class="follow-up__input-units">Kg.</p>

        <label for="height" class="follow-up__label">Altura</label><br>
        <input id="height" class="follow-up__input--short" type="text" name="height" value="" required>
        <p class="follow-up__input-units">cm.</p>

        PHYSICAL_ACTIVITIES

        <div class="row">
          <div class="col-12">
            <p class="follow-up__label">Sexo</p>
          </div>
          <div class="col-6 col-md-4 col-xl-2">
            <input type="radio" id="male" name="gender" value="M">
            <label for="male">Hombre</label>
          </div>
          <div class="col-6 col-md-4 col-xl-2">
            <input type="radio" id="female" name="gender" value="F">
            <label for="female">Mujer</label>
          </div>
        </div>

        <label for="calories" class="follow-up__label">Calorías a consumir</label><br>
        <input id="calories" class="follow-up__input--short" type="text" name="calories" value="" readonly required>
        <p class="follow-up__input-units">Kcal.</p>

      </fieldset>

      <label for="percent" class="follow-up__label">Porcentaje</label><br>
      <input id="percent" class="follow-up__input--short" type="text" name="percent" value="" required>
      <p class="follow-up__input-units">%.</p>

      GOALS

      TRAININGS

      <label for="days_week" class="follow-up__label">Días a la semana</label><br>
      <input id="days_week" class="follow-up__input" type="text" name="days_week" value="" required><br>

      TRAINING_AREAS

      <label for="sports" class="follow-up__label">Otros deportes</label><br>
      <input id="sports" class="follow-up__input" type="text" name="sports" value="" required><br>

      DIETS

      <label for="meals" class="follow-up__label">Número de comidas</label><br>
      <input id="meals" class="follow-up__input" type="text" name="meals" value="" required><br>

      <label for="intolerances" class="follow-up__label">Intolerancias</label><br>
      <input id="intolerances" class="follow-up__input" type="text" name="intolerances" value=""required.><br>

      <label for="supplementation" class="follow-up__label">Suplementación</label><br>
      <input class="follow-up__input" id="supplementation" type="text" name="supplementation" value="" required><br>

      <label for="photo" class="follow-up__label">Adjuntar foto</label><br>
      <input class="follow-up__input" id="photo" type="file" required>

      <label for="notes" class="follow-up__label">Notas</label><br>
      <textarea id="notes" name="notes"></textarea>

      <button id="pc_send_button" class="form__button" type="submit" name="send">Registrar</button>
    </form>
    <div id="user_registration_status"></div>
    <p id="new_user" style="cursor:pointer; display:none;">
      <b><u>
        Registrar nuevo usuario.
      </u></b>
    </p>
  </div><!-- End add_customer-->

  <div id="weekly_follow_up">
    <div>
      PC_USERS_PROGRESS
    </div>
    <div class="tab" style="min-height: 100px;">
      <div id="follow_up_loader" class="loader clustomer_info_loader">
        <div class="lds-dual-ring"></div>
      </div>
      <div id="accordion_user_progress">
      </div><!-- End accordion_user_progress -->
    </div>
  </div><!-- End weekly_follow_up -->

</div><!-- End admin-tabs -->
