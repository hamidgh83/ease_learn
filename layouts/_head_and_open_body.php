<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
		
		<meta name="ROBOTS" content="INDEX, FOLLOW">
		<meta name="revisit-after" content="2 days">
		<meta name="distribution" content="web">
		<?=$_meta;?>
		
		
		<meta name="keywords" content="<?=$_meta_keywords ?>" />
		<meta name="description" content="<?=$_meta_description ?>" />
	

        <title><?=$_title ?></title>

        <script type="text/javascript" src='/js/jquery-1.7.2.min.js' ></script>
       	<script src="/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        
        <link type="text/css" rel="stylesheet" href="/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
        
        <link type="text/css" rel="stylesheet" href="/css/elements.css" />
		<link href="/css/<?=$navigator['layout']?>.css" rel="stylesheet" type="text/css" />
		
		<!-- ***ADD MORE EXTERNAL CSS AND JS FILES***
		<script type="text/javascript" src='/js/####.js' ></script>
		<link type="text/css" rel="stylesheet" href="/css/####.css" />
		-->
</head>


<body>


<?php
// SHOW DIALOG BOX - START

/*

  $_SESSION['dialog']['title']=
  $_SESSION['dialog']['body_short']=
  $_SESSION['dialog']['body_long']=
  $_SESSION['dialog']['btns']=  DEF CLOSE
  $_SESSION['dialog']['selector_id']= OPTIONAL
  $_SESSION['dialog']['width']=  DEF 410

 */

if (isset($_SESSION['dialog'])) {

        if (!isset($_SESSION['dialog']['width']))
                $_SESSION['dialog']['width'] = 410;

        if (!isset($_SESSION['dialog']['selector_id']))
                $_SESSION['dialog']['selector_id'] = time();

        if (!isset($_SESSION['dialog']['btns']))
                $_SESSION['dialog']['btns'] = 'buttons: [{text: "Close",click: function() { $(this).dialog("close"); }}]';

        echo '<script type="text/javascript">
                $(document).ready(function() {
                $("#' . $_SESSION['dialog']['selector_id'] . '").dialog({
                  modal: true,
                  title:" ' . $_SESSION['dialog']['title'] . ' ",
                  width:' . $_SESSION['dialog']['width'] . ',
                  ' . $_SESSION['dialog']['btns'] . '
        });
});</script>';

        echo '<div id="' . $_SESSION['dialog']['selector_id'] . '" class="invisible">';

        if (isset($_SESSION['dialog']['body_short']))
                echo '<div class="title_4">' . $_SESSION['dialog']['body_short'] . '</div>';
        elseif (isset($_SESSION['dialog']['body_long']))
                echo $_SESSION['dialog']['body_long'];

        echo '</div>';

        unset($_SESSION['dialog']);
}

// SHOW DIALOG BOX - END
?>
