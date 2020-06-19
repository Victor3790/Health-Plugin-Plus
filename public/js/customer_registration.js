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


    //Register the user
    $( '#user_registration_form' ).on( 'submit', function(e) {
      e.preventDefault();

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
        success:  function(data){
          $('#user_registration_status').html(data);
          $('#new_user').show();
        }
      });

    });

    $('#new_user').click(function(){
        $( '#user_registration_form')[0].reset();
        $( '#user_registration_status' ).html('');
        $( '#new_user' ).hide();
        $( '#pc_send_button' ).attr('disabled', false);
        $( window ).scrollTop(90);
    });
  });
})(jQuery);
