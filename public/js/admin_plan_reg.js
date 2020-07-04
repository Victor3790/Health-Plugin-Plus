(function($){
    $(document).ready(function(){
        var plan;

        //Get the file
        $('#plan_file').change(function(){
          plan = this.files[0];
        });

        $( '#plan_reg_form' ).on( 'submit', function(e) {
            e.preventDefault();
            $('#plan_reg').attr('disabled', true);

            let formData = new FormData();

            formData.append( 'customer_id', $( '#plan_reg_customer_id' ).val() );
            formData.append( 'comments', $('#comments').val() );
            formData.append( 'plan',       plan );
            formData.append( 'action',     'pc_register_plan' );

            $.ajax({
                url:  ajax_follow_up_reg_object.ajax_url,
                type: 'POST',
                data: formData,
                contentType:false,
                cache:false,
                processData:false,
                success: on_plan_registration_success,
                error: on_plan_registration_error
              });
        });

        function on_plan_registration_success(result){
            console.log(result);
            $('#reg_plan_status').text(result['message']);
            if( result['code'] === 0 ){
                $('#plan_reg').attr('disabled', false);
            }
        }

        function on_plan_registration_error(result){
            $('#reg_plan_status').text(result['message']);
            $('#plan_reg').attr('disabled', false);
        }

    });
 })(jQuery);
