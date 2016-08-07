<?php
if(!isset($_POST['username'])||!isset($_POST['curr_username']))	
{
	die('Bad Page');
}
else
{	
	if(empty($_POST['username']))
	{
		?>
		<script>
		alert('Please enter a valid username');
		window.location.replace('../php/edit_user.php');
		</script>
		<?php
	}
	else
	{	
		include('../php/connect.php');
		mysqli_query($con,"UPDATE `bas_user` SET user_name='".$_POST['username']."' WHERE user_name='".$_POST['curr_username']."'");
		
		?>
		<script>
			alert('Done');
			window.location.replace('../');
		</script>
		<?php
		
	}
}
?>