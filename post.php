<?php
    /**
     * Description: 
     * https://www.youtube.com/watch?v=IYlDJ2K3MGk&index=21&list=PLillGF-Rfqbap2IB6ZS4BBBcYPagAjpjn
     * 
     * issue: can't delete post
     */
    require('config.php');
    require('db.php');
    
    // Delete
    if (isset($_POST['delete'])){
        //  echo 'Submitted';
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);        
        
        $query = "DELETE FROM posts WHERE id = {$delete_id}";

        if (mysqli_query($conn, $query)){
            header('Location: ' .ROOT_URL.'mysql.php');
        }else{
            echo 'ERROR: '.mysqli_error($conn);
        }
    }
    // get ID    
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // $query = 'SELECT * FROM posts WHERE id ='.$id;
    $query = 'SELECT * FROM posts WHERE id ='.$id;
    
    // get result
    $result = mysqli_query($conn, $query);
    
    // fetch data
    // $post = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $post = mysqli_fetch_assoc($result);

    // test data content
    // var_dump($post);    
    
    // free up memory
    mysqli_free_result($result);
    // close conn
    mysqli_close($conn);
?>
<?php include('header.php'); ?>
    <div class="container">    
        <h1>Posts</h1>        
        <div class="jumbotron">

            <!-- Go back -->
            <a href="<?php echo ROOT_URL;?>mysql.php" class="btn btn-secondary">Back</a>

            <!-- Display content -->
            <h1><?php echo $post['title']; ?></h1>
            <small>Created on <?php echo $post['created_date']; ?> by <?php echo $post['author']; ?> ID# <?php echo $post['id']; ?></small>
            <hr>            
            <p><?php echo $post['body'] ?></p>

            <!-- Delete button -->
            <form class="pull-right" mehtod="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="" name="delete_id" value="<?php echo $post['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>

            <!-- Edit -->
            <a href="<?php echo ROOT_URL; ?>editPost.php?id=<?php echo $post['id']; ?>" class ="btn btn-outline-primary">Edit</a>
        </div>        
    </div>
<?php include('footer.php'); ?>