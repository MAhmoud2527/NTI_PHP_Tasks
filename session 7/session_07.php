<?php
require '../include/conn.php';
// get data from database
$sql2 = "SELECT * FROM users";
$op = mysqli_query($conn, $sql2);
echo  $_SESSION['user']['name'];
?>
<?php include '../include/header.php'; ?>
<div class="container">
    <h1>Read User</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($git_data = mysqli_fetch_assoc($op)) { ?>
                <tr>
                    <td><?php echo $git_data['id']; ?></td>
                    <td><?php echo $git_data['name']; ?></td>
                    <td><?php echo $git_data['email']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $git_data['id']; ?>" class="btn btn-primary">Change Password</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include '../include/footer.php'; ?>