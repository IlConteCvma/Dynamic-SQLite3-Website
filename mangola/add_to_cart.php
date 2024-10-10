<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";
	
	$product_id=$_GET['product_id'];
	$user_id=$_SESSION['user_id'];

	$delete="DELETE FROM wishlist WHERE wishlist.product_id = '$product_id' AND wishlist.user_id = '$user_id'";
			$connection->exec($delete);

	$query1="SELECT * FROM cart WHERE product_id LIKE '$product_id' AND user_id LIKE '$user_id'";
	$result1=$connection->query($query1);
	$num_rows = 0;

	// Loop through the result set to count the rows
	while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
    		$num_rows++;
	}
		
	if($num_rows==0)
	{
		$query="INSERT INTO cart (cart_id, product_id, user_id) VALUES (NULL, '$product_id', '$user_id')";
		if($connection->query($query))
		{
			header('Location: product_description.php?product_id='.$product_id.'&msg=1');
		}
		else
		{
			echo "error!";
		}
	}
	elseif($num_rows==1)
	{
		header('Location: product_description.php?product_id='.$product_id.'&msg=2');
	}
	else
	{
		echo "Some Error Occured";
	}
	
?>
