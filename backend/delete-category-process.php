<?php

    require "connection.php";

    if (!isset($_GET['category_id'])) {
        header('location: ../frontend/category-list.php');
        exit();
    }

    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE category_id = '$category_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 1) {
        header('location: ../frontend/category-list.php');
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
        $sql = "DELETE FROM categories WHERE category_id = '$category_id'";

        if (mysqli_query($conn, $sql)) {
            header('location: ../frontend/category-list.php');
            exit();
        } else {
            $errors[] = "Error deleting category: " . mysqli_error($conn);
        }
    }

//    mysqli_close($conn);
?>

<?php
    foreach ($errors as $error) {
        echo "<h3 class='mt-2'>$error</h3>";
    }
?>