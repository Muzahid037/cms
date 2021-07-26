<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>



<!-- Page Content -->
<div class="container">

    <div class="row">




        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php

            $condition = "";

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                $condition .= "WHERE post_id={$post_id}";
            }

            $query = "SELECT * from posts $condition";
            $select_all_posts_query = mysqli_query($connection, $query);
            if (!$select_all_posts_query) {
                die("Query Failed!" . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                //echo $post_image."<br>;

            ?>

                <!-- Blog Post -->

                <h2>
                    <a href="#"> <?php echo $post_title ?> </a>
                </h2>

                <p class="lead">
                    by <a href="index.php"> <?php echo $post_author ?> </a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>

                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>

                <p> <?php echo $post_content ?> </p>

                <hr>

            <?php } ?>

            <!-- Blog Comments -->

            <?php
            if (isset($_POST['create_comment'])) {

                $comment_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                //$comment_status=$_POST['comment_status'];
                //$comment_date=$_POST['comment_date'];

                $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
                $query .= "VALUES ($comment_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";
                $comment_insert_query = mysqli_query($connection, $query);

                if (!$comment_insert_query) {
                    die("Query Failed!" . mysqli_error($connection));
                }

                ///Update post_comment_count(from table posts)

                //getting the value of post_comment_count(from table posts)
                $query = "SELECT * from posts WHERE post_id=$post_id";
                $select_posts_query = mysqli_query($connection, $query);
                if (!$select_posts_query) {
                    die("Query Failed!" . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($select_posts_query)) {
                    $post_comment_count = $row['post_comment_count'];
                }

                //Increase post_comment_count(from table posts) by one
                $query = "UPDATE posts SET post_comment_count =$post_comment_count+1 WHERE post_id={$post_id}";
                $update_post_query = mysqli_query($connection, $query);
                if (!$update_post_query) {
                    die("Query Failed!" . mysqli_error($connection));
                }
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>

                <form role="form" method="POST">

                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment_content">Your comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>

                </form>

            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='approved'";
            $get_comments = mysqli_query($connection, $query);

            if (!$get_comments) {
                die("Query Error comments" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($get_comments)) {
                $comment_id = $row['comment_id'];
                //echo  $comment_id;
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

            ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>

            <?php } ?>


            <!--    /// Comment 
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    
                   /// Nested Comment 
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    /// End Nested Comment 
                </div> 
            </div>
 -->
            <!-- End of Blog Comments -->


        </div>


        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>


    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>