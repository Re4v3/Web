<?php
session_start(); // เริ่ม session
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่าค่าใน $_POST มีค่าหรือไม่ก่อนใช้งาน
    if (isset($_POST["editFaqId"]) && isset($_POST["editFaqQuestion"]) && isset($_POST["editFaqAnswer"])) {
        $faqId = $_POST["editFaqId"];
        $question = $_POST["editFaqQuestion"];
        $answer = $_POST["editFaqAnswer"];

        // ใช้ prepared statement เพื่อป้องกัน SQL Injection
        $sql = "UPDATE faqs SET question=?, answer=? WHERE faq_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $question, $answer, $faqId);

        if ($stmt->execute()) {
            $_SESSION['message'] = "แก้ไข FAQ สำเร็จแล้ว";
        } else {
            $_SESSION['message'] = "มีข้อผิดพลาด: " . $conn->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "มีข้อผิดพลาดในการรับข้อมูลจากฟอร์ม";
    }
}
header("Location: manage_store.php");
?>
