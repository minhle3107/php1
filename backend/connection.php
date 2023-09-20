<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "asmphp";

// Tạo kết nối MySQLi
    $conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }