<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of html_tags
 *
 * @author Hadi
 */
class _html_tags {

        /**
         * Combobox of Iran Province List
         * @param type $tag_name string
         */
        public static function iran_province_list($tag_name,$def_province_name='') {
                
                $rtn = ' <select name="' . $tag_name . '">';
                foreach (city_province::get_all_provinces() as $pro) {
	    $selected= $def_province_name==$pro['province']?'selected="selected"':'';
	    $rtn.='<option value="' . $pro['province'] . '" '.$selected.'>' . $pro['province'] . '</option>';
                }
                $rtn.='</select>';

                return $rtn;
        }
        
        
        /**
         * Combobox of Iran City List by Province Name
         * @param type $tag_name string
         */
        public static function iran_city_list_by_provincce_name($tag_name,$province_name, $style='', $def_val='') {
                if(is_null($province_name))
	    $province_name=' تهران';
                
                $rtn = ' <select style="'.$style.'" name="' .$tag_name . '">';
                foreach (city_province::get_all_cities_by_province($province_name) as $city) {
	     $selected= $def_val==$city['id']?'selected="selected"':'';
	    $rtn.='<option value="' . $city['id'] . '" '.$selected.'>' . $city['city_name'] . '</option>';
                }
                $rtn.='</select>';

                return $rtn;
        }

}

?>
