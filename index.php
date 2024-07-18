<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Modern Business - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .carousel-item {
                width: 100%;
                height: auto; /* Adjust height as needed */
                object-fit: cover;
            }
            .carousel-item img {
                width: 100%;
                height: auto;
               
            }
            .promo-row {
                margin-bottom: 30px;
                text-align: center;
                background-color: #f9f9f9;
                border-radius: 10px;
                padding: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .promo-img {
                width: 100%;
                height: auto; /* Adjust height as needed */
                object-fit: cover;
                border-radius: 10px;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
        <?php include 'nev.php'; ?>

        <!-- Header with Promotional Slideshow -->
        <header>
            <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Carousel Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    include("connect.php");

                    $sql = "SELECT * FROM promotions ORDER BY promotion_id ASC";
                    $result = $conn->query($sql);

                    $active = true;
                    $index = 0;
                    while ($row = $result->fetch_assoc()) {
                        $active_class = $active ? 'active' : '';
                    ?>
                        <li data-bs-target="#promoCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $active_class; ?>"></li>
                    <?php
                        $active = false;
                        $index++;
                    }
                    $conn->close();
                    ?>
                </ol>

                <div class="carousel-inner">
                    <?php
                    include 'connect.php';

                    $sql = "SELECT * FROM promotions ORDER BY promotion_id ASC";
                    $result = $conn->query($sql);

                    $active = true;
                    while ($row = $result->fetch_assoc()) {
                        $image_url = $row['image_url'];

                        $active_class = $active ? 'active' : '';
                    ?>
                        <div class="carousel-item <?php echo $active_class; ?>">
                            <img src="<?php echo $image_url; ?>" alt="Promotion Image">
                        </div>
                    <?php
                        $active = false;
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </header>

        <!-- Display Promotions -->
                        <div class="container mt-5 pt-5 ">
                            <div class="text-center">
                                <h2 class="fw-bolder">Lovepotion Promotions</h2>
                                <p class="lead fw-normal text-muted mb-5">"โปรโมชั่นพิเศษสุดสำหรับคุณ รับส่วนลดและข้อเสนอสุดคุ้ม"</p>
                            </div>
                            </div>
        <section class="container col-4 py-5">
            <div class="row">
                
                <?php
                include 'connect.php';

                $sql = "SELECT * FROM promotions ORDER BY promotion_id ASC";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $promotion_name = $row['promotion_name'];
                    $description = $row['description'];
                    $image_url = $row['image_url'];
                ?>
                    <div class="col-md-12 promo-row">
                        <img src="<?php echo $image_url; ?>" class="promo-img" alt="<?php echo $promotion_name; ?>">
                        <h5><?php echo $promotion_name; ?></h5>
                        <p><?php echo $description; ?></p>
                    </div>
                <?php
                }
                $conn->close();
                ?>
            </div>
       
            </section>    
        <!-- Call to action-->
        <aside class="container mb-5 rounded-3 p-4 p-sm-5 mt-5 shadow border rounded" style="background: linear-gradient(to bottom right, #ffffff, #f0f0f0); background-image: url('images/followus.jpg'); background-size: 100%; background-position: center;">
            <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                <div class="mb-4 mb-xl-0">
                    <div class="fs-3 fw-bold text-dark">ติดตามข่าวสารได้ที่ IG</div>
                    <div class="text-dark">ติดตามเราเพื่อรับข่าวสารล่าสุดและโปรโมชั่น</div>
                </div>
                <div class="ms-xl-4">
                    <a class="btn btn-pink" href="https://www.instagram.com/tp23_shop?igsh=MXBobXFwNnpobHM0cA%3D%3D&utm_source=qr" target="_blank">ติดตามเรา</a>
                </div>
            </div>
        </aside>
        
    </main>

        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto">
                        <div class="small m-0 text-white">ลิขสิทธิ์ &copy; Lovepotion 2023</div>
                    </div>
                    <div class="col-auto">
                        <a class="link-light small text-decoration-none" href="https://www.instagram.com/tp23_shop?igsh=MXBobXFwNnpobHM0cA%3D%3D&utm_source=qr" target="_blank">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <span class="text-white mx-1 ">&middot;</span>
                        <a class="link-light small text-decoration-none" href="https://www.tiktok.com/@tp23_shop?_t=8o0ZBqDdza3&_r=1" target="_blank">
                        <i class="bi bi-file-play "></i> Tiktok
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
