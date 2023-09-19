<?php
//    session_start();
    require "connection.php";

    $errors = array();
    $success = array();

    if (isset($_POST['addcategory'])) {
        $category_name = trim($_POST['category_name']);
        $category_description = trim($_POST['category_description']);

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


        // Validate image
        if (isset($_FILES['category_image']) && $_FILES['category_image']['name']) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["category_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $errors['type-img'] = "Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed.";
            } elseif ($_FILES["category_image"]["size"] > 500000) {
                $errors['size-img'] = "Sorry, your file is too large.";
            } elseif (!move_uploaded_file($_FILES["category_image"]["tmp_name"], $target_file)) {
                $errors['failed'] = "Sorry, there was an error uploading your file.";
            } else {
                $category_image = $target_file;
            }
        }

        if (count($errors) === 0) {
            $sql = "INSERT INTO categories (category_name, category_description, category_image) VALUES ('$category_name', '$category_description', '$category_image')";
            if (mysqli_query($conn, $sql)) {
                $success['success'] = "Category added successfully.";
//                header('location: add-flight.php');
                // Đóng kết nối
//                mysqli_close($conn);
            } else {
                $errors['error'] = "Error: " . mysqli_error($conn);
            }
        }

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['category_name'] = $category_name;
            $_SESSION['category_description'] = $category_description;
        }
    }