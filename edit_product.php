<?php
session_start();
include 'connect.php';

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];

// Check if there are any uploaded files
if (!empty(array_filter($_FILES['image']['name']))) {
    $target_dir = "images/";
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

    // Assign image URLs to variables
    $image1 = isset($image_urls[0]) ? "'" . $image_urls[0] . "'" : "NULL";
    $image2 = isset($image_urls[1]) ? "'" . $image_urls[1] . "'" : "NULL";
    $image3 = isset($image_urls[2]) ? "'" . $image_urls[2] . "'" : "NULL";

    // Update SQL query with image URLs
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', category='$category', 
            image_url=$image1, image_url_2=$image2, image_url_3=$image3 WHERE product_id='$product_id'";
} else {
    // Update SQL query without changing images
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', category='$category' 
            WHERE product_id='$product_id'";
}

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "แก้ไขสินค้าเรียบร้อยแล้ว";
} else {
    $_SESSION['message'] = "เกิดข้อผิดพลาดในการแก้ไขสินค้า: " . $conn->error;
}

$conn->close();

header("Location: manage_store.php");
exit;
?>
