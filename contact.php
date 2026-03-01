<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Contact</title>
   
    <style>
        .contact-hero {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="2" x="0" y="0" fill="rgba(201,169,97,0.1)"/></svg>');
            opacity: 0.3;
        }
        
        .contact-hero h2 {
            color: white;
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }
        
        .contact-hero .h-line {
            background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
            height: 3px;
            position: relative;
            z-index: 1;
        }
        
        .contact-info-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(27, 59, 95, 0.15);
            border-top: 4px solid var(--primary-gold);
            transition: all 0.4s ease;
            height: 100%;
        }
        
        .contact-info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 60px rgba(201, 169, 97, 0.25);
        }
        
        .map-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .map-container iframe {
            border-radius: 12px;
            border: 3px solid var(--light-gray);
            transition: all 0.3s ease;
        }
        
        .map-container:hover iframe {
            border-color: var(--primary-gold);
        }
        
        .contact-info-card h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-gray);
            position: relative;
        }
        
        .contact-info-card h5::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-gold);
        }
        
        .contact-info-card h5:first-of-type {
            margin-top: 0;
        }
        
        .contact-link {
            display: inline-flex;
            align-items: center;
            color: var(--charcoal);
            text-decoration: none;
            margin-bottom: 12px;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: var(--light-gray);
        }
        
        .contact-link:hover {
            color: var(--primary-gold);
            background: linear-gradient(135deg, var(--cream) 0%, var(--light-gray) 100%);
            transform: translateX(5px);
        }
        
        .contact-link i {
            color: var(--primary-gold);
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--light-gray);
            color: var(--deep-blue);
            text-decoration: none;
            margin-right: 10px;
            transition: all 0.3s ease;
            font-size: 1.3rem;
        }
        
        .social-link:hover {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
            color: white;
            transform: translateY(-5px) rotate(5deg);
            box-shadow: 0 8px 20px rgba(201, 169, 97, 0.4);
        }
        
        .contact-form-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(27, 59, 95, 0.15);
            position: relative;
            height: 100%;
        }
        
        .contact-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--primary-gold-light), var(--primary-gold));
        }
        
        .contact-form-card h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
            position: relative;
        }
        
        .contact-form-card h5::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: var(--primary-gold);
        }
        
        .form-label {
            color: var(--deep-blue);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .form-label::before {
            content: '•';
            color: var(--primary-gold);
            margin-right: 8px;
            font-weight: bold;
        }
        
        .form-control {
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
            background: var(--warm-white);
        }
        
        textarea.form-control {
            resize: none;
        }
        
        .custom-bg {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%) !important;
            border: none !important;
            padding: 14px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(201, 169, 97, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .custom-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .custom-bg:hover::before {
            left: 100%;
        }
        
        .custom-bg:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%) !important;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(27, 59, 95, 0.5);
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
        
        .contact-info-card,
        .contact-form-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }
        
        .contact-form-card {
            animation-delay: 0.2s;
        }
        
        .decorative-dot {
            width: 8px;
            height: 8px;
            background: var(--primary-gold);
            border-radius: 50%;
            display: inline-block;
            margin: 0 8px;
        }
        
        @media (max-width: 991px) {
            .contact-form-card {
                margin-top: 30px;
            }
        }
    </style>
   
</head>

<body class="bg-light">

<?php require('user_components/header.php'); ?>

<!-- Hero Section -->
<div class="contact-hero">
    <div class="container">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line"></div>
    </div>
</div>

<div class="container my-5">
  <div class="row">
    <!-- Contact Information -->
    <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="contact-info-card p-4">
          <div class="map-container mb-4">
            <iframe class="w-100" height="320" src="<?php echo $contact_r['cd_iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          
          <h5>📍 Address</h5>
          <a href="<?php echo $contact_r['cd_map'] ?>" target="_blank" class="contact-link d-block text-decoration-none mb-3">
             <i class="bi bi-geo-alt-fill"></i> 
             <span><?php echo $contact_r['cd_address'] ?></span>
          </a>
          
          <h5>📞 Call Us</h5>
          <a href="tel: +<?php echo $contact_r['phone_no_1'] ?>" class="contact-link d-block text-decoration-none mb-2">
           <i class="bi bi-telephone-fill"></i>
           <span>+<?php echo $contact_r['phone_no_1'] ?></span>
          </a>

          <?php
            if($contact_r['phone_no_2']!='') {
              echo<<<data
                <a href="tel: +$contact_r[phone_no_2]" class="contact-link d-block text-decoration-none mb-3">
                <i class="bi bi-telephone-fill"></i>
                <span>+$contact_r[phone_no_2]</span>
                </a>
              data;
            } 
          ?>
          
          <h5>✉️ Email</h5>
          <a href="mailto:<?php echo $contact_r['cd_email'] ?>" class="contact-link d-block text-decoration-none mb-3">
             <i class="bi bi-envelope-fill"></i>
             <span><?php echo $contact_r['cd_email'] ?></span>
          </a>
          
          <h5>🌐 Follow Us</h5>
          <div class="d-flex align-items-center">
            <?php 
              if($contact_r['cd_tw']!=''){
                echo<<<data
                  <a href="$contact_r[cd_tw]" class="social-link" target="_blank" title="Twitter">
                  <i class="bi bi-twitter-x"></i>
                  </a>
                data;
              }
            ?>
            <a href="<?php echo $contact_r['cd_fb'] ?>" class="social-link" target="_blank" title="Facebook">
              <i class="bi bi-facebook"></i>
            </a>         
            <a href="<?php echo $contact_r['cd_insta'] ?>" class="social-link" target="_blank" title="Instagram">         
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </div>
    </div>
    
    <!-- Contact Form -->
    <div class="col-lg-6 col-md-6 px-4">
         <div class="contact-form-card p-4">
           <form method="POST">
              <h5>💬 Send a Message</h5>
              <div class="mt-3">
                    <label class="form-label">Name</label>
                    <input name="ur_name" type="text" class="form-control shadow-none" placeholder="Your full name" required>
              </div>
              <div class="mt-3">
                    <label class="form-label">Email</label>
                    <input name="ur_email" type="email" class="form-control shadow-none" placeholder="your.email@example.com" required>
              </div>
              <div class="mt-3">
                    <label class="form-label">Subject</label>
                    <input name="ur_subject" type="text" class="form-control shadow-none" placeholder="What is this regarding?" required>
              </div>
              <div class="mt-3">
                    <label class="form-label">Message</label>
                    <textarea name="ur_message" class="form-control shadow-none" rows="5" placeholder="Share your thoughts, questions, or feedback..." required></textarea>
              </div>
              <button type="submit" name="ur_send" class="btn text-white custom-bg mt-4 w-100">SEND MESSAGE</button>
           </form>
         </div>
      </div>
  </div>
</div>

<?php 
  if(isset($_POST['ur_send'])) {
    $form_data = filteration($_POST);

    $q = "INSERT INTO `user_reviews`(`ur_name`, `ur_email`, `ur_subject`, `ur_message`) VALUES (?,?,?,?)";
    $values = [$form_data['ur_name'],$form_data['ur_email'],$form_data['ur_subject'],$form_data['ur_message']];


    $res = insert($q,$values,'ssss');
    if($res==1) {
      alert('success','Review Sent!');
    }
    else {
      alert('error','Server Down!');
    }  
  }
?>
<?php require('user_components/footer.php'); ?>

</body>
</html>