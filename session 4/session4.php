<?php




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get details of the uploaded file
    $name = $_FILES['image']['name'];
    $type = $_FILES['image']['type'];
    $tmp = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];

    $nameArray = explode('/', $type);
    $exection = strtolower(end($nameArray));
    $finalName = rand() . time() . '.' . $exection;

    $exectionArray = array('png', 'jpeg', 'jpg');
    $folder = '../uploads/';
    $finalPath = $folder . $finalName;

    if (in_array($exection, $exectionArray)) {
        if (move_uploaded_file($tmp, $finalPath)) {
            echo 'File Uploaded';
        } else {
            echo 'File Not Uploaded';
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
        <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="linked_URL">Upload file:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="linked_URL" name="image">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>


</body>

</html>