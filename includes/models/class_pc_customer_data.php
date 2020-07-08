<?php
class Customer_Data
{
    /*
    *   This function validates and sanitizes 
    *   the data sent by the user.
    *   
    *   @ request   int (Two possible values 1 or 2) Indicates 
    *               if the function is called from
    *               the registration (1) or the update class (2)
    */
    protected function validate_data( $request=NULL ){
        global $wpdb;

        if( empty($request) ){
            return false;
        }elseif( !($request == 1 || $request == 2) ){
            return false;
        }

        if( !isset( $_POST['pc_user_id'] ) ){
            return false;
        }

        if( intval($_POST['pc_user_id']) == 0 ){
            return false;
        }

        if( $_POST['pc_user_id'] < 0){
            return false;
        }

        if( $request == 1 ){
            $count = $wpdb->get_var('SELECT COUNT(*) FROM ' . $wpdb->users . ' WHERE ID = ' . $_POST['pc_user_id']);

            if( $count != 1 ){
                return false;
            }
        } 

        if( !$this->check_text( 'name' ) ){
            return false;
        }

        if( $request == 1 ){
            if( !empty( $_POST['mail'] && is_email( $_POST['mail'] ) ) ){
                $_POST['mail'] = sanitize_email( $_POST['mail'] );
            }else{
                return false;
            }
        }

        if( !$this->in_range( 'country', 1, 12 ) ){
            return false;
        }

        if( !$this->in_range( 'age', 8, 150 ) ){
            return false;
        }

        if( !$this->in_range( 'weight', 9, 200 ) ){
            return false;
        }

        if( !$this->in_range( 'height', 50, 300 ) ){
            return false;
        }

        if( !$this->in_range( 'physical_activity', 1, 5 ) ){
            return false;
        }

        if( !$this->in_range( 'goal', 1, 4 ) ){
            return false;
        }

        if( !$this->in_range( 'percent', 0, 100 ) ){
            return false;
        }

        if( !$this->in_range( 'training', 1, 4 ) ){
            return false;
        }

        if( !$this->in_range( 'days_week', 1, 7 ) ){
            return false;
        }

        if( !$this->in_range( 'training_area', 1, 4 ) ){
            return false;
        }

        if( !$this->in_range( 'diet', 1, 4 ) ){
            return false;
        }

        if( !$this->in_range( 'calories', 1, 100000 ) ){
            return false;
        }

        if( !$this->in_range( 'meals', 1, 50 ) ){
            return false;
        }

        if( $_POST['sex'] != 'M' && $_POST['sex'] != 'F' ){
            return false;
        }

        if( !$this->check_text( 'phone' ) ){
            return false;
        }

        if( !$this->check_text( 'city' ) ){
            return false;
        }

        if( !$this->check_text( 'sports' ) ){
            return false;
        }

        if( !$this->check_text( 'intolerances' ) ){
            return false;
        }

        if( !$this->check_text( 'supplementation' ) ){
            return false;
        }

        if( !$this->check_text( 'notes' ) ){
            return false;
        }

        return true;

    }

    private function check_text( $key ){
        if( isset( $_POST[$key] ) ){
            $_POST[$key] = sanitize_text_field( $_POST[$key] );
            if( empty( $_POST[$key] ) ){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    private function in_range( $key, $first=0, $last=1 ){
        if( !empty( $_POST[$key] ) ){
            if( !($_POST[$key] >= $first && $_POST[$key] <= $last) ){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
