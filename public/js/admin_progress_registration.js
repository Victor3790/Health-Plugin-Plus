(function($){
  $(document).ready(function(){
    $( '#register_customer_prev_progress_form' ).on( 'submit', function(e) {
      e.preventDefault();

      let values = $('.prev_progress_weight');
      let info = [];
      let formData = new FormData();
      let customer_id = parseInt($('#pc_customer_info').val(), 10);

      for (let i = 0; i < values.length; i++) {
        info[i] = [ 
                 customer_id,
                 parseInt(values[i].id, 10), //week
                 values[i].valueAsNumber     //weight
        ]
      }

      console.log(info);

      formData.append('json_array', JSON.stringify(info));
      formData.append( 'action', 'pc_register_prev_follow_up' );

      $.ajax({
        url:  ajax_customer_registration_object.ajax_url,
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
