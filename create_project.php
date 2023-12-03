<?php 
include('Database.php');

createProject($_REQUEST['name'], $_REQUEST['company'], $_REQUEST['address'], $_REQUEST['detail']);

header('location:dashboard.php');

?>