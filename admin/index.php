<?php include "includes/admin_header.php" ?>

<?php

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id= {$user_id}";
    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['user_name'];
    }
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
                        <small> <?php echo $user_name; ?> </small>
                    </h1>




                    <!-- /.row -->

                    <div class="row">




                        <?php
                        $query = "SELECT * FROM posts";
                        $result = mysqli_query($connection, $query);
                        confirmQuery($result);
                        $noOfPosts = mysqli_num_rows($result);
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">

                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo $noOfPosts; ?></div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>

                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>



                        <?php
                        $query = "SELECT * FROM comments";
                        $result = mysqli_query($connection, $query);
                        confirmQuery($result);
                        $noOfComments = mysqli_num_rows($result);
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo $noOfComments; ?></div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <?php
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($connection, $query);
                        confirmQuery($result);
                        $noOfUsers = mysqli_num_rows($result);
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo $noOfUsers; ?></div>
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>



                        <?php
                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($connection, $query);
                        confirmQuery($result);
                        $noOfCategories = mysqli_num_rows($result);
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo $noOfCategories; ?></div>
                                            <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>


                    </div>
                    <!-- /.row -->


                    <?php

                    $query = "SELECT * FROM posts WHERE post_status='draft'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                    $noOfDraftPosts = mysqli_num_rows($result);

                    $query = "SELECT * FROM comments WHERE comment_status='unapproved'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                    $noOfUnapprovedComments = mysqli_num_rows($result);

                    $query = "SELECT * FROM users WHERE user_role='subscriber'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                    $noOfScriberUsers = mysqli_num_rows($result);

                    ?>




                    <div class="row">

                        <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['bar']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Data', 'Count'],

                                    <?php
                                    $elementText = ['Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers', 'Categories'];
                                    $elementValue = [$noOfPosts, $noOfDraftPosts, $noOfComments, $noOfUnapprovedComments, $noOfUsers, $noOfScriberUsers, $noOfCategories];

                                    for ($i = 0; $i < 7; $i++) {
                                        echo "['{$elementText[$i]}'" . "," . "{$elementValue[$i]}],";
                                    }
                                    ?>

                                ]);

                                var options = {
                                    chart: {
                                        title: '',
                                        subtitle: '',
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>

                        <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                    </div>







                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>