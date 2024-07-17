# เลือกฐานระบบที่ใช้
FROM php:7.4-apache

# ตั้งค่าให้ Apache ใช้ mod_rewrite สำหรับการ rewrite URLs
RUN a2enmod rewrite

# ตั้งค่า timezone ให้เป็น Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/Asia/Bangkok /etc/localtime && echo Asia/Bangkok > /etc/timezone

# ติดตั้ง extension ที่จำเป็นสำหรับการเชื่อมต่อ MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# ตั้ง WORKDIR ที่เป็นไดเร็กทอรีเริ่มต้นของแอปพลิเคชัน
WORKDIR /var/www/html

# คัดลอกไฟล์ PHP และไฟล์อื่นๆ จากโปรเจกต์ของคุณไปยัง WORKDIR ใน Docker container
COPY . .

# เปิดพอร์ต 80 สำหรับ Apache
EXPOSE 80

# คำสั่งสำหรับการรัน Apache เมื่อ Docker container ถูกสร้างขึ้น
CMD ["apache2-foreground"]
