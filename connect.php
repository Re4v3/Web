<?php
// ตรวจสอบสภาพแวดล้อม
if (getenv('RENDER')) {
    // สภาพแวดล้อมบน Render.com
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
} else {
    // สภาพแวดล้อมบน XAMPP
    $dsn = 'pgsql:host=localhost;port=5432;dbname=lovepotion_db';
    $username = 'root';
    $password = ''; // ใส่รหัสผ่านของคุณสำหรับ XAMPP
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
