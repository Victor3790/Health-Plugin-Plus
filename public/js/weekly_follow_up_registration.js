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

      var formData = new FormData();

      formData.append( 'customer_id', $( '#customer_id' ).val() );
      formData.append( 'week',        $( '#week' ).val() );
      formData.append( 'weight',      $( '#weight' ).val() );
      formData.append( 'answer_1',    $( '#answer_1' ).val() );
      formData.append( 'answer_2',    $( '#answer_2' ).val() );
      formData.append( 'answer_3',    $( '#answer_3' ).val() );
      formData.append( 'answer_4',    $( '#answer_4' ).val() );
      formData.append( 'photo',       photo );
      formData.append( 'action',      'pc_weekly_follow_up_registration' );

      $.ajax({
        url:  ajax_object.ajax_url,
        type: 'POST',
        data: formData,
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
