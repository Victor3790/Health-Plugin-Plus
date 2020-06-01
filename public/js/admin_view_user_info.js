(function($){
  $(document).ready(function(){
    $( '#pc_user_info' ).change( function() {

      var pc_user_info = {
        action:     'pc_admin_view_info',
        pc_user_id: $( '#pc_user_info' ).val()
      }

      var pc_user_progress = {
        action: 'pc_customer_progress_view',
        pc_user_id: $( '#pc_user_info' ).val()
      }

      $('#weights').empty();
      $('#weeks').empty();

      $.ajax({
        url:      ajax_user_object.ajax_url,
        data:     pc_user_info,
        method:   'POST',
        success:  on_success_user_info,
        error:    on_error_user_info
      });

      $.ajax({
        url: ajax_user_object.ajax_url,
        data: pc_user_progress,
        method: 'POST',
        success: on_success_user_progress,
        error: on_error_user_progress
      });

    });

    function on_success_user_info(user_data){
      $('#pc_user_name').text( user_data[0].name );
      $('#pc_user_mail').text( user_data[0].mail );
      $('#pc_user_phone').text( user_data[0].phone );
      $('#pc_user_country').text( user_data[0].country );
      $('#pc_user_city').text( user_data[0].city );
      $('#pc_user_age').text( user_data[0].age );
      $('#pc_user_weight').text( user_data[0].weight );
      $('#pc_user_height').text( user_data[0].height );
      $('#pc_user_activity').text( user_data[0].activity );
      $('#pc_user_goal').text( user_data[0].goal );
      $('#pc_user_percent').text( user_data[0].percent );
      $('#pc_user_training').text( user_data[0].training );
      $('#pc_user_days_week').text( user_data[0].days_week );
      $('#pc_user_training_area').text( user_data[0].area );
      $('#pc_user_sports').text( user_data[0].sports );
      $('#pc_user_diet').text( user_data[0].diet );
      $('#pc_user_calories').text( user_data[0].calories );
      $('#pc_user_meals').text( user_data[0].meals );
      $('#pc_user_intolerances').text( user_data[0].intolerances );
      $('#pc_user_supplementation').text( user_data[0].supplementation );
      $('#pc_user_image').html( user_data[0].user_photo );
      $('#pc_user_notes').text( user_data[0].notes );
      $('#pc_start_date').text( user_data[0].start_date_formatted );
      $('#pc_current_week').text( user_data[0].current_week );
    }

    function on_success_user_progress(user_progress){

      user_progress.forEach((item) => {
        $('#weights').append('<td class="progress_weight">' + item.weight + '</td>');
        $('#weeks').append('<td class="progress_week">' + item.week + '</td>');
      });

      drawProgressChart();
    }

    function on_error_user_info(){
      console.log('Could not get the user info');
    }

    function on_error_user_progress(){
      console.log('Could not get the user progress');
    }

    function drawProgressChart(){
      let progress_data = $('.progress_weight');
      let progress_week = $('.progress_week');
      let rows = new Array();

      let i;

      for (i = 0; i < progress_data.length; i++){
        rows.push( [
          Number( progress_week[i].innerText ),
          Number( progress_data[i].innerText )
        ] );
      }

      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Semana');
        data.addColumn('number', 'Peso');
        data.addRows( rows );

        var options = {
          title: 'Progreso',
          hAxis: {
            title: 'Semana',
          },
          vAxis: {
            title: 'Peso',
          },
          lineWidth: 2,
          legend: 'none',
          curveType: 'function',
          pointSize: 5,
          width: 600
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.LineChart(document.getElementById('pc_chart'));
        chart.draw( data, options );
      }
    }

    $('.inactive_customer').click(function(){
      console.log($(this).val());
      var pc_customer_id = {
        action: 'pc_inactive_customer',
        pc_user_id: $(this).val()
      }

      $.ajax({
        url: ajax_user_object.ajax_url,
        data: pc_customer_id,
        method: 'POST',
        success: prueba_success,
        error: function(){console.log('error')}
      });

    });

    function prueba_success(result){
      console.log(result);
    }
  } );
})(jQuery);
