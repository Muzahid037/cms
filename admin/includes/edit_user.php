<?php

if (isset($_GET['u_id'])) {
    $editable_user_id = $_GET['u_id'];
    //echo $_GET['u_id'];

    $editable_user_query = "SELECT * FROM users WHERE user_id={$editable_user_id}";

    $get_editable_user = mysqli_query($connection, $editable_user_query);
    confirmQuery($get_editable_user);

    while ($row = mysqli_fetch_assoc($get_editable_user)) {

        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['update_user'])) {


    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    /*
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    
    move_uploaded_file($post_image_tmp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id={$editable_post_id}";
        $get_post_img = mysqli_query($connection, $query);
        confirmQuery($get_post_img);
        while ($row = mysqli_fetch_assoc($get_post_img)) {
            $post_image = $row['post_image'];
        }
    }

    */
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];


    $upd_query = "UPDATE users SET ";

    $upd_query .= "user_name = '{$user_name}', ";
    $upd_query .= "user_password = '{$user_password}', ";
    $upd_query .= "user_firstname = '{$user_firstname}', ";
    $upd_query .= "user_lastname = '{$user_lastname}', ";
    $upd_query .= "user_email = '{$user_email}', ";
    $upd_query .= "user_role = '{$user_role}' ";

    $upd_query .= "WHERE user_id={$editable_user_id}";

    $upd_query_res = mysqli_query($connection, $upd_query);
    confirmQuery($upd_query_res);

    header("Location: users.php");
}

?>



<div class="col-xs-12">

    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="user_name">Username</label><br>
            <input class="form-control" type="text" name="user_name" value="<?php echo $user_name; ?>">
        </div>

        <div class="form-group">
            <label for="user_password">Password</label><br>
            <input class="form-control" type="password" name="user_password" value="<?php echo $user_password; ?>">
        </div>

        <div class="form-group">
            <label for="user_firstname">First Name</label><br>
            <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname; ?>">
        </div>

        <div class="form-group">
            <label for="user_lastname">Last Name</label><br>
            <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname; ?>">
        </div>


        <!--
        <div class="form-group">
            <label for="user_image">User Image</label><br>
            <input class="form-control" type="file" name="user_image">
        </div>
        -->

        <div class="form-group">
            <label for="user_email">User Email</label><br>
            <input class="form-control" type="email" name="user_email" value="<?php echo $user_email; ?>">
        </div>


        <div class="form-group">

            <label for="user_role">Choose a Role:</label>
            <select name="user_role" id="">

                <option value='<?php echo $user_role;?>'><?php echo $user_role;?></option>
                <?php 
                if($user_role=="subscriber"){
                echo "<option value='admin'>admin</option>";}
                else{
                    echo "<option value='subscriber'>subscriber</option>";
                }
                ?>


            </select>

        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_user" value="Update">
        </div>

    </form>