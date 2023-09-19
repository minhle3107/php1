<?php
//    session_start();
    require "connection.php";
    $errors = array();
    $success = array();
    function getAll()
    {
        global $conn;
        // Truy vấn để lấy thông tin sản phẩm kết hợp với tên danh mục
        $query_all = "SELECT p.product_id, p.product_name, p.price, p.product_image, p.product_description, c.category_name
          FROM products p
          INNER JOIN categories c ON p.category_id = c.category_id";
        $results = $conn->query($query_all);
        $products = array();
        while ($row = $results->fetch_assoc()) {
            $products[] = $row;
        }
        // Close the database connection
        $conn->close();
        if (!empty($products)) {
            // Print the list of flights
            echo "<div class='col-lg-12 mb-4'>";
            echo "<div class='card shadow mb-4'>";
            echo "<div class='card-header py-3'>";
            echo "<h3 class='text-primary fw-bold m-0 text-center'>Product List</h3>";
            echo "</div>";
            echo "<div class='card-bod'>";
            echo "<table id='custom-table' class='table table-hover table-striped table-responsive'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='col-lg-1 text-center align-middle'>Product ID</th>";
            echo "<th class='col-lg-2 text-center align-middle'>Name</th>";
            echo "<th class='col-lg-1 text-center align-middle'>Price</th>";
            echo "<th class='col-lg-2 text-center align-middle'>Image</th>";
            echo "<th class='col-lg-3 text-center align-middle'>Description</th>";
            echo "<th class='col-lg-1 text-center align-middle'>Category Name</th>";
            echo "<th class='col-lg-2 text-center align-middle'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($products as $product) {
                echo "<tr class='justify-content-center align-middle'>";
                echo "<td class='text-center align-middle'>{$product['product_id']}</td>";
                echo "<td class='text-center align-middle'>{$product['product_name']}</td>";
                echo "<td class='text-center align-middle'>" . "$" . number_format($product['price']) . "</td>";
//                echo "<td>" . "$" . number_format($row['price']) . "</td>";
                echo "<td class='text-center align-middle'><img class='img-fluid' src='{$product['product_image']}' alt='{$product['product_image']}'></td>";
                echo "<td class='align-middle'>{$product['product_description']}</td>";
                echo "<td class='text-center align-middle'>{$product['category_name']}</td>";
                echo "<td>";
                echo "<div class='d-flex justify-content-center align-items-center'>";
                echo "<botton class='btn btn-warning m-lg-2'><a class='text-decoration-none text-center text-black fs-6' href='../frontend/edit-product.php?product_id={$product['product_id']}'><i class='fas fa-edit'></i></a></botton>";
                echo "<botton class='btn btn-danger m-lg-2'><a class='text-decoration-none text-center text-white fs-6' href='../frontend/delete-product.php?product_id={$product['product_id']}'><i class='fas fa-trash'></i></a></botton>";

                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<botton class='btn btn-outline-info m-lg-2'><a class='text-decoration-none' href='../frontend/add-product.php'>Add new product</a></botton>";
            echo "</div >";
            echo "</div >";
            echo "</div >";
        } else {
            echo "<h4>You don't have any product yet. Please add a new product!</h4>";
            echo "<div class='d-sm-flex justify-content-between align-items-center mb-4'>";
            echo "<botton class='btn btn-outline-info m-lg-2'><a class='text-decoration-none' href='../frontend/add-product.php'>Add new product</a></botton>";
            echo "</div>";
        }
//        }
        // Đóng kết nối
//        mysqli_close($conn);
    }