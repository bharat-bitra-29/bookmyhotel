<?php
    require('admin/admin_components/db_config.php');
    require('admin/admin_components/essentials.php');

    $verification_status = '';
    $verification_message = '';
    $verification_icon = '';
    $verification_type = '';

    if(isset($_GET['type']) && $_GET['type'] == 'email_confirmation') {
        $data = filteration($_GET);
        $query = select("SELECT * FROM `user_details` WHERE `email`=? AND `token`=? LIMIT 1 ",[$data['email'],$data['token']],'ss');

        if(mysqli_num_rows($query) == 1) {
            $fetch = mysqli_fetch_assoc($query);

            if($fetch['is_verified']==1) {
                $verification_status = 'Already Verified';
                $verification_message = 'Your email has already been verified. You can proceed to login.';
                $verification_icon = 'bi-check-circle-fill';
                $verification_type = 'info';
            }
            else {
                $update = update("UPDATE `user_details` SET `is_verified`=?  WHERE `id`=?",[1,$fetch['id']],'ii' );
                if($update) {

                    $env = "LD_LIBRARY_PATH=/usr/lib/x86_64-linux-gnu";
                    $pkcs = realpath(dirname(__DIR__) . "/pkcs11");
                    $user_id = $fetch['id'];

                    exec("$env $pkcs/genkey " . escapeshellarg($user_id) . " 2>&1", $out, $code);
                    if ($code !== 0) {
                        error_log("HSM KEY CREATE ON VERIFY FAILED for user $user_id: " . implode("\n", $out));
                    }

                    $verification_status = 'Verification Successful';
                    $verification_message = 'Congratulations! Your email has been successfully verified. You can now login to your account.';
                    $verification_icon = 'bi-check-circle-fill';
                    $verification_type = 'success';
                }

                else {
                    $verification_status = 'Verification Failed';
                    $verification_message = 'Sorry, we could not verify your email. Please try again or contact support.';
                    $verification_icon = 'bi-x-circle-fill';
                    $verification_type = 'error';
                }
            }
        }
        else {
            $verification_status = 'Invalid Link';
            $verification_message = 'The verification link is invalid or has expired. Please request a new verification email.';
            $verification_icon = 'bi-exclamation-triangle-fill';
            $verification_type = 'error';
        }
    }
    else {
        redirect('index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gold: #C9A961;
            --primary-gold-light: #D4B876;
            --primary-gold-dark: #B8964D;
            --deep-blue: #1B3B5F;
            --deep-blue-dark: #152E4A;
            --charcoal: #2C3E50;
            --light-gray: #F8F9FA;
            --medium-gray: #DEE2E6;
            --success: #2D6A4F;
            --danger: #C1121F;
            --info: #457B9D;
        }

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(201, 169, 97, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(201, 169, 97, 0.05) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .verification-container {
            position: relative;
            z-index: 10;
            max-width: 600px;
            width: 90%;
            margin: 20px;
        }

        .verification-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .verification-header {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            padding: 30px;
            text-align: center;
            border-bottom: 4px solid var(--primary-gold);
        }

        .verification-header h2 {
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            font-family: 'Merienda', cursive;
            letter-spacing: 1px;
        }

        .verification-body {
            padding: 50px 40px;
            text-align: center;
        }

        .status-icon {
            font-size: 5rem;
            margin-bottom: 25px;
            animation: scaleIn 0.5s ease-out 0.3s backwards;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .status-icon.success {
            color: var(--success);
        }

        .status-icon.error {
            color: var(--danger);
        }

        .status-icon.info {
            color: var(--info);
        }

        .status-title {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease-out 0.4s backwards;
        }

        .status-message {
            color: var(--charcoal);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 35px;
            animation: fadeIn 0.6s ease-out 0.5s backwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .btn-home {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
            border: none;
            color: white;
            padding: 14px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(201, 169, 97, 0.3);
            text-decoration: none;
            display: inline-block;
            animation: fadeIn 0.6s ease-out 0.6s backwards;
        }

        .btn-home:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(27, 59, 95, 0.4);
            color: white;
        }

        .btn-home i {
            margin-right: 8px;
        }

        .decorative-line {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
            margin: 25px auto;
            position: relative;
        }

        .decorative-line::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: var(--primary-gold);
            border-radius: 50%;
        }

        @media screen and (max-width: 768px) {
            .verification-body {
                padding: 40px 25px;
            }

            .status-icon {
                font-size: 4rem;
            }

            .status-title {
                font-size: 1.5rem;
            }

            .status-message {
                font-size: 1rem;
            }

            .btn-home {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>

</head>
<body>

    <div class="verification-container">
        <div class="verification-card">
            <div class="verification-header">
                <h2>Email Verification</h2>
            </div>
            
            <div class="verification-body">
                <i class="bi <?php echo $verification_icon; ?> status-icon <?php echo $verification_type; ?>"></i>
                
                <h3 class="status-title"><?php echo $verification_status; ?></h3>
                
                <div class="decorative-line"></div>
                
                <p class="status-message"><?php echo $verification_message; ?></p>
                
                <a href="index.php" class="btn-home">
                    <i class="bi bi-house-door-fill"></i>
                    Go to Homepage
                </a>
            </div>
        </div>
    </div>

    <script>
        <?php if($verification_type == 'success'): ?>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000);
        <?php endif; ?>
    </script>

</body>
</html>