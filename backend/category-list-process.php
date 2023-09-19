<?php
    session_start();
    require "connection.php";
    $errors = array();
    $success = array();
    function getAllCategories()
    {
        global $conn;
        // Truy vấn để lấy thông tin sản phẩm kết hợp với tên danh mục
        $query_all_category = "SELECT * FROM categories";
        $results = $conn->query($query_all_category);
        $categories = array();
        while ($row = $results->fetch_assoc()) {
            $categories[] = $row;
        }
        // Close the database connection
        $conn->close();
        if (!empty($categories)) {
            // Print the list of flights
            echo "<div class='col-lg-12 mb-4'>";
            echo "<div class='card shadow mb-4'>";
            echo "<div class='card-header py-3'>";
            echo "<h3 class='text-primary fw-bold m-0 text-center'>Category List</h3>";
            echo "</div>";
            echo "<div class='card-bod'>";
            echo "<table id='custom-table' class='table table-hover table-striped table-responsive'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='col-lg-2 text-center align-middle'>Category ID</th>";
            echo "<th class='col-lg-2 text-center align-middle'>Category Name</th>";
            echo "<th class='col-lg-3 text-center align-middle'>Image</th>";
            echo "<th class='col-lg-3 text-center align-middle'>Description</th>";
            echo "<th class='col-lg-2 text-center align-middle'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($categories as $category) {
                echo "<tr class='justify-content-center align-middle'>";
                echo "<td class='text-center align-middle'>{$category['category_id']}</td>";
                echo "<td class='text-center align-middle'><button class='btn btn-outline-info m-lg-2'><a class='text-decoration-none' href='../frontend/getallproduct-category.php?category_id={$category['category_id']}'>{$category['category_name']}</a></button></td>";
                echo "<td class='text-center align-middle'><img class='img-fluid' src='{$category['category_image']}' alt='{$category['category_image']}'></td>";
                echo "<td class='align-middle'>{$category['category_description']}</td>";
                echo "<td>";
                echo "<div class='d-flex justify-content-center align-items-center'>";
                echo "<botton class='btn btn-warning m-lg-2'><a class='text-decoration-none text-center text-black fs-6' href='../frontend/edit-category.php?category_id={$category['category_id']}'><i class='fas fa-edit'></i></a></botton>";
                echo "<botton class='btn btn-danger m-lg-2'><a class='text-decoration-none text-center text-white fs-6' href='../frontend/delete-category.php?category_id={$category['category_id']}'><i class='fas fa-trash'></i></a></botton>";

                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<botton class='btn btn-outline-info m-lg-2'><a class='text-decoration-none' href='../frontend/add-category.php'>Add new category</a></botton>";
            echo "</div >";
            echo "</div >";
            echo "</div >";
            // Đóng kết nối
            mysqli_close($conn);
        } else {
            echo "<h4>You don't have any category yet. Please add a new category!</h4>";
            echo "<div class='d-sm-flex justify-content-between align-items-center mb-4'>";
            echo "<botton class='btn btn-outline-info m-lg-2'><a class='text-decoration-none' href='../frontend/add-category.php'>Add new category</a></botton>";
            echo "</div>";
        }
//        }
        // Đóng kết nối
//        mysqli_close($conn);
    }