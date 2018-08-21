<?php
    
    require('config.php');
    require('db.php');  

    // check for submit
    if (isset($_POST['submit'])){
        //  echo 'Submitted';
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $query = "INSERT INTO posts(title, author, body) VALUES ('$title', '$author', '$body')";
        if (mysqli_query($conn, $query)){
            header('Location: ' .ROOT_URL.'mysql.php');
        }else{
            echo 'ERROR: '.mysqli_error($conn);
        }
    }
?>
<?php include('header.php'); ?>
    <div class="container">    
        <h1>Add Post</h1>
        <form method ="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="">
            </div>
            <div class="form-group">
                <label for="">Author</label>
                <input type="text" name="author" class="form-control" value="">
            </div>
            <div class="form-group">
                <label for="">Body</label>
                <textarea type="body" name="body" class="form-control" ></textarea><br>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>       
    </div>
<?php include('footer.php'); ?>
