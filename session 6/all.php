<?php
require '../include/conn.php';
// get data from database
$sql2 = "SELECT * FROM post";
$op = mysqli_query($conn, $sql2);
$folder = '../uploads/';

?>
<?php include '../include/header.php'; ?>
<div class="container">
    <h1>Read User</h1>
    <a href="add.php" class="btn btn-primary">Add New User</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($git_data = mysqli_fetch_assoc($op)) { ?>
                <tr>
                    <td><?php echo $git_data['id']; ?></td>
                    <td><img src="<?php echo $folder . $git_data['image']; ?>" alt="" width="50px"></td>
                    <td><?php echo $git_data['name']; ?></td>
                    <td><?php echo $git_data['content']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $git_data['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id=<?php echo $git_data['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include '../include/footer.php'; ?>