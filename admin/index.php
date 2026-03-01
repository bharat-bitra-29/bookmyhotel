<?php 
    require('admin_components/essentials.php');
    require('admin_components/db_config.php');
    session_start();
    if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel - HotelHub</title>
    <?php require('admin_components/link.php'); ?>
    <link rel="stylesheet" href="admin_luxury_theme.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a2332 0%, #2C3E50 50%, #1a2332 100%);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23D4AF37' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }

        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .admin_login_details {
            padding: 3rem 2rem;
        }

        .admin_login_details input {
            height: 50px;
            text-align: center;
            width: 100%;
            border: 2px solid #e9ecef;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .admin_login_details input:focus {
            border-color: #D4AF37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            outline: none;
        }

        .admin_login_details button {
            height: 50px;
            color: #1a2332;
            border: none;
            border-radius: 50px;
            width: 100%;
            background: linear-gradient(135deg, #D4AF37 0%, #F4E4B7 100%);
            font-weight: 600;
            letter-spacing: 1.5px;
            font-size: 1rem;
            text-transform: uppercase;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .admin_login_details button:hover {
            background: linear-gradient(135deg, #B8941E 0%, #D4AF37 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        form h4 {
            background: linear-gradient(135deg, #1a2332 0%, #2C3E50 100%);
            padding: 1.5rem;
            margin: 0;
            text-align: center;
            color: white;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            border-radius: 15px 15px 0 0;
        }

        .login-subtitle {
            text-align: center;
            color: #8B6F47;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .luxury-icon {
            text-align: center;
            margin-bottom: 1rem;
        }

        .luxury-icon i {
            font-size: 3rem;
            background: linear-gradient(135deg, #D4AF37 0%, #F4E4B7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (max-width: 576px) {
            div.login-form {
                width: 95%;
                margin: 1rem;
            }

            .admin_login_details {
                padding: 2rem 1.5rem;
            }

            form h4 {
                font-size: 1.2rem;
                letter-spacing: 2px;
            }
        }
    </style>
</head>
<body class="bg-light">

    <div class="login-form text-center shadow-lg overflow-hidden">
        <form method="POST">
            <h4>Hotelhub</h4>
            
            <div class="admin_login_details">
                <div class="luxury-icon">
                    <i class="bi bi-gem"></i>
                </div>
                <p class="login-subtitle">Administrative Access Portal</p>
                
                <div class="mb-4">
                    <input name="admin_username" required type="text" placeholder="Username" autocomplete="username">
                </div>
                <div class="mb-4">
                    <input name="admin_password" required type="password" placeholder="Password" autocomplete="current-password">
                </div>
                <button name="admin_login" type="submit">Sign In</button>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['admin_login'])) {
        $form_data = filteration($_POST);

        $query = "SELECT * FROM `admin_details` WHERE `admin_username`=? AND `admin_password`=?";
        $values = [$form_data['admin_username'],$form_data['admin_password']];
        $res = select($query,$values,"ss");
        if($res->num_rows==1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminID'] = $row['sl_no'];
            redirect('dashboard.php');
        }
        else {
            alert('error','Invalid Credentials');
        }
    }
    ?>

    <?php require('admin_components/scripts.php'); ?>
</body>
</html>