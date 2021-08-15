<!--  Task 4 -->
<!--  Create a form with the following inputs (name, email, password, address, gender, linkedin url) Validate inputs then return message to user . 
* validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
gender = [required]
linkedin url = [reuired | url]
Upload File = [required]
------- write all form value in file text --------
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
$name = $email = $password = $address = $linked_url = $gender = $imgName =  "";
$errors = ['name' => '', 'email' => '', 'password' => '', 'address' => '', 'gender' => '', 'url' => '', 'image' => ''];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = checkCode($_POST['name']);
    $email = checkCode($_POST['email']);
    $password = $_POST['password'];
    $address = checkCode($_POST['address']);
    // $gender = $_POST['gender'];
    $linked_url = checkCode($_POST['lindedin']);
    $errors = [];
    // print_r($_POST);
    // Check Validation For Name
    if (empty($name)) {
        $errors['name'] = 'Your Name is Required';
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors['name'] = 'Your Name Must Be a Text';
    }
    // Check Validation For Email
    if (empty($email)) {
        $errors['email'] = 'Your Email is Required';
    } elseif (filter_var($name, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Your Email Must Be a Valid Email';
    }
    // Check Validation For Password
    if (empty($password)) {
        $errors['password'] = 'Your Password is Required';
    } elseif (strlen($password) > 0 && strlen($password) < 6) {
        $errors['password'] = 'Your password can not be less than 6 Char ';
    } else {
        $hashPass = sha1($password);
    }
    // Check Validation For Address
    if (empty($address)) {
        $errors['address'] = 'Your Address is Required';
    } elseif (!strlen($address) == 10) {
        $errors['address'] = 'Your address Must Be a 10 Chars';
    }
    // Check Validation For Gender
    if (!isset($_POST['gender'])) {
        $errors['gender'] = 'Your Gender is Required';
    } else {
        $gender = $_POST['gender'];
    }
    // Check Validation For URL
    if (empty($linked_url)) {
        $errors['url'] = 'LinkedIn URL is Required';
    } elseif (!filter_var($linked_url, FILTER_VALIDATE_URL)) {
        $errors['url'] = 'LinkedIn URL Must Be a valid URL';
    }
    // image Upload 
    $name_img = $_FILES['image']['name'];
    $name_type = $_FILES['image']['type'];
    $name_size = $_FILES['image']['size'];
    $name_temp = $_FILES['image']['tmp_name'];

    $nameImageArray = explode('/', $name_type);
    $exection = strtolower(end($nameImageArray));
    $finalName = rand() . time() . '.' . $exection;

    $exectionArray = array('png', 'jpg', 'jpeg', 'ico');
    $folder = '../uploads/';
    $finalImageName = $folder .  $finalName;
    // Check Before Upload 
    if (in_array($exection, $exectionArray)) {
        if (move_uploaded_file($name_temp, $finalImageName)) {
            //    Code ..
            $imgName =  $finalName;
        } else {
            $errors['image'] = 'File Not Uploaded Try Again';
        }
    } else {
        $errors['image'] = 'Please Select a Photo';
    }

    if (empty($errors)) {
        $myfile = fopen("UserInfo.txt", "a") or die("Unable to open file!");
        fwrite($myfile, ' - Your name is : ' . $name . "\n");
        fwrite($myfile, ' - Your Email is : ' . $email . "\n");
        fwrite($myfile, ' - Your Password is : ' . $hashPass . "\n");
        fwrite($myfile, ' - Your Address is : ' . $address . "\n");
        fwrite($myfile, ' - Your Gender is : ' . $gender . "\n");
        fwrite($myfile, ' - Your Linked URL is : ' . $linked_url . "\n");
        fwrite($myfile, ' - Your Image Name is : ' . $imgName . "\n\n");
        fclose($myfile);
        // $gender = '';
    } else {
        $name = checkCode($_POST['name']);
        $email = checkCode($_POST['email']);
        $password = $_POST['password'];
        $address = checkCode($_POST['address']);
        // $gender = $_POST['gender'];
        $linked_url = checkCode($_POST['lindedin']);
        $imgName =  $finalName;
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
        <h2 class="text-center">Task 4 ( Form Validation) </h2>
        <br>
        <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" value="<?php
                                                                                                                        if (!empty($errors)) {
                                                                                                                            echo $name;
                                                                                                                        }
                                                                                                                        ?>">
                    <small class="error">
                        <?php
                        if (isset($errors['name'])) {
                            echo $errors['name'];
                        }
                        ?>
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email" value="<?php
                                                                                                                            if (!empty($errors)) {
                                                                                                                                echo $email;
                                                                                                                            }
                                                                                                                            ?>">

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
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" value="<?php
                                                                                                                                if (!empty($errors)) {
                                                                                                                                    echo $password;
                                                                                                                                }
                                                                                                                                ?>">

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
                <label class="control-label col-sm-2" for="address">Address:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" placeholder="Enter Your Address" name="address" value="<?php
                                                                                                                                if (!empty($errors)) {
                                                                                                                                    echo $address;
                                                                                                                                }
                                                                                                                                ?>">

                    <small class="error">
                        <?php
                        if (isset($errors['address'])) {
                            echo $errors['address'];
                        }
                        ?>
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="address">Gender:</label>
                <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : '' ?>>Male</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : '' ?>>Female</label>
                    <br>
                    <small class="error">
                        <?php
                        if (isset($errors['gender'])) {
                            echo $errors['gender'];
                        }
                        ?>
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="linked_URL">LinkedIn URL:</label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" id="linked_URL" placeholder="Enter Your LinkedIn URL" name="lindedin" value="<?php
                                                                                                                                        if (!empty($errors)) {
                                                                                                                                            echo $linked_url;
                                                                                                                                        }
                                                                                                                                        ?>">
                    <small class="error">
                        <?php
                        if (isset($errors['url'])) {
                            echo $errors['url'];
                        }
                        ?>
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="linked_URL">Upload image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="linked_URL" name="image" value="<?php
                                                                                                if (!empty($errors)) {
                                                                                                    echo $imgName;
                                                                                                }
                                                                                                ?>">
                    <small class="error">
                        <?php
                        if (isset($errors['image'])) {
                            echo $errors['image'];
                        }
                        ?>
                    </small>
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
        if (empty($errors)) {
            echo 'Your Name : ' . $name . '<br>';
            echo 'Your Email : ' . $email . '<br>';
            echo 'Your Password : ' . sha1($password) . '<br>';
            echo 'Your Address : ' . $address . '<br>';
            echo 'Your Gender : ' . $gender . '<br>';
            echo 'Your Linkedin URL : ' . $linked_url . '<br>';
            echo 'Image Name : ' . $imgName . '<br>';
        }
        ?>
        <br>
        <br>
    </div>


</body>

</html>