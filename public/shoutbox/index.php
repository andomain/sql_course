<?php include 'database.php'; ?>
<?php
    // Create Select Query
    $query = "SELECT * FROM shouts ORDER BY id DESC";
    $results = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shoutbox</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class='container'>
        <header>
            <h1>Shout It! Shoutbox</h1>
        </header>
        <div class='shouts'>
            <ul>
                <?php while($row = mysqli_fetch_assoc($results)) : ?>
                    <li class='shout'>
                        <span><?php echo $row['time'] ?> - </span><strong><?php echo $row['user'] ?>: </strong>
                        <?php echo $row['message'] ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class='input'>
            <?php if(isset($_GET['error'])) : ?>
                <div class='error'>
                    <?php echo $_GET['error']; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="process.php">
                <input type="text" name="user" placeholder="Enter your name">
                <input type="text" name="message" placeholder="...">
                <br>
                <input class='shout-btn' type="submit" name="submit" value="Shout it!">
            </form>
        </div>
    </div>

</body>
</html>