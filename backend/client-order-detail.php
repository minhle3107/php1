<?php
    require_once "connection.php";
    function orderDetail()
    {
        global $conn;
// Lấy mã đơn hàng từ đường dẫn URL hoặc biểu mẫu
        $purchase_id = $_GET['purchase_id'];

// Truy vấn thông tin đơn hàng từ bảng 'purchase' dựa trên 'purchase_id'
        $sql = "SELECT * FROM purchase_info WHERE purchase_id = '$purchase_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Hiển thị thông tin chi tiết đơn hàng
            echo "<h2>Order Details</h2>";
            echo "<p>Purchase ID: " . $row['purchase_id'] . "</p>";
            echo "<p>Order Date: " . $row['order_date'] . "</p>";
            echo "<p>Full Name: " . $row['customer_firstname'] . " " . $row['customer_lastname'] . "</p>";
            echo "<p>Phone: " . $row['customer_phone'] . "</p>";
            echo "<p>Shipping Address: " . $row['shipping_address'] . "</p>";
            echo "<h3>Product information</h3>";

            // Truy vấn thông tin sản phẩm từ bảng 'order_items' dựa trên 'purchase_id'
//            $items_sql = "SELECT oi.product_id, p.product_name, oi.quantity
//                  FROM order_items oi
//                  INNER JOIN purchase_info p ON oi.product_id = p.product_id
//                  WHERE oi.purchase_id = '$purchase_id'";

            $items_sql = "SELECT oi.product_id, p.product_name, oi.quantity
              FROM order_items oi
              INNER JOIN products p ON oi.product_id = p.product_id
              WHERE oi.purchase_id = '$purchase_id'";

            $items_result = $conn->query($items_sql);

            if ($items_result->num_rows > 0) {
                echo "<table>";
//                echo "<tr><th>Product ID</th><th>Product Name</th><th>Quantity</th></tr>";
                echo "<tr class='table-bordered'><th class='table-striped'>Product ID</th><th class='table-striped'>Product Name</th><th class='table-striped'>Quantity</th></tr>";

                while ($item_row = $items_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $item_row['product_id'] . "</td>";
                    echo "<td>" . $item_row['product_name'] . "</td>";
                    echo "<td>" . $item_row['quantity'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "Không có sản phẩm nào trong đơn hàng này.";
            }
        } else {
            echo "Không tìm thấy đơn hàng.";
        }

// Đóng kết nối cơ sở dữ liệu
//        $conn->close();
    }