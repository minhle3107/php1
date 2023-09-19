<?php
    require_once "../backend/controllerUserData.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Forgotten Password - BUBO</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
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
							<div class="flex-grow-1 bg-password-image"
							     style="background-image: url(&quot;assets/img/dogs/image1.jpeg?h=430aabda8f7926f94f558f54049fc6e6&quot;);">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h4 class="text-dark mb-2">Forgot Your Password?</h4>
									<p class="mb-4">We get it, stuff happens. Just enter your email address below
										and we'll send you a link to reset your password!</p>
								</div>
								<form class="user" action="forgot-password.php" method="post">
                                    <?php
                                        if (isset($errors)) {
                                            ?>
                                            <?php
                                            if (count($errors) > 0) {
                                                ?>
												<div class="alert alert-danger text-center">
                                                    <?php
                                                        foreach ($errors as $error) {
                                                            echo $error;
                                                        }
                                                    ?>
												</div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                    ?>
									<div class="mb-3"><input class="form-control form-control-user" type="email"
									                         id="exampleInputEmail" aria-describedby="emailHelp"
									                         placeholder="Enter Email Address..." name="email" required></div>
									<button
											class="btn btn-primary d-block btn-user w-100" type="submit" name="check-email">Reset
										Password
									</button>
								</form>
								<div class="text-center">
									<hr>
									<a class="small" href="register.php">Create an Account!</a>
								</div>
								<div class="text-center"><a class="small" href="login.php">Already have an account?
										Login!</a></div>
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