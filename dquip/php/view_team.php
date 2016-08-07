<?php
if(!isset($_POST['view_team']))
{
	die("Bad page. Very bad page.");
}
else
{
	$variable=$_POST['view_team'];
	include('../php/connect.php');
	$show_del=$_POST['show_delete'];
	include('../html/style.css');

}
?>
<!DOCTYPE html>
<html>
<head>
<?php 
	$curr_usr_query=mysqli_query($con,"SELECT * FROM `bas_user` WHERE user_id = '$variable'");
	$curr_usr=mysqli_fetch_array($curr_usr_query);

	
	
?>
	<title>Team members of <?php echo $curr_usr['user_name'];?></title>
	<script type="text/javascript" src="../scripts/jquery.js"></script>
</head>
<body>
<?php
function find_team($var,$show_del=0)
	{
		include('../php/connect.php');

		
		?>
		<?php
		$flag=1;
		while($flag==1)
		{
			$team_query=mysqli_query($con,"SELECT * FROM `mapping_table` where manager = '$var'");
			if(mysqli_num_rows($team_query)!=0)
			{
				while($team_arr=mysqli_fetch_array($team_query))
				{
					$user_id_loop = $team_arr['team_member'];
					$find_username_query=mysqli_query($con,"SELECT * FROM `bas_user` where user_id = '$user_id_loop'");
					$find_username_array=mysqli_fetch_array($find_username_query);
					echo '<tr><td>'.$find_username_array['user_name'].'</td>';
					?>
					<td>
						<form action="delete_mem.php" method="post">
							<input type="hidden" name="curr_usr" value="<?php echo $var;?>">
							<input type="hidden" name="todel_mem" value="<?php echo $find_username_array['user_id'];?>">
							<input type="hidden" name="flag_val" value="0">
							<button type="submit" value="submit">Delete from team</button>
						</form>
					<form id="submitform" method="post" action="../php/post_user_popup.php" target="_blank">
						<input type="hidden" name="user_id" value="<?php echo $find_username_array['user_id'];?>">
						<button type="submit" value="Submit">Set Reporting Rights</button>
					</form>
					<form id="view_team_form" method="post" action="../php/view_team.php">
						<input type="hidden" name="view_team" value="<?php echo $find_username_array['user_id'];?>">
						<input type="hidden" name="show_delete" value="1">
						<button type="submit" value="Submit">View Team Members</button>
					</form>
					<form id="view_man" method="post" action="../php/view_man.php">
						<input type="hidden" name="view_man" value="<?php echo $find_username_array['user_id'];?>">
						<input type="hidden" name="show_delete" value="1">
						<button type="submit" value="Submit">View Managers</button>
					</form>
					
					</td>
					</tr>
					<?php
					find_team($user_id_loop);
					$flag=0;
				}
			}
			else $flag=0;
			
		}
		
	}
	
 ?>
<p>Here are the team members of <strong><?php echo $curr_usr['user_name'];?>:</strong></p>
<table>
	
<thead>
		<tr>
			<th>Username:</th>
			<th>Actions:</th>
		</tr>
	</thead>
	<tbody>	
	
			<?php find_team($variable,$show_del);?>
		
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