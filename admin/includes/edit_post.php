<?php

if (isset($_GET['p_id'])) {

    $editable_post_id = $_GET['p_id'];

    $editable_post_query = "SELECT * FROM posts WHERE post_id={$editable_post_id}";
    $editable_post_result = mysqli_query($connection, $editable_post_query);
    confirmQuery($editable_post_result);

    while ($row = mysqli_fetch_assoc($editable_post_result)) {
        $editable_post_category_id = $row['post_category_id'];
        $editable_post_title = $row['post_title'];
        $editable_post_author = $row['post_author'];
        $editable_post_date = $row['post_date'];
        $editable_post_image = $row['post_image'];
        $editable_post_content = $row['post_content'];
        $editable_post_tags = $row['post_tags'];
        $editable_post_status = $row['post_status'];

        $editable_post_category_query = "SELECT * FROM categories WHERE cat_id={$editable_post_category_id}";
        $editable_post_category_result = mysqli_query($connection, $editable_post_category_query);
        confirmQuery($editable_post_category_result);

        while ($rowForPostTitle = mysqli_fetch_assoc($editable_post_category_result)) {
            $editable_post_category_title = $rowForPostTitle['cat_title'];
        }
    }
}




if (isset($_POST['update_post'])) {

    $edited_post_title = $_POST['post_title'];
    $edited_post_category_id = $_POST['post_category_id'];
    $edited_post_author = $_POST['post_author'];
    $edited_post_date = $_POST['post_date'];
    $edited_post_image = $_FILES['post_image']['name'];
    $edited_post_image_tmp = $_FILES['post_image']['tmp_name'];
    $edited_post_content = $_POST['post_content'];
    $edited_post_tags = $_POST['post_tags'];
    $edited_post_status = $_POST['post_status'];

    move_uploaded_file($post_image_tmp, "../images/$edited_post_image");

    if (empty($edited_post_image)) {
        $query = "SELECT * FROM posts WHERE post_id={$editable_post_id}";
        $get_post_img = mysqli_query($connection, $query);
        confirmQuery($get_post_img);
        while ($row = mysqli_fetch_assoc($get_post_img)) {
            $edited_post_image = $row['post_image'];
        }
    }

    $upd_query = "UPDATE posts SET ";

    $upd_query .= "post_title = '{$edited_post_title}', ";
    $upd_query .= "post_category_id = '{$edited_post_category_id}', ";
    $upd_query .= "post_author = '{$edited_post_author}', ";
    $upd_query .= "post_date = now(), ";
    $upd_query .= "post_image = '{$edited_post_image}', ";
    $upd_query .= "post_content = '{$edited_post_content}', ";
    $upd_query .= "post_tags = '{$edited_post_tags}', ";
    $upd_query .= "post_status = '{$edited_post_status}' ";

    $upd_query .= "WHERE post_id={$editable_post_id}";

    $upd_query_res = mysqli_query($connection, $upd_query);
    confirmQuery($upd_query_res);

    header("Location: posts.php");
}


?>



<div class="col-xs-12">

    <form action="" method="post" enctype="multipart/form-data">


        <div class="form-group">
            <label for="post_title">Post Title</label><br>
            <input class="form-control" type="text" name="post_title" value="<?php echo $editable_post_title ?>">
        </div>


        <div class="form-group">

            <label for="post_category_id">Choose a category:</label>
            <select name="post_category_id" id="">
                <?php

                echo "<option value='{$editable_post_category_id}'>{$editable_post_category_title}</option>";

                $all_category_query = "SELECT * FROM categories";
                $all_category_result = mysqli_query($connection, $all_category_query);
                confirmQuery($all_category_result);

                while ($rowForPostTitle = mysqli_fetch_assoc($all_category_result)) {
                    $all_category_id = $rowForPostTitle['cat_id'];
                    $all_category_title = $rowForPostTitle['cat_title'];

                    if ($editable_post_category_id != $all_category_id) {
                        echo "<option value='{$all_category_id}'>{$all_category_title}</option>";
                    }
                }
                ?>
            </select>
            
        </div>



        <div class="form-group">
            <label for="post_author">Post Author</label><br>
            <input class="form-control" type="text" name="post_author" value="<?php echo $editable_post_author ?>">
        </div>

        <div class="form-group">
            <label for="post_date">Post Date</label><br>
            <input class="form-control" type="text" name="post_date" value="<?php echo $editable_post_date ?>">
        </div>

        <div class="form-group">

            <label for="post_image">Post Image</label><br>

            <img width="100" src="../images/<?php echo $editable_post_image ?>" alt="image">
            <input class="" type="file" name="post_image">

        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label><br>
            <textarea name="post_content" id="" cols="100" rows="10"><?php echo $editable_post_content ?></textarea>
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label><br>
            <input class="form-control" type="text" name="post_tags" value="<?php echo $editable_post_tags ?>">
        </div>


        <div class="form-group">

            <label for="post_status">Choose Post Status:</label>
            <select name="post_status" id="">

                <?php
                 echo "<option value='{$editable_post_status}'>{$editable_post_status}</option>";
                if($editable_post_status=='draft')
                {
                    echo "<option value='published'>published</option>";
                }
                else
                {
                    echo "<option value='draft'>draft</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
        </div>

    </form>