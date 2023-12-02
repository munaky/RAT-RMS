<?php 
session_start();

$_SESSION[$_REQUEST['subdimension']][$_REQUEST['content']][$_REQUEST['index']] = $_REQUEST['value'];

?>