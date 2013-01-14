<?php

class _sclass {

        //1. PRICE FORMAT : CONVERT PRICES TO 3 DIGIT SEPERATOR
        //sclass::price($price)

        public static function price($price) {
                $priceStr = (string) $price;


                if (strlen($priceStr) > 3) {
	    if (strlen($priceStr) <= 6) {
	            $finalPrice = '<span class="priceL">' . substr($priceStr, -6, strlen($priceStr) - 3) . '</span>';
	            $finalPrice.='<span class="priceM">,' . substr($priceStr, -3, 3) . '</span>';
	    } else if (strlen($priceStr) <= 9) {
	            $finalPrice = '<span class="priceL">' . substr($priceStr, -9, strlen($priceStr) - 6) . '</span>';
	            $finalPrice.='<span class="priceM">,' . substr($priceStr, -6, 3);
	            $finalPrice.=',' . substr($priceStr, -3, 3) . '</span>';
	    } else if (strlen($priceStr) <= 12) {
	            $finalPrice = '<span class="priceL">' . substr($priceStr, -12, strlen($priceStr) - 9) . '</span>';
	            $finalPrice.='<span class="priceM">,' . substr($priceStr, -9, 3);
	            $finalPrice.=',' . substr($priceStr, -6, 3);
	            $finalPrice.=',' . substr($priceStr, -3, 3) . '</span>';
	    }
	    /* $len=strlen($priceStr)%3;
	      $finalPrice=substr($priceStr,0,$len);
	      for($i=$len+1 ; $i<=strlen($priceStr)-$len ; $i+3){
	      $finalPrice.=','.substr($priceStr,$i,3);
	      } */
	    return $finalPrice;
                }else
	    return '<span class="priceL">' . $priceStr . '</span>';
        }

        //1. PRICE FORMAT : CONVERT PRICES TO 3 DIGIT SEPERATOR WITH NO CSS
        //sclass::price($price)

        public static function price_just_seperator($price) {
                $priceStr = (string) $price;


                if (strlen($priceStr) > 3) {
	    if (strlen($priceStr) <= 6) {
	            $finalPrice = '' . substr($priceStr, -6, strlen($priceStr) - 3) . '';
	            $finalPrice.=',' . substr($priceStr, -3, 3) . '';
	    } else if (strlen($priceStr) <= 9) {
	            $finalPrice = '' . substr($priceStr, -9, strlen($priceStr) - 6) . '';
	            $finalPrice.=',' . substr($priceStr, -6, 3);
	            $finalPrice.=',' . substr($priceStr, -3, 3) . '';
	    } else if (strlen($priceStr) <= 12) {
	            $finalPrice = '' . substr($priceStr, -12, strlen($priceStr) - 9) . '';
	            $finalPrice.=',' . substr($priceStr, -9, 3);
	            $finalPrice.=',' . substr($priceStr, -6, 3);
	            $finalPrice.=',' . substr($priceStr, -3, 3) . '';
	    }

	    return $finalPrice;
                }else
	    return '' . $priceStr . '';
        }

        public static function timeAgo($submit_date, $isDateTime = true) {
                if ($isDateTime) {
	    $submit_date = strtotime($submit_date);
                }

//                $cur_time = gmmktime();
                $cur_time = time();

                $added_temp = $cur_time - $submit_date;
//                echo date("Y-m-j H:i:s",$cur_time);
//                echo '<br>'.date("Y-m-j H:i:s",$submit_date).'<br>';
//                var_dump($added_temp);
//                die();
//        var_dump($cur_time);
//        var_dump($added_temp);

                if ($added_temp < (60)) {
	    $added = floor($added_temp) . ' ثانیه پیش';
                } elseif ($added_temp < (60 * 2)) {
	    $added = floor($added_temp / (60)) . ' دقیقه پیش';
                } elseif ($added_temp < (60 * 60)) {
	    $added = floor($added_temp / (60)) . ' دقیقه پیش';
                } elseif ($added_temp < (60 * 60 * 2)) {
	    $added = floor($added_temp / (3600)) . ' ساعت پیش';
                } elseif ($added_temp < (60 * 60 * 24)) {
	    $added = floor($added_temp / (3600)) . ' ساعت پیش';
                } elseif ($added_temp < (3600 * 24 * 30)) {
	    $added = floor($added_temp / (3600 * 24));

	    if ($added == 1)
	            $added = "دیروز";

	    else
	            $added = $added . ' روز پیش';
                }else {
	    $added = date("j F Y ", $submit_date);
                }



                return($added);
        }

        public static function timeLater($submit_date, $isDateTime = true) {
                if ($isDateTime) {
	    $submit_date = strtotime($submit_date);
                }

//                $cur_time = gmmktime();
                $cur_time = time();
                

                $added_temp = $submit_date - $cur_time;

//        var_dump($cur_time);
//        var_dump($added_temp);

                if ($added_temp < (60)) {
	    $added = floor($added_temp) . ' seconds later';
                } elseif ($added_temp < (60 * 2)) {
	    $added = floor($added_temp / (60)) . ' min later';
                } elseif ($added_temp < (60 * 60)) {
	    $added = floor($added_temp / (60)) . ' mins later';
                } elseif ($added_temp < (60 * 60 * 2)) {
	    $added = floor($added_temp / (3600)) . ' hour later';
                } elseif ($added_temp < (60 * 60 * 24)) {
	    $added = floor($added_temp / (3600)) . ' hours later';
                } elseif ($added_temp < (3600 * 24 * 30)) {
	    $added = floor($added_temp / (3600 * 24));

	    if ($added == 1)
	            $added = 'tomorrow';

	    else
	            $added = $added . ' days later';
                }else {
	    $added = date("j F Y ", $submit_date);
                }



                return($added);
        }

        public static function timeAgoOrLater($submit_date, $isDateTime = true) {
                if ($isDateTime) {
	    $submit_date = strtotime($submit_date);
                }

//                $cur_time = gmmktime();
                $cur_time = time();
                



                if ($submit_date < $cur_time) {
	    $added_temp = $cur_time - $submit_date;

	    if ($added_temp < (60)) {
	            $added = floor($added_temp) . ' seconds ago';
	    } elseif ($added_temp < (60 * 2)) {
	            $added = floor($added_temp / (60)) . ' min ago';
	    } elseif ($added_temp < (60 * 60)) {
	            $added = floor($added_temp / (60)) . ' mins ago';
	    } elseif ($added_temp < (60 * 60 * 2)) {
	            $added = floor($added_temp / (3600)) . ' hour ago';
	    } elseif ($added_temp < (60 * 60 * 24)) {
	            $added = floor($added_temp / (3600)) . ' hours ago';
	    } elseif ($added_temp < (3600 * 24 * 30)) {
	            $added = floor($added_temp / (3600 * 24));

	            if ($added == 1)
		$added = 'yesterday';

	            else
		$added = $added . ' days ago';
	    }else {
	            $added = date("j F Y ", $submit_date);
	    }
                } else {
	    $added_temp = $submit_date - $cur_time;

	    if ($added_temp < (60)) {
	            $added = floor($added_temp) . ' seconds later';
	    } elseif ($added_temp < (60 * 2)) {
	            $added = floor($added_temp / (60)) . ' min later';
	    } elseif ($added_temp < (60 * 60)) {
	            $added = floor($added_temp / (60)) . ' mins later';
	    } elseif ($added_temp < (60 * 60 * 2)) {
	            $added = floor($added_temp / (3600)) . ' hour later';
	    } elseif ($added_temp < (60 * 60 * 24)) {
	            $added = floor($added_temp / (3600)) . ' hours later';
	    } elseif ($added_temp < (3600 * 24 * 30)) {
	            $added = floor($added_temp / (3600 * 24));

	            if ($added == 1)
		$added = 'tomorrow';

	            else
		$added = $added . ' days later';
	    }else {
	            $added = date("j F Y ", $submit_date);
	    }
                }


                return($added);
        }

        /**
         * make given value URL include safe
         * @param String $val
         * @return String $uniq_url
         */
        public static function makeTitleURLSafe($val_org, $destination_table, $destination_column, $extraTable = false) {
                $checked = 0;
                $addition = 0;
                $existInDB = true;
                do {
	    if ($checked == 1) {
	            $addition++;
	            $val = $val_org . '-' . $addition;
	    } else {
	            $val = $val_org;
	    }
	    $val = ucwords($val);
	    // DO STRIP TAGS
	    $chars = array('_', '/', '.', ' ', '^', '&', '*', ',');
	    foreach ($chars as $ch)
	            $val = str_replace($ch, '-', $val);
	    do {
	            $val = str_replace('--', '-', $val);
	            $has_dbl_dash = strpos('a' . $val, '--');
	    } while ($has_dbl_dash);

	    // DELETE FIRST DASH IF COMES AT FIRST CHARACTER
	    if (substr($val, 0, 1) == '-')
	            $val = substr($val, 1);

	    //$val = preg_replace('/[^A-Za-z0-9-]/', "", $val);
	    $checked = 1;
	    //$val = preg_replace('/[^\X-]/', "", $val);

	    if (!$extraTable) {
	            $existInDB = DatabaseEngine::just_count("SELECT * FROM $destination_table WHERE $destination_column='$val'") > 0;
	    } else {
	            $existInDB = (DatabaseEngine::just_count("SELECT * FROM $destination_table WHERE $destination_column='$val'") > 0)
		|| (DatabaseEngine::just_count("SELECT * FROM $extraTable[table] WHERE $extraTable[column]='$val'") > 0);
	    }
                } while ($existInDB);

                return $val;
        }

        /**
         *  NORMAL STR_WORD_COUNT CAN NOT SUPPORT UTF-8, SO MUST USE THIS FUNCTION
         * @param type $str
         * @return type string
         */
        public static function str_word_count_utf8($str) {
                return count(preg_split('~[^\p{L}\p{N}\']+~u', $str));
        }

        /**
         *  CREATE COMBO BOX
         */
        public static function count_numbers($from_number, $to_number) {
                for ($i = $from_number; $i <= $to_number; $i++)
	    $rtn[]=$i;
                return $rtn;
        }

        /**
         *  CREATE COMBO BOX
         */
        public static function create_combo_box($element_name='',$style='',$key_value,$default='',$first_row_empty='yes') {
//                var_dump($key_value);
                $rtn = '<select name="'.$element_name.'" style="'.$style.'">';
                $rtn.= $first_row_empty=='yes' ? '<option value=""></option>':'';
                foreach ($key_value as $key=>$value){
	    $selected= $default==$key ?'selected="selected"':'';
	    $rtn.='<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                }
                $rtn.='</select>';
                return $rtn;
        }

}

?>