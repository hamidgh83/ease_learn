<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<style type="text/css">
        #list_of_words ul li{
                float:left;
                margin-right:10px;
                margin-bottom:10px;
                background:#9CF;
                padding: 5px 15px;
                border:1px solid #8AA7D3;
                -moz-border-radius: 3px; -webkit-border-radius: 3px; 
                background: #b0d5fb;
                background: -moz-linear-gradient(top,  #b0d5fb 0%, #8aa7d3 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b0d5fb), color-stop(100%,#8aa7d3));
                background: -webkit-linear-gradient(top,  #b0d5fb 0%,#8aa7d3 100%);
                background: -o-linear-gradient(top,  #b0d5fb 0%,#8aa7d3 100%);
                background: -ms-linear-gradient(top,  #b0d5fb 0%,#8aa7d3 100%);
                background: linear-gradient(to bottom,  #b0d5fb 0%,#8aa7d3 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b0d5fb', endColorstr='#8aa7d3',GradientType=0 );


                text-transform: capitalize;
                font-family: tahoma;

        }

        #list_of_words fieldset{
                padding: 10px 10px 0px 10px;
                margin-bottom:20px;
                border: 1px solid #CCC;
                -moz-border-radius: 5px; -webkit-border-radius: 5px;
                background: #eceff5;
                background: -moz-linear-gradient(top,  #eceff5 0%, #ffffff 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eceff5), color-stop(100%,#ffffff));
                background: -webkit-linear-gradient(top,  #eceff5 0%,#ffffff 100%);
                background: -o-linear-gradient(top,  #eceff5 0%,#ffffff 100%);
                background: -ms-linear-gradient(top,  #eceff5 0%,#ffffff 100%);
                background: linear-gradient(to bottom,  #eceff5 0%,#ffffff 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eceff5', endColorstr='#ffffff',GradientType=0 );


        }

        #list_of_words fieldset legend{
                margin-left:10px;
                padding:0px 5px;
                background: white;
                border: 1px solid #CCC;
                border: 1px solid #CCC;
                -moz-border-radius: 5px; -webkit-border-radius: 5px;
                background: #eceff5;
                border-bottom: none;
                display: inline-block;
                margin-top: -10px;
        }

</style>


<div id="list_of_words">

        <?php
        $time_range = phrases::get_first_n_last_rec_date();

        $time_range['first_rec'] = substr($time_range['first_rec'], 0, 10);
        $time_range['last_rec'] = substr($time_range['last_rec'], 0, 10);

        $stack_date = $time_range['last_rec'];


        do {
                $stack_phrase = phrases::get_recs_in_range_date($stack_date, $stack_date);
                if (!$stack_phrase) {
	    $stack_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($stack_date)) . " -1 day"));
	    continue;
                }
//        var_dump($stack_phrase[0]);
                ?>





                <fieldset>

                        <legend><?= date("D j M Y", strtotime($stack_phrase[0]['date_added'])) ?></legend>

                        <ul>
	            <?php foreach ($stack_phrase as $temp) { ?>
                	    <li title="<?= $temp['synonym'] ?>"> <?= $temp['phrase'] ?> </li>
	            <?php } ?>

                        </ul>


                </fieldset>

                <?php
                $stack_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($stack_date)) . " -1 day"));
        } while ($stack_date != date("Y-m-d", strtotime(date("Y-m-d", strtotime($time_range['first_rec'])) . " -1 day")));
        ?>







</div>