<?php
if (isset($_POST['create_post'])) {
    $post_category_id = $_POST['post_category_id'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];

    $post_date = date('d-m-y');

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    //$post_comment_count = $_POST['post_comment_count'];
    $post_status = $_POST['post_status'];

    move_uploaded_file($post_image_temp, "../images/$post_image");



    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,
    post_content,post_tags,post_comment_count,post_status) ";
    $query .= "VALUES ($post_category_id,'{$post_title}','{$post_author}',now(),'{$post_image}',
    '{$post_content}','{$post_tags}',0,'{$post_status}')";
    $post_insert_query = mysqli_query($connection, $query);

    confirmQuery($post_insert_query);

    header("Location: posts.php");
}
?>




<div class="col-xs-12">

    <form action="" method="post" enctype="multipart/form-data">


        <!--
        <div class="form-group">
            <label for="post_category_id">Post Category Id</label><br>
            <input class="form-control" type="text" name="post_category_id">
        </div>
        -->

        <div class="form-group">
            <label for="post_title">Post Title</label><br>
            <input class="form-control" type="text" name="post_title">
        </div>


        <div class="form-group">

            <label for="post_category_id">Choose a category:</label>
            <select name="post_category_id" id="">
                <?php

                $query = "SELECT * FROM categories";
                $get_category_title = mysqli_query($connection, $query);
                confirmQuery($get_category_title);

                while ($rowForPostTitle = mysqli_fetch_assoc($get_category_title)) {
                    $category_id = $rowForPostTitle['cat_id'];
                    $category_title = $rowForPostTitle['cat_title'];

                    echo "<option value='{$category_id}'>{$category_title}</option>";
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="post_author">Post Author</label><br>
            <input class="form-control" type="text" name="post_author">
        </div>

        <div class="form-group">
            <label for="post_date">Post Date</label><br>
            <input class="form-control" type="text" name="post_date">
        </div>

        <div class="form-group">
            <label for="post_image">Post Image</label><br>
            <input class="form-control" type="file" name="image">
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label><br>
            <textarea name="post_content" id="body" cols="100" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label><br>
            <input class="form-control" type="text" name="post_tags">
        </div>

        <!--
        <div class="form-group">
            <label for="post_comment_count">Post Comment Count</label><br>
            <input class="form-control" type="text" name="post_comment_count">
        </div>
       
 -->

        <div class="form-group">

            <label for="post_status">Choose Post Status:</label>
            <select name="post_status" id="">
                  <option value='draft'>Draft</option>
                  <option value='published'>Published</option>
            </select>
        </div>


        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_post" value="Create Post">
        </div>

    </form>