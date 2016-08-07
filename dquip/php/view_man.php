<?php
if(!isset($_POST['view_man']))
{
	die("Bad page. Very bad page.");
}
else
{
	$variable=$_POST['view_man'];
	include('../php/connect.php');
	include('../html/style.css');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php 
	$curr_usr_query=mysqli_query($con,"SELECT * FROM `bas_user` WHERE user_id = '$variable'");
	$curr_usr=mysqli_fetch_array($curr_usr_query);
	function find_man($var,$show_del=0)
	{	
		include('../php/connect.php');
		$flag=1;
		while($flag==1)
		{
			$man_query=mysqli_query($con,"SELECT * FROM `mapping_table` where team_member = '$var'");
			if(mysqli_num_rows($man_query)!=0)
			{
				while($man_arr=mysqli_fetch_array($man_query))
				{
					$user_id_loop = $man_arr['manager'];
					$find_username_query=mysqli_query($con,"SELECT * FROM `bas_user` where user_id = '$user_id_loop'");
					$find_username_array=mysqli_fetch_array($find_username_query);
					echo '<tr><td>'.$find_username_array['user_name'].'</td>';
					?>
					<td>
						<form action="delete_mem.php" method="post">
							<input type="hidden" name="curr_usr" value="<?php echo $var;?>">
							<input type="hidden" name="todel_mem" value="<?php echo $find_username_array['user_id'];?>">
							<input type="hidden" name="flag_val" value="1">
							<button type="submit" value="submit">Delete</button>
						</form>
					</td>	
					</tr>
					<?php
					find_man($user_id_loop);
					$flag=0;
				}
			}
			else $flag=0;
			
		}
	}

?>
	<title>Managers of <?php echo $curr_usr['user_name'];?></title>
	<script type="text/javascript" src="../scripts/jquery.js"></script>
</head>
<body>
<p>Here are the managers of <strong><?php echo $curr_usr['user_name'];?>:</strong></p>
<table>
	
<?php
	$show_del=$_POST['show_delete'];

?><thead>
		<tr>
			<th>Username:</th>
			<th>Actions:</th>
		</tr>
	</thead>
	<tbody>
		
			<?php find_man($variable,$show_del);?>
		
	</tbody>
</table>
<button id="back_button">Go Back</button>
<script type="text/javascript">
	$("#back_button").click(function(){
		window.location.replace('../html/list_users.html');
	});
</script>
</body>
</html>