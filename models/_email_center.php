<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of _email_center
 *
 * @author Hadi Hoseini
 */
class _email_center {

//put your code here
        private static function _layout($body, $to) {
                $body=nl2br($body);
                $date = date("D j M Y - g:i:s A");
                $message = '<html><body>';
                $message .= '<div style="width:100%; text-align:center">
	<div id="mainFrame" style="width:550px;
	border-top:#295484 1px solid;
	border-bottom:#295484 5px solid;
	border-left:#295484 1px solid;
	border-right:#295484 1px solid;
	color:#333;
	text-align:justify;
	line-height:22px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	margin:0px auto;">
	<div class="header">
    <a href="http://www.mydaroo.com" title="Go to MyDaroo Homepage"><img src="http://www.mydaroo.com/images/email_header.png" width="550" height="75" alt="MyDaroo official website" longdesc="http://www.mydaroo.com" /></a></div>
	<div style="padding:60px 15px 5px 15px; overflow:auto; direction:rtl; font-family:Tahoma, Geneva, sans-serif">
	با اهدای سلام و احترام
    <br/>
    ' . $body . '
             <div style="clear:both"><br>با سپاس فراوان<br>
            تیم پشتیبانی مای دارو
            </div>
            <br><br><div align="center" style="text-align:center; font-size:10px;line-height:14px;">با تشکر از اینکه ما را برگزیدید<br><a href="http://www.mydaroo.com" title="Go to MyDaroo Homepage">www.mydaroo.com</a></div>
	</div>
    </div>


<table width="548px" border="0" cellspacing="0" cellpadding="0" style="/*border-top:1px dotted #ccc;*/ margin:30px auto auto;text-align:center;font-size:10px;min-height:38px;font-family:Arial,Helvetica,sans-serif">
        <tbody>
            <tr>
                <td style="padding:0px 30px;color:#999">
                This message sent to <a href="mailto:' . $to . '" target="_blank">' . $to . '</a> by <span style="color:#000"></span><span style="color:#D32121">MyDaroo</span><br>

                On ' . $date . '
                </td>
            </tr>
            <tr>
                    <td style="/*border-top:1px dotted #ccc;*/padding:0px 30px;color:#999">
                    Feel free to contact us for any enquiry at <a rel="nofollow" href="mailto:support@mydaroo.com" target="_blank">support@mydaroo.com</a>
                    </td>
            </tr>
            <tr>
                    <td style="/*border-top:1px dotted #ccc;*/padding:0px 30px;color:#999">
                    We respect your right to privacy- <a href="http://www.mydaroo.com/terms-and-condition">View our Privacy</a>
                    </td>
            </tr>

            <tr>
                    <td style="/*border-top:1px dotted #ccc;*/padding:0px 30px;color:#999">
                    &copy; 2012 <a href="http://www.mydaroo.com/" target="_blank"><span style="color:#000"> <span style="color:#D32121">MyDaroo.com</span></span></a>
                    </td>
            </tr>	

        </tbody>
    </table>
</div>';


                $message .= "</body></html>";
                return $message;
        }

        public static function send_email($to, $subject, $message) {
                $message = self::_layout($message, $to);
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                $headers .= 'From: MyDaroo <support@mydaroo.com>' . "\r\n";

                if (mail($to, $subject, $message, $headers))
	    return true;
                else
	    return false;
        }

}

?>
