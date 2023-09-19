<?php
    session_start();
    require "connection.php";
    $errors = array();
    $success = array();

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$row) {
            echo "<h3>Product does not exist</h3>";
            echo "<a href='../frontend/index.php'>Back to List</a>";
            die();
        } else {
// Lấy giá trị đã lưu trong session
            $errors = $_SESSION['errors'] ?? [];
            $product_name = $_SESSION['product_name'] ?? '';
            $category_id = $_SESSION['category_id'] ?? '';
            $product_description = $_SESSION['product_description'] ?? '';

// Xóa session để không hiển thị thông báo lỗi nữa
            unset($_SESSION['errors']);
            unset($_SESSION['product_name']);
            unset($_SESSION['category_id']);
            unset($_SESSION['product_description']);
        }
    }

    if (isset($_POST['editproduct'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $product_description = $_POST['product_description'];
        $old_image = $_POST['old_image'];

        if (!is_numeric($price) || $price <= 0) {
            $errors['price'] = "Price must be a positive number";
        }

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
            $sql = "UPDATE products
            SET product_name = '$product_name',
                price = '$price',
                product_image = '$new_image',
                product_description = '$product_description',
                category_id = '$category_id'
            WHERE product_id = $product_id";
            if ($conn->query($sql) === TRUE) {
                // Đóng kết nối nếu cần
                // mysqli_close($conn);
                // Chuyển hướng đến trang danh sách sản phẩm nếu cập nhật thành công
                header('location: ../frontend/index.php?success=1');
                exit();
            } else {
                $errors['error'] = "Error: " . mysqli_error($conn);
            }
        }
// Nếu có lỗi xảy ra, giữ lại các giá trị đã nhập và hiển thị các thông báo lỗi
        if (count($errors) > 0) {
            header("location: ../frontend/edit-product.php?product_id=$product_id");
            $_SESSION['errors'] = $errors;
            $_SESSION['price'] = $price;
            $_SESSION['category_id'] = $category_id;
            $_SESSION['product_description'] = $product_description;
        }
    }