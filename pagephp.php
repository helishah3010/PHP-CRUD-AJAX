

<?php								//ONLY DISPLAY DATA WITHOUT EDIT DELETE AND PAGINATION
include 'db_config.php';
?>


<?php
	$select=$_POST['typeid'];
	$txt=$_POST['search'];
	//$select="ID";
	//$txt="1";
	$sql="select * from phonebook";

	switch($select)
	{
		case "ID":
			$sql.=" WHERE ID LIKE '".$txt."%' ";
			break;
		case "Name":
			$sql.=" WHERE Name LIKE '".$txt."%'";
			break;
		case "phone_no":
			$sql.=" WHERE phone_no LIKE '".$txt."%'";
			break;
	}
		if(!mysqli_query($con,$sql))
			echo "query didnt worked";
		else
			$result=mysqli_query($con,$sql);
		?>
		<table border="1px" width="400px" height="500px">
		<tr><th>ID</th><th>Name</th><th>Contact no</th></tr>
		<?php
		while($rs=mysqli_fetch_array($result))
		{?>																
					<tr><td><?php echo $rs['ID'];?></td>
					<td><?php echo $rs['Name']; ?></td>
					<td><?php echo $rs['phone_no']; ?></td>
					</tr>
					<?php
		}?>
</table>