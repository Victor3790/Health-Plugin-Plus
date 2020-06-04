(function($){
  $(document).ready(function(){
    $( '#pc_user_follow_up' ).change( function() {

      var pc_customer_follow_up = {
        action:                     'pc_get_follow_up',
        pc_customer_id_follow_up:   $( '#pc_user_follow_up' ).val()
      }

      $.ajax({
        url: ajax_customer_follow_up_object.ajax_url,
        data: pc_customer_follow_up,
        method: 'POST',
        success: on_success_customer_follow_up,
        error: on_error_customer_follow_up
      });

    } );

    function on_success_customer_follow_up( user_data ){
      console.log('Success!');
      console.log(user_data);
      console.log($( '#pc_user_follow_up' ).val());
      let id = '';
      let q1 = '¿Has tenido dificultes para seguir el plan? ¿Cuáles?';
      let q2 = '¿Algo que te gustaría añadir o cambiar?';
      let q3 = '¿Sientes especial dificultad en algún ejercicio? ¿Cuál y por qué?';
      let q4 = 'Otras observaciones';

      if( $('#accordion_user_progress').accordion( 'instance' ) !== undefined){

        $('#accordion_user_progress').accordion( "destroy" );

        $('#accordion_user_progress').empty();

      }

      user_data.forEach( item => {
        $('#accordion_user_progress').append( '<h3>Semana ' + item.week + '</h3>' );
        $('#accordion_user_progress').append( '<div><ul id = "wk_' + item.week + '"></ul></div>' );
        id = '#wk_' + item.week;
        $(id).append( '<li>Peso en ayunas: ' + item.weight + ' Kg.</li>' );
        $(id).append( '<li><p>' + q1 + '</p>' + item.answer_1 + '</p></li>' );
        $(id).append( '<li><p>' + q2 + '</p>' + item.answer_2 + '</p></li>' );
        $(id).append( '<li><p>' + q3 + '</p>' + item.answer_3 + '</p></li>' );
        $(id).append( '<li><p>' + q4 + '</p>' + item.answer_4 + '</p></li>' );
        $(id).append( item.user_photo );
      });

      $('#accordion_user_progress').accordion({heightStyle: "content"});

    }


    function on_error_customer_follow_up(){
      console.log('Could not get the user weekly follow up');
    }

  } );
})(jQuery);
