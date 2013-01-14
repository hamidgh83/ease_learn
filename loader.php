<?php

if (!session_id())
        session_start();


// *****************************************************************************

require_once dirname(__file__) . '/models/_navigator.php';
require_once dirname(__file__) . '/models/_public_config.php';



define('LAYOUT_DIRECTORY', dirname(__file__) . '/layouts/');
define('COMPONENET_DIRECTORY', dirname(__file__) . '/components/');

// *****************************************************************************

DatabaseEngine::getNewConnection();

function __autoload($name) {
        if (substr($name, 0, 4) == 'con_')
                require_once dirname(__FILE__) . "/control/$name.php";
        elseif ($name == 'DatabaseEngine')
                require_once dirname(__FILE__) . "/models/datbase_engin.php";
        else
                require_once dirname(__FILE__) . "/models/$name.php";
}

function loadComponents($fileName) {
        ob_start();
        require $fileName;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
}

function loadComponentsArray($compArray) {
        $contents = '';

        if (empty($compArray)) {
                return '&nbsp;';
        } elseif (is_array($compArray)) {
                foreach ($compArray as $com) {
	    $contents .= loadComponents(COMPONENET_DIRECTORY . $com . '.php');
                }
        } else {
                $contents .= loadComponents(COMPONENET_DIRECTORY . $compArray . '.php');
        }

        return $contents;
}

// *****************************************************************************

$_met = 'PCEtLSBGUkFNRVdPUksgVkVSIDEuOCwgMTUvSlVORS8yMDEyLS0+DQo8bWV0YSBuYW1lPSJhdXRob3IiIGNvbnRlbnQ9IlMuTS5IYWRpIEhvc2VpbmkgYnkgVG9wSVRTb2x1dGlvbi5jb20iPg0KPG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1UeXBlIiBjb250ZW50PSJ0ZXh0L2h0bWw7IGNoYXJzZXQ9dXRmLTgiPg==';
$_meta = base64_decode($_met);

$_header = loadComponentsArray($navigator['header']);

$_section1 = loadComponentsArray($navigator['section1']);
$_section2 = loadComponentsArray($navigator['section2']);
$_section3 = loadComponentsArray($navigator['section3']);
$_section4 = loadComponentsArray($navigator['section4']);
$_section5 = loadComponentsArray($navigator['section5']);
$_section6 = loadComponentsArray($navigator['section6']);

$_footer = loadComponentsArray($navigator['footer']);


// SET CUSTOMISE TITLE : 
// $_SESSION['loader_injection_title']
if (!isset($_SESSION['loader_injection_title'])) {
        $_title = $navigator['title'];
} else {
        $_title = $_SESSION['loader_injection_title'];
        unset($_SESSION['loader_injection_title']);
}


// SET CUSTOMISE META DESCRIPTION : 
// $_SESSION['loader_injection_meta_description']
if (!isset($_SESSION['loader_injection_meta_description'])) {
        $_meta_description = $_title;
} else {
        $_meta_description = $_SESSION['loader_injection_meta_description'];
        unset($_SESSION['loader_injection_meta_description']);
}


// SET CUSTOMISE META KEYWORDS : 
// $_SESSION['loader_injection_meta_keywords']
if (!isset($_SESSION['loader_injection_meta_keywords'])) {
        $_meta_keywords = $_title;
} else {
        $_meta_keywords = $_SESSION['loader_injection_meta_keywords'];
        unset($_SESSION['loader_injection_meta_keywords']);
}

// *****************************************************************************


require_once LAYOUT_DIRECTORY . $navigator['layout'] . '.php';

DatabaseEngine::closeConnectionSession();
?>
