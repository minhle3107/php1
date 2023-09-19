<?php
//    session_start();
    require "connection.php";
    $errors = array();
    $success = array();
//    if (isset($_GET['category_id'])) {
//        $category_id = $_GET['category_id'];
//        $sql = "SELECT * FROM categories WHERE category_id = ?";
//        $stmt = mysqli_prepare($conn, $sql);
//        mysqli_stmt_bind_param($stmt, "i", $category_id);
//        mysqli_stmt_execute($stmt);
//        $result = mysqli_stmt_get_result($stmt);
//        $row = mysqli_fetch_assoc($result);
//        mysqli_stmt_close($stmt);
//
//        if (!$row) {
//            echo "<h3>Category does not exist</h3>";
////            echo "<a href='../frontend/category-list.php'>Back to List</a>";
//            die();
//        }
//    }

    function getDetail()
    {
        global $conn;
        // Truy vấn để lấy tất cả sản phẩm
        $category_id = $_GET['category_id'];
        $sql_all_product = "SELECT * FROM products WHERE category_id = '$category_id'";
        $result_products = $conn->query($sql_all_product);
    if(!empty($category_id)){
        // Hiển thị sản phẩm
        if ($result_products->num_rows > 0) {
            while ($row = $result_products->fetch_assoc()) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $product_image = $row['product_image'];

                echo '<div class="col-12 col-md-6 col-lg-3 bg-white m-lg-1">';
                echo '<div class="clean-product-item border-2">';
                echo '<div class="image"><a href="product-detail.php?product_id=' . $product_id . '"><img class="img-fluid d-block mx-auto" src="../../' . $product_image . '"></a></div>';
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
            echo "<h4>You don't have any category yet. Please add a new category!</h4>";
            echo "<div class='d-sm-flex justify-content-between align-items-center mb-4'>";
            echo "<botton class='btn btn-outline-info m-lg-2'><a class='text-decoration-none' href='../frontend/add-category.php'>Add new category</a></botton>";
            echo "</div>";
        }
    }

    }