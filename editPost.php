<?php
    /**
     * https://www.youtube.com/watch?v=9t7AH7lOlL0&index=22&list=PLillGF-Rfqbap2IB6ZS4BBBcYPagAjpjn
     */
    require('config.php');
    require('db.php');  

    // check for submit
    /** */
    if (isset($_POST['submit'])){
        //  echo 'Submitted';
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $query = "UPDATE posts SET 
                    title ='$title', 
                    author ='$author', 
                    body ='$body'
                    WHERE id = {$update_id}";

        if (mysqli_query($conn, $query)){
            header('Location: ' .ROOT_URL.'mysql.php');
        }else{
            echo 'ERROR: '.mysqli_error($conn);
        }
    }
    // check submitted query 
    // die($query);

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
        <h1>Add Post</h1>
        <form method ="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title'];?>">
            </div>
            <div class="form-group">
                <label for="">Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author'];?>">
            </div>
            <div class="form-group">
                <label for="">Body</label>
                <textarea name="body" class="form-control" ><?php echo $post['body'];?></textarea><br>      
                <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">          
                <input type="submit" name="submit" value="Save" class="btn btn-primary">
                <input type="" name="" value="Cancle" class="btn btn-secondary">
            </div>
        </form>       
    </div>
<?php include('footer.php'); ?>
