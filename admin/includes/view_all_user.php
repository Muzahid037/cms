<?php

if(isset($_GET['delete']))
{
    $deletable_user_id=$_GET['delete'];
    $dlt_user_query="DELETE FROM users WHERE user_id={$deletable_user_id}";
    $dlt_user_query_result=mysqli_query($connection,$dlt_user_query);
    confirmQuery($dlt_user_query_result);
}
?>



<?php

if (isset($_GET['u_id'])) {
    $user_id = $_GET['u_id'];
    $user_role = $_GET['u_role'];
    
    if ($user_role == 'admin') $user_role = 'subscriber';
    else $user_role = 'admin';

    $query = "UPDATE users SET user_role='{$user_role}' WHERE user_id={$user_id}";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    header("Location: users.php");
}

?>




<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Usename</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);
        

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_randSalt = $row['user_randSalt'];

            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";

            echo "<td><a href='users.php?u_id={$user_id}&u_role={$user_role}'>{$user_role}</a></td>";
           echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";

            echo "</tr>";
        }
        ?>

    </tbody>

</table>