<?php include "includes/admin_header.php"; ?>


<!--Add categories backend-->
<?php insertCategory(); ?>

<!--Delete category backend-->
<?php deleteCategory(); ?>
<!--End of Delete category backend-->


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
                        <small>Author</small>
                    </h1>
                    <!-- End of Page Heading -->


                    <!-- Add and update category form -->
                    <div class="col-xs-6">

                        <!-- Add category form -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label><br>
                                <input class="form-control" type="text" name="cat_title">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>

                        </form>
                        <!-- End of add category form -->


                        <!--Includng Update category form -->
                        <?php
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include "includes/update_category.php";
                        }
                        ?>
                        <!-- Update category form -->



                    </div>
                    <!-- End of add and update category form -->


                    <!--category table -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th>Category Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thread>
                            <tbody>

                                <?php findAllCategory(); ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- End of category table -->


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>