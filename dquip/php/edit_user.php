<?php
if(!isset($_POST['user_id'])||empty($_POST['user_id']))
{
	die('Bad Page.');
}
else
{	?>
	<head><script type="text/javascript" src="../scripts/jquery.js"></script></head>
	<?php
	include('../php/connect.php');
	include('../html/style.css');
	$user_id=$_POST['user_id'];
	$username=mysqli_query($con,"SELECT user_name from `bas_user` where user_id = '$user_id'");
	$username_array=mysqli_fetch_array($username);
	?>
	<p>Enter New username for <?php echo $username_array['user_name'];?>
	<form action="edit_enter.php" method="post">
	<input type="hidden" name="curr_username" value="<?php echo $username_array['user_name'];?>">
	<input type="text" name="username" placeholder="Enter new username">
	<input type="submit" value="submit">
	</form>
	<button id="back_button">Go Back</button>
<script type="text/javascript">
	$("#back_button").click(function(){
		window.location.replace('../html/edit_user.html');
	});
</script>
	<?php
	include('../php/close_connection.php');
}
?>