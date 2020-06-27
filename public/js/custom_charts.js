(function($){
  $(document).ready(function(){

    let progress_data = $('.progress_weight');
    let progress_week = $('.progress_week');
    let rows = new Array();

    let i;

    for (i = 0; i < progress_data.length; i++){
      console.log( progress_data[i].innerText );
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

  });
})(jQuery);
