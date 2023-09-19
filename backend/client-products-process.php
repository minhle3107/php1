<?php
//    session_start();

    require_once "connection.php";
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
        }
    }

    function allProducts()
    {
        global $conn;

// Truy vấn để lấy tất cả sản phẩm
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

// Hiển thị sản phẩm
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $product_image = $row['product_image'];

                echo '<div class="col-12 col-md-6 col-lg-3 bg-white m-lg-1">';
                echo '<div class="clean-product-item border-2 d-flex flex-column align-items-stretch h-100">';
                echo '<div class="image"><a href="product-detail.php?product_id=' . $product_id . '"><img class="img-fluid d-block mx-auto h-100" src="../../' . $product_image . '"></a></div>';
                echo '<div class="product-name"><a href="product-detail.php?product_id=' . $product_id . '">' . $product_name . '</a></div>';
                echo '<div class="about">';
                echo '<div class="rating"><img src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img src="assets/img/star-half-empty.svg?h=52643cdf5581ce4b2bc133d700b32857"><img src="assets/img/star-empty.svg?h=67e3ef1204a154c2af6db4a9eaf69156"></div>';
                echo '<div class="price">';
                echo '<h3>$' . $price . '</h3>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Không có sản phẩm.";
        }

// Đóng kết nối
//        $conn->close();
    }
