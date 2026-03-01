<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?>-Profile</title>
    
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
        }

        body {
            background: var(--light-gray);
        }

        .page-header {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(27, 59, 95, 0.2);
        }

        .page-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 2rem;
        }

        .breadcrumb-custom {
            font-size: 14px;
            margin-top: 10px;
        }

        .breadcrumb-custom a {
            color: var(--primary-gold-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-custom a:hover {
            color: var(--primary-gold);
        }

        .breadcrumb-custom span {
            color: rgba(255, 255, 255, 0.7);
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-top: 4px solid var(--primary-gold);
            overflow: hidden;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(201, 169, 97, 0.3);
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--primary-gold-light), var(--primary-gold));
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }

        .card-header-custom h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-custom i {
            color: var(--primary-gold);
        }

        .card-body-custom {
            padding: 30px;
        }

        .form-label {
            color: var(--deep-blue);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
            outline: none;
        }

        .form-control:hover {
            border-color: var(--primary-gold-light);
        }

        .btn-save {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(201, 169, 97, 0.3);
        }

        .btn-save:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 59, 95, 0.4);
            color: white;
        }

        .btn-save:active {
            transform: translateY(0);
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-gold);
            z-index: 10;
        }

        .input-group-custom .form-control {
            padding-left: 45px;
        }

        .password-strength {
            height: 4px;
            background: var(--medium-gray);
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            background: linear-gradient(90deg, #e74c3c, #f39c12, #2ecc71);
        }

        .info-box {
            background: linear-gradient(135deg, var(--primary-gold-light) 0%, var(--primary-gold) 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-box i {
            font-size: 1.5rem;
        }

        .info-box p {
            margin: 0;
            font-size: 0.9rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media screen and (max-width: 768px) {
            .page-header {
                padding: 30px 20px;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }

            .card-body-custom {
                padding: 20px;
            }
        }
    </style>

</head>

<body class="bg-light">

    <?php 
    require('user_components/header.php');
    if(!(isset($_SESSION['user_login']) && $_SESSION['user_login'] == true)) {
            redirect('index.php');
        } 

    $u_exist = select("SELECT * FROM `user_details` WHERE `id`=? LIMIT 1",[$_SESSION['U_Id']],'s');

    if(mysqli_num_rows($u_exist) == 0) {
        redirect('index.php');
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);
    ?>

<div class="container-fluid page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><i class="bi bi-person-circle me-2"></i>My Profile</h2>
                <div class="breadcrumb-custom">
                    <a href="index.php">Home</a>
                    <span> > </span>
                    <span>Profile</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Personal Information Card -->
        <div class="col-12 mb-4">
            <div class="profile-card">
                <div class="card-header-custom">
                    <h5><i class="bi bi-person-lines-fill"></i>Personal Information</h5>
                </div>
                <div class="card-body-custom">
                    <div class="info-box">
                        <i class="bi bi-info-circle-fill"></i>
                        <p>Keep your personal information up to date to ensure smooth booking experience.</p>
                    </div>
                    <form id="info-form">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Full Name</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-person-fill"></i>
                                    <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control" placeholder="Enter your full name" required>
                                </div>
                            </div>  
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Phone Number</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-telephone-fill"></i>
                                    <input name="phone_num" type="number" value="<?php echo $u_fetch['phone_num'] ?>" class="form-control" placeholder="Enter phone number" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-calendar-event"></i>
                                    <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pincode</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control" placeholder="Enter pincode" required>
                                </div>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label class="form-label">Address</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-house-fill"></i>
                                    <textarea name="address" class="form-control" rows="2" placeholder="Enter your complete address" required><?php echo $u_fetch['address'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check-circle me-2"></i>Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="col-lg-8 mb-5">
            <div class="profile-card">
                <div class="card-header-custom">
                    <h5><i class="bi bi-shield-lock-fill"></i>Security Settings</h5>
                </div>
                <div class="card-body-custom">
                    <div class="info-box">
                        <i class="bi bi-shield-check"></i>
                        <p>Use a strong password with at least 8 characters, including uppercase, lowercase, and numbers.</p>
                    </div>
                    <form id="pass-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-key-fill"></i>
                                    <input name="new_pass" type="password" class="form-control" placeholder="Enter new password" required>
                                </div>
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="strength-bar"></div>
                                </div>
                            </div>  
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-lock-fill"></i>
                                    <input name="confirm_pass" type="password" class="form-control" placeholder="Confirm new password" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-shield-check me-2"></i>Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('user_components/footer.php'); ?>

<script>
    // Password strength indicator
    document.querySelector('input[name="new_pass"]').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('strength-bar');
        let strength = 0;

        if (password.length >= 8) strength += 25;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 25;
        if (password.match(/[0-9]/)) strength += 25;
        if (password.match(/[^a-zA-Z0-9]/)) strength += 25;

        strengthBar.style.width = strength + '%';
    });

    // Information form submission
    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit', function(e) {
        e.preventDefault();

        let data = new FormData();
        data.append('info_form', '');
        data.append('name', info_form.elements['name'].value);
        data.append('phone_num', info_form.elements['phone_num'].value);
        data.append('address', info_form.elements['address'].value);
        data.append('pincode', info_form.elements['pincode'].value);
        data.append('dob', info_form.elements['dob'].value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "user_ajax/profile.php", true);

        xhr.onload = function() {
            if(this.responseText == 'phone_already') {
                alert('error', "This Phone Number is Already Registered");       
            }
            else if(this.responseText == 0) {
                alert('error', "No changes made");
            }
            else {
                alert('success', 'Changes Saved Successfully!');
            }
        }
        xhr.send(data);
    });

    // Password form submission
    let pass_form = document.getElementById('pass-form');

    pass_form.addEventListener('submit', function(e) {
        e.preventDefault();

        let new_pass = pass_form.elements['new_pass'].value;
        let confirm_pass = pass_form.elements['confirm_pass'].value;

        if(new_pass != confirm_pass) {
            alert('error', 'Passwords do not match!');
            return false;
        }

        if(new_pass.length < 8) {
            alert('error', 'Password must be at least 8 characters long!');
            return false;
        }

        let data = new FormData();
        data.append('pass_form', '');
        data.append('new_pass', new_pass);
        data.append('confirm_pass', confirm_pass);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "user_ajax/profile.php", true);

        xhr.onload = function() {
            if(this.responseText == 'mismatch') {
                alert('error', "Password Not Matched!");       
            }
            else if(this.responseText == 0) {
                alert('error', "No changes made");
            }
            else {
                alert('success', 'Password Updated Successfully!');
                pass_form.reset();
                document.getElementById('strength-bar').style.width = '0%';
            }
        }
        xhr.send(data);
    });
</script>

</body>
</html>