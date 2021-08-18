<?php
require '../include/conn.php';
function checkCode($str)
{
    $str = trim($str);
    $str = htmlspecialchars($str);
    $str = stripslashes($str);
    return $str;
}

$id = $_GET['id'];
$sql = "SELECT * FROM `post` WHERE  id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = checkCode($_POST['name']);
    $content = checkCode($_POST['address']);
    $errors = [];
    // print_r($_POST);
    // Check Validation For Name
    if (empty($title)) {
        $errors['name'] = 'Title is Required';
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $title)) {
        $errors['name'] = 'Your Name Must Be a Text';
    }

    // Check Validation For Address
    if (empty($content)) {
        $errors['address'] = 'Content is Required';
    } elseif (!strlen($content) == 10) {
        $errors['address'] = 'Your Content Must Be a 10 Chars';
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
            unlink($finalPath); // Delete image from Folder
        }
    } else {
        $finalName =  $data['image']; // Set old Value For image
        // var_dump($finalName);
    }

    if (empty($errors)) {

        $sql = "UPDATE `post` SET `name`='$title',`content`='$content',`image`='$finalName' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: all.php");
        }
    }
}

?>





<!-- Form -->
<?php include '../include/header.php'; ?>

<div class="container">
    <h2 class="text-center">Edit ( Crud Operation ) </h2>
    <br>
    <form class="form-horizontal" method="POST" action="edit.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Enter title" name="name" value="<?php echo $data['name']; ?>">
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
            <label class="control-label col-sm-2" for="address">content</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" placeholder="Enter a content" name="address" value="<?php echo $data['content']; ?>">

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
                <button type="submit" class="btn btn-default">Edit</button>
            </div>
        </div>
    </form>
</div>
<?php include '../include/footer.php'; ?>