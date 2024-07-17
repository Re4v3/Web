<?php
require 'vendor/autoload.php'; // สำหรับการใช้ vlucas/phpdotenv หากคุณใช้ composer

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// ตรวจสอบสภาพแวดล้อม
if (getenv('RENDER') === 'true') {
    // สภาพแวดล้อมบน Render.com
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
} else {
    // สภาพแวดล้อมบน XAMPP
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
}

// สร้างการเชื่อมต่อ
try {
    $conn = new PDO($dsn, $username, $password);
    // ตั้งค่า PDO error mode ให้เป็น exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
