<?php

	session_start();

	include "includes/dbconnect.php";


	$email=$_POST['user_email'];
	$password=$_POST['user_password'];

	$query="SELECT * FROM users WHERE email = '$email' AND password = '$password'";

	//running the serch in DB and storing in $result
	$result=$connection->query($query);

	//function to return the number of rows in $result

	$num_rows = 0;

	// Loop through the result set to count the rows
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    		$num_rows++;
	}
	$result=$connection->query($query);
	if($num_rows==0)
	{
		header('Location: register.php');
	}

	if($num_rows==1)
	{
		//correct login

		//retriving session name

		$row=$result->fetchArray(SQLITE3_ASSOC);
		$_SESSION['name']=$row['name'];
		$_SESSION['email']=$row['email'];
		$_SESSION['user_id']=$row['user_id'];

		
		if(($_SESSION['email']=="admin@mangola.com")&&($row['password']=="1234"))
		{
			header('Location: admin.php');
		}
		else
			header('Location: products.php');
	}
	else
	{	//incorrect login
		//redirect
		header('Location: index.php');
	}

?>
