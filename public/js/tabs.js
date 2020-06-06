(function($){
  $(document).ready(function(){

    let refresh_active   = false;
    let refresh_inactive = false;

    $( "#admin-tabs" ).tabs({
      create:   add_customers,
      activate: check_tab
    });

    function add_customers(){
      add_active_customers();
      add_inactive_customers();
    }

    function check_tab( event, ui ){
      if( ui.newPanel.selector == '#inactive_customers' && refresh_inactive === true ){
        refresh_inactive = false;
        add_inactive_customers();
      }else if ( ui.newPanel.selector == '#active_customers' && refresh_active === true ) {
        refresh_active = false;
        add_active_customers();
      }
    }

//*************************** Active customers

    function add_active_customers(){
      $('#active_customers > table ').empty();
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
            .append('<td class = "inactivate_button"><button value = "' + item.pc_customer_id + '"></button></td>')
      });

      $( '.inactivate_button > button' )
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
      refresh_inactive = true;
      alert(result);
      $('#active_customers > table ').empty();
      add_active_customers();
    }

    function inactivation_error(){
      alert('Error, consulte al administrador');
    }

//********************** Inactive customers

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
            .append('<td id="inactive_actions_' + item.pc_customer_id + '"></td>')
        $( '#inactive_actions_' + item.pc_customer_id )
            .append('<button class="activate_customer" value = "' + item.pc_customer_id + '"></button>')
            .append('<button class="delete_customer" value = "' + item.pc_customer_id + '"></button>');
      });

      $( '.activate_customer' )
          .text( 'Activar' );
      $( '.delete_customer' )
          .text( 'Eliminar' );


      $('.activate_customer').one('click', function(){
        let customer_id = $(this).val();
        activate_customer( customer_id );
      });

      $('.delete_customer').one('click', function(){
        let customer_id = $(this).val();
        delete_customer( customer_id );
      });
    }

    function activate_customer( customer_id ){
      let pc_customer = {
        action: 'pc_activate_customer',
        pc_customer_id: customer_id
      }

      $.ajax({
        url: ajax_active_users_object.ajax_url,
        data: pc_customer,
        method: 'POST',
        success: activation_success,
        error: activation_error
      });
    }

    function activation_success(result){
      refresh_active = true;
      alert(result);
      $('#inactive_customers > table ').empty();
      add_inactive_customers();
    }

    function activation_error(){
      alert('Error, consulte al administrador');
    }

    function delete_customer( customer_id ){
      let pc_customer = {
        action: 'pc_delete_customer',
        pc_customer_id: customer_id
      }

      $.ajax({
        url: ajax_active_users_object.ajax_url,
        data: pc_customer,
        method: 'POST',
        success: deletion_success,
        error: deletion_error
      });

      function deletion_success(result){
        refresh_active = true;
        alert(result);
        $('#inactive_customers > table ').empty();
        add_inactive_customers();
      }

      function deletion_error(){
        alert('Error, consulte al administrador');
      }
    }



  });
})(jQuery);
