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
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
        <?php include 'nev.php'; ?>


<!-- Other Sections -->

            <!-- Product preview section-->
            <section class="py-2">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-9 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder">Lovepotion Products</h2>
                                <p class="lead fw-normal text-muted mb-5">"สินค้าของเรามาพร้อมกับคุณภาพและการบริการที่ดีที่สุด"</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="search-form-container border">
                        <form class="d-flex w-100" method="POST" action="">
                            <input class="form-control me-2" type="search" name="search_query" placeholder="ค้นหาสินค้า..." aria-label="Search">
                            <button class="btn btn-pink btn px-4" type="submit">
                                <i class="bi bi-search"></i> <!-- Bootstrap Icons search icon -->
                            </button>
                        </form>
                    </div>
                    
                    <?php
                    include 'connect.php'; // รวมไฟล์เชื่อมต่อฐานข้อมูล

                    $search_query = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $search_query = $_POST['search_query'];
                    }

                    $sql = "SELECT * FROM products WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<section class="py-5 ">';
                        echo '<div class="container px-5 my-5 ">';
                        echo '<div class="row gx-6 justify-content-center ">';

                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-lg-4 mb-5">';
                            echo '<div class="card h-100  shadow border-0">';
                            echo '<img class="card-img-top" src="'.$row["image_url"].'" alt="Product Image" />';
                            echo '<div class="card-body p-4">';
                            echo '<h5 class="card-title mb-3">'.$row["name"].'</h5>';
                            echo '<p class="card-text">'.$row["description"].'</p>';
                            echo '</div>';
                            echo '<div class="card-footer p-4 pt-0 bg-transparent border-top-0">';
                            echo '<div class="d-flex align-items-end justify-content-between">';
                            echo '<div class="fw-bold">'.$row["price"].'</div>';
                            echo '<a class="btn btn-pink2 " href="https://www.instagram.com/tp23_shop?igsh=MXBobXFwNnpobHM0cA%3D%3D&utm_source=qr">Buy Now</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>';
                        echo '</div>';
                        echo '</section>';
                    } else {
                        echo '<div class="opacity-50 text-center">ไม่พบสินค้าที่ตรงกับคำค้นหา</div>';
                    }

                    $conn->close();
                    ?>





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
