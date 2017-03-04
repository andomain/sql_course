<?php include 'includes/header.php' ?> 
<?php 
    $db = new Database();
    
    $id = $_GET['id'];

    $query = "SELECT * FROM categories WHERE id=".$id;
    $category = $db->select($query)->fetch_assoc(); 

    if(isset($_POST['submit']))
    {
        //Assign Vars
        $name = mysqli_real_escape_string($db->link, $_POST['category']);

        //Simple Validation
        if($name == ''){
            //Set Error
            $error = 'Please fill out all required fields';
        } else {
            $query = "UPDATE categories 
                    SET 
                    name = '$name'
                    WHERE id =".$id;
            
            $update_row = $db->update($query);
      }
    }
    else if(isset($_POST['delete']))
    {
        $query = "DELETE FROM categories
                    WHERE id=".$id;
        $delete_row = $db->delete($query);
    }

?>
<form method="post" action="edit_category.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label>Category Name</label>
    <input type="text" name="category" class="form-control" placeholder="Enter Category" value="<?php echo $category['name'] ?>">
  </div>
  <div>
    <input type="submit" name="submit" class="btn btn-default" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
    <input type="submit" name="delete" class="btn btn-danger" value="Delete">
  </div>
  <br>
</form>

<?php include 'includes/footer.php' ?>