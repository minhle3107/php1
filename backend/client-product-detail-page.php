<?php
    require_once "connection.php";
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result || mysqli_num_rows($result) == 0) {
            echo "<h3>Product does not exist</h3>";
            echo "<a href='../frontend/client/index.php'>Back to Home</a>";
            die();
        } else {
            $row = mysqli_fetch_assoc($result);
            $product_name = $row['product_name'];
            $price = $row['price'];
            $product_image = $row['product_image'];
            $product_description = $row['product_description'];
        }

//        mysqli_stmt_close($stmt);
    }
?>