<?php
if(!isset($_POST['user_id'])||empty($_POST['user_id']))
{
	die('Bad Page.');
}
else
{	
	include('../php/connect.php');
	$user_id=$_POST['user_id'];
	$exist=mysqli_query($con,"SELECT * FROM `mapping_table` where manager='$user_id'");
	if(mysqli_num_rows($exist)>0)
	{
		include('../php/close_connection.php');
		?><script type="text/javascript">
			alert('User is a part of an existing team. Please remove user from all teams before attempting to remove from database');

			window.location.replace('../html/index.html');
		</script><?php
	}
	else
	{	
		mysqli_query($con,"DELETE from `bas_user` WHERE user_id='$user_id'");
		include('../php/close_connection.php');
		header('Location: ../html/index.html');
	}
}
?>