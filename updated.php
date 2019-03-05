<?php
	include 'db_config.php';
	$na=$_GET['name'];
	$pno=$_GET['no'];
	$id=$_GET['id']; 
	$str1="UPDATE phonebook SET Name='".$na."',phone_no='".$pno."' WHERE ID='".$id."'";
	if(mysqli_query($con,$str1))
		echo "<br>Database updated!";	
	else
		echo "<br>Sorry!Could not update data"; 
?>