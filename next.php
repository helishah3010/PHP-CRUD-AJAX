<?php
	include 'db_config.php';
?>
<html>
<head></head>
<body>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Contact no</th><th>Choose to update</th></tr>
<?php
$resultNext=mysqli_query($con,"select * from phonebook LIMIT $rows ");
	while($showNext=mysqli_fetch_array($resultNext))
	{
?>
		<tr><td><?php echo $showNext['ID']; ?></td>
			<td><?php echo $showNext['Name']; ?></td>
			<td><?php echo $showNext['phone_no']; ?></td>
			<td><a href="form1.php?nextid=<?php echo $showNext['ID'];  ?> ">edit</a></td>
		</tr>
	<?php
	}
	?>
	<tr>
	<td><a href="index.php">previous>></a></td>
	<td><a href="next.php">Next>></a></td></tr>
	</table>