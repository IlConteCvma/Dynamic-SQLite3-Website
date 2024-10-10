<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";
	$product_id=$_GET['product_id'];
	$user_id=$_SESSION['user_id'];

	$query="DELETE FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";
	if($connection->query($query))
	{
		header('Location: show_cart_items.php?msg=1');
	}
	else
	{
		header('Location: show_cart_items.php?msg=2');
	}
?>
