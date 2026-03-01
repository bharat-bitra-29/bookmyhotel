<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - About</title>

<style>
    .about-hero {
        background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }
    
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="2" x="0" y="0" fill="rgba(201,169,97,0.1)"/></svg>');
        opacity: 0.3;
    }
    
    .about-hero h2 {
        color: white;
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
    }
    
    .about-hero .h-line {
        background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
        height: 3px;
    }
    
    .about-hero p {
        color: var(--cream);
        font-size: 1.1rem;
        line-height: 1.8;
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    .stats-box {
        border-top: 4px solid var(--primary-gold) !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        background: white;
    }
    
    .stats-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.1), transparent);
        transition: left 0.6s ease;
    }
    
    .stats-box:hover::before {
        left: 100%;
    }
    
    .stats-box:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 20px 50px rgba(201, 169, 97, 0.25);
        border-top-color: var(--deep-blue) !important;
    }
    
    .stats-box img {
        filter: grayscale(20%);
        transition: all 0.3s ease;
    }
    
    .stats-box:hover img {
        filter: grayscale(0%);
        transform: scale(1.1) rotate(-5deg);
    }
    
    .stats-box h4 {
        color: var(--charcoal);
        font-weight: 600;
        font-size: 1.3rem;
    }
    
    .about-content {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        margin-top: -30px;
        position: relative;
        z-index: 2;
    }
    
    .about-content h3 {
        color: var(--deep-blue);
        font-weight: 700;
        font-size: 2rem;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }
    
    .about-content h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--primary-gold);
    }
    
    .about-content p {
        color: var(--charcoal);
        line-height: 1.8;
        font-size: 1.05rem;
    }
    
    .about-image {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(27, 59, 95, 0.2);
        position: relative;
    }
    
    .about-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 3px solid var(--primary-gold);
        border-radius: 16px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .about-image:hover::after {
        opacity: 1;
    }
    
    .about-image img {
        transition: transform 0.5s ease;
    }
    
    .about-image:hover img {
        transform: scale(1.05);
    }
    
    .team-section {
        background: linear-gradient(135deg, var(--light-gray) 0%, var(--cream) 100%);
        padding: 80px 0;
        margin-top: 60px;
        position: relative;
    }
    
    .team-section h3 {
        color: var(--deep-blue);
        font-size: 2.5rem;
        font-weight: 700;
        position: relative;
        display: inline-block;
        padding-bottom: 20px;
    }
    
    .team-section h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
    }
    
    .swiper-slide {
        transition: all 0.3s ease;
    }
    
    .team-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    
    .team-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-gold), var(--primary-gold-light));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .team-card:hover::before {
        transform: scaleX(1);
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(201, 169, 97, 0.3);
    }
    
    .team-card img {
        transition: all 0.5s ease;
        filter: grayscale(10%);
    }
    
    .team-card:hover img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }
    
    .team-card h5 {
        color: var(--deep-blue);
        font-weight: 600;
        padding: 20px;
        margin: 0;
        background: linear-gradient(180deg, white 0%, var(--cream) 100%);
    }
    
    /* Swiper Pagination */
    .swiper-pagination-bullet {
        background: var(--primary-gold);
        opacity: 0.5;
        width: 12px;
        height: 12px;
    }
    
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: var(--deep-blue);
        width: 30px;
        border-radius: 6px;
    }
    
    /* Stats Counter Animation */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stats-box {
        animation: countUp 0.6s ease-out backwards;
    }
    
    .stats-box:nth-child(1) { animation-delay: 0.1s; }
    .stats-box:nth-child(2) { animation-delay: 0.2s; }
    .stats-box:nth-child(3) { animation-delay: 0.3s; }
    .stats-box:nth-child(4) { animation-delay: 0.4s; }
    
    .decorative-dot {
        width: 8px;
        height: 8px;
        background: var(--primary-gold);
        border-radius: 50%;
        display: inline-block;
        margin: 0 5px;
    }
</style>

</head>

<body class="bg-light">

<?php require('user_components/header.php'); ?>

<!-- Hero Section -->
<div class="about-hero">
    <div class="container">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line"></div>
        <p class="text-center mt-4 px-3">
            <span class="decorative-dot"></span>
            Welcome to Novotel – Your Home Away From Home
            <span class="decorative-dot"></span>
            <br><br>
            At Novotel, we believe that a great stay begins with genuine hospitality, comfort, and personalized service. 
            Nestled in the heart of Vijayawada, our hotel offers the perfect blend of modern luxury and warm ambiance 
            for both business and leisure travelers.
        </p>
    </div>
</div>

<!-- About Content Section -->
<div class="container mt-5">
    <div class="row justify-content-between align-items-center about-content">
        <div class="col-lg-6 col-md-6 mb-4 order-lg-1 order-md-1 order-2">
            <h3 class="mb-4">Novotel</h3>
            <p>
                Experience seamless hospitality with our cutting-edge booking platform. We've revolutionized 
                the way you reserve your stay, making it easier than ever to secure your perfect accommodation.
            </p>
            <p class="mt-3">
                Our state-of-the-art facilities, combined with exceptional service, ensure every guest enjoys 
                a memorable experience. From luxurious rooms to world-class amenities, we're committed to 
                exceeding your expectations at every turn.
            </p>
        </div>
        <div class="col-lg-5 col-md-6 mb-4 order-lg-2 order-md-2 order-1">
            <div class="about-image">
                <img src="images/about/about.jpg" class="w-100" alt="Novotel Hotel">
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center stats-box">
                <img src="images/about/hotel.svg" width="70px" alt="Rooms">
                <h4 class="mt-3">100+ Rooms</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center stats-box">
                <img src="images/about/rating.svg" width="70px" alt="Reviews">
                <h4 class="mt-3">100+ Reviews</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center stats-box">
                <img src="images/about/customers.svg" width="70px" alt="Customers">
                <h4 class="mt-3">200+ Customers</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center stats-box">
                <img src="images/about/staff.svg" width="70px" alt="Staff">
                <h4 class="mt-3">150+ Staff</h4>
            </div>
        </div>
    </div>
</div>

<!-- Management Team Section -->
<div class="team-section">
    <div class="container">
        <h3 class="my-5 fw-bold h-font text-center">
            <span class="decorative-dot"></span>
            Management Team
            <span class="decorative-dot"></span>
        </h3>
        
        <div class="container px-4">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper mb-5">
                    <?php
                        $about_r = selectAll('management_team_details');
                        $path = ABOUT_IMG_PATH;

                        while($row = mysqli_fetch_assoc($about_r)) {
                            echo<<<data
                                <div class="swiper-slide">
                                    <div class="team-card">
                                        <img src="$path$row[picture]" class="w-100" alt="$row[name]">
                                        <h5>$row[name]</h5>
                                    </div>
                                </div>
                            data;
                        }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 40,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        }
    });
</script>

<?php require('user_components/footer.php'); ?>

</body>
</html>