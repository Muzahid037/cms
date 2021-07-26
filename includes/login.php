<?php include "db.php"; ?>
<?php session_start() ?>

<?php
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE user_name = '{$username}' AND user_password='{$password}'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed!" . mysqli_error($connection));
    }


    $noOfRecord = mysqli_num_rows($result);
    //echo "Returned rows are: " . mysqli_num_rows($result);
    if (!$noOfRecord) {
        header("Location: ../index.php");
    } else {

        while($row=mysqli_fetch_assoc($result))
        {
            $_SESSION['user_id']= $row['user_id'];
            //$_SESSION['user_name'] = $row['user_name'];
            //$_SESSION['user_password'] = $row['user_password'];
           // $_SESSION['user_firstname']= $row['user_firstname'];
            //$_SESSION['user_lastname']= $row['user_lastname'];
            //$_SESSION['user_image']= $row['user_image'];
           // $_SESSION['user_email']= $row['user_email'];
            //$_SESSION['user_role']= $row['user_role'];
            
        }

        header("Location: ../admin/index.php");
    }

}

?>
