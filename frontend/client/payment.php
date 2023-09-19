<?php
    require_once "../../backend/controllerUserData.php";
    require_once "../../backend/client-categories-process.php";
    require_once "../../backend/client-products-process.php";
	require_once "../../backend/client-payment.php";
	require_once "../../backend/client-proceed-process.php";
?>

<?php
//    $email = $_SESSION['email'];
//    $password = $_SESSION['password'];
//    if ($email != false && $password != false) {
//        $sql = "SELECT * FROM users WHERE email = ?";
//        $stmt = $conn->prepare($sql);
//        $stmt->bind_param('s', $email);
//        $stmt->execute();
//        $result = $stmt->get_result();
//
//        if ($result) {
//            $fetch_info = $result->fetch_assoc();
//            $user_id = $fetch_info['user_id'];
//
//            // Lưu user_id vào session
//            $_SESSION['user_id'] = $user_id;
//
//            $status = $fetch_info['status'];
//            $code = $fetch_info['code'];
//            if ($status == "verified") {
//                if ($code != 0) {
//                    header('Location: ../reset-code.php');
//                    exit();
//                }
//            } else {
//                header('Location: ../user-otp.php');
//                exit();
//            }
//        }
//    } else {
//        header('Location: ../login.php');
//        exit();
//    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Payment - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=ae510b1c65562a9ddc65f41fcd50c745">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">

    <link rel="stylesheet" href="assets/css/styles.min.css?h=a73ec4f273770a46550a3669ccb10b7a">
</head>

<body>
<div class="d-flex flex-column">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container">
            <a class="navbar-brand logo" href="#">MINHLE</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navcol-1" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto d-lg-flex d-sm-inline-block d-md-inline-block d-inline-block justify-content-lg-start align-items-center">
                    <li class="nav-item no-arrow"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item no-arrow"><a class="nav-link" href="get-category.php">Categories</a></li>

                    <li class="nav-item no-arrow">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"></span><img class="border rounded-circle img-profile" width="30" height="30" src="assets/img/avatars/avatar5.jpeg"></a>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;<?php echo $fetch_info['first_name'] . " " . $fetch_info['last_name'] ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                    &nbsp;Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<main class="page payment-page mt-5">
    <section class="clean-block payment-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Payment</h2>
            </div>
            <form action="" method="post">
                <div class="products">
                    <h3 class="title">Checkout</h3>
<!--                    <div class="item"><span class="price">Price 1</span>-->
<!--                        <p class="item-name">Product 1</p>-->
<!--                        <p class="item-description">product_description </p>-->
<!--                    </div>-->
<!--                    <div class="total"><span>Total</span><span class="price">$320</span></div>-->
	                <?php
	                productPayment();
					?>
                </div>
                <div class="card-details">
                    <h3 class="title">Delivery information</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3"><label class="form-label" for="first_name">First Name</label><input
                                    class="form-control" type="text" id="first_name" placeholder="First Name"
                                    name="first_name" required></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3"><label class="form-label" for="last_name">Last Name</label><input
                                    class="form-control" type="text" id="last_name" placeholder="Last Name"
                                    name="last_name"" required></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3"><label class="form-label" for="email">Email</label><input
                                    class="form-control" type="email" id="email" placeholder="Email"
                                    name="email"" required></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3"><label class="form-label" for="phone">Phone</label><input
                                    class="form-control" type="text" id="phone" placeholder="Phone"
                                    name="phone"" required></div>
                        </div>

                        <div class="col-sm-12">
                            <div class="mb-3"><label class="form-label" for="address">Address</label><textarea
                                    class="form-control" type="text" id="address" placeholder="Address"
                                    name="address"" required></textarea></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label" for="paymentmethod">Payment Method</label>
                                <select class="form-control" type="text" id="paymentmethod" name="paymentmethod">
                                    <option>Cash On Delivery</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3"><button class="btn btn-primary d-block w-100"
                                                      type="submit" name="proceed">Proceed</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main><!-- Start: Footer Dark -->
<footer class="page-footer dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Get started</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Sign up</a></li>
                    <li><a href="#">Downloads</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>About us</h5>
                <ul>
                    <li><a href="#">Company Information</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Reviews</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Support</h5>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Help desk</a></li>
                    <li><a href="#">Forums</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Legal</h5>
                <ul>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© 2023 Copyright Text</p>
    </div>
</footer><!-- End: Footer Dark -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.min.js?h=eaa36c7429bf27936b1059031f2a5b02"></script>
</body>

</html>