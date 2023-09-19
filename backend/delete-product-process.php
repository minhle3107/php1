<?php

    require "connection.php";

    if (!isset($_GET['product_id'])) {
        header('location: ../frontend/index.php');
        exit();
    }

    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 1) {
        header('location: ../frontend/index.php');
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
        $sql = "DELETE FROM products WHERE product_id = '$product_id'";

        if (mysqli_query($conn, $sql)) {
            header('location: ../frontend/index.php');

            exit();
        } else {
            $errors[] = "Error deleting product: " . mysqli_error($conn);
        }
    }

//    mysqli_close($conn);
?>

<?php
    foreach ($errors as $error) {
        echo "<h3 class='mt-2'>$error</h3>";
    }
?>