<?php 
session_start();//because session must be started before html tag

?>
<html>
<head></head>
<body>
<form action="" method="post">
<select name="opt">
<option name="ID" id="id">ID</option>
<option name="Name" id="name">Name</option>
<option name="phone_no" id="no">phone_no</option>
</select>
Enter<input type="text" name="txt" id="txtid"/>
<input type="submit" value="search"/>
</form>
<table border="1" width=400px height=500px cellpadding="3">
	<tr><th>ID</th><th>Name</th><th>Contact no</th><th>Choose to update</th></tr> 
<?php
	include 'db_config.php';
  
    if($_POST)
	{
		$option=@$_POST['opt'];
		$txt=@$_POST['txt'];
		$_SESSION['option']=$option;
		$_SESSION['txts']=$txt;
		
		echo "IF block ".$option."</br>";									//checked
		echo "if block ".$txt."</br>";										//checked
	}
    else//checked
    {	
		$_SESSION['option']="ID";
		$_SESSION['txts']="";
		$option=$_SESSION['option'];
		$txt=$_SESSION['txts'];	
    }//checked
	
	if($option=="ID" && $txt=="")//checked
	{
		$limit=3;
		$sql = "select * from phonebook";
		$rs=mysqli_query($con,$sql);
		$total_results = mysqli_num_rows($rs);
		$total_pages=ceil($total_results/$limit);
		
		echo "Pages ".$total_pages;														
		
		if (isset($_GET['page'])) {
			$show_page = $_GET['page']; //current page
			if ($show_page > 0 && $show_page <= $total_results) {
				$start = ($show_page - 1) * $limit;
				$end = $start + $limit;
			} 
			else {
				$start = 0;
				$end = $limit;
			}
		} 
		else {
			// if page isn't set, show first set of results
			$start = 0;
			$end = $limit;
		}   
		$page = intval(@$_GET['page']);
		if ($page <= 0)
		$page = 1;		
		$sql.=" LIMIT ".$start.",".$limit.""; 		
		echo "query ".$sql;																			
		if(mysqli_query($con,$sql))														
		{
			$resultsearch=mysqli_query($con,$sql);  
			echo "</br>resultresearch";
			while($result2=mysqli_fetch_array($resultsearch))
				{ ?>																
				<tr><td><?php echo $result2['ID'];?></td>
				<td><?php echo $result2['Name']; ?></td>
				<td><?php echo $result2['phone_no']; ?></td>
				<td><a href="form1.php?editid=<?php echo $result2['ID']; ?>">Edit</a>
				&nbsp;&nbsp;<a href="form1.php?deleteid=<?php echo $result2['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
				</td></tr>
				<?php
				}?>
			<tr align="center">
			<td>
			<?php
				for($page=1;$page<$total_pages+1;$page++)
				{	
					if($page == @$show_page)
						echo ' '.$page.' ';
					else
						echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($page).'">'.($page).'</a>&nbsp;&nbsp;&nbsp'; 
				}
			?>
				</td></tr></table>
	<?php	}	
		
	}	//checked
	
	if($txt)
	{	
		$sql = "select * from phonebook";
		echo "if txt vado block";											//checked
		switch($option)
			{
				case "ID":
					$sql.=" WHERE ID LIKE '".$txt."%'";
					break;
				case "Name":
					$sql.=" WHERE Name LIKE '".$txt."%'";
					break;
				case "phone_no":
					$sql.=" WHERE phone_no LIKE '".$txt."%'";
					break;
			}
	
	 //pagination
	if(!empty($_SESSION['option']) && !empty($_SESSION['txts']))
	{
		echo "</br>".$sql;
		echo "</br>empty session vado block";											//checked
		$limit=3;
		$rs=mysqli_query($con,$sql);
		$total_results = mysqli_num_rows($rs);
		echo "Rows ".$total_results;												//checked
		
		$total_pages=ceil($total_results/$limit);
		echo "pages ".$total_pages;															//checked
		if (isset($_GET['page'])) {
			$show_page = $_GET['page']; //current page
			if ($show_page > 0 && $show_page <= $total_results) {
				$start = ($show_page - 1) * $limit;
				$end = $start + $limit;
			} 
			else {
				$start = 0;
				$end = $limit;
			}
		} 
		else {
			// if page isn't set, show first set of results
			$start = 0;
			$end = $limit;
			}  
		$page = intval(@$_GET['page']);
		if ($page <= 0)
			$page = 1;
			
		$sql.=" LIMIT ".$start.",".$limit."";
		echo "sql ".$sql;		 											//checked
		if(mysqli_query($con,$sql))
		{
			echo "QUERY RUN";												//checked
		$resultsearch=mysqli_query($con,$sql);
		while($result2=mysqli_fetch_array($resultsearch))
				{?>
				<tr><td><?php echo $result2['ID'];?></td>			
				<td><?php echo $result2['Name']; ?></td>
				<td><?php echo $result2['phone_no']; ?></td>
				<td><a href="form1.php?editid=<?php echo $result2['ID']; ?>">Edit</a>
				&nbsp;&nbsp;<a href="form1.php?deleteid=<?php echo $result2['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
				</td></tr>
				<?php
				}?>
			<tr align="center">
			<td>
			<?php
				for($page=1;$page<$total_pages+1;$page++)
				{	
					if($page == @$show_page)
						echo ' '.$page.' ';
					else
						echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($page).'">'.($page).'</a>&nbsp;&nbsp;&nbsp'; 
				}
		?>
			</td></tr></table>
		<?php
		}
	}	}?>		
	</body>
	</html>