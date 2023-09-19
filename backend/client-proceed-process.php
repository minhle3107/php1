<?php
require_once "connection.php";

if(isset($_POST['proceed'])) {


// Lấy thông tin người dùng từ biểu mẫu và các giá trị khác cần thiết
    $user_id = $_SESSION['user_id'];
    $customer_firstname = $_POST['first_name'];
    $customer_lastname = $_POST['last_name'];
    $customer_phone = $_POST['phone'];
    $shipping_address = $_POST['address'];
    $total_amount = $_SESSION['total-price'];
    $payment_method = $_POST['paymentmethod'];
    $order_date = date('Y-m-d'); // Ngày hiện tại

// Thêm thông tin người dùng vào bảng "purchase"
    $sql = "INSERT INTO purchase_info (user_id, customer_firstname, customer_lastname, customer_phone, shipping_address, total_amount, payment_method, order_date)
        VALUES ('$user_id', '$customer_firstname', '$customer_lastname', '$customer_phone', '$shipping_address', '$total_amount', '$payment_method', '$order_date')";

    if ($conn->query($sql) === TRUE) {
        // Lấy mã "purchase_id" của đơn hàng vừa tạo
        $purchase_id = $conn->insert_id;

        // Lấy thông tin sản phẩm từ bảng "carts" dựa trên "user_id"
        $select_items_sql = "SELECT product_id, quantity FROM carts WHERE user_id = '$user_id'";
        $result = $conn->query($select_items_sql);

        // Lưu thông tin sản phẩm vào bảng "order_items" dựa trên "purchase_id"
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            $insert_item_sql = "INSERT INTO order_items (purchase_id, product_id, quantity)
                            VALUES ('$purchase_id', '$product_id', '$quantity')";

            $conn->query($insert_item_sql);
        }

        // Xóa các hàng đã mua trong bảng "carts" dựa trên "user_id"
        $delete_cart_sql = "DELETE FROM carts WHERE user_id = '$user_id'";
        $conn->query($delete_cart_sql);

        // Thực hiện các công việc khác sau khi thanh toán thành công

        // Hiển thị thông báo thành công
//        echo "Đặt hàng thành công. Cám ơn bạn đã mua hàng!";
        header("location: order-detail.php?purchase_id=$purchase_id");
    } else {
        // Xử lý lỗi nếu cần
        echo "Đặt hàng thất bại. Vui lòng thử lại sau.";
    }

// Đóng kết nối cơ sở dữ liệu
    $conn->close();
}
