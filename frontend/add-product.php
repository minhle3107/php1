<?php require_once "../backend/controllerUserData.php";
?>
<?php
	require_once "../backend/add-product-process.php";
?>
<?php
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    if ($email != false && $password != false) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $fetch_info = $result->fetch_assoc();
            $status = $fetch_info['status'];
            $code = $fetch_info['code'];
            if ($status == "verified") {
                if ($code != 0) {
                    header('Location: reset-code.php');
                    exit();
                }
            } else {
                header('Location: user-otp.php');
                exit();
            }
        }
    } else {
        header('Location: login.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - BUBO</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=716a9d77da85c6b5972e0b907ecb6b4b">
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0"><a
                class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                <div class="sidebar-brand-text mx-3"><span>BUBO</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
	            <li class="nav-item"><a class="nav-link" href="index.php"><i
					            class="fas fa-tag"></i><span>Products List</span></a></li>
	            <li class="nav-item"><a class="nav-link active" href="add-product.php"><i
					            class="fas fa-plus"></i><span>Add Product</span></a></li>
	            <li class="nav-item"><a class="nav-link" href="category-list.php"><i
					            class="fas fa-tag"></i><span>Category list</span></a></li>
	            <li class="nav-item"><a class="nav-link" href="add-category.php"><i
					            class="fas fa-plus"></i><span>Add Category</span></a></li>
	            <li class="nav-item"><a class="nav-link" href="logout.php"><i
					            class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
	            <li class="nav-item"><a class="nav-link" href="register.php"><i
					            class="fas fa-user-circle"></i><span>Register</span></a></li>
	            <li class="nav-item"><a class="nav-link" href="forgot-password.php"><i
					            class="fas fa-key"></i><span>Forgotten Password</span></a></li>

            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                                                                id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                                                     id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                                        placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i
                                    class="fas fa-search"></i></button></div>
                    </form>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                                                            aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                    class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                 aria-labelledby="searchDropdown">
                                <form class="me-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small"
                                                                    type="text" placeholder="Search for ...">
                                        <div class="input-group-append"><button class="btn btn-primary py-0"
                                                                                type="button"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                                                       aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                        class="badge bg-danger badge-counter">3+</span><i
                                        class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6><a
                                        class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="me-3">
                                            <div class="bg-primary icon-circle"><i
                                                    class="fas fa-file-alt text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 12, 2019</span>
                                            <p>A new monthly report is ready to download!</p>
                                        </div>
                                    </a><a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="me-3">
                                            <div class="bg-success icon-circle"><i
                                                    class="fas fa-donate text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 7, 2019</span>
                                            <p>$290.29 has been deposited into your account!</p>
                                        </div>
                                    </a><a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="me-3">
                                            <div class="bg-warning icon-circle"><i
                                                    class="fas fa-exclamation-triangle text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 2, 2019</span>
                                            <p>Spending Alert: We've noticed unusually high spending for your
                                                account.</p>
                                        </div>
                                    </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                        Alerts</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                                                       aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                        class="badge bg-danger badge-counter">7</span><i
                                        class="fas fa-envelope fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6><a
                                        class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                                                   src="assets/img/avatars/avatar4.jpeg?h=fefb30b61c8459a66bd338b7d790c3d5">
                                            <div class="bg-success status-indicator"></div>
                                        </div>
                                        <div class="fw-bold">
                                            <div class="text-truncate"><span>Hi there! I am wondering if you can
                                                        help me with a problem I've been having.</span></div>
                                            <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                        </div>
                                    </a><a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                                                   src="assets/img/avatars/avatar2.jpeg?h=5d142be9441885f0935b84cf739d4112">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="fw-bold">
                                            <div class="text-truncate"><span>I have the photos that you ordered last
                                                        month!</span></div>
                                            <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                        </div>
                                    </a><a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                                                   src="assets/img/avatars/avatar3.jpeg?h=c5166867f10a4e454b5b2ae8d63268b3">
                                            <div class="bg-warning status-indicator"></div>
                                        </div>
                                        <div class="fw-bold">
                                            <div class="text-truncate"><span>Last month's report looks great, I am
                                                        very happy with the progress so far, keep up the good
                                                        work!</span></div>
                                            <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                        </div>
                                    </a><a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                                                   src="assets/img/avatars/avatar5.jpeg?h=35dc45edbcda6b3fc752dab2b0f082ea">
                                            <div class="bg-success status-indicator"></div>
                                        </div>
                                        <div class="fw-bold">
                                            <div class="text-truncate"><span>Am I a good boy? The reason I ask is
                                                        because someone told me that people say this to all dogs, even
                                                        if they aren't good...</span></div>
                                            <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                        </div>
                                    </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                        Alerts</a>
                                </div>
                            </div>
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-end"
                                 aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                                                       aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                        class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $fetch_info['first_name'] . " " . $fetch_info['last_name'] ?></span><img
                                        class="border rounded-circle img-profile"
                                        src="assets/img/avatars/avatar5.jpeg"></a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                        class="dropdown-item" href="#"><i
                                            class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a
                                        class="dropdown-item" href="#"><i
                                            class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a
                                        class="dropdown-item" href="#"><i
                                            class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity
                                        log</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item"
                                                                           href="logout.php"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Welcome
                        <?php echo $fetch_info['first_name'] . " " . $fetch_info['last_name'] ?></h3><a
                        class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i
                            class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                </div>
	            <div class="row justify-content-center">
		            <div class="col-lg-6 mb-4">
			            <h3 class='text-primary fw-bold m-0 text-center'>Add Product</h3>
                        <?php
                            if (!empty($errors)) {
                                echo '<div class="alert alert-danger" role="alert">';
                                foreach ($errors as $error) {
                                    echo '<p>' . $error . '</p>';
                                }
                                echo '</div>';
                            }
                        ?>
                        <?php
                            if (!empty($success)) {
                                echo '<div class="alert alert-success" role="alert">';
                                foreach ($success as $success) {
                                    echo '<p>' . $success . '</p>';
                                }
                                echo '</div>';
                            }
                        ?>
			            <form method="post" action="add-product.php" enctype="multipart/form-data">
				            <div class="mb-3">
					            <label for="product_name" class="form-label">Product Name:</label>
					            <input type="text" class="form-control" id="product_name" name="product_name"
					                   value="" required>
				            </div>
				            <div class="mb-3">
					            <label for="price" class="form-label">Price:</label>
					            <input type="type" class="form-control" id="price" name="price"
					                   value="" required>
				            </div>
				            <div class="mb-3">
					            <label for="product_image" class="form-label">Image:</label>
					            <input type="file" class="form-control" id="product_image" name="product_image"
					                   value="" required>
				            </div>
				            <div class="mb-3">
					            <label for="product_description" class="form-label">Product Description:</label>
					            <textarea class="form-control" id="product_description"
					                      name="product_description" value="<?php echo $_SESSION['product_description'];?>" required></textarea>
				            </div>
				            <div class="mb-3">
					            <label for="category_id" class="form-label">Category Name:</label>
					            <select class="form-select" id="category_id" name="category_id" value="<?php echo $_SESSION['category_id'];?>" required>
						            <option value="">Select an category</option>
                                    <?php
                                        // Truy vấn danh sách hãng hàng không
                                        $sql = "SELECT category_id, category_name FROM categories";
                                        $result = mysqli_query($conn, $sql);

                                        // Thêm các lựa chọn vào combobox
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                        }

                                        // Đóng kết nối
                                        //                                        mysqli_close($conn);
                                    ?>
					            </select>
				            </div>
				            <button type="submit" class="btn btn-primary" name="addproduct">Add Now</button>
			            </form>
			            <br>
			            <a href="index.php">Back to List</a>

		            </div>
	            </div>

            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © BUBO 2023</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>