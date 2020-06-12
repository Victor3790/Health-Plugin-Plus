(function($){
  $(document).ready(function(){
    $( '#pc_customer_info' ).change( function() {
      health_plugin_get_customer_info( $( '#pc_customer_info' ).val(), 
        function(result){
          on_success_customer_info(result);
        });

      var pc_customer_progress = {
        action: 'pc_get_ajax_progress',
        pc_customer_id: $( '#pc_customer_info' ).val()
      }

      $('#weights').empty();
      $('#weeks').empty();



      $.ajax({
        url:      ajax_customer_info_object.ajax_url,
        data:     pc_customer_progress,
        method:   'POST',
        success:  on_success_customer_progress,
        error:    on_error_customer_progress,
        beforeSend:   function(){$('#info_customers_loader').show();},
        complete:     function(){$('#info_customers_loader').hide();}
      });

    });

    function on_success_customer_info(customer_data){
      $('#pc_user_name').text( customer_data[0].name );
      $('#pc_user_mail').text( customer_data[0].mail );
      $('#pc_user_phone').text( customer_data[0].phone );
      $('#pc_user_country').text( customer_data[0].country );
      $('#pc_user_city').text( customer_data[0].city );
      $('#pc_user_age').text( customer_data[0].age );
      $('#pc_user_weight').text( customer_data[0].weight );
      $('#pc_user_height').text( customer_data[0].height );
      $('#pc_user_activity').text( customer_data[0].activity );
      $('#pc_user_goal').text( customer_data[0].goal );
      $('#pc_user_percent').text( customer_data[0].percent );
      $('#pc_user_training').text( customer_data[0].training );
      $('#pc_user_days_week').text( customer_data[0].days_week );
      $('#pc_user_training_area').text( customer_data[0].area );
      $('#pc_user_sports').text( customer_data[0].sports );
      $('#pc_user_diet').text( customer_data[0].diet );
      $('#pc_user_calories').text( customer_data[0].calories );
      $('#pc_user_meals').text( customer_data[0].meals );
      $('#pc_user_intolerances').text( customer_data[0].intolerances );
      $('#pc_user_supplementation').text( customer_data[0].supplementation );
      $('#pc_user_image').html( customer_data[0].user_photo );
      $('#pc_user_notes').text( customer_data[0].notes );
      $('#pc_start_date').text( customer_data[0].start_date_formatted );
      $('#pc_current_week').text( customer_data[0].current_week );
    }

    function on_success_customer_progress( customer_progress ){

      customer_progress.forEach((item) => {
        $('#weights').append('<td class="progress_weight">' + item.weight + '</td>');
        $('#weeks').append('<td class="progress_week">' + item.week + '</td>');
      });

      drawProgressChart();
    }

    function on_error_customer_progress(){
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
  } );
})(jQuery);
