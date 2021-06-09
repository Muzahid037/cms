<?php

if (isset($_GET['p_id'])) {


    $editable_post_id = $_GET['p_id'];

    $editable_post_query = "SELECT * FROM posts WHERE post_id={$editable_post_id}";
    $get_editable_post = mysqli_query($connection, $editable_post_query);
    confirmQuery($get_editable_post);

    while ($row = mysqli_fetch_assoc($get_editable_post)) {
        $post_category_id = $row['post_category_id'];

        $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
        $get_category_title = mysqli_query($connection, $query);

        confirmQuery($get_category_title);

        while ($rowForPostTitle = mysqli_fetch_assoc($get_category_title)) {
            $category_title = $rowForPostTitle['cat_title'];
        }

        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
    }
}







if (isset($_POST['update_post'])) {

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_date = $_POST['post_date'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_comment_count = $_POST['post_comment_count'];
    $post_status = $_POST['post_status'];

    move_uploaded_file($post_image_tmp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id={$editable_post_id}";
        $get_post_img = mysqli_query($connection, $query);
        confirmQuery($get_post_img);
        while ($row = mysqli_fetch_assoc($get_post_img)) {
            $post_image = $row['post_image'];
        }
    }

    $upd_query = "UPDATE posts SET ";

    $upd_query .= "post_title = '{$post_title}', ";
    $upd_query .= "post_category_id = '{$post_category_id}', ";
    $upd_query .= "post_author = '{$post_author}', ";
    $upd_query .= "post_date = now(), ";
    $upd_query .= "post_image = '{$post_image}', ";
    $upd_query .= "post_content = '{$post_content}', ";
    $upd_query .= "post_tags = '{$post_tags}', ";
    $upd_query .= "post_comment_count = '{$post_comment_count}', ";
    $upd_query .= "post_status = '{$post_status}' ";

    $upd_query .= "WHERE post_id={$editable_post_id}";

    $upd_query_res = mysqli_query($connection, $upd_query);
    confirmQuery($upd_query_res);
}




?>



<div class="col-xs-12">

    <form action="" method="post" enctype="multipart/form-data">


        <div class="form-group">
            <label for="post_title">Post Title</label><br>
            <input class="form-control" type="text" name="post_title" value="<?php echo $post_title ?>">
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
            <!--
            <label for="post_category_id">Post Category Id</label><br>
            <input class="form-control" type="text" name="post_category_id" value="<?php echo $post_category_id ?>">
        -->
        </div>
        

        <div class="form-group">
            <label for="post_author">Post Author</label><br>
            <input class="form-control" type="text" name="post_author" value="<?php echo $post_author ?>">
        </div>

        <div class="form-group">
            <label for="post_date">Post Date</label><br>
            <input class="form-control" type="text" name="post_date" value="<?php echo $post_date ?>">
        </div>

        <div class="form-group">

            <label for="post_image">Post Image</label><br>

            <img width="100" src="../images/<?php echo $post_image ?>" alt="image">
            <input class="" type="file" name="post_image">

        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label><br>
            <textarea name="post_content" id="" cols="100" rows="10"><?php echo $post_content ?></textarea>
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label><br>
            <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags ?>">
        </div>

        <div class="form-group">
            <label for="post_comment_count">Post Comment Count</label><br>
            <input class="form-control" type="text" name="post_comment_count" value="<?php echo $post_comment_count ?>">
        </div>

        <div class="form-group">
            <label for="post_status">Post Status</label><br>
            <input class="form-control" type="text" name="post_status" value="<?php echo $post_status ?>">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
        </div>

    </form>