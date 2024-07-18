<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LOVEPOTION</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

    <style>
        .product-name {
            font-size: 1.5rem;
            text-align: left;
            margin-top: 0px; /* Remove default margin */
            padding-top: 1rem; /* Add padding for spacing */
        }

        .read-more {
            cursor: pointer;
            color: blue; /* Change color as desired */
        }

        .read-more:hover {
            text-decoration: underline;
        }

        .description-full {
            display: none;
        }

        .expanded {
            display: block;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <?php include 'nev.php'; ?>

        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <?php
                        include 'connect.php'; // Connect to the database
                        
                        // Get product_id from URL
                        $product_id = $_GET['product_id'];

                        // SQL to retrieve product information
                        $sql = "SELECT * FROM products WHERE product_id = $product_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            ?>
                            <div id="product-images-carousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $image_urls = array($row['image_url'], $row['image_url_2'], $row['image_url_3']);
                                    foreach ($image_urls as $index => $image_url) {
                                        if (!empty($image_url)) { // Check if the image URL is not empty
                                            $active = ($index === 0) ? ' active' : '';
                                            echo '<div class="carousel-item' . $active . '">';
                                            echo '<img src="' . $image_url . '" class="d-block w-100" alt="Product Image">';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#product-images-carousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#product-images-carousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <?php
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Product not found</div>';
                        }

                        $conn->close();
                        ?>
                    </div>
                    <div class="col-lg-6 rounded bg-light shadow border">
                        <?php
                        include 'connect.php'; // Connect to the database
                        
                        // Get product_id from URL
                        $product_id = $_GET['product_id'];

                        // SQL to retrieve product information
                        $sql = "SELECT * FROM products WHERE product_id = $product_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            ?>
                            <div class="text-dark rounded p-4">
                                <h1 class="display-6 fw-bolder product-name"><?php echo $row['name']; ?></h1>
                                <p class="lead fw-normal text-muted description-full" style="font-size: 1rem; display: none;">
                                    <?php echo $row['description']; ?>
                                </p>
                                <p class="lead fw-normal text-muted">
                                    <span class="description-short" style="font-size: 1rem;">
                                        <?php
                                        $short_description = $row['description'];
                                        if (strlen($short_description) > 430) {
                                            $short_description = substr($short_description, 0, 430) . '...';
                                        }
                                        echo $short_description;
                                        ?>
                                    </span>
                                    <button class="text-dark btn-sm btn read-more">อ่านเพิ่มเติม</button>
                                </p>
                                <div class="text-muted rounded-pill px-2 py-3 mb-4 text-uppercase">
                                    <?php echo $row['category']; ?>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="fs-5">
                                        <span class="ms-2">ราคา : <span class="text-success fw-bold"><?php echo $row['price']; ?> </span><span style="font-size: 0.9rem;">ต่อชิ้น </span></span>
                                    </div>
                                </div>
                                <div class="ms-3 w-100 container d-flex justify-content-left">
                                    <a class="btn btn-pink btn-lg flex-shrink-0 me-3" href="https://www.instagram.com/tp23_shop?igsh=MXBobXFwNnpobHM0cA%3D%3D&utm_source=qr" target="_blank">
                                        <i class="bi bi-instagram"></i> Instagram
                                    </a>
                                    <a class="btn btn-tiktok btn-lg flex-shrink-0" href="https://www.tiktok.com/@tp23_shop?_t=8o0ZBqDdza3&_r=1" target="_blank">
                                        <i class="bi bi-file-play"></i> Tiktok
                                    </a>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Product not found</div>';
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </section>
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
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small text-decoration-none" href="https://www.tiktok.com/@tp23_shop?_t=8o0ZBqDdza3&_r=1" target="_blank">
                        <i class="bi bi-file-play"></i> Tiktok
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script for "Read More" functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const readMoreButton = document.querySelector('.read-more');
            const shortDescription = document.querySelector('.description-short');
            const fullDescription = document.querySelector('.description-full');

            readMoreButton.addEventListener('click', function () {
                shortDescription.style.display = 'none';
                fullDescription.style.display = 'block';
                readMoreButton.style.display = 'none'; // Optional: Hide "Read More" button after click
            });
        });
    </script>

</body>

</html>
