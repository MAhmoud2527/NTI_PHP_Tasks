<?php
require '../include/conn.php';
$id = $_GET['id'];
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
if (filter_var($id, FILTER_VALIDATE_INT)) {
    $sql = "SELECT * FROM `users` WHERE  id = $id";
    $result = mysqli_query($conn, $sql);
    $git_data = mysqli_fetch_assoc($result);
    if (!$git_data) {
        header("Location: session_07.php");
    }
}
$old_password = $git_data['password'];

// $errors = ['Password' => ''];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $old_password_check = $_POST['old_password'];
    $errors = [];
    if (empty($password)) {
        $errors['password'] = 'Password is Required';
    } elseif (strlen($password) > 0 && strlen($password) < 6) {
        $errors['password'] = 'Your password can not be less than 6 Char ';
    }
    if (empty($old_password_check)) {
        $errors['old_password'] = 'Your old Password is Required';
    }

    if (empty($errors)) {
        if (sha1($old_password_check) == $old_password) {
            $password = sha1($_POST['password']);
            // Update Password
            $sql = "UPDATE `users` SET `password`='$password' WHERE id= $id";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: session_07.php");
            }
        } else {
            $errors['old_password'] = 'Your old password is not correct ';
        }
    }
}

?>
<!-- Form -->
<?php include '../include/header.php'; ?>

<div class="container">
    <h2 class="text-center">Task 7 ( Edit Password ) </h2>
    <br>
    <form class="form-horizontal" method="POST" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Old Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="name" name="old_password">
                <small class="error">
                    <?php
                    if (isset($errors['old_password'])) {
                        echo $errors['old_password'];
                    }
                    ?>
                </small>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="name" name="password">
                <small class="error">
                    <?php
                    if (isset($errors['password'])) {
                        echo $errors['password'];
                    }
                    ?>
                </small>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </div>
    </form>
</div>
<?php include '../include/footer.php'; ?>