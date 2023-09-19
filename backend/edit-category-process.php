<?php
    session_start();
    require "connection.php";
    $errors = array();
    $success = array();

    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM categories WHERE category_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $category_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$row) {
            echo "<h3>Category does not exist</h3>";
            echo "<a href='../frontend/category-list.php'>Back to List</a>";
            die();
        } else {
// Lấy giá trị đã lưu trong session
            $errors = $_SESSION['errors'] ?? [];
            $category_id = $_SESSION['category_id'] ?? '';
            $category_name = $_SESSION['category_name'] ?? '';
            $category_description = $_SESSION['category_description'] ?? '';

// Xóa session để không hiển thị thông báo lỗi nữa
            unset($_SESSION['errors']);
            unset($_SESSION['category_id']);
            unset($_SESSION['category_name']);
            unset($_SESSION['category_description']);
        }
    }

    if (isset($_POST['editcategory'])) {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category_description = $_POST['category_description'];
        $old_image = $_POST['old_image'];


// Xử lý tệp tin hình ảnh
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . uniqid() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            $new_image = $target_file;
// Xóa tệp ảnh cũ nếu người dùng tải lên một tệp ảnh mới
            if ($new_image != $old_image) {
                unlink($old_image);
            }
        } else {
// Giữ nguyên đường dẫn ảnh cũ nếu người dùng không tải lên tệp ảnh mới
            $new_image = $old_image;
        }

// Sử dụng Prepared Statements để cập nhật thông tin chuyến bay vào cơ sở dữ liệu
        if (count($errors) === 0) {
            // Câu lệnh SQL UPDATE
            $sql = "UPDATE categories
            SET category_name = '$category_name',
                category_description = '$category_description',
                category_image = '$new_image'
            WHERE category_id = $category_id";
            if ($conn->query($sql) === TRUE) {
                // Đóng kết nối nếu cần
                // mysqli_close($conn);
                // Chuyển hướng đến trang danh sách sản phẩm nếu cập nhật thành công
                header('location: ../frontend/category-list.php?success=1');
                exit();
            } else {
                $errors['error'] = "Error: " . mysqli_error($conn);
            }
        }
// Nếu có lỗi xảy ra, giữ lại các giá trị đã nhập và hiển thị các thông báo lỗi
        if (count($errors) > 0) {
            header("location: ../frontend/edit-category.php?product_id=$category_id");
            $_SESSION['errors'] = $errors;
            $_SESSION['category_name'] = $category_name;
            $_SESSION['category_description'] = $category_description;
        }
    }