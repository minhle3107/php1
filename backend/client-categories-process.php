<?php
//    session_start();

    require_once "connection.php";

    function clientCategories()
    {
        global $conn;
        // Truy vấn để lấy thông tin danh mục và ảnh từ bảng categories
        $query = "SELECT category_id, category_name, category_image FROM categories";
        $result = mysqli_query($conn, $query);

        // Hiển thị danh sách danh mục và ảnh
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row["category_id"];
                $category_name = $row["category_name"];
                $category_image = $row["category_image"];

                echo '<div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-lg-2">';
                echo '<a class="text-decoration-none d-flex align-items-stretch" href="get-category.php?category_id=' . $category_id . '">';
                echo '<div class="card text-center clean-card flex-fill"><img class="card-img-top w-100 d-block hover-opacity" src="../../' . $category_image . '">';
                echo '<div class="card-body info">';
                echo '<h4 class="card-title text-black">' . $category_name . '</h4>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "Không có danh mục nào.";
        }

        // Đóng kết nối cơ sở dữ liệu
//        mysqli_close($conn);
    }

