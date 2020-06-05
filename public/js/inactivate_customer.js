(function($){
  $(document).ready(function(){

    $('.inactive_customer').click(function(){
      var pc_customer_id = {
        action: 'pc_inactivate_customer',
        pc_customer_id: $(this).val()
      }

      $.ajax({
        url: ajax_inactivate_customer_object.ajax_url,
        data: pc_customer_id,
        method: 'POST',
        success: inactivation_success,
        error: inactivation_error
      });

      function inactivation_success(result){
        alert(result);
      }

      function inactivation_error(){
        alert('Error, consulte al administrador');
      }
    });

  });
})(jQuery);
