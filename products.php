<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้า</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="my-4">รายการสินค้า</h1>
        <div class="row">
            <?php
            // Connect to database and fetch products
            include 'connect.php';

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="product">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" class="img-fluid mb-2">';
                    echo '<h4>' . $row['name'] . '</h4>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p><strong>ราคา: ' . number_format($row['price']) . ' บาท</strong></p>';
                    echo '<a href="product_details.php?id=' . $row['id'] . '" class="btn btn-primary">ดูรายละเอียด</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>ไม่มีสินค้าในระบบ</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
