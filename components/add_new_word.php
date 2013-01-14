<?php 

//var_dump($_POST);

if(isset($_POST['add'])){
        
        $key_val=array();
        $key_val['phrase']=$_POST['phrase'];
        $key_val['meaning']=$_POST['meaning'];
        $key_val['synonym']=$_POST['synonym'];
		
        $key_val['user_id']=$_SESSION['user_info']['id'];
        
        $id=phrases::set_vals($key_val);
        
        foreach ($_POST['example_usage'] as $ex){
               if(!empty($ex))
	   example_usege::set_vals (array('phrase_id'=>$id,'example_usage'=>$ex));
        }
        
        
        $_SESSION['dialog']['title']="Done!";
        $_SESSION['dialog']['body_short']='New Word/Phrase added successfully.';
        
        header('location: /');
        die();
        
        
        
        
        
        
}

?>



<style type="text/css">

#add_new_word label{
	text-align:right;
	width:120px;
	display:inline-block;
}

#add_new_word input[type=text]{
	width:200px;
}

#add_new_word .examples .cell{
	margin-bottom:10px;
}

#add_new_word .examples .cell input[type=text]{
	width:500px;
}

#add_new_word .examples .cell:last-child{
	margin-bottom:0px;
}

</style>


<div id="add_new_word">


<div class="title_3">Add new word/phrase</div>
<hr class="doted" />

<form action="" method="post" class="internal">

<div class="row">

<div class="cell">
	<label>Word/Phrase</label>
    <input name="phrase" type="text">
</div>

</div>





<div class="row examples">

<div class="cell">
	<label>Example usage 1: </label>
    <input name="example_usage[1]" type="text">
</div><br>

<div class="cell">
	<label>Example usage 2: </label>
    <input name="example_usage[2]" type="text">
</div><br>

<div class="cell">
	<label>Example usage 3: </label>
    <input name="example_usage[3]" type="text">
</div><br>

<div class="cell">
	<label>Example usage 4: </label>
    <input name="example_usage[4]" type="text">
</div><br>

<div class="cell">
	<label>Example usage 5: </label>
    <input name="example_usage[5]" type="text">
</div>

</div>





<div class="row">

<div class="cell">
	<label>Synonym(Optional)</label>
    <input name="synonym" type="text">
</div>

</div>




<div class="row">

<div class="cell">
	<label>Meaning(Optional)</label>
    <input name="meaning" type="text">
</div>

</div>


<div class="row">

<div class="cell">
	<input class="btn" name="add" type="submit" value="Submit" style="margin-left:137px">
</div>

</div>


</form>

</div>