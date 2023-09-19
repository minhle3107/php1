<?php
    require_once "../backend/controllerUserData.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Register - BUBO</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
	<link rel="stylesheet" href="assets/css/styles.min.css?h=716a9d77da85c6b5972e0b907ecb6b4b">
</head>

<body class="bg-gradient-primary">
<div class="container">
	<div class="card shadow-lg o-hidden border-0 my-5">
		<div class="card-body p-0">
			<div class="row">
				<div class="col-lg-5 d-none d-lg-flex">
					<div class="flex-grow-1 bg-register-image"
					     style="background-image: url(&quot;assets/img/dogs/image2.jpeg?h=a0a7d00bcd8e4f84f4d8ce636a8f94d4&quot;);">
					</div>
				</div>
				<div class="col-lg-7">
					<div class="p-5">
						<div class="text-center">
							<h4 class="text-dark mb-4">Create an Account!</h4>
						</div>
						<form action="register.php" method="post" class="user">
                            <?php
                                if (isset($errors)) {
                                    ?>
                                    <?php
                                    if (count($errors) == 1) {
                                        ?>
										<div class="alert alert-danger text-center">
                                            <?php
                                                foreach ($errors as $showerror) {
                                                    echo $showerror;
                                                }
                                            ?>
										</div>
                                        <?php
                                    } elseif (count($errors) > 1) {
                                        ?>
										<div class="alert alert-danger">
                                            <?php
                                                foreach ($errors as $showerror) {
                                                    ?>
													<li><?php echo $showerror; ?></li>
                                                    <?php
                                                }
                                            ?>
										</div>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                }
                            ?>
							<div class="row mb-3">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input class="form-control form-control-user"
								                                          type="text" id="exampleFirstName"
								                                          placeholder="First Name"
								                                          name="first_name" required>
								</div>
								<div class="col-sm-6">
									<input class="form-control form-control-user" type="text"
								                             id="exampleLastName" placeholder="Last Name"
								                             name="last_name" required>
								</div>
							</div>
							<div class="mb-3">
								<input class="form-control form-control-user" type="email"
							                         id="exampleInputEmail" aria-describedby="emailHelp"
							                         placeholder="Email Address"
							                         name="email" required>
							</div>
							<div class="row mb-3">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input class="form-control form-control-user"
								                                          type="password" id="examplePasswordInput"
								                                          placeholder="Password"
								                                          name="password" required>
								</div>
								<div class="col-sm-6">
									<input class="form-control form-control-user" type="password"
								                             id="exampleRepeatPasswordInput"
								                             placeholder="Repeat Password"
								                             name="password_repeat" required>
								</div>

							</div>
							<div class="mb-3">

								<select class="form-select form-control-user" id="classify" name="classify" value="" required>
									<option value="">Select an account type</option>
									<option value="Admin">Admin</option>
									<option value="User">User</option>

								</select>
							</div>
							<button class="btn btn-primary d-block btn-user w-100" type="submit" name="signup">Register
								Account
							</button>
							<hr>
							<a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"><i
										class="fab fa-google"></i>&nbsp; Register with Google</a><a
									class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i
										class="fab fa-facebook-f"></i>&nbsp; Register with Facebook</a>
							<hr>
						</form>
						<div class="text-center"><a class="small" href="forgot-password.php">Forgot Password?</a>
						</div>
						<div class="text-center"><a class="small" href="login.php">Already have an account?
								Login!</a></div>
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