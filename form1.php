<?php
	include 'db_config.php';
	$msg="";
	$got="";
	$msg2="";
	if($_POST){
		$id=$_POST['id'];
		$name = $_POST['name'];
		$phone_num = $_POST['no'];
		$sql="Select phone_no from phonebook WHERE phone_no=$phone_num";
		if(@$_GET['editid'])
			$sql .= " and id <>".$_GET['editid'];
		$rs=mysqli_query($con,$sql);
		
		while($arr=mysqli_fetch_array($rs))
		{
		$got=$arr['phone_no'];
		}
		
		if(!preg_match("/^(\+91[\-\s]?)?[89]\d{9}$/",$phone_num))
		{
			$msg2="sorry!Incorrect format of phone number";		
		}			
		else if($got)
			 $msg2="Entered contact: ".$phone_num." already exists";		
		else{		
			if(@$_GET['editid'])
			{			
				$str1="UPDATE phonebook SET Name='".$name."',phone_no='".$phone_num."' WHERE ID='".$id."'";
				if(mysqli_query($con,$str1)){
					header('location:indexCopy.php');
					exit(0); 
				}		
			}
			else
			{						
				$str="insert into phonebook (Name,phone_no) values('".$name."','".$phone_num."')";
				 if(mysqli_query($con,$str)){
					header('location:indexCopy.php');
					exit(0); 
				}			
			}
		}
	}
	else if(!empty($_GET['editid']))
	{
		$i=$_GET['editid'];
		$st=mysqli_query($con,"Select * from phonebook WHERE ID=$i");
			if(!$st)
				echo die(mysqli_error());
		$result=mysqli_fetch_array($st);
		$id=$result['ID'];
		$name=$result['Name'];
		$phone_num=$result['phone_no'];
	}	
	else if(!empty($_GET['deleteid']))
	{
		$delid=$_GET['deleteid'];
		$sqldel="delete from phonebook WHERE ID='".$delid."'";
		if(mysqli_query($con,$sqldel)){
				header('location:indexCopy.php');
				exit(0); 
			}	
		else
			echo "sorry could not delete";
	}
	else
		$name = $phone_num =$id= '';		
?>
<html>
	<head>
		<title>Contact form</title>
		<script>
			function ValidateForm()
			{
				var return_flag = true;
				var n=document.getElementById("name");
				var num=document.getElementById("nu");
				if(n.value=="" || n.value==null){				
					alert("Name required");
					document.getElementById("name").focus();
					return_flag = false;
				}
				else if(num.value=="" || n.value==null){
					alert("Contact no required");
					document.getElementById("nu").focus();
					return_flag = false;
				}
				else
					return_flag = true;
				return return_flag;
				
			}
		</script>
	</head>
	<body>
		<form action="" method="post" onsubmit="return ValidateForm();">		
			<input type="hidden" name="id" value="<?php echo $id ?>" />
			Name<input type="text" name="name" id="name" value="<?php echo $name; ?>" />
			Phone no<input type="text" name="no" id="nu" value="<?php echo $phone_num; ?>" />
			<input type="submit" name="add" value="submit" />
			<a href="paginationCopy.html">List</a>
			<p><?php echo $msg2;
				?>
			</p>
		<!-- <input type="submit" name="edit" value="edit" onclick="action='edit.php'"/>  -->
		<!-- <input type="submit" value="Add"/> -->
		</form>
	</body>
</html>