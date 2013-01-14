<?php 
session_start();
$_SESSION['user_info']=array();
unset($_SESSION['user_info']);

header('location: '.$_SERVER['HTTP_REFERER']);
die();
?>