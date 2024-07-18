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
        <div id="navbarContainer"></div>
        <!-- ส่วน Script ที่ใช้โหลด Navigation Bar -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(function() {
                $('#navbarContainer').load('nev.php');
            });
        </script>

        <!-- FAQ Section -->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Frequently Asked Questions</h1>
                    <p class="lead fw-normal text-muted mb-0">How can we help you?</p>
                </div>

                <div class="row gx-5">
                    <div class="col-xl-8">
                        <!-- FAQ Accordion -->
                        <div class="accordion mb-5" id="faqAccordion">
                            <h2 class="fw-bolder mb-3">คำถามที่พบบ่อย</h2>

                            <?php
                            include 'connect.php';

                            $sql = "SELECT * FROM faqs ORDER BY faq_id ASC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="accordion-item">';
                                    echo '<h3 class="accordion-header" id="heading' . $row['faq_id'] . '">';
                                    echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $row['faq_id'] . '" aria-expanded="false" aria-controls="collapse' . $row['faq_id'] . '">';
                                    echo $row['question'];
                                    echo '</button>';
                                    echo '</h3>';
                                    echo '<div id="collapse' . $row['faq_id'] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $row['faq_id'] . '" data-bs-parent="#faqAccordion">';
                                    echo '<div class="accordion-body">';
                                    echo $row['answer'];
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p>ไม่พบคำถามในฐานข้อมูล</p>';
                            }

                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mt-xl-5">
                            <div class="card-body p-4 py-lg-5">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder">Have more questions?</div>
                                        <p class="text-muted mb-4">
                                            Contact us at
                                            <br />
                                            <a href="#!">support@domain.com</a>
                                        </p>
                                        <div class="h6 fw-bolder">Follow us</div>
                                        <a class="fs-5 px-2 link-dark" href="https://www.instagram.com/tp23_shop?igsh=MXBobXFwNnpobHM0cA%3D%3D&utm_source=qr" target="_blank"><i class="bi-instagram"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="https://www.tiktok.com/@tp23_shop?_t=8o0ZBqDdza3&_r=1" target="_blank"><i class="bi bi-file-play"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
