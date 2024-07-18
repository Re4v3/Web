<?php
ob_start(); // เริ่ม output buffering
session_start(); // เริ่ม session
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["faq_id"])) {
    $faqId = $_GET["faq_id"];

    // ตรวจสอบว่า faq_id เป็นตัวเลขหรือไม่
    if (!is_numeric($faqId)) {
        $_SESSION['message'] = "ข้อมูลที่ส่งมาไม่ถูกต้อง";
    } else {
        $faqId = mysqli_real_escape_string($conn, $faqId);

        $sql = "DELETE FROM faqs WHERE faq_id = '$faqId'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "ลบ FAQ สำเร็จแล้ว";
        } else {
            $_SESSION['message'] = "มีข้อผิดพลาดในการลบ FAQ: " . $conn->error;
        }
    }
} else {
    $_SESSION['message'] = "ไม่พบข้อมูลที่ต้องการลบ";
}

$conn->close();
header("Location: manage_store.php");
exit;
?>
