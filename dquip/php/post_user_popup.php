<?php
if(!isset($_POST['user_id']))
{
	die("Bad page. Very bad page.");
}
else
{
	$variable=$_POST['user_id'];
	include('../php/connect.php');
}
?>
<?php include('../html/style.css');
$curr_usr_query=mysqli_query($con,"SELECT * FROM `bas_user` WHERE user_id = '$variable'");
$curr_usr=mysqli_fetch_array($curr_usr_query);
$list_less=mysqli_query($con,"SELECT user_name from `bas_user` where user_id<'".$curr_usr['user_id']."' ORDER BY user_id DESC");
$arr_less=array();
while($list_arr_less=mysqli_fetch_array($list_less))
{
$arr_less[]=$list_arr_less['user_name'];
}
$list_more=mysqli_query($con,"SELECT user_name from `bas_user` where user_id>'".$curr_usr['user_id']."' ORDER BY user_id ASC");
$arr_more=array();
while($list_arr_more=mysqli_fetch_array($list_more))
{
$arr_more[]=$list_arr_more['user_name'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Set Reporting Rights</title>
<link rel="stylesheet" href="jquery-ui.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="../scripts/external/jquery/jquery.js"></script>
<script src="../scripts/jquery-ui.min.js"></script>
  <script>
	$(document).ready(function()
	{
	    $("#submit_form").submit(function()
	    {
	        $("input").each(function(index, obj)
	        {
	            if($(obj).val() == "") 
	            {
	                $(obj).remove();
	            }
	        });
	    });
	});
	$( function() {
    var availableTagless = <?php echo json_encode($arr_less); ?>;
    var availableTagmore = <?php echo json_encode($arr_more); ?>;
    $( "#team_member" ).autocomplete({
      source: availableTagmore
    });
    $("#manager").autocomplete({
    	source: availableTagless
    });
  } );
</script>
</head>
<body>
	
	<p>Set Reporting Rights for <strong><?php echo $curr_usr['user_name'];?></strong>:</p>
	<form id="submit_form" action="set_map_usr.php" method="post">
		<input type="hidden" name="curr_usr" value="<?php echo $curr_usr['user_id'];?>">
		<p>
			<strong>Set People reporting to <?php echo $curr_usr['user_name'];?>: (Team Members)</strong>
		</p>
		<input id="team_member" name="team_member">
		<p>
			<strong>Set People <?php echo $curr_usr['user_name'];?> reports to: (Managers)</strong>
		</p>
		<input id="manager" name="manager">
		<p><button type="submit" value="Submit">Confirm</button></p>
	</form>
	<button id="back_button">Close</button>
<script type="text/javascript">
	$("#back_button").click(function(){
		window.close();
	});
</script>
</body>
<?php include('../php/close_connection.php');?>
</html>