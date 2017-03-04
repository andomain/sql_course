<?php
include 'includes/global.inc.php';
session_start();

	// Set question number
	$number = (int) $_GET['n'];

	/*
	 *	Get Question
	 */
	$query = "
		SELECT *
		FROM `questions`
		WHERE `question_number` = $number
	";

	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$question = $result->fetch_assoc();

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
	 *	Get Choices
	 */
	$query = "
		SELECT *
		FROM `choices`
		WHERE `question_number` = $number
	";

	$choices = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Quizzer</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>PHP Quizzer</h1>
        </div>  
    </header>
    <main>
        <div class="container">
            <div class="current">Question <?php echo $question['question_number']; ?> of <?php echo $total ?></div>
            <p class="question">
            	<?php echo $question['text']; ?>
            </p>
            <form method="post" action="process.php">
            	<ul class="choices">
            		<?php while($row = $choices->fetch_assoc()) : ?>
	            		<li><input type="radio" name="choice" value="<?php echo $row['id']; ?>" / ><?php echo $row['text']; ?></li>
        			<?php endwhile; ?>
            	</ul>
            	<input type="submit" value="Submit">
				<input type="hidden" name="number" value="<?php echo $number; ?>" />
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2017, PHP Quizzer
        </div>
    </footer>
</body>
</html>