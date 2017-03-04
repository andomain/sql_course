<?php
include('database.php');

// Check message submitted
if(isset($_POST['submit']))
{
	$user    = mysqli_real_escape_string($con, $_POST['user']);
	$message = mysqli_real_escape_string($con, $_POST['message']);
	
	date_default_timezone_set('Europe/London');
	$time    =  date('G:i:s', time());

	if(!isset($user) || $user == '' || !isset($message) || $message == '')
	{
		$error = 'Please enter a name and a message';
		header('Location: index.php?error='.urlencode($error));
		die('Redirecting to index.php');
	}
	else
	{
		$query = "
			INSERT INTO shouts
			(
				user,
				message,
				time
			)
			VALUES
			(
				'$user',
				'$message',
				'$time'
			)
		";

		if(!mysqli_query($con, $query))
		{
			die('Error: '.mysqli_error($con));
		}
		else
		{
			header('Location: index.php');
			die('Redirecting to index.php');
		}
	}
}

?>