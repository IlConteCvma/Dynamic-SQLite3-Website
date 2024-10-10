<?php
	session_start();	
	if(!(isset($_POST['user_name'])&&isset($_POST['user_email'])))
  	{
    	header('Location: register.php?msg=108');
  	}
  	include "includes/dbconnect.php";
	//fetch the user data
	$name=$_POST['user_name'];
	$email=$_POST['user_email'];
	$password=$_POST['user_password'];

	//check for already registerd user
	$query1="SELECT * FROM users WHERE email LIKE '$email'";
	$result1=$connection->query($query1);
	$num_rows = 0;

	// Loop through the result set to count the rows
	while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
    		$num_rows++;
	}

	//print_r($num_rows);

	if($num_rows == 0)
	{
		//push data to the DB
		$query="INSERT INTO users (user_id, name, email, password) VALUES (NULL, '$name', '$email', '$password')";
		//$connection->exec($query)
		if ($connection->exec($query))
		{	
			print_r("TEST 2");
			//redirect
			$_SESSION['name']=$name;
			$_SESSION['email']=$email;

			$query1="SELECT * FROM users WHERE email LIKE '$email' AND password LIKE '$password'";
			$result1=$connection->query($query1);
			$row1=$result1->fetchArray(SQLITE3_ASSOC);
			$_SESSION['user_id']=$row1['user_id'];
			header('Location: products.php');
		}
	}
	elseif($num_rows==1)
	{
		header('Location: register.php?msg=2');
	}
	else
	{
		echo "Some Error occured!";
	}


//redirect


?>
