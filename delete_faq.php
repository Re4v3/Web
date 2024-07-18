<?php
ob_start(); // เริ่ม output buffering
session_start(); // เริ่ม session
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faqId = $_POST["faq_id"];

    $sql = "DELETE FROM faqs WHERE faq_id='$faqId'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "ลบ FAQ สำเร็จแล้ว";
    } else {
        $_SESSION['message'] = "มีข้อผิดพลาด: " . $conn->error;
    }
}

$conn->close();
header("Location: manage_store.php");
?>
