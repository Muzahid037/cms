<?php include "includes/admin_header.php" ?>

<?php

///show data
if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id= {$user_id}";
    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        //$user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}


///update data
if (isset($_POST['update_profile'])) {
    $edt_user_name = $_POST['user_name'];
    $edt_user_password = $_POST['user_password'];
    $edt_user_firstname = $_POST['user_firstname'];
    $edt_user_lastname = $_POST['user_lastname'];
    //$edt_user_image=$_POST['user_image'];
    $edt_user_email = $_POST['user_email'];
    $edt_user_role = $_POST['user_role'];


    $upd_query = "UPDATE users SET ";

    $upd_query .= "user_name = '{$edt_user_name}', ";
    $upd_query .= "user_password = '{$edt_user_password}', ";
    $upd_query .= "user_firstname = '{$edt_user_firstname}', ";
    $upd_query .= "user_lastname = '{$edt_user_lastname}', ";
    $upd_query .= "user_email = '{$edt_user_email}', ";
    $upd_query .= "user_role = '{$edt_user_role}' ";

    $upd_query .= "WHERE user_id={$user_id}";

    $upd_query_res = mysqli_query($connection, $upd_query);
    confirmQuery($upd_query_res);

    header("Location: user_profile.php");
}

?>



<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $user_name; ?></small>
                    </h1>


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

                                <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
                                <?php
                                if ($user_role == "subscriber") {
                                    echo "<option value='admin'>admin</option>";
                                } else {
                                    echo "<option value='subscriber'>subscriber</option>";
                                }
                                ?>


                            </select>

                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>