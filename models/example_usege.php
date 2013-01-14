<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of example_usege
 *
 * @author Hadi
 */
class example_usege {
        //put your code here
        
        public static function set_vals($keyval){
                return DatabaseEngine::insert($keyval, 'example_usage');
        }
}

?>
