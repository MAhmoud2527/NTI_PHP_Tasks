<?php
require '../include/conn.php';
function checkCode($str)
{
    $str = trim($str);
    $str = htmlspecialchars($str);
    $str = stripslashes($str);
    return $str;
}
$name = $email = $password = $address = $linked_url = $gender = $imgName =  "";
$errors = ['email' => '', 'password' => ''];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = checkCode($_POST['email']);
    $password = $_POST['password'];
    $errors = [];

    // Check Validation For Email
    if (empty($email)) {
        $errors['email'] = 'Your Email is Required';
    } elseif (filter_var($name, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Your Email Must Be a Valid Email';
    }
    // Check Validation For Password
    if (empty($password)) {
        $errors['password'] = 'Your Password is Required';
    }

    if (empty($errors)) {
        $hashPass = sha1($password);
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$hashPass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $data;
            header('Location: session_07.php');
        }
    }
}

?>





<!-- Form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Login</h2>
        <br>
        <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email">

                    <small class="error">
                        <?php
                        if (isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">

                    <small class="error">
                        <?php
                        if (isset($errors['password'])) {
                            echo $errors['password'];
                        }
                        ?>
                    </small>
                </div>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">login</button>
        </div>
    </div>
    </form>
    </div>
</body>

</html>