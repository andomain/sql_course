<?php 
	// Connect to mysql
	$con = mysqli_connect('localhost', "root", "root", "shouted");

	// Test connection
	if(mysqli_connect_errno())
	{
		echo 'Failed to connect to MySQL: '. mysqli_connect_error();
	}
?>