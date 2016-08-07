<?php

if(!isset($_POST['curr_usr'])||!isset($_POST['todel_mem'])||!isset($_POST['flag_val']))
{
	die("Bad Page.");
}
else
{
	include('../php/connect.php');
	$curr_usr=$_POST['curr_usr'];
	$todel_mem=$_POST['todel_mem'];
	$flag_val=$_POST['flag_val'];
	
	function connect_children($todel)
	{
		include('../php/connect.php');
		$curr_usr=$_POST['curr_usr'];
		
		
			$qu=mysqli_query($con,"SELECT * from `mapping_table` where manager='$todel'");
			if(mysqli_num_rows($qu)>1){
				?><script>
					alert('All team members are transferred to manager who removed this person from their team.');
				</script><?php
			}
			while($ar=mysqli_fetch_array($qu))
			{
				mysqli_query($con,"INSERT INTO `mapping_table` VALUES('".$ar['user_id_2']."','$curr_usr')");
			}
		
			
		
	}
	
	
	{	
		
		if($flag_val==0)
		{
		connect_children($todel_mem,$flag_val);
		mysqli_query($con,"DELETE FROM `mapping_table` WHERE manager='$curr_usr' AND team_member='$todel_mem'");
		include('../php/close_connection.php');	
		?><script>
			window.location.replace("../html/list_users.html");
		</script><?php
		}
		else
		{
		mysqli_query($con,"DELETE FROM `mapping_table` WHERE team_member='$curr_usr' AND manager='$todel_mem'");
		include('../php/close_connection.php');	
		?><script>
			window.location.replace("../html/list_users.html");
		</script><?php
		}
	}
	
}
?>