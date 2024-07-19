<?php
ob_start(); // เริ่ม output buffering
session_start(); // เริ่ม session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manage - LOVEPOTION</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <style>
        .table-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }

        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

    <main class="flex-shrink-0">
        <?php include 'nev.php'; ?>
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-3">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action manage-section active"
                                id="manage-products">
                                <i class="bi bi-cart-fill"></i> จัดการสินค้า
                            </a>
                            <a href="#" class="list-group-item list-group-item-action manage-section"
                                id="manage-promotions">
                                <i class="bi bi-gift-fill"></i> จัดการโปรโมชั่น
                            </a>
                            <a href="#" class="list-group-item list-group-item-action manage-section" id="manage-faq">
                                <i class="bi bi-question-circle-fill"></i> จัดการ FAQ
                            </a>
                            <a href="manage_about_us.php" class="list-group-item list-group-item-action manage-section">
                                <i class="bi bi-cart-fill"></i> จัดการ About us
                            </a>


                            <div class="py-2"></div>
                            <a href="#"
                                class="list-group-item text-light bg-success list-group-item-action manage-section"
                                id="add-product" style="display: none;">
                                <i class="bi bi-plus-circle"></i> เพิ่มสินค้าใหม่
                            </a>
                            <a href="#"
                                class="list-group-item text-light bg-success list-group-item-action manage-section"
                                id="add-promotion" style="display: none;">
                                <i class="bi bi-plus-circle"></i> เพิ่มโปรโมชั่นใหม่
                            </a>

                            <a href="#"
                                class="list-group-item text-light bg-success list-group-item-action manage-section"
                                id="add-faq" style="display: none;">
                                <i class="bi bi-plus-circle"></i> เพิ่ม FAQ ใหม่
                            </a>

                        </div>
                    </div>

                    <div class="col-lg-9">
                        <!-- Alert Message -->
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<script>';
                            echo 'Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: "' . htmlspecialchars($_SESSION['message']) . '"
                            });';
                            echo '</script>';
                            unset($_SESSION['message']);
                        }
                        ?>


                        <!-- product Management Section -->
                        <div id="product-management" class="management-section" style="display: block;">
                            <h2>จัดการสินค้า</h2>
                            <div id="products-list" class="mt-3"></div>
                            <?php
                            include 'connect.php'; // เชื่อมต่อฐานข้อมูล
                            
                            $sql = "SELECT * FROM products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<div class="table-responsive table-wrapper">';
                                echo '<table class="table table-striped">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>ชื่อสินค้า</th>';
                                echo '<th>รายละเอียด</th>';
                                echo '<th>ราคา</th>';
                                echo '<th>ประเภท</th>';
                                echo '<th>ภาพสินค้า</th>';
                                echo '<th>การจัดการ</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';

                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row["name"] . '</td>';
                                    echo '<td class="description">' . $row["description"] . '</td>';
                                    echo '<td>' . $row["price"] . '</td>';
                                    echo '<td>' . $row["category"] . '</td>';

                                    // Gather all image URLs into an array
                                    $image_urls = [];
                                    if (!empty($row["image_url"])) {
                                        $image_urls[] = $row["image_url"];
                                    }
                                    if (!empty($row["image_url_2"])) {
                                        $image_urls[] = $row["image_url_2"];
                                    }
                                    if (!empty($row["image_url_3"])) {
                                        $image_urls[] = $row["image_url_3"];
                                    }

                                    // Display each image in a table cell
                                    echo '<td>';
                                    foreach ($image_urls as $image_url) {
                                        echo '<img src="' . $image_url . '" class="img-thumbnail" style="margin-bottom: 5px;">';
                                    }
                                    echo '</td>';

                                    echo '<td>';
                                    echo '<button class="btn btn-warning btn-sm edit-product" data-id="' . $row["product_id"] . '" data-name="' . $row["name"] . '" data-description="' . $row["description"] . '" data-price="' . $row["price"] . '" data-category="' . $row["category"] . '">แก้ไข</button> ';
                                    echo '<button class="btn btn-danger btn-sm delete-product" data-id="' . $row["product_id"] . '">ลบ</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            } else {
                                echo '<p class="text-muted">ยังไม่มีสินค้าในฐานข้อมูล</p>';
                            }

                            $conn->close();
                            ?>
                        </div>

                        <!-- Promotions Management -->
                        <div id="promotion-management" class="management-section" style="display: none;">
                            <h2>จัดการโปรโมชั่น</h2>
                            <div id="promotions-list" class="mt-3">
                                <?php
                                include 'connect.php'; // เชื่อมต่อฐานข้อมูล
                                
                                $sql = "SELECT * FROM promotions";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<div class="table-responsive table-wrapper">';
                                    echo '<table class="table table-striped">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>ชื่อโปรโมชั่น</th>';
                                    echo '<th>รายละเอียด</th>';
                                    echo '<th>ส่วนลด</th>';
                                    echo '<th>ภาพโปรโมชั่น</th>';
                                    echo '<th class="col-2">การจัดการ</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row["promotion_name"] . '</td>';
                                        echo '<td>' . $row["description"] . '</td>';
                                        echo '<td>' . $row["discount_percentage"] . '</td>';
                                        echo '<td><img src="' . $row["image_url"] . '" class="img-thumbnail" width="100"></td>';
                                        echo '<td>';
                                        echo '<button class="btn btn-warning btn-sm edit-promotion" data-id="' . $row["promotion_id"] . '" data-name="' . $row["promotion_name"] . '" data-description="' . $row["description"] . '" data-discount="' . $row["discount_percentage"] . '">แก้ไข</button> ';
                                        echo '<button class="btn btn-danger btn-sm delete-promotion" data-id="' . $row["promotion_id"] . '">ลบ</button>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }

                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                } else {
                                    echo '<p class="text-muted">ยังไม่มีโปรโมชั่นในฐานข้อมูล</p>';
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>

                        <!-- FAQ Management Section -->
                        <div id="faq-management" class="management-section" style="display: none;">
                            <h2>จัดการ FAQ</h2>
                            <div id="faq-list" class="mt-3">
                                <?php
                                include 'connect.php'; // เชื่อมต่อฐานข้อมูล
                                
                                $sql = "SELECT * FROM faqs";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<div class="table-responsive table-wrapper">';
                                    echo '<table class="table table-striped">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>คำถาม</th>';
                                    echo '<th>คำตอบ</th>';
                                    echo '<th class="col-2">การจัดการ</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row["question"] . '</td>';
                                        echo '<td>' . $row["answer"] . '</td>';
                                        echo '<td>';
                                        echo '<button class="btn btn-warning btn-sm edit-faq" data-id="' . $row["faq_id"] . '" data-question="' . $row["question"] . '" data-answer="' . $row["answer"] . '">แก้ไข</button> ';
                                        echo '<button class="btn btn-danger btn-sm delete-faq" data-id="' . $row["faq_id"] . '">ลบ</button>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }

                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                } else {
                                    echo '<p class="text-muted">ไม่มี FAQ ในฐานข้อมูล</p>';
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>


        </section>
    </main>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">เพิ่มสินค้าใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" id="productName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">รายละเอียดสินค้า</label>
                            <textarea class="form-control" id="productDescription" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">ราคา</label>
                            <input type="number" class="form-control" id="productPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">ประเภทสินค้า</label>
                            <input type="text" class="form-control" id="productCategory" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="productImage1" class="form-label">ภาพสินค้า 1</label>
                            <input class="form-control" type="file" id="productImage1" name="image[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="productImage2" class="form-label">ภาพสินค้า 2</label>
                            <input class="form-control" type="file" id="productImage2" name="image[]">
                        </div>
                        <div class="mb-3">
                            <label for="productImage3" class="form-label">ภาพสินค้า 3</label>
                            <input class="form-control" type="file" id="productImage3" name="image[]">
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">แก้ไขสินค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" action="edit_product.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="editProductId" name="product_id">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" id="editProductName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">รายละเอียดสินค้า</label>
                            <textarea class="form-control" id="editProductDescription" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">ราคา</label>
                            <input type="number" class="form-control" id="editProductPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label">ประเภทสินค้า</label>
                            <input type="text" class="form-control" id="editProductCategory" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage1" class="form-label">ภาพสินค้า 1</label>
                            <input class="form-control" type="file" id="editProductImage1" name="image[]">
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage2" class="form-label">ภาพสินค้า 2</label>
                            <input class="form-control" type="file" id="editProductImage2" name="image[]">
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage3" class="form-label">ภาพสินค้า 3</label>
                            <input class="form-control" type="file" id="editProductImage3" name="image[]">
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Add Promotion Modal -->
    <div class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="addPromotionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPromotionModalLabel">เพิ่มโปรโมชั่นใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_promotion.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="promotionName" class="form-label">ชื่อโปรโมชั่น</label>
                            <input type="text" class="form-control" id="promotionName" name="promotion_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="promotionDescription" class="form-label">รายละเอียดโปรโมชั่น</label>
                            <textarea class="form-control" id="promotionDescription" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="promotionDiscount" class="form-label">ส่วนลด (%)</label>
                            <input type="number" class="form-control" id="promotionDiscount" name="discount_percentage"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="promotionImage" class="form-label">ภาพโปรโมชั่น</label>
                            <input class="form-control" type="file" id="promotionImage" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Promotion Modal -->
    <div class="modal fade" id="editPromotionModal" tabindex="-1" aria-labelledby="editPromotionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPromotionModalLabel">แก้ไขโปรโมชั่น</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPromotionForm" action="edit_promotion.php" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" id="editPromotionId" name="promotion_id">
                        <div class="mb-3">
                            <label for="editPromotionName" class="form-label">ชื่อโปรโมชั่น</label>
                            <input type="text" class="form-control" id="editPromotionName" name="promotion_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editPromotionDescription" class="form-label">รายละเอียดโปรโมชั่น</label>
                            <textarea class="form-control" id="editPromotionDescription" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPromotionDiscount" class="form-label">ส่วนลด (%)</label>
                            <input type="number" class="form-control" id="editPromotionDiscount"
                                name="discount_percentage" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPromotionImage" class="form-label">ภาพโปรโมชั่น</label>
                            <input class="form-control" type="file" id="editPromotionImage" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFaqModalLabel">เพิ่ม FAQ ใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_faq.php" method="post">
                        <div class="mb-3">
                            <label for="faqQuestion" class="form-label">คำถาม</label>
                            <input type="text" class="form-control" id="faqQuestion" name="question" required>
                        </div>
                        <div class="mb-3">
                            <label for="faqAnswer" class="form-label">คำตอบ</label>
                            <textarea class="form-control" id="faqAnswer" name="answer" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit FAQ Modal -->
    <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFaqModalLabel">แก้ไขคำถามและคำตอบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="edit_faq.php" method="POST">
                        <input type="hidden" id="editFaqId" name="editFaqId" value="">
                        <div class="mb-3">
                            <label for="editFaqQuestion" class="form-label">คำถาม</label>
                            <input type="text" class="form-control" id="editFaqQuestion" name="editFaqQuestion"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editFaqAnswer" class="form-label">คำตอบ</label>
                            <textarea class="form-control" id="editFaqAnswer" name="editFaqAnswer" rows="3"
                                required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer-->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Show add product button
            document.getElementById("add-product").style.display = "block";

            // Toggle between sections
            document.querySelectorAll(".manage-section").forEach(function (el) {
                el.addEventListener("click", function () {
                    document.querySelectorAll(".manage-section").forEach(function (section) {
                        section.classList.remove("active");
                    });
                    el.classList.add("active");

                    const sectionId = el.id;
                    document.querySelectorAll(".management-section").forEach(function (section) {
                        section.style.display = "none";
                    });
                    if (sectionId === "manage-products") {
                        document.getElementById("product-management").style.display = "block";
                        document.getElementById("add-product").style.display = "block";
                        document.getElementById("add-promotion").style.display = "none";
                        document.getElementById("add-faq").style.display = "none";
                    }
                    if (sectionId === "manage-promotions") {
                        document.getElementById("promotion-management").style.display = "block";
                        document.getElementById("add-product").style.display = "none";
                        document.getElementById("add-promotion").style.display = "block";
                        document.getElementById("add-faq").style.display = "none";
                    }
                    if (sectionId === "manage-faq") {
                        document.getElementById("faq-management").style.display = "block";
                        document.getElementById("add-product").style.display = "none";
                        document.getElementById("add-promotion").style.display = "none";
                        document.getElementById("add-faq").style.display = "block";
                    }
                });
            });

            // Show add product modal
            document.getElementById("add-product").addEventListener("click", function () {
                var myModal = new bootstrap.Modal(document.getElementById("addProductModal"));
                myModal.show();
            });

            // Show add promotion modal
            document.getElementById("add-promotion").addEventListener("click", function () {
                var myModal = new bootstrap.Modal(document.getElementById("addPromotionModal"));
                myModal.show();
            });

            // Show add FAQ modal
            document.getElementById("add-faq").addEventListener("click", function () {
                var myModal = new bootstrap.Modal(document.getElementById("addFaqModal"));
                myModal.show();
            });

            // Show edit product modal
            document.querySelectorAll(".edit-product").forEach(function (button) {
                button.addEventListener("click", function () {
                    const productId = button.getAttribute("data-id");
                    const productName = button.getAttribute("data-name");
                    const productDescription = button.getAttribute("data-description");
                    const productPrice = button.getAttribute("data-price");
                    const productCategory = button.getAttribute("data-category");

                    document.getElementById("editProductId").value = productId;
                    document.getElementById("editProductName").value = productName;
                    document.getElementById("editProductDescription").value = productDescription;
                    document.getElementById("editProductPrice").value = productPrice;
                    document.getElementById("editProductCategory").value = productCategory;

                    var myModal = new bootstrap.Modal(document.getElementById("editProductModal"));
                    myModal.show();
                });
            });

            // Show edit promotion modal
            document.querySelectorAll(".edit-promotion").forEach(function (button) {
                button.addEventListener("click", function () {
                    const promotionId = button.getAttribute("data-id");
                    const promotionName = button.getAttribute("data-name");
                    const promotionDescription = button.getAttribute("data-description");
                    const promotionDiscount = button.getAttribute("data-discount");

                    document.getElementById("editPromotionId").value = promotionId;
                    document.getElementById("editPromotionName").value = promotionName;
                    document.getElementById("editPromotionDescription").value = promotionDescription;
                    document.getElementById("editPromotionDiscount").value = promotionDiscount;

                    var myModal = new bootstrap.Modal(document.getElementById("editPromotionModal"));
                    myModal.show();
                });
            });

            // Show edit FAQ modal
            document.querySelectorAll(".edit-faq").forEach(function (button) {
                button.addEventListener("click", function () {
                    const faqId = button.getAttribute("data-id");
                    const faqQuestion = button.getAttribute("data-question");
                    const faqAnswer = button.getAttribute("data-answer");

                    document.getElementById("editFaqId").value = faqId;
                    document.getElementById("editFaqQuestion").value = faqQuestion;
                    document.getElementById("editFaqAnswer").value = faqAnswer;

                    var myModal = new bootstrap.Modal(document.getElementById("editFaqModal"));
                    myModal.show();
                });
            });

            // Show delete product confirmation
            document.querySelectorAll(".delete-product").forEach(function (button) {
                button.addEventListener("click", function () {
                    const productId = button.getAttribute("data-id");
                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: "คุณจะไม่สามารถกู้คืนการลบนี้ได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ใช่, ลบเลย!',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'delete_product.php?product_id=' + productId;
                        }
                    });
                });
            });

            // Show delete FAQ confirmation
            document.querySelectorAll(".delete-faq").forEach(function (button) {
                button.addEventListener("click", function () {
                    const faqId = button.getAttribute("data-id");
                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: "คุณจะไม่สามารถกู้คืนการลบนี้ได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ใช่, ลบเลย!',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'delete_faq.php?faq_id=' + faqId;
                        }
                    });
                });
            });

            // Show delete promotion confirmation
            document.querySelectorAll(".delete-promotion").forEach(function (button) {
                button.addEventListener("click", function () {
                    const promotionId = button.getAttribute("data-id");
                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: "คุณจะไม่สามารถกู้คืนการลบนี้ได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ใช่, ลบเลย!',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'delete_promotion.php?promotion_id=' + promotionId;
                        }
                    });
                });
            });
        });

    </script>

</body>

</html>