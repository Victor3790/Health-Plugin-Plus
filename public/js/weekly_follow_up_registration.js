(function($){
  $(document).ready(function(){
    var photo;

    //Get the file
    $('#photo').change(function(){
      photo = this.files[0];
    });


    //Register the follow up
    $( '#follow-up_form' ).on( 'submit', function(e) {
      e.preventDefault();

      $('#pc_customer_follow_up_reg').attr('disabled', true);

      var formData = new FormData();

      formData.append( 'customer_id', $( '#customer_id' ).val() );
      formData.append( 'week',        $( '#week' ).val() );
      formData.append( 'weight',      $( '#weight' ).val() );
      formData.append( 'answer_1',    $( '#answer_1' ).val() );
      formData.append( 'answer_2',    $( '#answer_2' ).val() );
      formData.append( 'answer_3',    $( '#answer_3' ).val() );
      formData.append( 'answer_4',    $( '#answer_4' ).val() );
      formData.append( 'photo',       photo );
      formData.append( 'action',      'pc_register_follow_up' );

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

    });

    function on_follow_up_reg_success( result ){
      if( result.code === 0 ){
        $('#follow_up_reg_status').text(result.message);
        $('#pc_customer_follow_up_reg').attr('disabled', false);
      }else if( result.code === 1 ){
        $('#follow-up_form').hide();
        $('#follow_up_reg_status').text(result.message);
      }
    }

    function on_follow_up_reg_error(){
      console.log('Hubo un error, por favor contacte al administrador');
    }
  });
})(jQuery);
