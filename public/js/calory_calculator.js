(function($){
  $(document).ready(function(){

    $('form input:radio[name = "gender"]').change(function(){

      let calories;

      calories = get_calories(
                  $( '#weight' ).val(),
                  $( '#height' ).val(),
                  $( '#age' ).val(),
                  $( '#physical_activity' ).val(),
                  $(this).val()
                );

      $( '#calories' ).val( calories );

    });

    $('form input:radio[name = "update_gender"]').change(function(){

      let calories;

      calories = get_calories(
                  $( '#update_weight' ).val(),
                  $( '#update_height' ).val(),
                  $( '#update_age' ).val(),
                  $( '#update_physical_activity' ).val(),
                  $(this).val()
                );

      $( '#update_calories' ).val( calories );

    });

    function get_calories(p_weight, p_height, p_age, p_physical_activity, p_gender){
      let weight              = p_weight;
      let height              = p_height;
      let age                 = p_age;
      let physical_activity   = p_physical_activity;
      let gender              = p_gender;

      let tmb = ( 10 * weight ) + ( 6.25 * height ) - ( 5 * age );

      if( gender === 'M' ){
        tmb += 5;
      }else if ( gender === 'F' ) {
        tmb -= 161;
      }

      switch ( physical_activity ) {
        case '1':
            tmb *= 1.2;
          break;
        case '2':
            tmb *= 1.375;
          break;
        case '3':
            tmb *= 1.55;
          break;
        case '4':
            tmb *= 1.725;
          break;
        case '5':
            tmb *= 1.9;
          break;
      }

      return Math.round(tmb);
    }

  });
})(jQuery);
