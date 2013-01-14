<?

class _validator {

        public static function strip_tag_from_array($arr) {
                $new_arr = array();
                foreach ($arr as $key => $text) {
	    $new_arr[$key] = self::strip_tag($text);
                }
                return $new_arr;
        }

        public static function strip_tag($text) {
                // PHP's strip_tags() function will remove tags, but it
                // doesn't remove scripts, styles, and other unwanted
                // invisible text between tags.  Also, as a prelude to
                // tokenizing the text, we need to insure that when
                // block-level tags (such as <p> or <div>) are removed,
                // neighboring words aren't joined.
                $text = preg_replace(
	    array(
	// Remove invisible content
	'@<head[^>]*?>.*?</head>@siu',
	'@<style[^>]*?>.*?</style>@siu',
	'@<script[^>]*?.*?</script>@siu',
	'@<object[^>]*?.*?</object>@siu',
	'@<embed[^>]*?.*?</embed>@siu',
	'@<applet[^>]*?.*?</applet>@siu',
	'@<noframes[^>]*?.*?</noframes>@siu',
	'@<noscript[^>]*?.*?</noscript>@siu',
	'@<noembed[^>]*?.*?</noembed>@siu',
	// Add line breaks before & after blocks
	'@<((br)|(hr))@iu',
	'@</?((address)|(blockquote)|(center)|(del))@iu',
	'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
	'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
	'@</?((table)|(th)|(td)|(caption))@iu',
	'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
	'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
	'@</?((frameset)|(frame)|(iframe))@iu',
	    ), array(
	' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
	"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
	"\n\$0", "\n\$0",
	    ), $text);
                $text = strtr($text, array(
	"\0" => "",
	"'" => "&#39;",
	"\"" => "&#34;",
	"\\" => "&#92;",
	// more secure
	"<" => "&lt;",
	">" => "&gt;",
	    ));

                // Remove all remaining tags and comments and return.
                return strip_tags($text);
        }
        
        
        public static function strip_quote($text){
                    return strtr($text, array(
        "\0" => "",
        "'"  => "&#39;",
        "\"" => "&#34;"
    ));

        }

        /*         * ***********************Email Validation****************************** */

        public static function email_validation($email) {
                if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
//            if (ereg("^([0-9a-z_.\-]+)@([0-9a-z_\-]+\.)+[a-z0-9]{2,4}$", $email))
	    return true;
                else
	    return false;
        }

        //sending email verification after register
        public static function send_mail($to, $subject, $message_entery) {
                con_email_center::send_mail($to, $subject, $message_entery);
        }

}

?>