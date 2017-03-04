<?php
include 'includes/global.inc.php'; 
session_start();

	// Check to see if score is set
	if(!isset($_SESSION['score']))
	{
		$_SESSION['score'] = 0;
	}

	if($_POST)
	{
		$number = $_POST['number'];
		$selected_choice = $_POST['choice'];
		$next = $number + 1;
	}

	/*
	 * Get total questions
	 */
	$query = "
		SELECT *
		FROM `questions`
	";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$total = $result->num_rows;



	/*
	 * Get correct choice
	 */
	$query = "
		SELECT *
		FROM `choices`
		WHERE question_number = $number AND is_correct = 1 
	";

	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$row = $result->fetch_assoc();
	$correct_choice = $row['id'];

	if($correct_choice == $selected_choice)
	{
		$_SESSION['score']++;
	}
	if($number == $total)
	{
		header("Location: final.php");
		die('Redirecting to final.php');
	}
	else
	{
		header("Location: question.php?n=".$next);
		die('Redirecting to next question');
	}