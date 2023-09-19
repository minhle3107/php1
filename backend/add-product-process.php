<?php
//    session_start();
    require "connection.php";

    $errors = array();
    $success = array();

    if (isset($_POST['addproduct'])) {
        $product_name = trim($_POST['product_name']);
        $price = trim($_POST['price']);
        $product_description = trim($_POST['product_description']);
        $category_id = trim($_POST['category_id']);

//        $errors = $_SESSION['errors'] ?? [];
//        $flight_number = $_SESSION['flight_number'] ?? '';
//        $airline_id = $_SESSION['airline_id'] ?? '';
//        $description = $_SESSION['description'] ?? '';
//
//// Xóa session để không hiển thị thông báo lỗi nữa
//        unset($_SESSION['errors']);
//        unset($_SESSION['flight_number']);
//        unset($_SESSION['airline_id']);
//        unset($_SESSION['description']);

        // Validate total_passengers
        if (!is_numeric($price) || $price <= 0) {
            $errors['price'] = "Price must be a positive number";
        }

        // Validate image
        if (isset($_FILES['product_image']) && $_FILES['product_image']['name']) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $errors['type-img'] = "Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed.";
            } elseif ($_FILES["product_image"]["size"] > 500000) {
                $errors['size-img'] = "Sorry, your file is too large.";
            } elseif (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $errors['failed'] = "Sorry, there was an error uploading your file.";
            } else {
                $product_image = $target_file;
            }
        }

        if (count($errors) === 0) {
            $sql = "INSERT INTO products (product_name, price, product_image, product_description, category_id) VALUES ('$product_name', '$price', '$product_image', '$product_description', '$category_id')";
            if (mysqli_query($conn, $sql)) {
                $success['success'] = "Product added successfully.";
//                header('location: add-flight.php');
                // Đóng kết nối
//                mysqli_close($conn);
            } else {
                $errors['error'] = "Error: " . mysqli_error($conn);
            }
        }

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['product_name'] = $product_name;
            $_SESSION['product_description'] = $product_description;
            $_SESSION['category_id'] = $category_id;
        }
    }