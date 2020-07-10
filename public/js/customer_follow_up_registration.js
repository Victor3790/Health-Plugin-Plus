(function($){
  $(document).ready(function(){
    var photo;

    //Get the file
    $('#photo').change(function(){
      photo = this.files[0];
    });

        //Validate the form
        $('#follow-up_form').validate({

          rules: {
            current_weight: {
              required: true,
              range: [ 9, 250 ]
            }
          },
          messages: {
            current_weight: {
              required: 'Por favor, ingresa tu peso para esta semana.',
              range: '¿El peso es correcto?'
            }
          },
          submitHandler: function(){
            pc_register_progress(event);
          }
    
        });


    //Register the follow up
    function pc_register_progress(event){
      event.preventDefault();

      $('#pc_customer_follow_up_reg').attr('disabled', true);

      var formData = new FormData();

      formData.append( 'customer_id',   $( '#customer_id' ).val() );
      formData.append( 'week',          $( '#week' ).val() );
      formData.append( 'weight',        $( '#weight' ).val() );
      formData.append( 'answer_1',      $( '#answer_1' ).val() );
      formData.append( 'answer_2',      $( '#answer_2' ).val() );
      formData.append( 'answer_3',      $( '#answer_3' ).val() );
      formData.append( 'answer_4',      $( '#answer_4' ).val() );
      formData.append( 'photo',         photo );
      formData.append( 'action',        'pc_register_follow_up' );
      formData.append( 'customer_form', $( '#customer_form' ).val() );

      $.ajax({
        url:  ajax_follow_up_reg_object.ajax_url,
        type: 'POST',
        data: formData,
        contentType:false,
        cache:false,
        processData:false,
        success: on_follow_up_reg_success,
        error: on_follow_up_reg_error
      });

    }

    function on_follow_up_reg_success( result ){
      if( result.code == 0 ){
        $('#follow_up_reg_status').text(result.message);
        $('#pc_customer_follow_up_reg').attr('disabled', false);
      }else if( result.code == 1 ){
        alert(result.message);
        $('#follow-up_form').hide();
        $('#follow_up_reg_status').text(result.message);
        $("html, body").animate({scrollTop: 0}, 100);
      }
    }

    function on_follow_up_reg_error(){
      error_message = 'Hubo un error, por favor contacte al administrador';
      $('#pc_customer_follow_up_reg').attr('disabled', false);
      $('#follow_up_reg_status').text(error_message);
    }
  });
})(jQuery);
