(function($){
  $(document).ready(function(){
    $( "#admin-tabs" ).tabs({
      create:   add_active_customers,
      activate: check_tab
    });

    function check_tab( event, ui ){
      if( ui.newPanel.selector == '#inactive_customers' ){
        add_inactive_customers();
      }
    }

    function add_active_customers(){
      let pc_active_customers = {
        action: 'pc_get_active_customers',
      }

      $.ajax({
        url:          ajax_active_users_object.ajax_url,
        data:         pc_active_customers,
        method:       'POST',
        success:      append_active_customers,
        error:        show_error_message,
        beforeSend:   function(){$('#active_customers_loader').show();},
        complete:     function(){$('#active_customers_loader').hide();}
      });
    }

    function append_active_customers( active_customers ){
      let active_table = ' #active_customers > table ';

      $( active_table ).append('<tr id = "table_header"></tr>')
      $('#table_header')
              .append('<th>Nombre</th>')
              .append('<th>Mail</th>')
              .append('<th>Teléfono</th>')
              .append('<th>Acciones</th>')

      active_customers.forEach( item => {
        $( active_table ).append('<tr id = "customer_' + item.pc_customer_id + '"></tr>');
        $( '#customer_' + item.pc_customer_id )
            .append('<td>' + item.name + '</td>')
            .append('<td>' + item.mail + '</td>')
            .append('<td>' + item.phone + '</td>')
            .append('<td><button value = "' + item.pc_customer_id + '"></button></td>')
      });

      $( 'td > button' )
          .text( 'Inactivar' )
          .addClass( 'inactivate_customer' )

      $('.inactivate_customer').one('click', function(){
        let customer_id = $(this).val();
        inactivate_customer( customer_id );
      });

    }

    function show_error_message(){
      console.log('Error');
    }

    function inactivate_customer( customer_id ){
      let pc_customer = {
        action: 'pc_inactivate_customer',
        pc_customer_id: customer_id
      }

      $.ajax({
        url: ajax_active_users_object.ajax_url,
        data: pc_customer,
        method: 'POST',
        success: inactivation_success,
        error: inactivation_error
      });
    }

    function inactivation_success(result){
      alert(result);
      $('#active_customers > table ').empty();
      add_active_customers();
    }

    function inactivation_error(){
      alert('Error, consulte al administrador');
    }

    function add_inactive_customers(){
      let pc_inactive_customers = {
        action: 'pc_get_inactive_customers',
      }

      $.ajax({
        url:      ajax_active_users_object.ajax_url,
        data:     pc_inactive_customers,
        method:   'POST',
        success:  append_inactive_customers,
        error:    show_error_message,
        beforeSend:   function(){$('#inactive_customers_loader').show();},
        complete:     function(){$('#inactive_customers_loader').hide();}
      });
    }

    function append_inactive_customers( inactive_customers ){
      let inactive_table = ' #inactive_customers > table ';

      $('#inactive_customers > table ').empty();

      $( inactive_table ).append('<tr id = "inactive_table_header"></tr>')
      $('#inactive_table_header')
              .append('<th>Nombre</th>')
              .append('<th>Mail</th>')
              .append('<th>Teléfono</th>')
              .append('<th>Acciones</th>')

      inactive_customers.forEach( item => {
        $( inactive_table ).append('<tr id = "customer_' + item.pc_customer_id + '"></tr>');
        $( '#customer_' + item.pc_customer_id )
            .append('<td>' + item.name + '</td>')
            .append('<td>' + item.mail + '</td>')
            .append('<td>' + item.phone + '</td>')
            .append('<td><button value = "' + item.pc_customer_id + '"></button></td>')
      });

      $( 'td > button' )
          .text( 'Activar' )
          .addClass( 'activate_customer' )

      $('.inactivate_customer').one('click', function(){
        let customer_id = $(this).val();
        activate_customer( customer_id );
      });
    }

  });
})(jQuery);
