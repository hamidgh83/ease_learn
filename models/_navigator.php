<?php
// URL PARAMETERS

$action = ($_GET['action'] == '') ? '_index_' : $_GET['action'];
$p1 = (isset($_GET['p1'])) ? $_GET['p1'] : '';
$p2 = (isset($_GET['p2'])) ? $_GET['p2'] : '';
$p3 = (isset($_GET['p3'])) ? $_GET['p3'] : '';
$p4 = (isset($_GET['p4'])) ? $_GET['p4'] : '';
$p5 = (isset($_GET['p5'])) ? $_GET['p5'] : '';





switch ($action) {
        case "_index_":
                $navigator = array(
	'layout' => 'layout_1_1_2_1',
	'title' => 'Ease of Learning Language by EaseLearnLanguage',
	'header' => array('_header'),
	'section1' => 'top_menu',
	'section2' => 'list_of_words',
	'section3' => '',
	'section4' =>'',
	'section5' => '',
	'section6' => '',
	'footer' => '',
                );
                break;
        
        
        case "add-new-word":
                $navigator = array(
	'layout' => 'layout_1_1_2_1',
	'title' => 'Add New Word',
	'header' => array('_header'),
	'section1' => 'top_menu',
	'section2' => 'add_new_word',
	'section3' => '',
	'section4' =>'',
	'section5' => '',
	'section6' => '',
	'footer' => '',
                );
                break;


        
}











//