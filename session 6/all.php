<?php
require 'conn.php';
// get data from database
$sql2 = "SELECT * FROM post";
$op = mysqli_query($conn, $sql2);
$folder = '../uploads/';

?>
<?php include '../include/header.php'; ?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>image</th>
                <th>Title</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($git_data = mysqli_fetch_assoc($op)) { ?>
                <tr>
                    <th><?php echo $git_data['id']; ?></th>
                    <th><img src="<?php echo $folder . $git_data['image']; ?>" alt="" width="50px"></th>
                    <th><?php echo $git_data['name']; ?></th>
                    <th><?php echo $git_data['content']; ?></th>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include '../include/footer.php'; ?>