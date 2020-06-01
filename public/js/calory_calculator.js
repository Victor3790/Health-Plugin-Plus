(function($){
  $(document).ready(function(){
    $('form input:radio[name = "gender"]').change(function(){

      let weight              = $( '#weight' ).val();
      let height              = $( '#height' ).val();
      let age                 = $( '#age' ).val();
      let physical_activity   = $( '#physical_activity' ).val();
      let gender              = $(this).val();
      let percent             = $( '#percent' ).val();

      let tmb_percent         = 0;

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

      /*tmb_percent = ( tmb / 100 ) * percent;

      tmb += tmb_percent;*/

      $( '#calories' ).val( Math.round(tmb) );

    });
  });
})(jQuery);
