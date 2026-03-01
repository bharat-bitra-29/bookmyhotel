<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Facilities</title>
   
   <style>
        .facilities-hero {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        .facilities-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="2" x="0" y="0" fill="rgba(201,169,97,0.1)"/></svg>');
            opacity: 0.3;
        }
        
        .facilities-hero h2 {
            color: white;
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }
        
        .facilities-hero .h-line {
            background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
            height: 3px;
            position: relative;
            z-index: 1;
        }
        
        .facilities-hero .h-line::before {
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
        
        .facility-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--primary-gold);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            height: 100%;
        }
        
        .facility-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary-gold), var(--primary-gold-dark));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .facility-card:hover::before {
            opacity: 1;
        }
        
        .facility-card:hover {
            border-top-color: var(--deep-blue);
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(201, 169, 97, 0.25);
        }
        
        .facility-icon-wrapper {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--light-gray) 0%, var(--cream) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            position: relative;
        }
        
        .facility-card:hover .facility-icon-wrapper {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 8px 20px rgba(201, 169, 97, 0.4);
        }
        
        .facility-icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid var(--primary-gold);
            border-radius: 50%;
            opacity: 0;
            animation: pulse 2s ease-out infinite;
        }
        
        .facility-card:hover .facility-icon-wrapper::after {
            opacity: 1;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }
            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }
        
        .facility-icon-wrapper img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            filter: grayscale(20%);
            transition: all 0.3s ease;
        }
        
        .facility-card:hover .facility-icon-wrapper img {
            filter: grayscale(0%) brightness(1.2);
        }
        
        .facility-card h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
            transition: all 0.3s ease;
        }
        
        .facility-card:hover h5 {
            color: var(--primary-gold);
        }
        
        .facility-card p {
            color: var(--charcoal);
            line-height: 1.7;
            margin: 0;
            font-size: 0.95rem;
        }
        
        .facility-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
            position: relative;
        }
        
        .facility-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.4s ease;
        }
        
        .facility-card:hover .facility-header::after {
            width: 60px;
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
        
        .facility-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }
        
        .facility-card:nth-child(1) { animation-delay: 0.1s; }
        .facility-card:nth-child(2) { animation-delay: 0.2s; }
        .facility-card:nth-child(3) { animation-delay: 0.3s; }
        .facility-card:nth-child(4) { animation-delay: 0.4s; }
        .facility-card:nth-child(5) { animation-delay: 0.5s; }
        .facility-card:nth-child(6) { animation-delay: 0.6s; }
        .facility-card:nth-child(7) { animation-delay: 0.7s; }
        .facility-card:nth-child(8) { animation-delay: 0.8s; }
        .facility-card:nth-child(9) { animation-delay: 0.9s; }
        
        .premium-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease;
        }
        
        .facility-card:hover .premium-badge {
            opacity: 1;
            transform: translateX(0);
        }
        
        .facilities-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        @media (max-width: 768px) {
            .facilities-hero h2 {
                font-size: 2.2rem;
            }
            
            .facility-card {
                margin-bottom: 30px;
            }
        }
   </style>

</head>

<body class="bg-light">

<?php require('user_components/header.php'); ?>

<div class="facilities-hero">
    <div class="container">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line"></div>
    </div>
</div>

<!-- Facilities Grid -->
<div class="container facilities-container">
  <div class="row">

  <?php 

  $res = selectAll(('hotel_facilities'));
  $path = FACILITIES_IMG_PATH;

  while($row = mysqli_fetch_assoc($res)){
    echo<<<data

      <div class="col-lg-4 col-md-6 mb-5 px-4">
          <div class="facility-card p-4">
            <span class="premium-badge">PREMIUM</span>
            <div class="facility-header">
              <div class="facility-icon-wrapper">
                <img src="$path$row[icon]" alt="$row[name]">
              </div>
              <h5 class="ms-3">$row[name]</h5>
            </div>
            <p>$row[description]</p>
          </div>
      </div>

    data;
  }
  ?>

  </div>
</div>

<?php require('user_components/footer.php'); ?>

</body>
</html>