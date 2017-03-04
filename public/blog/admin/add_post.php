<?php include 'includes/header.php' ?> 
<?php 
    $db = new Database();
    if(isset($_POST['submit']))
    {
      $title = mysqli_real_escape_string($db->link, $_POST['title']);
      $body = mysqli_real_escape_string($db->link, $_POST['body']);
      $category = mysqli_real_escape_string($db->link, $_POST['category']);
      $author = mysqli_real_escape_string($db->link, $_POST['author']);
      $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

      if($title == '' || $body == '' || $category == '' || $author == ''  )
      {
        $error = 'Please fill put all fields';
      } 
      else
      {
        $query = "
          INSERT INTO posts
          (title, body, category, author, tags)
          VALUES('$title', '$body', $category, '$author', '$tags' )
        ";

        $insert_row = $db->insert($query);
      }
    }
    
    $query = "SELECT * FROM categories";
    $categories = $db->select($query);  
?>
<form method="post" action="add_post.php">
  <div class="form-group">
    <label>Post Title</label>
    <input type="text" name="title" class="form-control" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label>Post Body</label>
    <input type="textarea" name="body" class="form-control" placeholder="Enter Post Body">
  </div>
  <div class="form-group">
    <label>Post Category</label>
    <select name="category" class="form-control">
    <?php while($row = $categories->fetch_assoc()) : ?>
      <option value=<?php echo $row['id'] ?>><?php echo $row['name']?></option>
    <?php endwhile; ?> 
    </select>
  </div>
  <div class="form-group">
    <label>Post Author</label>
    <input type="text" name="author" class="form-control" placeholder="Author Name">
  </div>
  <div class="form-group">
    <label>Tags</label>
    <input type="text" name="tags" class="form-control" placeholder="Enter Tags">
  </div>
  <div>
    <input type="submit" name="submit" class="btn btn-default" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br>
</form>

<?php include 'includes/footer.php' ?>