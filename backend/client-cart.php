<?php
    require_once "connection.php";

    function viewCart()
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

            echo '<div class="row g-0">';
            echo '<div class="col-md-12 col-lg-8">';
            echo '<div class="items">';

            $total_price = 0;
            while ($row = $result->fetch_assoc()) {
                $quantity = $row["quantity"];
                $product_name = $row["product_name"];
                $product_image = $row["product_image"];
                $product_id = $row["product_id"];
                $product_description = $row["product_description"];
                $price = $row["price"];
                $total_price += $price;

                echo '<div class="product">';
                echo '<div class="row justify-content-center align-items-center">';
                echo '<div class="col-md-3">';
                echo '<div class="product-image"><img class="img-fluid d-block mx-auto image" src="../../' . $product_image . '"></div>';
                echo '</div>';
                echo '<div class="col-md-4 product-info"><a class="product-name" href="product-detail.php?product_id=' . $product_id . '">' . $product_name . '</a>';
                echo '<div class="product-specs">';
                echo '<div><span></span><span class="value">' . $product_description . '</span></div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="col-6 col-md-2 quantity"><label class="form-label d-none d-md-block" for="quantity">Quantity</label><input name="quantity-input" type="number" id="number" class="form-control quantity-input" value="' . $quantity . '" min="1"></div>';
                echo '<div class="col-6 col-md-2 price"><span>$' . $price * $quantity . '</span></div>';
                echo '<div class="col-6 col-md-1 price"><span><button name="delete-product-cart" class="border-0 bg-transparent" onclick="confirmDelete(' . $product_id . ')"><i class="fas fa-trash"></i></button></span></div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
            echo '</div>';
            echo '<div class="col-md-12 col-lg-4">';
            echo '<div class="summary">';
            echo '<h3>Summary</h3>';
            echo '<h4><span class="text">Subtotal</span><span class="price">$' . $total_price . '</span></h4>';
            echo '<h4><span class="text">Discount</span><span class="price">$0</span></h4>';
            echo '<h4><span class="text">Shipping</span><span class="price">$0</span></h4>';
            echo '<h4><span class="text">Total</span><span class="price">$' . $total_price . '</span></h4><button class = "btn btn-primary btn-lg d-block w-100" type = "button" ><a class="text-white text-decoration-none" href="payment.php">Checkout</a></button > ';
            echo '</div > ';
            echo '</div > ';
            echo '</div > ';
        } else {
            echo "Không có sản phẩm trong giỏ hàng.";
        }

// Đóng kết nối
//        $conn->close();
    }
