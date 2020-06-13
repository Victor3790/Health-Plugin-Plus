function health_plugin_get_customer_info(info_type, customer_id, callback){

        if(info_type === 'info'){
            $function = 'pc_get_customer'
        }else if(info_type === 'raw'){
            $function = 'pc_get_customer_raw_info'
        }

        let pc_customer_info = {
            action:     $function,
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