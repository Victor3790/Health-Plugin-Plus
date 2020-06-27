(function($){
  $(document).ready(function(){
    var photo;

    //Get the file
    $('#registration_photo').change(function(){
      photo = this.files[0];
    });

    //Get the mail
    $('#pc_user_id_reg').change(function(){
      let mail = $.trim($('#pc_user_id_reg option:selected').html());
      $('#mail').val( mail );
    });

    //Validate the form
    $('#user_registration_form').validate({

      rules: {
        user: 'required',
        name: {
          required: true,
          minlength: 9
        },
        phone: 'required',
        country: 'required',
        city: 'required',
        start_date_view: 'required',
        age:  {
          required: true,
          range: [ 8, 99 ]
        }, 
        weight: {
          required: true,
          range: [ 9, 250 ]
        },
        height: {
          required: true,
          range: [ 10, 290 ]
        },
        physical_activity: 'required',
        gender: 'required',
        percent:{
          required: true,
          range: [ 0, 100 ]
        },
        goal: 'required',
        training: 'required',
        days_week: {
          required: true,
          range: [ 1, 7 ]
        },
        training_area: 'required',
        sports: 'required',
        diet: 'required',
        meals: 'required',
        intolerances: 'required',
        supplementation: 'required',
        reg_photo: 'required'
      },
      messages: {
        user: 'Selecciona un usuario',
        name: {
          required: 'Ingresa el nombre.',
          minlength: jQuery.validator.format("Por lo menos {0} caracteres.")
        },
        phone: 'Ingresa el teléfono',
        country: 'Selecciona un país',
        city: 'Ingresa una ciudad',
        start_date_view: 'Selecciona la fecha de inicio',
        age: {
          required: 'Ingresa la edad',
          range: '¿La edad es correcta?'
        },
        weight: {
          required: 'Ingresa el peso',
          range: '¿El peso es correcto?'
        },
        height: {
          required: 'Ingresa la altura',
          range: '¿La altura es correcta?'
        },
        physical_activity: 'Selecciona la actividad física',
        gender: 'Selecciona un sexo',
        percent: {
          required: 'Ingresa el porcentage de grasa',
          range: 'Verifica el porcentaje'
        },
        goal: 'Selecciona un objetivo',
        training: 'Selecciona el tipo de entrenamiento',
        days_week: 'Ingresa los días de la semana',
        training_area: 'Selecciona el lugar de entrenamiento',
        sports: 'Ingresa otros deportes que el cliente practica o "ninguno"',
        diet: 'Selecciona el tipo de dieta',
        meals: 'Ingresa el número de comidas al día',
        intolerances: 'Ingresa alguna intolerancia o "ninguna"',
        supplementation: 'Ingresa la suplementación',
        reg_photo: 'Por favor selecciona una foto'
      },
      submitHandler: function(){
        pc_send_form(event);
      }

    });

    //Register the user
    function pc_send_form(event){

      event.preventDefault();

      $('#pc_send_button').attr('disabled', true);
  
      var formData = new FormData();

      formData.append( 'pc_user_id',        $( '#pc_user_id_reg' ).val() );
      formData.append( 'name',              $( '#name' ).val() );
      formData.append( 'mail',              $( '#mail' ).val() );
      formData.append( 'phone',             $( '#phone' ).val() );
      formData.append( 'country',           $( '#country' ).val() );
      formData.append( 'city',              $( '#city' ).val() );
      formData.append( 'start_date',        $( '#start-date' ).val() );
      formData.append( 'age',               $( '#age' ).val() );
      formData.append( 'sex',               $( 'input[name = "gender"]:checked' ).val() );
      formData.append( 'weight',            $( '#weight' ).val() );
      formData.append( 'height',            $( '#height' ).val() );
      formData.append( 'physical_activity', $( '#physical_activity' ).val() );
      formData.append( 'goal',              $( '#goal' ).val() );
      formData.append( 'percent',           $( '#percent' ).val() );
      formData.append( 'training',          $( '#training' ).val() );
      formData.append( 'days_week',         $( '#days_week' ).val() );
      formData.append( 'training_area',     $( '#training_area' ).val() );
      formData.append( 'sports',            $( '#sports' ).val() );
      formData.append( 'diet',              $( '#diet' ).val() );
      formData.append( 'calories',          $( '#calories' ).val() );
      formData.append( 'meals',             $( '#meals' ).val() );
      formData.append( 'intolerances',      $( '#intolerances' ).val() );
      formData.append( 'supplementation',   $( '#supplementation' ).val() );
      formData.append( 'photo',             photo );
      formData.append( 'notes',             $( '#notes' ).val() );
      formData.append( 'action', 'pc_user_registration' );

      $.ajax({
        url:  ajax_customer_registration_object.ajax_url,
        type: 'POST',
        data: formData,
        contentType:false,
        cache:false,
        processData:false,
        success: on_user_registration_success,
        error: on_user_registration_error
      });
    }

    function on_user_registration_success( result ){
      if( result.code === 0 ){
        $('#user_registration_status').text(result.message);
        $('#pc_send_button').attr('disabled', false);
      }else if( result.code === 1 ){
        $('#user_registration_status').text( result.message );
        $('#new_user').show();
      }
    }

    function on_user_registration_error(){
      $('#user_registration_status')
        .text('Error, no fue posible registrar el usuario, contacte al administrador.');
    }

    $('#new_user').click(function(){
        $( '#user_registration_form')[0].reset();
        $( '#user_registration_status' ).html('');
        $( '#new_user' ).hide();
        $( '#pc_send_button' ).attr('disabled', false);
        $( window ).scrollTop(90);
    });
  });
})(jQuery);
