<?php require_once '_head_and_open_body.php';?>

<div id="temp_header" class="clear">
    <div class="temp_container">
               <?=$_header?>
    </div>           
</div>
<div id="temp_wraper" class="clear">
	
        
        <div id="temp_row1" class="clear"> 
                 <div class="temp_container">
                    <?=$_section1?>
                 </div>
        </div>
        
        <div id="temp_row2" class="temp_container"> 
                 
                    <?=$_section2?>
                
        </div>
        
        <div id="temp_row2" class="clear">                
                    <div id="temp_row2__section1"><?=$_section3?></div>
                    <div id="temp_row2__section2"><?=$_section4?></div>
        </div>
   
</div>
<div id="temp_footer" class="clear">                
                <?=$_footer?>
</div>
                
<?php require_once '_before_and_body_close.php';?>
     