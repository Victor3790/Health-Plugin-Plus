(function($){
    $(document).ready(function(){

        $( '#pc_update_customer_info' ).change( function() {

            if(  $( '#pc_update_customer_info' ).val() == 0 ){
                return;
            }
            
            health_plugin_name_space.health_plugin_get_customer_info('raw', $( '#pc_update_customer_info' ).val(), 
              function(result){
                on_success_update_customer_info(result);
              });
        });

        function on_success_update_customer_info(customer_data){
            $('#update_name').val(customer_data[0].name);
            $('#update_phone').val(customer_data[0].phone);
            $('#update_country').val(customer_data[0].country);
            $('#update_city').val(customer_data[0].city);
            let date = new Date(customer_data[0].start_date);
            date = $.datepicker.formatDate( "dd/mm/yy", date );
            $('#update_start_date_view').val(date);
            $('#update_start_date_view').datepicker();
            $('#update_start_date').val(customer_data[0].start_date);
            $('#update_age').val(customer_data[0].age);
            $('#update_weight').val(customer_data[0].weight);
            $('#update_height').val(customer_data[0].height);
            $('#update_physical_activity').val(customer_data[0].physical_activity);
            $('input[name = "update_gender"][value = "' + customer_data[0].sex + '"]')
                .prop("checked",true)
                .trigger('click');
            $('#update_calories').val(customer_data[0].calories);
            $('#update_percent').val(customer_data[0].percent);
            $('#update_goal').val(customer_data[0].goal);
            $('#update_training').val(customer_data[0].training);
            $('#update_days_week').val(customer_data[0].days_week);
            $('#update_training_area').val(customer_data[0].training_area);
            $('#update_sports').val(customer_data[0].sports);
            $('#update_diet').val(customer_data[0].diet);
            $('#update_meals').val(customer_data[0].meals);
            $('#update_intolerances').val(customer_data[0].intolerances);
            $('#update_supplementation').val(customer_data[0].supplementation);
            $('#update_notes').val(customer_data[0].notes);
        }

        //Validate the form
        $('#update_customer_form').validate({

            rules: {
                update_name: {
                    required: true,
                    minlength: 9
                },
                update_phone: 'required',
                update_country: 'required',
                update_city: 'required',
                update_start_date_view: 'required',
                update_age:  {
                    required: true,
                    range: [ 8, 99 ]
                }, 
                update_weight: {
                    required: true,
                    range: [ 9, 250 ]
                },
                update_height: {
                    required: true,
                    range: [ 10, 290 ]
                },
                update_physical_activity: 'required',
                update_gender: 'required',
                update_percent:{
                    required: true,
                    range: [ 0, 100 ]
                },
                update_goal: 'required',
                update_training: 'required',
                update_days_week: {
                    required: true,
                    range: [ 1, 7 ]
                },
                update_training_area: 'required',
                update_sports: 'required',
                update_diet: 'required',
                update_meals: 'required',
                update_intolerances: 'required',
                update_supplementation: 'required',
            },
            messages: {
                update_name: {
                    required: 'Ingresa el nombre.',
                    minlength: jQuery.validator.format("Por lo menos {0} caracteres.")
                },
                update_phone: 'Ingresa el teléfono',
                update_country: 'Selecciona un país',
                update_city: 'Ingresa una ciudad',
                update_start_date_view: 'Selecciona la fecha de inicio',
                update_age: {
                    required: 'Ingresa la edad',
                    range: '¿La edad es correcta?'
                },
                update_weight: {
                    required: 'Ingresa el peso',
                    range: '¿El peso es correcto?'
                },
                update_height: {
                    required: 'Ingresa la altura',
                    range: '¿La altura es correcta?'
                },
                update_physical_activity: 'Selecciona la actividad física',
                update_gender: 'Selecciona un sexo',
                update_percent: {
                    required: 'Ingresa el porcentage de grasa',
                    range: 'Verifica el porcentaje'
                },
                update_goal: 'Selecciona un objetivo',
                update_training: 'Selecciona el tipo de entrenamiento',
                update_days_week: 'Ingresa los días de la semana',
                update_training_area: 'Selecciona el lugar de entrenamiento',
                update_sports: 'Ingresa otros deportes que el cliente practica o "ninguno"',
                update_diet: 'Selecciona el tipo de dieta',
                update_meals: 'Ingresa el número de comidas al día',
                update_intolerances: 'Ingresa alguna intolerancia o "ninguna"',
                update_supplementation: 'Ingresa la suplementación',
            },
            submitHandler: function(){
                pc_send_form(event);
            }
    
        });

        //Update customer info
        function pc_send_form(event){
            event.preventDefault();

            $('#pc_update_button').attr('disabled', true);
    
            var updateFormData = new FormData();
    
            updateFormData.append( 'pc_user_id',        $( '#pc_update_customer_info' ).val() );
            updateFormData.append( 'name',              $( '#update_name' ).val() );
            updateFormData.append( 'phone',             $( '#update_phone' ).val() );
            updateFormData.append( 'country',           $( '#update_country' ).val() );
            updateFormData.append( 'city',              $( '#update_city' ).val() );
            updateFormData.append( 'start_date',        $( '#update_start_date' ).val() );
            updateFormData.append( 'age',               $( '#update_age' ).val() );
            updateFormData.append( 'sex',               $( 'input[name = "update_gender"]:checked' ).val() );
            updateFormData.append( 'weight',            $( '#update_weight' ).val() );
            updateFormData.append( 'height',            $( '#update_height' ).val() );
            updateFormData.append( 'physical_activity', $( '#update_physical_activity' ).val() );
            updateFormData.append( 'goal',              $( '#update_goal' ).val() );
            updateFormData.append( 'percent',           $( '#update_percent' ).val() );
            updateFormData.append( 'training',          $( '#update_training' ).val() );
            updateFormData.append( 'days_week',         $( '#update_days_week' ).val() );
            updateFormData.append( 'training_area',     $( '#update_training_area' ).val() );
            updateFormData.append( 'sports',            $( '#update_sports' ).val() );
            updateFormData.append( 'diet',              $( '#update_diet' ).val() );
            updateFormData.append( 'calories',          $( '#update_calories' ).val() );
            updateFormData.append( 'meals',             $( '#update_meals' ).val() );
            updateFormData.append( 'intolerances',      $( '#update_intolerances' ).val() );
            updateFormData.append( 'supplementation',   $( '#update_supplementation' ).val() );
            updateFormData.append( 'notes',             $( '#update_notes' ).val() );
            updateFormData.append( 'action', 'pc_customer_update' );
    
            $.ajax({
                url:  ajax_customer_registration_object.ajax_url,
                type: 'POST',
                data: updateFormData,
                contentType:false,
                cache:false,
                processData:false,
                success: on_user_update_success,
                error: on_user_update_error
            });
    
        }

        function on_user_update_success( result ){
            if( result.code === 0 ){
              $('#user_update_status').text(result.message);
              $('#pc_update_button').attr('disabled', false);
            }else if( result.code === 1 ){
              $('#user_update_status').text( result.message );
              $('#new_update').show();
            }
          }
      
        function on_user_update_error(){
            $('#user_registration_status')
              .text('Error, no fue posible registrar el usuario, contacte al administrador.');
        }

        $('#new_update').click(function(){
            $( '#update_customer_form')[0].reset();
            $( '#user_update_status' ).html('');
            $( '#new_update' ).hide();
            $( '#pc_update_button' ).attr('disabled', false);
            $( window ).scrollTop(90);
        });
    });
})(jQuery);