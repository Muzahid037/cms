<?php
if (isset($_GET['delete'])) {
    $deletable_post_id = $_GET['delete'];
    $dlt_post_query = "DELETE FROM posts WHERE post_id={$deletable_post_id}";
    $dlt_post_query_result = mysqli_query($connection, $dlt_post_query);
    confirmQuery($dlt_post_query_result);
}
?>



<?php
if (isset($_GET['varPostId'])) {
    $varPostId = $_GET['varPostId'];
    $varPoststatus = $_GET['varPoststatus'];
    //echo $commentStat . $reqCommentId;
    if ($varPoststatus == 'draft') $varPoststatus = 'published';
    else $varPoststatus = 'draft';

    $statQuery = "UPDATE posts SET post_status='{$varPoststatus}' WHERE post_id={$varPostId}";

    $statQuery_result = mysqli_query($connection, $statQuery);
    confirmQuery($statQuery_result);

    header("Location: posts.php");
}
?>



<?php

if (isset($_POST['apply_posts'])) {

    $query_type = $_POST['query_type'];

    for ($i = 0; $i < count($_POST['postIdArray']); $i++) {
        $postIdFrQuery = $_POST['postIdArray'][$i];

        $query = "";
        if ($query_type == 'draft') {
            $query .= "UPDATE posts SET post_status='draft' WHERE post_id={$postIdFrQuery}";
        } else if ($query_type == 'publish') {
            $query .= "UPDATE posts SET post_status='published' WHERE post_id={$postIdFrQuery}";
        } else if ($query_type = 'delete') {
            $query .= "DELETE FROM posts WHERE post_id={$postIdFrQuery}";
        }
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
    }
}

?>



<form action="" method="POST">

    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="query_type" id="">
                <option value="">Select Options</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>


        <div class="col-xs-4">
            <input class="btn btn-success" type="submit" name="apply_posts" value="Apply">
            <a href="" class="btn btn-primary">Add New</a>
        </div>


        <thead>
            <tr>
                <th><input type="checkbox" id="" name="" value=""></th>

                <th>Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT * FROM posts";
            $get_all_posts = mysqli_query($connection, $query);
            if (!$get_all_posts) {
                die("Query Error post" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($get_all_posts)) {
                echo "<tr>";

                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];

                $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
                $get_category_title = mysqli_query($connection, $query);
                if (!$get_category_title) {
                    die("Query Error post title" . mysqli_error($connection));
                }

                while ($rowForPostTitle = mysqli_fetch_assoc($get_category_title)) {
                    $category_title = $rowForPostTitle['cat_title'];
                }

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];


                echo "<td><input type='checkbox' class='' id='' name='postIdArray[]' value='{$post_id}'></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$category_title}</td>";
                echo "<td>{$post_title}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><img width='100' src='../images/$post_image' alt='image'</td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                //echo "<td>{$post_status}</td>";   

                echo "<td><a href='posts.php?varPostId={$post_id}&varPoststatus={$post_status}'>{$post_status}</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";

                echo "</tr>";
            }
            ?>

        </tbody>

    </table>

</form>