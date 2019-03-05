<?php include 'db_config.php';
	
	$na=$_GET['name'];
	$pno=$_GET['no'];
	$id=$_GET['id'];
	$str="insert into phonebook (ID,Name,phone_no) values('".$id."','".$na."','".$pno."')";
	if(mysqli_query($con,$str)){
		header('location:index.php');
		exit(0);
	}
		
	
		
	?>
	<html>
	<head>
	<body>
	<form action="form1.php">
	<input type="submit" value="back"/>
	</form>
	</body>
	</head>
	</html>
	<?php } 
	//TO FIND NO OF FIELDS AND ROWS
	/* $result=mysqli_query($con,"Select * from phonebook");
	$col=mysqli_num_fields($result);
	$rows=mysqli_num_rows($result);
	printf("There are %d columns and %d rows",$col,$rows); */
	
	//information about each field
	//$currentfield=mysqli_field_tell($result);
	/* $count=0;
	while($finfo=mysqli_fetch_array($result))
	{
		$count++;
	}
	echo "<br>".$count; */
?>
