<?php include 'includes/header.php' ?> 
<?php 
    $db = new Database();

    $id = $_GET['id'];
    if(isset($id))
    {
	    $query = "SELECT * FROM posts WHERE id=".$id;

	    $post = $db->select($query)->fetch_assoc();

	    $query = "SELECT * FROM categories";

	    $categories = $db->select($query);    	
    }
    else
    {
    	header("Location: posts.php");
    	die("Redirecting to posts.php");
    }

?>

<div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post['title'] ?></h2>
    <p class="blog-post-meta"><?php echo formatDate($post['date']) ?> by <a href="#"><?php echo $post['author'] ?></a></p>
    <?php echo $post['body'] ?>
</div><!-- /.blog-post -->

<?php include 'includes/footer.php' ?> 

