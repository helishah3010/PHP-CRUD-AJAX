<?php
	include 'db_config.php';

	
	$option=$_GET['opt'];
	$txt=$_GET['txt'];

	echo "$option";
	echo "$txt";
	if($option="ID")
	{
		$sql="Select * from phonebook WHERE ID LIKE '(intval($txt))%'";
	}
	else if($option="Name")
	{
		$sql="Select * from phonebook WHERE Name LIKE '$txt%'";
	}
	 else
	{
		$sql="Select * from phonebook WHERE phone_no LIKE '$txt%'";
	}
	$rs=mysqli_query($con,$sql);
	?>
<html>
<head></head>
<body>
<table>
<?php
	if($rs)
	{
		while($result=mysqli_fetch_array($rs))
		{?>
		<tr><td><?php echo $result['ID']; ?></td>
		<td><?php echo $result['Name']; ?></td>
		<td><?php echo $result['phone_no']; ?></td>
		<td><a href="form1.php?editid=<?php echo $result['ID']; ?>">Edit</a>
		&nbsp;&nbsp;<a href="form1.php?deleteid=<?php echo $result['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
		</td></tr>
		<?php
	}	}
	?>
	</table>
	</body>
	</html>
