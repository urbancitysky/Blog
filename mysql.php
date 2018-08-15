<?php
    /**
     * https://www.youtube.com/watch?v=IYlDJ2K3MGk&index=21&list=PLillGF-Rfqbap2IB6ZS4BBBcYPagAjpjn
     */
    require('config.php');
    require('db.php');  

    // $query = 'SELECT * FROM posts WHERE id ='.$id;
    $query = 'SELECT * FROM posts ORDER BY created_date DESC';
    
    // get result
    $result = mysqli_query($conn, $query);
    
    // fetch data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // test data content
    // var_dump($post);    
    
    // free up memory
    mysqli_free_result($result);
    // close conn
    mysqli_close($conn);
    // <?php echo ROOT_URL;
?>
<?php include('header.php'); ?>
    <div class="container">    
        <h1>Blog</h1>       
        <?php foreach ($posts as $post): ?>
            <div class="jumbotron">
                <h5><?php echo $post['title']; ?></h5>
                <small>Created on <?php echo $post['created_date']; ?> by <?php echo $post['author']; ?></small>   
                
                <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-link">Read...</a>
                
            </div>
        <?php endforeach; ?>
    </div>
<?php include('footer.php'); ?>



