<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";

	$product_id=$_POST['product_id'];
	$user_id=$_SESSION['user_id'];
	$review_heading=$_POST['review_heading'];
	$review_text=$_POST['review_text'];
	
	$query1="SELECT * FROM reviews WHERE product_id LIKE '$product_id' AND user_id LIKE '$user_id'";
	$result1=$connection->query($query1);
	$num_rows = 0;

	// Loop through the result set to count the rows
	while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
    		$num_rows++;
	}

	if($num_rows==0)
	{
		$query="INSERT INTO reviews (review_id, user_id, product_id, review_heading, review_text) VALUES (NULL, '$user_id', '$product_id', '$review_heading', '$review_text')";
		if($connection->query($query))
		{
			header('Location: show_cart_items.php?product_id='.$product_id.'&msg=11'); //redirect**
		}
		else
		{
			header('Location: show_cart_items.php?product_id='.$product_id.'&msg=33');
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
