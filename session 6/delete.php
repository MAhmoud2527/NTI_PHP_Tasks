<?php
require '../include/conn.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `post` WHERE  id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$filename = '../uploads/';
$imageName = $data['image'];
$finalPath = $filename . $imageName;
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
if (filter_var($id, FILTER_VALIDATE_INT)) {
    $sql = "DELETE FROM `post` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: all.php");
        unlink($finalPath); // Delete image from Folder
    }
}
