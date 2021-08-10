<!--  Task 3 -->
<!--  Create a form with the following inputs (name, email, password, address, gender, linkedin url) Validate inputs then return message to user . 
* validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
gender = [required]
linkedin url = [reuired | url]
 -->

<!-- PHP CODE -->
<?php

function checkCode($str)
{
    $str = trim($str);
    $str = htmlspecialchars($str);
    $str = stripslashes($str);
    return $str;
}
$name = $email = $password = $address = $linked_url = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = checkCode($_POST['name']);
    $email = checkCode($_POST['email']);
    $password = $_POST['password'];
    $address = checkCode($_POST['address']);
    $gender = $_POST['gender'];
    $linked_url = checkCode($_POST['lindedin']);
    $errors = [];

    // Check Validation For Name
    if (empty($name)) {
        $errors['name'] = 'Your Name is Required';
    }
    if (!filter_var($name, FILTER_SANITIZE_STRING)) {
        $errors['name'] = 'Your Name Must Be a Text';
    }
    // Check Validation For Email
    if (empty($email)) {
        $errors['email'] = 'Your Email is Required';
    }
    if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Your Email Must Be a Valid Email';
    }
    // Check Validation For Password
    if (empty($password)) {
        $errors['password'] = 'Your Password is Required';
    }
    if (strlen($password) > 0 && strlen($password) < 6) {
        $errors['password'] = 'Your password can not be less than 6 Char ';
    }
    // Check Validation For Address
    if (empty($address)) {
        $errors['address'] = 'Your Address is Required';
    }
    if (!strlen($address) == 10) {
        $errors['address'] = 'Your address Must Be a 10 Chars';
    }
    // Check Validation For Gender
    if (empty($gender)) {
        $errors['gender'] = 'Your Gender is Required';
    }
    // Check Validation For URL
    if (empty($linked_url)) {
        $errors['url'] = 'LinkedIn URL is Required';
    }
    if (!filter_var($linked_url, FILTER_VALIDATE_URL)) {
        $errors['url'] = 'LinkedIn URL Must Be a valid URL';
    }
    // Print Error
    if (count($errors)  > 0) {
        foreach ($errors as $key => $error) {
            echo $error . '<br>';
        }
    }
}

?>





<!-- Form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Validation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Task 3 ( Form Validation) </h2>
        <br>
        <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="address">Address:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" placeholder="Enter Your Address" name="address">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="address">Gender:</label>
                <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="gender" value="Male">Male</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="linked_URL">LinkedIn URL:</label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" id="linked_URL" placeholder="Enter Your LinkedIn URL" name="lindedin">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <?php
        echo "<h2>Your Input:</h2>";
        echo $name;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $password;
        echo "<br>";
        echo $address;
        echo "<br>";
        echo $gender;
        echo "<br>";
        echo $linked_url;

        ?>
        <br>
        <br>
    </div>


</body>

</html>