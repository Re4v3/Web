<?php
session_start();
include 'connect.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];

$target_dir = "images/";

// Prepare array to hold uploaded image URLs
$image_urls = [];

// Loop through each uploaded file
foreach ($_FILES['image']['name'] as $key => $image_name) {
    if (!empty($image_name)) {
        $target_file = $target_dir . basename($image_name);
        move_uploaded_file($_FILES['image']['tmp_name'][$key], $target_file);
        $image_urls[] = $target_file;
    } else {
        $image_urls[] = NULL;
    }
}

// Assign image URLs to variables, handle NULL if no image uploaded
$image1 = !empty($image_urls[0]) ? "'" . $image_urls[0] . "'" : "NULL";
$image2 = !empty($image_urls[1]) ? "'" . $image_urls[1] . "'" : "NULL";
$image3 = !empty($image_urls[2]) ? "'" . $image_urls[2] . "'" : "NULL";

$sql = "INSERT INTO products (name, description, price, category, image_url, image_url_2, image_url_3) 
        VALUES ('$name', '$description', '$price', '$category', $image1, $image2, $image3)";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "เพิ่มสินค้าใหม่เรียบร้อยแล้ว";
} else {
    $_SESSION['message'] = "เกิดข้อผิดพลาดในการเพิ่มสินค้า: " . $conn->error;
}

$conn->close();

header("Location: manage_store.php");
exit;
?>
