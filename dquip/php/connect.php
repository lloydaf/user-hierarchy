<?php
$username="root";
$password="123456";
$database="dquip";
$con=mysqli_connect('localhost',$username,$password,$database);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>