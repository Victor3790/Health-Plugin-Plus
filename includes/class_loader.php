<?php
/*
*   This function loads views (Any HTML code)
*   to show on the front-end. 
*
*   @file       the full path to the view to load.
*   @params     Associative array of parameters to use in the view.
*
*/
if(!class_exists('Pc_Loader'))
{
    class Pc_Loader
    {
        public function load_view( $file, $params = null )
        {
            if(is_file( $file ))
            {
                if(!empty($params) && is_array($params))
                {
                    extract( $params );
                }

                ob_start();

                require( $file );

                $buffer = ob_get_clean();

                //$result['status']   = 1;
                //$result['content']  = $buffer;

                return $buffer;
            }else{

                //$result['status']   = 0;
                //$result['content']  = 'File not found, please contact tech support';
                $result = 'Error';

                return $result;
            }
        }
    }
}