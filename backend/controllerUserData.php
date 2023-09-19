<?php
    session_start();
    require_once "connection.php";

    use PHPMailer\PHPMailer\PHPMailer;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    $email = "";
    $name = "";
    $errors = array();

    function sendVerificationEmail($email, $subject, $message)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'leminhhh.3107@gmail.com';
        $mail->Password = 'dsnkhflwkeefyfsm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->SetFrom("leminhhh.3107@gmail.com", "Send Code Sign Up"); // your email address and name
        $mail->Subject = $subject;

        $mail->Body = $message;
        $mail->AddAddress($email);

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

// if user clicks signup button
    if (isset($_POST['signup'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_repeat = $_POST['password_repeat'];
        $classify = $_POST['classify'];

        if ($password !== $password_repeat) {
            $errors['password'] = "Confirm password not matched!";
        } else {
            $check_email = "SELECT * FROM users WHERE email = ? LIMIT 1";
            $stmt = $conn->prepare($check_email);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $errors['email'] = "Email that you have entered is already exist!";
            } else {
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $code = rand(100000, 999999); // OTP code
                $status = "notverified";

                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, code, status, classify) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('sssssss', $first_name, $last_name, $email, $encpass, $code, $status, $classify);
                $insert_data = $stmt->execute();

                if ($insert_data) {
                    $subject = "Email Verification Code";
                    $message = "Your verification code is $code";
                    if (sendVerificationEmail($email, $subject, $message)) {
                        $info = "We've sent a verification code to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $_SESSION['classify'] = $classify;
                        header('location: ../frontend/user-otp.php');
                        exit();
                    } else {
                        $errors['otp-error'] = "Failed while sending code!";
                    }
                } else {
                    $errors['db-error'] = "Failed while inserting data into the database!";
                }
            }
            $stmt->close();
        }
    }


    // if user clicks verification code submit button
    if (isset($_POST['check'])) {
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $check_code = "SELECT * FROM users WHERE code = ?";
        $stmt = $conn->prepare($check_code);
        $stmt->bind_param('s', $otp_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $fetch_data = $result->fetch_assoc();
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = ?, status = ? WHERE code = ?";
            $stmt = $conn->prepare($update_otp);
            $stmt->bind_param('sss', $code, $status, $fetch_code);
            $update_success = $stmt->execute();

            if ($update_success) {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                if ($_SESSION['classify'] === "Admin") {
                    header('location: ../frontend/index.php');
                    exit();
                } elseif ($_SESSION['classify'] === "User") {
                    header('location: ../frontend/client/index.php');
                    exit();
                }
            } else {
                $errors['otp-error'] = "Failed while updating code!";
            }
        } else {
            $errors['otp-error'] = "You've entered incorrect code!";
        }
        $stmt->close();
    }

    // if user clicks login button
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $fetch = $result->fetch_assoc();
            $classify = $fetch['classify']; // Lấy giá trị của cột "classify"
            $user_id = $fetch['user_id'];
            $_SESSION['user_id'] = $user_id;
            $fetch_pass = $fetch['password'];
            if (password_verify($password, $fetch_pass)) {
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if ($status == 'verified') {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    if ($classify === 'Admin') {
                        header('location: ../frontend/index.php');
                        exit();
                    } elseif ($classify === 'User') {
                        header('location: ../frontend/client/index.php');
                        exit();
                    }
                } else {
                    $info = "It's look like you haven't still verified your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: ../frontend/user-otp.php');
                    exit();
                }
            } else {
                $errors['email'] = "Incorrect email or password!";
            }
        } else {
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to Create an Account!.";
        }
        $stmt->close();
    }

    // if user clicks continue button in forgot password form
    if (isset($_POST['check-email'])) {
        $email = $_POST['email'];
        $check_email = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $code = rand(100000, 999999);
            $insert_code = "UPDATE users SET code=? WHERE email=?";
            $stmt = $conn->prepare($insert_code);
            $stmt->bind_param('ss', $code, $email);
            $run_success = $stmt->execute();

            if ($run_success) {
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                if (sendVerificationEmail($email, $subject, $message)) {
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: ../frontend/reset-code.php');
                    exit();
                } else {
                    $errors['otp-error'] = "Failed while sending code!";
                }
            } else {
                $errors['db-error'] = "Something went wrong!";
            }
        } else {
            $errors['email'] = "This email address does not exist!";
        }
        $stmt->close();
    }

    // if user clicks check reset otp button
    if (isset($_POST['check-reset-otp'])) {
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $check_code = "SELECT * FROM users WHERE code = ?";
        $stmt = $conn->prepare($check_code);
        $stmt->bind_param('s', $otp_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $fetch_data = $result->fetch_assoc();
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: ../frontend/new-password.php');
            exit();
        } else {
            $errors['otp-error'] = "You've entered incorrect code!";
        }
        $stmt->close();
    }

    // if user clicks change password button
    if (isset($_POST['change-password'])) {
        $_SESSION['info'] = "";
        $password = $_POST['password'];
        $password_repeat = $_POST['password_repeat'];
        if ($password !== $password_repeat) {
            $errors['password'] = "Confirm password not matched!";
        } else {
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET code=?, password=? WHERE email=?";
            $stmt = $conn->prepare($update_pass);
            $stmt->bind_param('iss', $code, $encpass, $email);
            $run_success = $stmt->execute();

            if ($run_success) {
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: ../frontend/password-changed.php');
                exit();
            } else {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    //if login now button click
    if (isset($_POST['login-now'])) {
        header('Location: ../frontend/login.php');
    }