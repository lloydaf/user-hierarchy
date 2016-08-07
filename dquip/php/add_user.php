<?php
if(!isset($_POST['user_name'])){
	die('Invalid page');
}
else{
include('../php/connect.php');
$user_name=$_POST['user_name'];
mysqli_query($con,"INSERT INTO `bas_user`(user_name) VALUES('$user_name')");
mysqli_close();
}
header('Location: ../html/index.html');
?>