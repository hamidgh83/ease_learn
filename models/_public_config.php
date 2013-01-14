<?php


/*
 * THIS FILE IS INCLUDING PUBLIC CONSTANTS AND CONFIGURATION 
 * ========================
 * -> LOADS IN ALL PAGES <-
 * ========================
 */

$_SESSION['user_info']['id']=1;


define('DOMAIN', 'http://' . $_SERVER['HTTP_HOST'] . '/');


date_default_timezone_set('Asia/Kuala_Lumpur');


$_SESSION['debug'] = 1;

$_SESSION['loader_injection_meta_description'] = ' MyDaroo.com::مای دارو اولین بانک رسمی تبادل دارو در ایران با بیش از 200 داروخانه عضو ارایه دهنده خدمات تبادل دارو و سرویسهای رایگان برای داروخانه ها';



//:::::::::EMAIL DEFINDER:::::::::

$_mail_fix_rec='dominantboy@gmail.com,saharfarnaz@yahoo.com,dr.fkahrizi@gmail.com';
//$_mail_fix_rec='dominantboy@gmail.com';

$_SESSION['_mail_']['admin']=$_mail_fix_rec.'';
$_SESSION['_mail_']['operator']=$_mail_fix_rec.',farshid.763@gmail.com';
$_SESSION['_mail_']['support']=$_mail_fix_rec.'';






/**
 * SET MESSAGE STRING
 * @param type $message STRING
 * @param type $alert_type GREEN (DEF) OR RED OR YELLOW
 */
function msg_set($message, $alert_type='green') {
        $_SESSION['msg']['txt'] = $message;
        $_SESSION['msg']['alert'] = $alert_type;
}

function msg_view() {
        if (isset($_SESSION['msg']['txt'])) {
                if (!isset($_SESSION['msg']['alert']))
	    $_SESSION['msg']['alert'] = 'green';

                echo '<div class="alert_' . $_SESSION['msg']['alert'] . '">' . $_SESSION['msg']['txt'] . '</div>';
                unset($_SESSION['msg']);
                return true;
        }else {
                return false;
        }
}


//:::::::::MY NOTES:::::::::
//==============================================================================================================

/*
:::::::::PERSIAN CELENDER:::::::::

$persian=new con_persian_date();

echo '<br><br><span class="font_tahoma">'.$persian->date('complete').'</span><br><br>';

echo '<br><br><span class="font_tahoma">'.$persian->to_date("2010-07-21 18:20:41",'complete').'</span><br><br>';

$persian->to_date("2010-07-21 18:20:41",'complete');
$persian->to_date("2010-07-21 18:20:41",'just_date');

 




::::::::: SHOW DIALOG BOX :::::::::

$_SESSION['dialog']['title']=
$_SESSION['dialog']['body_short']=  
$_SESSION['dialog']['body_long']=  
$_SESSION['dialog']['btns']=  DEF CLOSE
$_SESSION['dialog']['selector_id']= OPTIONAL
$_SESSION['dialog']['width']=  DEF 410 


*/

?>
