<?php
	require_once "../backend/controllerUserData.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - BUBO</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=716a9d77da85c6b5972e0b907ecb6b4b">
</head>

<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image"
                                 style="background-image: url(&quot;assets/img/dogs/image3.jpeg?h=cbc3a40dae521ddee89bf6b026abde71&quot;);">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Welcome Back!</h4>
                                </div>
                                <form action="login.php" method="post" class="user">
                                    <?php
                                        if (isset($errors)) {
                                            ?>
                                            <p class="text-center">Login with your email and password.</p>
                                            <?php
                                            if (count($errors) > 0) {
                                                ?>
                                                <div class="alert alert-danger text-center">
                                                    <?php
                                                        foreach ($errors as $showerror) {
                                                            echo $showerror;
                                                        }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                    ?>
                                    <div class="mb-3">
                                        <input class="form-control form-control-user" type="email"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Enter Email Address..." name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control form-control-user" type="password"
                                               id="exampleInputPassword" placeholder="Password"
                                               name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check">
                                                <input class="form-check-input custom-control-input" type="checkbox"
                                                       id="formCheck-1">
                                                <label class="form-check-label custom-control-label"
                                                       for="formCheck-1">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary d-block btn-user w-100"
                                            type="submit" name="login">Login
                                    </button>
                                    <hr>
                                    <a class="btn btn-primary d-block btn-google btn-user w-100 mb-2"
                                       role="button"><i class="fab fa-google"></i>&nbsp; Login with Google</a><a
                                            class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i
                                                class="fab fa-facebook-f"></i>&nbsp; Login with Facebook</a>
                                    <hr>
                                </form>
                                <div class="text-center"><a class="small" href="forgot-password.php">Forgot
                                        Password?</a></div>
                                <div class="text-center"><a class="small" href="register.php">Create an
                                        Account!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>