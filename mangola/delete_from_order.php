<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";
	$product_id=$_GET['product_id'];
	$user_id=$_SESSION['user_id'];

	$query="DELETE FROM orders WHERE product_id = '$product_id' AND user_id = '$user_id'";
	if($connection->query($query))
	{
		$query1="DELETE FROM details WHERE product_id = '$product_id' AND user_id = '$user_id'";
		if($connection->query($query1))
		{
			header('Location: show_order_items.php?msg=1');
		}
	}
	else
	{
		header('Location: show_order_items.php?msg=2');
	}
?>
