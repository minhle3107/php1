<?php
require_once "connection.php";

    function productPayment()
    {
        global $conn;
        $user_id = $_SESSION['user_id'];

// Truy vấn SQL để lấy thông tin sản phẩm từ bảng carts theo user_id

        $sql = "SELECT carts.quantity, products.product_id, products.product_name, products.product_image, products.product_description, products.price
    FROM carts
    INNER JOIN products ON carts.product_id = products.product_id
    WHERE carts.user_id = '$user_id'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Duyệt qua từng bản ghi và hiển thị thông tin sản phẩm


            // Hiển thị thông tin sản phẩm trong câu trúc HTML

//            echo '<div class="row g-0">';
//            echo '<div class="col-md-12 col-lg-8">';
//            echo '<div class="items">';

            $total_price = 0;
            while ($row = $result->fetch_assoc()) {
                $quantity = $row["quantity"];
                $product_name = $row["product_name"];
//                $product_image = $row["product_image"];
//                $product_id = $row["product_id"];
                $product_description = $row["product_description"];
                $price = $row["price"];
                $total_price += $price;

                echo '<div class="item"><span class="price">$' . $price * $quantity . '</span>';
                echo '<p class="item-name">' . $product_name . '</p>';
                echo '<p class="item-description">' . $product_description . '</p>';
                echo '</div>';

            }
            echo '<div class="total"><span>Total</span><span class="price">$' . $total_price . '</span></div>';
            $_SESSION['total-price'] = $total_price;

        } else {
            echo "Không có sản phẩm trong giỏ hàng.";
        }

// Đóng kết nối
//        $conn->close();
    }