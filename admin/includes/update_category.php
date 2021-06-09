<!--Update category query-->
<?php

if (isset($_POST['update'])) {
    $cat_title = $_POST['cat_title'];

    $query = "UPDATE categories  SET cat_title =  '{$cat_title}' WHERE cat_id={$cat_id}";
    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die("Query Failed" . mysqli_error($connection));
    }
}
?>
<!--End of Update category query-->




<!--Edit category form-->
<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label><br>

        <!--show editClicked category-->
        <?php
        if (isset($_GET['edit'])) {

            $editClicked_cat_id = $_GET['edit'];
            $editClicked_query = "SELECT *FROM categories WHERE cat_id={$editClicked_cat_id}";

            $get_editClicked_query = mysqli_query($connection, $editClicked_query);
            if (!$get_editClicked_query) {
                die("get_editClicked query error!" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($get_editClicked_query)) {
                $editClicked_cat_id = $row['cat_id'];
                $editClicked_cat_title = $row['cat_title'];
        ?>
                <input class="form-control" type="text" name="cat_title" value="<?php echo $editClicked_cat_title; ?>">
        <?php
            }
        }
        ?>
        <!--End of show editClicked category-->

    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>

</form>

<!--End of Edit category form-->