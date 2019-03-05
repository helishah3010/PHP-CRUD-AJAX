<?php
	include 'db_config.php';
	$val=$_GET['val'];	
	$sql="select * from phonebook WHERE Name='$val'";
	//echo $sql;
	if(!mysqli_query($con,$sql))
		echo "query didnt worked";
	else
	$result=mysqli_query($con,$sql);
	
	while($rs=mysqli_fetch_array($result))
	{
		echo "</br>ID:".$rs['ID'];
		echo "</br>Name:".$rs['Name'];
		echo "</br>Contact no:".$rs['phone_no'];
	}

?>