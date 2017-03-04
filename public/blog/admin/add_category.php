<?php include 'includes/header.php' ?> 
<?php 
    $db = new Database();
    if(isset($_POST['submit']))
    {
      $name = mysqli_real_escape_string($db->link, $_POST['category']);

      if($name == '' )
      {
        $error = 'Please enter a category name';
      } 
      else
      {
        $query = "
          INSERT INTO categories
          (name)
          VALUES('$name')
        ";

        $insert_row = $db->update($query);
      }
    }
?>
<form method="post" action="add_category.php">
  <div class="form-group">
    <label>Category Name</label>
    <input type="text" name="category" class="form-control" placeholder="Enter Category">
  </div>
  <div>
    <input type="submit" name="submit" class="btn btn-default" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br>
</form>

<?php include 'includes/footer.php' ?>