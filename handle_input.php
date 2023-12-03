<?php 
session_start();

$_SESSION['data'][$_REQUEST['dimension']][$_REQUEST['subdimension']][$_REQUEST['content']][$_REQUEST['index']] = $_REQUEST['value'];

?>