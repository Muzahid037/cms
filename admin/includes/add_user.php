<?php
if (isset($_POST['create_user'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    /*
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");
    */
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];


    $query = "INSERT INTO users(user_name,user_password,user_firstname,user_lastname,user_email,
    user_role) ";
    $query .= "VALUES ('{$user_name}','{$user_password}','{$user_firstname}',
    '{$user_lastname}','{$user_email}','{$user_role}')";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    header("Location: users.php");
}
?>




<div class="col-xs-12">

    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="user_name">Username</label><br>
            <input class="form-control" type="text" name="user_name">
        </div>

        <div class="form-group">
            <label for="user_password">Password</label><br>
            <input class="form-control" type="password" name="user_password">
        </div>

        <div class="form-group">
            <label for="user_firstname">First Name</label><br>
            <input class="form-control" type="text" name="user_firstname">
        </div>

        <div class="form-group">
            <label for="user_lastname">Last Name</label><br>
            <input class="form-control" type="text" name="user_lastname">
        </div>


        <!--
        <div class="form-group">
            <label for="user_image">User Image</label><br>
            <input class="form-control" type="file" name="user_image">
        </div>
        -->

        <div class="form-group">
            <label for="user_email">User Email</label><br>
            <input class="form-control" type="email" name="user_email">
        </div>


        <div class="form-group">

            <label for="user_role">Choose a Role:</label>
            <select name="user_role" id="">
                <option value='subscriber'>Subscriber</option>
                <option value='admin'>Admin</option>
            </select>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
        </div>

    </form>