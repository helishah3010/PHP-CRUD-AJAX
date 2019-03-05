<?php
include 'db_config.php';

if(empty($_GET['name']))
	die("Name required!");
elseif(empty($_GET['no']))
	die("Contact no required!");
?>