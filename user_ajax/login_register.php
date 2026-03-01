<?php
    require('../admin/admin_components/db_config.php');
    require('../admin/admin_components/essentials.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require("../user_components/PHPMailer/src/Exception.php");
    require("../user_components/PHPMailer/src/PHPMailer.php");
    require("../user_components/PHPMailer/src/SMTP.php");
    
    date_default_timezone_set("Asia/Kolkata");

    function send_mail($uemail, $token, $type) {
        if ($type == "email_confirmation") {
            $page = 'email_confirm.php';
            $subject = "Account Verification Link";
            $content = "Confirm Your Email";
        } else {
            $page = 'index.php';
            $subject = "Account Reset Link";
            $content = "Reset Your Account";
        }

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'a1451b001@smtp-brevo.com';
            $mail->Password = BREVO_SMTP_KEY;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(BREVO_EMAIL, MAIL_FROM_NAME);
            $mail->addAddress($uemail);

            $mail->isHTML(true);
            $mail->Subject = $subject;

            $link = SITE_URL . "$page?type=$type&email=$uemail&token=$token";
            $mail->Body = "Click the link to $content:<br><br><a href='$link'>CLICK ME</a>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("MAIL ERROR: " . $mail->ErrorInfo);
            return false;
        }
    }

    function send_otp_mail($email, $otp) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'a1451b001@smtp-brevo.com';
            $mail->Password = BREVO_SMTP_KEY;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(BREVO_EMAIL, MAIL_FROM_NAME);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Your Login OTP";
            $mail->Body = "<h3>Your OTP is: <b>$otp</b></h3><p>Valid for 30 seconds.</p>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("OTP MAIL ERROR: " . $mail->ErrorInfo);
            return false;
        }
    }

    function hsm_generate_otp_or_create_key($uid)
        {
            $pkcs = realpath(dirname(__DIR__) . "/pkcs11");

            $env = "LD_LIBRARY_PATH=/usr/lib/x86_64-linux-gnu";

            $otp = trim(shell_exec("$env $pkcs/genotp " . escapeshellarg($uid) . " 2>&1"));

            if (strpos($otp, "KEY_NOT_FOUND") !== false) {
                exec("$env $pkcs/genkey " . escapeshellarg($uid) . " 2>&1", $out, $code);
                if ($code !== 0) {
                    error_log("HSM KEY ERROR: " . implode("\n", $out));
                    return false;
                }
                $otp = trim(shell_exec("$env $pkcs/genotp " . escapeshellarg($uid) . " 2>&1"));
            }

            if (!$otp || !preg_match('/^\d{6}$/', $otp)) {
                error_log("OTP GEN FAIL: " . $otp);
                return false;
            }

            return $otp;
    }


    if(isset($_POST['register'])) {
        $data = filteration($_POST);

        // mathc and confirm pass
        if($data['password'] != $data['confirm_pass']) {
            echo 'pass_mismatch';
            exit;
        }

        // chech user exists
        $user_exist = select("SELECT * FROM `user_details` WHERE `email` = ? OR `phone_num` = ? LIMIT 1",[$data['email'],$data['phone_num']],"ss");

        if(mysqli_num_rows($user_exist)!=0) {
            $user_exist_fetch = mysqli_fetch_assoc($user_exist);
            echo ($user_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
            exit;
        }

        // send confirmation link
        $token = bin2hex(random_bytes(16));

        if(!send_mail($data['email'],$token,"email_confirmation")) {
            echo 'mail_failed';
            exit;
        }

        $enc_pass = password_hash($data['password'],PASSWORD_BCRYPT);
        $query = "INSERT INTO `user_details` (`name`, `email`, `address`, `phone_num`, `pincode`, `dob`,`password`, `token`) VALUES (?,?,?,?,?,?,?,?)";

        $values = [$data['name'],$data['email'],$data['address'],$data['phone_num'],$data['pincode'],$data['dob'],$enc_pass,$token];

        if(insert($query,$values,'ssssssss')){
            echo 1;
        } else {
            echo 'ins_failed';
        }
    }

    if(isset($_POST['user_login'])) {
        $data = filteration($_POST);

        $user_exist = select("SELECT * FROM `user_details` WHERE `email` = ? OR `phone_num` = ? LIMIT 1",[$data['email_num'],$data['email_num']],"ss");

        if(mysqli_num_rows($user_exist) == 0) {
            echo 'inv_email_mob';
        }
        else {
            $user_fetch = mysqli_fetch_assoc($user_exist);
            if($user_fetch['is_verified'] == 0) {
                echo 'not_verified';
            }
            else if($user_fetch['status'] == 0) {
                echo 'inactive';
            }
            else {
                if(!password_verify($data['pass'],$user_fetch['password'])) {
                    echo 'invalid_password';
                }
                else {
                    session_start();
                    $_SESSION['user_login'] = true;
                    $_SESSION['U_Id'] = $user_fetch['id'];
                    $_SESSION['U_Name'] = $user_fetch['name'];
                    $_SESSION['U_Phone'] = $user_fetch['phone_num'];
                    echo 1;
                }
            }
        }
    }
    
    if(isset($_POST['forgot_pass'])) {
        $data = filteration($_POST);

        $user_exist = select("SELECT * FROM `user_details` WHERE `email` = ? LIMIT 1",[$data['email']],"s");

        if(mysqli_num_rows($user_exist) == 0) {
            echo 'inv_email';
        }
        else {
            $user_fetch = mysqli_fetch_assoc($user_exist);
            if($user_fetch['is_verified'] == 0) {
                echo 'not_verified';
            }
            else if($user_fetch['status'] == 0) {
                echo 'inactive';
            }
            else {
                // send reset email
                $token = bin2hex(random_bytes(16));
                if(!send_mail($data['email'],$token,'account_recovery')) {
                    echo 'mail_failed';
                }
                else {
                    $date = date("Y-m-d");
                    $query = mysqli_query($con,"UPDATE `user_details` SET `token`='$token',`t_expire`='$date' WHERE `id`='$user_fetch[id]'");

                    if($query) {
                        echo 1;
                    }                 
                    else {
                        echo 'upd_failed';
                    }
                }
            }
        }
    }

    if(isset($_POST['recover_user'])) {
        $data = filteration($_POST);
        $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

        $query = "UPDATE `user_details` SET `password`=?, `token`=?, `t_expire`=?  WHERE `email`=? AND `token`=?";

        $values = [$enc_pass,null,null,$data['email'],$data['token']];

        if(update($query,$values,'sssss')) {
            echo 1;
        }
        else {
            echo 'failed';
        }
    }

    

    if (isset($_POST['generate_otp'])) {
        $data = filteration($_POST);

        $user_exist = select("SELECT * FROM `user_details` WHERE `email`=? OR `phone_num`=? LIMIT 1",
            [$data['email_num'], $data['email_num']], "ss");

        if (mysqli_num_rows($user_exist) == 0) { echo 'inv_email_mob'; exit; }

        $user = mysqli_fetch_assoc($user_exist);

        if (!password_verify($data['pass'], $user['password'])) { echo 'invalid_password'; exit; }
        if ($user['is_verified'] == 0) { echo 'not_verified'; exit; }
        if ($user['status'] == 0) { echo 'inactive'; exit; }

        session_start();
        $_SESSION['OTP_USER_ID'] = $user['id'];
        $_SESSION['OTP_TRIES'] = 0;

        $otp = hsm_generate_otp_or_create_key($user['id']);
        if ($otp === false) { echo "hsm_or_otp_failed"; exit; }

        if (!send_otp_mail($user['email'], $otp)) { echo "mail_failed"; exit; }

        $_SESSION['OTP_TIME'] = time();
        echo "OTP_SENT";
        exit;
    }


   if (isset($_POST['verify_otp'])) {
    session_start();

    $uid = $_SESSION['OTP_USER_ID'] ?? null;
    $otp = $_POST['otp'] ?? '';

    if (!$uid) { echo "SESSION_EXPIRED"; exit; }

    $_SESSION['OTP_TRIES'] = ($_SESSION['OTP_TRIES'] ?? 0) + 1;
    if ($_SESSION['OTP_TRIES'] > 5) { echo "TOO_MANY_ATTEMPTS"; exit; }

    if (time() - ($_SESSION['OTP_TIME'] ?? 0) > 60) { echo "OTP_EXPIRED"; exit; }

    $env = "LD_LIBRARY_PATH=/usr/lib/x86_64-linux-gnu";
    $pkcs = realpath(dirname(__DIR__) . "/pkcs11");

    $result = shell_exec(
        "$env $pkcs/verifyotp " . escapeshellarg($uid) . " " . escapeshellarg($otp) . " 2>&1"
    );

    if (strpos($result, "OTP_OK") !== false) {

        // Fetch user details for session
        $user = mysqli_fetch_assoc(select(
            "SELECT name, phone_num FROM user_details WHERE id=?",
            [$uid], "i"
        ));

        $_SESSION['user_login'] = true;
        $_SESSION['U_Id'] = $uid;
        $_SESSION['U_Name'] = $user['name'];
        $_SESSION['U_Phone'] = $user['phone_num'];

        unset($_SESSION['OTP_USER_ID'], $_SESSION['OTP_TRIES'], $_SESSION['OTP_TIME']);
        echo "LOGIN_OK";
    }
    else {
            error_log("VERIFY OTP RAW OUTPUT: " . $result);
            echo "OTP_INVALID";
        }
    exit;
    }




    if (isset($_POST['regenerate_otp'])) {
        session_start();
        $uid = $_SESSION['OTP_USER_ID'] ?? null;
        if (!$uid) { echo "SESSION_EXPIRED"; exit; }

        if (isset($_SESSION['OTP_TIME']) && (time() - $_SESSION['OTP_TIME'] < 30)) {
            echo "WAIT_30_SECONDS"; exit;
        }

        $otp = hsm_generate_otp_or_create_key($uid);
        if ($otp === false) { echo "hsm_or_otp_failed"; exit; }

        $user = mysqli_fetch_assoc(select("SELECT email FROM user_details WHERE id=?", [$uid], "i"));
        if (!send_otp_mail($user['email'], $otp)) { echo "mail_failed"; exit; }

        $_SESSION['OTP_TIME'] = time();
        echo "OTP_SENT";
        exit;
    }







    
?>