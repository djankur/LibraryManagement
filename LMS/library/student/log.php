
<?php

include '../connect.php';
// $con=mysqli_connect("localhost","root1","pass","library")or die("can't connect...");
session_start();
$s_email = $_POST["s_email"];
$s_password = $_POST["s_password"];
$result=mysqli_query($con,"select * from student where s_email = '$s_email'");
	$row=mysqli_fetch_array($result);
	$s_name = $row["s_name"];
	if($row['s_password']==$s_password)
	{
		$_SESSION['s_name']=$s_name;
 		header("Location:studentpanel.php");
 	}
 	else
 	{
 		header("location:login.php?err=1");
 	}
 


?>

