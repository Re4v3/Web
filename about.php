<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>About us - LOVEPOTION</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .about-section .row {
            margin-bottom: 30px;
        }

        .about-section .row:nth-child(even) .about-text {
            text-align: left;
            order: 1;
        }

        .about-section .row:nth-child(even) .about-image {
            order: 2;

        }

        .about-section .row:nth-child(odd) .about-text {
            text-align: right;
            order: 2;
        }

        .about-section .row:nth-child(odd) .about-image {
            order: 1;
        }

        .about-section .about-image img {
            max-width: 100%;
            height: auto;
        }

        .about-section .about-text {
            display: flex;
            align-items: right;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <?php include 'nev.php'; ?>

        <!-- About Section -->
        <section class="about-section py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder mt-3 mb-5 pb-5">About Us </h1>

                    <?php
                    include 'connect.php';

                    $sql = "SELECT * FROM about_us";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="row my-5 py-5">';
                            echo '<div class="col-md-6 about-image mb-4">';
                            echo '<img src="' . $row['image_path'] . '" alt="About Us Image" class="img-fluid rounded" />';
                            echo '</div>';
                            echo '<div class="col-md-6 about-text">';
                            echo '<h2 class="fw-bolder ">' . $row['topic'] . '</h2>';
                            echo '<p class="lead fw-normal text-muted">' . $row['content'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No information available.</p>';
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </section>

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

        <!-- Load Navigation Bar Script -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(function() {
                $('#navbarContainer').load('nev.php');
            });
        </script>
    </main>
</body>

</html>
