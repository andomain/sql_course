<?php include 'includes/header.php' ?> 
<?php 
    $db = new Database();

    $id = $_GET['id'];

    $query = "SELECT * FROM posts WHERE id=".$id;
    $post = $db->select($query)->fetch_assoc();

    $query = "SELECT * FROM categories";
    $categories = $db->select($query);  

    if(isset($_POST['submit']))
    {

        //Assign Vars
        $title = mysqli_real_escape_string($db->link, $_POST['title']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);
        $category = mysqli_real_escape_string($db->link, $_POST['category']);
        $author = mysqli_real_escape_string($db->link, $_POST['author']);
        $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
        //Simple Validation
        if($title == '' || $body == '' || $category == '' || $author == ''){
            //Set Error
            $error = 'Please fill out all required fields';
        } else {
            $query = "UPDATE posts 
                    SET 
                    title = '$title',
                    body = '$body',
                    category = '$category',
                    author = '$author',
                    tags = '$tags' 
                    WHERE id =".$id;
            
            $update_row = $db->update($query);
      }
    }
    else if(isset($_POST['delete']))
    {
        $query = "DELETE FROM posts
                    WHERE id=".$id;
        $delete_row = $db->delete($query);
    }
    
    $query = "SELECT * FROM categories";
    $categories = $db->select($query);  
?>

<form method="post" action="edit_post.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label>Post Title</label>
    <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $post['title']; ?>" >
</div>
<div class="form-group">
    <label>Post Body</label>
    <textarea type="textarea" name="body" class="form-control" placeholder="Enter Post Body"><?php echo $post['body']; ?></textarea>
</div>
<div class="form-group">
    <label>Post Category</label>
    <select name="category" class="form-control">
    <?php while($row = $categories->fetch_assoc()) : ?>
        <?php $selected = ($row['id'] == $post['category']) ? 'selected' : '' ?>
      <option <?php echo $selected ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php endwhile ?>
  </select>
</div>
<div class="form-group">
    <label>Post Author</label>
    <input type="text" name="author" class="form-control" placeholder="Author Name" value="<?php echo $post['author']; ?>">
</div>
<div class="form-group">
    <label>Tags</label>
    <input type="text" name="tags" class="form-control" placeholder="Enter Tags" value="<?php echo $post['tags']; ?>">
</div>
<div>
    <input type="submit" name="submit" class="btn btn-default" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
    <input type="submit" name="delete" class="btn btn-danger" value="Delete">

</div>
<br>
</form>

<?php include 'includes/footer.php' ?>