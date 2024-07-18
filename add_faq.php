<?php
ob_start(); // เริ่ม output buffering
session_start(); // เริ่ม session
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    $sql = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "เพิ่ม FAQ ใหม่สำเร็จแล้ว";
    } else {
        $_SESSION['message'] = "มีข้อผิดพลาด: " . $conn->error;
    }
}

$conn->close();
header("Location: manage_store.php");
?>
