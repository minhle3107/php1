<?php
    session_start();

    require_once "connection.php";
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        if ($email != false && $password != false) {
            $sql_checkacc = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql_checkacc);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result_checkacc = $stmt->get_result();

            if ($result_checkacc) {
                $fetch_info = $result_checkacc->fetch_assoc();
                $user_id = $fetch_info['user_id'];

                // Lưu user_id vào session
//                $_SESSION['user_id'] = $user_id;
                $status = $fetch_info['status'];
                $code = $fetch_info['code'];
                if ($status == "verified") {
                    if ($code != 0) {
                        header('Location: ../reset-code.php');
                        exit();
                    }
                } else {
                    header('Location: ../user-otp.php');
                    exit();
                }
            }
        } else {
            header('Location: ../login.php');
            exit();
        }

        if (isset($_POST['addtocart'])) {
            // Lấy thông tin từ form
            $product_id = $_POST["product_id"];
            $quantity = $_POST["quantity"];
            $user_id = $_SESSION['user_id'];
            var_dump($product_id);
            var_dump($quantity);
            var_dump($user_id);
            // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
            $check_sql = "SELECT * FROM carts WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng
                $update_sql = "UPDATE carts SET quantity = quantity + '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";

                if ($conn->query($update_sql) === TRUE) {
//                    echo "Số lượng sản phẩm đã được cập nhật trong giỏ hàng.";
                    header('location: ../client/cart.php');

                } else {
//                    echo "Lỗi: " . $update_sql . "<br>" . $conn->error;
                    header("location: ../frontend/client/product-detail.php?product_id='$product_id'");

                }
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
                $insert_sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";

                if ($conn->query($insert_sql) === TRUE) {
                    header('location: ../client/cart.php');

                } else {
//                    echo "Lỗi: " . $insert_sql . "<br>" . $conn->error;
                    header("location: ../frontend/client/product-detail.php?product_id='$product_id'");

                }
            }

        }