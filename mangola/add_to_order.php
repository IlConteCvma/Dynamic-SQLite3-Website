<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";

	$product_id=$_GET['product_id'];
	$user_id=$_SESSION['user_id'];

	$delete="DELETE FROM cart WHERE cart.product_id LIKE '$product_id' AND cart.user_id LIKE '$user_id'";
	$connection->exec($delete);

	$query1="SELECT * FROM orders WHERE product_id LIKE '$product_id' AND user_id LIKE '$user_id'";
	$result1=$connection->query($query1);
	$num_rows = 0;

	// Loop through the result set to count the rows
	while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
    		$num_rows++;
	}

	if($num_rows==0)
	{
		$query="INSERT INTO orders (order_id, user_id, product_id) VALUES (NULL, '$user_id', '$product_id');";
		if($connection->query($query))
		{
			header('Location: details_form.php?product_id='.$product_id.''); //redirect**
		}
		else
		{
			echo "error!";
		}
	}
	elseif($num_rows==1)
	{
		header('Location: show_cart_items.php?product_id='.$product_id.'&msg=22');
	}
	else
	{
		echo "Some Error Occured";
	}
	
?>
