<?php
$servername = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USERNAME') ?: 'root';
$password = getenv('DB_PASSWORD') ?: ''; // ใส่รหัสผ่านของคุณสำหรับ XAMPP
$dbname = getenv('DB_NAME') ?: 'lovepotion_db';

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
