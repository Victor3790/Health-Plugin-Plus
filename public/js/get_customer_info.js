
function health_plugin_get_customer_info(customer_id, callback){

        let pc_customer_info = {
            action:     'pc_get_customer',
            pc_customer_id: customer_id
        }

        jQuery.ajax({
            url:      ajax_customer_info_object.ajax_url,
            data:     pc_customer_info,
            method:   'POST',
            success:  on_success,
            error:    function(){console.log('Error, contacte al administrador, get_customer_info.js')},
          });

        function on_success(data){
            res = data;
            callback(res);
        }

}