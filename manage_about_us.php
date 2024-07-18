<?php
session_start();
include 'connect.php';

// Handle Add/Edit form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $topic = $_POST['topic'];
    $content = $_POST['content'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = 'images/about/' . basename($_FILES['image']['name']);
        if (!is_dir('images/about/')) {
            mkdir('images/about/', 0777, true);
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            // Image upload success
        } else {
            // Handle upload error
            $_SESSION['message'] = "มีข้อผิดพลาดในการอัปโหลดรูปภาพ.";
            header('Location: manage_about_us.php');
            exit();
        }
    } else {
        $image_path = $_POST['image_path'];
    }

    if ($id > 0) {
        // Update existing record
        $sql = "UPDATE about_us SET topic='$topic', content='$content', image_path='$image_path' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "ข้อมูลได้รับการปรับปรุงแล้ว";
        } else {
            $_SESSION['message'] = "มีข้อผิดพลาด: " . $conn->error;
        }
    } else {
        // Insert new record
        $sql = "INSERT INTO about_us (topic, content, image_path) VALUES ('$topic', '$content', '$image_path')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "ข้อมูลได้รับการเพิ่มแล้ว";
        } else {
            $_SESSION['message'] = "มีข้อผิดพลาด: " . $conn->error;
        }
    }
}

// Handle Delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM about_us WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "ข้อมูลได้รับการลบแล้ว";
    } else {
        $_SESSION['message'] = "มีข้อผิดพลาด: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage - LOVEPOTION</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <?php include 'nev.php'; ?>

        <div class="container my-5">
            <h1 class="mb-4">จัดการ About Us</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
            ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addEditModal" onclick="resetForm()">
                เพิ่มข้อมูล
            </button>

            <!-- List of About Us -->
            <div class="card">
                <div class="card-header">
                    <h2 class="h5">ข้อมูลที่มีอยู่</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>หัวข้อ</th>
                                <th>เนื้อหา</th>
                                <th>ที่อยู่ของรูปภาพ</th>
                                <th>การกระทำ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM about_us";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['topic'] . '</td>';
                                    echo '<td>' . $row['content'] . '</td>';
                                    echo '<td>';
                                    if (!empty($row['image_path'])) {
                                        echo '<img src="' . $row['image_path'] . '" alt="Image" style="max-width: 100px; max-height: 100px;">';
                                    }
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#addEditModal" onclick="editRecord(' . $row['id'] . ', \'' . $row['topic'] . '\', \'' . $row['content'] . '\', \'' . $row['image_path'] . '\')">แก้ไข</button>';
                                    echo ' <button class="btn btn-sm btn-danger" onclick="confirmDelete(' . $row['id'] . ')">ลบ</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">ไม่มีข้อมูล</td></tr>';
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditModalLabel">เพิ่ม/แก้ไข ข้อมูล</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addEditForm" action="manage_about_us.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label for="topic" class="form-label">หัวข้อ</label>
                                <input type="text" class="form-control" id="topic" name="topic" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">เนื้อหา</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">เลือกรูปภาพ</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <input type="hidden" id="image_path" name="image_path">
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

        <!-- Bootstrap core JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Script -->
        <script>
            function editRecord(id, topic, content, image_path) {
                document.getElementById('id').value = id;
                document.getElementById('topic').value = topic;
                document.getElementById('content').value = content;
                document.getElementById('image_path').value = image_path;
                document.getElementById('addEditModalLabel').textContent = 'แก้ไข ข้อมูล';
            }

            function resetForm() {
                document.getElementById('id').value = '';
                document.getElementById('topic').value = '';
                document.getElementById('content').value = '';
                document.getElementById('image_path').value = '';
                document.getElementById('image').value = '';
                document.getElementById('addEditModalLabel').textContent = 'เพิ่ม ข้อมูล';
            }

            function confirmDelete(id) {
                Swal.fire({
                    title: 'คุณแน่ใจที่จะลบข้อมูลนี้?',
                    text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'manage_about_us.php?delete=' + id;
                    }
                })
            }
        </script>
    </main>
</body>
</html>
