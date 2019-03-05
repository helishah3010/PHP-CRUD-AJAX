<html>
<head>
<?php include 'db_config.php';
	$i=$_POST['id'];
	$str=mysqli_query($con,"Select * from phonebook WHERE ID=$i");
	if(!$str)
		echo die(mysqli_error());
	$result=mysqli_fetch_array($str);
?>
	<form action="updated.php" method="get">
		ID<input type="hidden" name="id" value="<?php echo $result['ID'] ?>"/></br>
		Name<input type="text" name="name" value="<?php echo $result['Name'] ?>"/>
		Phone no<input type="text" name="no" value="<?php echo $result['phone_no'] ?>"/>
		<input type="submit" name="edit" value="done"/>
	</form>
	

</head>
</html>