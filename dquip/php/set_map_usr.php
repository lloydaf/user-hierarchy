<?php
if(!isset($_POST['curr_usr'])){
	die('Wrong page, dude.');
}
else
{	
	$invalid_flag=0;
	$curr_usr=$_POST['curr_usr'];
	include('../php/connect.php');
	if(!isset($_POST['team_member'])&&!isset($_POST['manager']))
	{
			?><script>
				alert('Invalid entry');
				window.close();
				</script><?php
	}
	else
	{
		function findloop($curr,$ref,$usr_1,$usr_2,$flag)
		{
			include('../php/connect.php');
			$loopquery=mysqli_query($con,"SELECT * FROM mapping_table where manager='$curr'");
			while($looparr=mysqli_fetch_array($loopquery))
			{	
				$next=$looparr['team_member'];
				if($ref==$next)
				{	
					$invalid_flag=1;
					?><script>
					alert('Loop found, value not entered.');
					</script><?php
					if($flag==1)
					{
					mysqli_query($con,"DELETE FROM `mapping_table` where team_member='$usr_1' and manager='$usr_2'");
					}
					else
					{
					mysqli_query($con,"DELETE FROM `mapping_table` where team_member='$usr_2' and manager='$usr_1'");
					}
					
					break;
				}
				findloop($next,$ref,$usr_1,$usr_2,$flag);
				
			}
			
		}	
		if(isset($_POST['team_member']))
		{
			$team_member=$_POST['team_member'];		
			$team_mem_query=mysqli_query($con,"SELECT * FROM `bas_user` WHERE user_name = '$team_member'");
			if(mysqli_num_rows($team_mem_query)==1)
			{
				$team_mem_arr=mysqli_fetch_array($team_mem_query);
				$team_mem_id=$team_mem_arr['user_id'];
				$dupli=mysqli_query($con,"SELECT * FROM `mapping_table` where manager='$curr_usr' and team_member='$team_mem_id'");
				if(mysqli_num_rows($dupli)==0)
				{
					mysqli_query($con,"INSERT INTO `mapping_table` VALUES ('$team_mem_id','$curr_usr')");
					$varia=0;
					$allposs=mysqli_query($con,"SELECT user_id FROM `bas_user`");
					while($allposs_arr=mysqli_fetch_array($allposs))
					{
						findloop($allposs_arr['user_id'],$allposs_arr['user_id'],$curr_usr,$team_mem_id,$varia);
					}
				}
				else
				{
					?><script>
						alert('Team Member already exists! Kindly try again');
					</script><?php
					$invalid_flag=1;
				}
			}
			else
			{
				?><script>
					alert('Invalid username');
					window.close();
				</script><?php
				$invalid_flag=1;
			}

		}
		if(isset($_POST['manager']))
		{
			$manager=$_POST['manager'];
			$man_query=mysqli_query($con,"SELECT * FROM `bas_user` WHERE user_name = '$manager'");
			if(mysqli_num_rows($man_query)==1)
			{
				$man_arr=mysqli_fetch_array($man_query);
				$man_id=$man_arr['user_id'];
				$dupli=mysqli_query($con,"SELECT * FROM `mapping_table` where team_member='$curr_usr' and manager='$man_id'");
				if(mysqli_num_rows($dupli)==0)
				{	
					mysqli_query($con,"INSERT INTO `mapping_table` VALUES ('$curr_usr','$man_id')");
					$vari=1;
					$allposs=mysqli_query($con,"SELECT user_id FROM `bas_user`");
					while($allposs_arr=mysqli_fetch_array($allposs))
					{
						findloop($allposs_arr['user_id'],$allposs_arr['user_id'],$curr_usr,$man_id,$vari);
					}
				}
				else
				{
					?><script>
						alert('Manager already exists! Kindly try again');
					</script><?php
					$invalid_flag=1;
				}
			}
			else
			{
				?><script>
					alert('Invalid second username');
					window.close();
				</script><?php
				$invalid_flag=1;
			}	
		}
	}
	if($invalid_flag==0)
	{
		?><script>
			alert('Done');

		</script><?php
	}
	?><script>
			window.close();
	</script><?php
	include('../php/close_connection.php');
}
?>