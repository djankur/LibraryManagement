<?php
	include "../connect.php";
	session_start();
	$name=$_SESSION['name'];
	$oldp=$_POST["opwd"];
	$newp=$_POST["npwd"];
	$result=mysqli_query($con,"Select password from admin where name='$name'");
	$row=mysqli_fetch_array($result);
	$op=$row["password"];
	if($oldp==$op)
	{
		$rec=mysqli_query($con,"Update admin set password='$newp' where name='$name'");
		if($rec)
		{
			header("location:changepass.php?pwd=changed");	
		}
		else
		{
			echo $mysqli_error($con);	
		}
	}
	else
	{
		header("location:changepass.php?pwd=nochanged");	
	}
?>