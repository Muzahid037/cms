<?php

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("Query Failed!" . mysqli_error($connection));
    }
}

function insertCategory()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if (strlen(trim($cat_title)) == 0) {
            echo "This Field should not be empty!";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUE ('$cat_title')";
            $insert_query = mysqli_query($connection, $query);

            if (!$insert_query) {
                die("Query Failed" . mysqli_error($connection));
            }
            //echo "connection";
        }
    }
}

function findAllCategory()
{
    //find all categories query
    global $connection;
    $query = "SELECT * FROM categories";
    $get_all_categories = mysqli_query($connection, $query);
    if (!$get_all_categories) {
        die("Query Error category" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($get_all_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'> Delete </a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'> Edit </a></td>";
        echo "</tr>";
    }
}

function deleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {

        $dlt_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$dlt_cat_id}";
        $delete_categories = mysqli_query($connection, $query);
        header("Location: categories.php");
        if (!$delete_categories) {
            die("Delete query error!" . mysqli_error($connection));
        }
    }
}
