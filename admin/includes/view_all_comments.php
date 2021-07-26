<?php
if (isset($_GET['varDeleteId'])) {
    $varDeleteId = $_GET['varDeleteId'];
    $comment_post_id = $_GET['commentPostId'];

    $dltQuery = "DELETE FROM comments WHERE comment_id={$varDeleteId}";
    $dltQuery_result = mysqli_query($connection, $dltQuery);
    confirmQuery($dltQuery_result);

    ///Update post_comment_count(from table posts)

    //getting the value of post_comment_count(from table posts)
    $query = "SELECT * from posts WHERE post_id=$comment_post_id";
    $select_posts_query = mysqli_query($connection, $query);
    if (!$select_posts_query) {
        die("Query Failed!" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_posts_query)) {
        $post_comment_count = $row['post_comment_count'];
    }

    //Decrease post_comment_count(from table posts) by one
    $query = "UPDATE posts SET post_comment_count =$post_comment_count-1 WHERE post_id={$comment_post_id}";
    $update_post_query = mysqli_query($connection, $query);
    confirmQuery($update_post_query);

    header("Location: comments.php");
}

?>

<?php
if (isset($_GET['varCommentId'])) {
    $varCommentId = $_GET['varCommentId'];
    $varCommentstatus = $_GET['varCommentstatus'];
    //echo $commentStat . $reqCommentId;
    if ($varCommentstatus == 'approved') $varCommentstatus = 'unapproved';
    else $varCommentstatus = 'approved';

    $statQuery = "UPDATE comments SET comment_status='{$varCommentstatus}' WHERE comment_id={$varCommentId}";

    $statQuery_result = mysqli_query($connection, $statQuery);
    confirmQuery($statQuery_result);

    header("Location: comments.php");

}
?>







<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $query = "SELECT * FROM comments";
        $get_all_comments = mysqli_query($connection, $query);
        if (!$get_all_comments) {
            die("Query Error comments" . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($get_all_comments)) {
            echo "<tr>";

            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];

            $comment_post_id = $row['comment_post_id'];

            $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
            $get_post_title = mysqli_query($connection, $query);
            if (!$get_post_title) {
                die("Query Error get_post_title" . mysqli_error($connection));
            }
            while ($rowForPostTitle = mysqli_fetch_assoc($get_post_title)) {
                $post_id = $rowForPostTitle['post_id'];
                $post_title = $rowForPostTitle['post_title'];
            }


            $comment_date = $row['comment_date'];

            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td> <a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            echo "<td>{$comment_date}</td>";

            echo "<td><a href='comments.php?varCommentId={$comment_id}&varCommentstatus={$comment_status}'>{$comment_status}</a></td>";
            
            echo "<td><a href='comments.php?varDeleteId={$comment_id}&commentPostId={$comment_post_id}'>Delete</a></td>";

            echo "</tr>";
        }
        ?>

    </tbody>

</table>