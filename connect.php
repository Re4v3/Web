<?php
// ฟังก์ชันสำหรับโหลดตัวแปรจากไฟล์ .env
function loadEnv($file) {
    if (!file_exists($file)) {
        return false;
    }
    
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        list($name, $value) = explode('=', $line, 2);
        $_ENV[$name] = trim($value);
    }
    return true;
}

// โหลดตัวแปรจากไฟล์ .env
loadEnv(__DIR__ . '/.env');

// ตรวจสอบสภาพแวดล้อม
if ($_ENV['RENDER'] === 'true') {
    // สภาพแวดล้อมบน Render.com
    $dsn = $_ENV['DB_DSN'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
} else {
    // สภาพแวดล้อมบน XAMPP
    $dsn = $_ENV['DB_DSN'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
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
