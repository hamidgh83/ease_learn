<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of phrases
 *
 * @author Hadi
 */
class phrases {
        //put your code here
        
        
        public static function set_vals($keyval){
                return DatabaseEngine::insert($keyval, 'phrases');
        }
        
        
        public static function get_first_n_last_rec_date(){
                return DatabaseEngine::select_row('SELECT MIN(date_added) as first_rec,MAX(date_added) as last_rec FROM phrases');
        }
        
        
        public static function get_recs_in_range_date($from_date,$to_date){
                $from_date.=' 00:00:00';
                $to_date.=' 23:59:59';
                $res= DatabaseEngine::select_all("SELECT * FROM phrases 
			            WHERE date_added>'$from_date' 
			            AND date_added<='$to_date'
			            ORDER BY date_added DESC");
                if(count($res)){
	    return $res;
                }  else {
	    return FALSE;    
                }
        }
        
}

?>
