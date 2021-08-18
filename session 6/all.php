<?php
require '../include/conn.php';


function checkCode($str)
{
    $str = trim($str);
    $str = htmlspecialchars($str);
    $str = stripslashes($str);
    return $str;
}
// get data from database

$folder = '../uploads/';

$errors = ['search' => ''];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $search = checkCode($_POST['search']);
    $search = strtolower($search);
    if (empty($search)) {
        $errors['search'] = 'Input is Required';
        $sql2 = "SELECT * FROM post order by id desc";
        $r_query = mysqli_query($conn, $sql2);
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $search)) {
        $errors['search'] = 'Your input Must Be a Text';
        $sql2 = "SELECT * FROM post order by id desc";
        $r_query = mysqli_query($conn, $sql2);
    } else {
        $sql = "SELECT * FROM post WHERE name LIKE '%$search%' OR content LIKE '%$search%'";
        $r_query = mysqli_query($conn, $sql);
    }
} else {
    $sql2 = "SELECT * FROM post order by id desc";
    $r_query = mysqli_query($conn, $sql2);
}
?>
<?php include '../include/header.php'; ?>
<div class="container">
    <h1>Read User</h1>
    <div class="col-md-8">
        <a href="add.php" class="btn btn-primary">Add New User</a>
    </div>
    <div class="col-md-4">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="col-md-8">
                <input class="form-control" type="text" placeholder="Search... " name="search">
                <small class="error">
                    <?php
                    if (isset($errors['search'])) {
                        echo $errors['search'];
                    }
                    ?>
                </small>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>
        <br>
    </div>

    <table class="table table-striped table-bordered" style="margin-top: 60px;">
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
            <?php while ($data = mysqli_fetch_assoc($r_query)) { ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><img src="<?php echo $folder . $data['image']; ?>" alt="" width="80px"></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['content']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include '../include/footer.php'; ?>