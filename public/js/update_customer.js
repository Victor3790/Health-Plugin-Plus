(function($){
    $(document).ready(function(){
        $( '#pc_update_customer_info' ).change( function() {
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
            $('#update_start-date-view').datepicker(
                                                    'setDate', 
                                                    $.datepicker.formatDate( "dd/mm/yy", new Date(	
                                                        $.datepicker.parseDate( "yy-mm-dd", customer_data[0].start_date )))
                                                    );
            $('#update_start-date').val(customer_data[0].start_date);
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

        //Update customer
        $( '#update_customer_form' ).on( 'submit', function(e) {
            e.preventDefault();
    
            var updateFormData = new FormData();
    
            updateFormData.append( 'pc_user_id',        $( '#pc_update_customer_info' ).val() );
            updateFormData.append( 'name',              $( '#update_name' ).val() );
            updateFormData.append( 'phone',             $( '#update_phone' ).val() );
            updateFormData.append( 'country',           $( '#update_country' ).val() );
            updateFormData.append( 'city',              $( '#update_city' ).val() );
            updateFormData.append( 'start_date',        $( '#update_start-date' ).val() );
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
                success:  function(data){
                    console.log(data);
                }
            });
    
        });
    });
})(jQuery);