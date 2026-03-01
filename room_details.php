<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Rooms Details</title>
   
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

        .page-header-section {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(27, 59, 95, 0.2);
        }

        .page-header-section h2 {
            margin: 0;
            font-weight: 700;
            font-size: 2rem;
            color: white;
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

        #room_carousel {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(27, 59, 95, 0.2);
            margin-bottom: 20px;
        }

        #room_carousel .carousel-inner {
            border-radius: 16px;
        }

        #room_carousel .carousel-item img {
            height: 450px;
            object-fit: cover;
            border-radius: 16px;
        }

        @media screen and (max-width: 768px) {
            #room_carousel .carousel-item img {
                height: 300px;
            }
        }

        .room-details-card {
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-gold);
            overflow: hidden;
            position: relative;
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .room-details-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--primary-gold-light), var(--primary-gold));
        }

        .room-details-card .card-body {
            padding: 30px;
        }

        .room-details-card h4 {
            color: var(--primary-gold);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .room-details-card h6 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 10px;
            position: relative;
            padding-bottom: 8px;
        }

        .room-details-card h6::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-gold);
        }

        .rating-container {
            margin-bottom: 20px;
        }

        .bi-star-fill.text-warning {
            color: var(--primary-gold) !important;
            font-size: 1.1rem;
        }

        .badge.bg-light {
            background: linear-gradient(135deg, var(--light-gray) 0%, #E9ECEF 100%) !important;
            color: var(--charcoal) !important;
            border: 1px solid var(--medium-gray);
            padding: 8px 14px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .badge.bg-light:hover {
            background: linear-gradient(135deg, var(--primary-gold-light) 0%, var(--primary-gold) 100%) !important;
            color: white !important;
            border-color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .custom-bg {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%) !important;
            border: none;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(201, 169, 97, 0.3);
        }

        .custom-bg:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%) !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(27, 59, 95, 0.4);
        }

        .custom-bg:active {
            transform: translateY(-1px);
        }

        .description-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-top: 3px solid var(--primary-gold);
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out 0.1s backwards;
        }

        .description-section h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 12px;
        }

        .description-section h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary-gold);
        }

        .description-section p {
            color: var(--charcoal);
            line-height: 1.8;
            font-size: 1rem;
        }

        .reviews-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-top: 3px solid var(--primary-gold);
            animation: fadeInUp 0.6s ease-out 0.2s backwards;
        }

        .reviews-section h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 12px;
        }

        .reviews-section h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background: var(--primary-gold);
        }

        .review-card {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--primary-gold);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .review-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(201, 169, 97, 0.2);
            border-left-color: var(--deep-blue);
        }

        .review-card h6 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .review-card p {
            color: var(--charcoal);
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .review-stars {
            margin-top: 10px;
        }

        .no-reviews {
            text-align: center;
            padding: 40px 20px;
            color: var(--charcoal);
            font-size: 1.1rem;
            font-style: italic;
        }

        .info-section {
            margin-bottom: 25px;
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
            .page-header-section {
                padding: 30px 20px;
            }

            .page-header-section h2 {
                font-size: 1.5rem;
            }

            .room-details-card .card-body,
            .description-section,
            .reviews-section {
                padding: 20px;
            }
        }
   </style>

</head>

<body class="bg-light">

<?php require('user_components/header.php'); ?>

<?php 

    if(!isset($_GET['id'])) {
        redirect('room.php');
    }


    $data = filteration($_GET);
    
    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND  `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0) {
        redirect('room.php');
    }

    $roomdata = mysqli_fetch_assoc($room_res);


?>

<div class="container-fluid page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?php echo $roomdata['name'] ?></h2>
                <div class="breadcrumb-custom">
                    <a href="index.php">HOME</a>
                    <span> > </span>
                    <a href="room.php">ROOMS</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">

    <div class="col-lg-7 col-md-12 px-4">
        <div id="room_carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                    $room_img = ROOMS_IMG_PATH."thumbnail.jpg";
                    $img_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id` = '$roomdata[id]'");


                    if(mysqli_num_rows($img_q)>0) {
                        $active_class = 'active';

                        while($img_res = mysqli_fetch_assoc($img_q)) {

                            echo "
                            <div class='carousel-item $active_class'>
                            <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                            </div>";
                            $active_class = '';
                        }
                    }
                    else {
                        echo "
                        <div class='carousel-item active'>
                        <img src='$room_img' class='d-block w-100'>
                        </div>";
                    }
                
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#room_carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#room_carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 room-details-card">
            <div class="card-body">
                <?php 
                
                echo<<<price
                    <h4>₹$roomdata[price] per night </h4>
price;

                $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
                WHERE `room_id` = '$roomdata[id]' ORDER BY `sl_no` DESC LIMIT 20 
                ";

                $rating_res = mysqli_query($con,$rating_q);
                $rating_fetch = mysqli_fetch_assoc($rating_res);

                $rating_data = "";

                if($rating_fetch['avg_rating'] != NULL) {

                    for($i=0; $i < $rating_fetch['avg_rating']; $i++) {
                    $rating_data .= " <i class='bi bi-star-fill text-warning'></i>";
                    }
                } 

                echo <<< rating
                <div class="mb-3 rating-container">
                  $rating_data
                </div>
rating;


                $fea_q = mysqli_query($con,"SELECT f.name FROM `hotel_features` f 
                            INNER JOIN `room_features` rf ON f.id = rf.features_id
                            WHERE rf.room_id = '$roomdata[id]'");

                $features_data = "";

                while($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        $fea_row[name]
                    </span>";
                }

                echo <<< features
                    <div class="mb-3 info-section">
                        <h6 class="mb-2">Features</h6>
                        $features_data 
                    </div>
features;



                $fac_q = mysqli_query($con,"SELECT f.name FROM `hotel_facilities` f
                            INNER JOIN `room_facilities` rfa ON f.id = rfa.facilities_id
                            WHERE rfa.room_id = '$roomdata[id]'");

                $facilities_data = "";

                while($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        $fac_row[name]
                    </span>";

                }

                echo <<< facilities
                    <div class="mb-3 info-section">
                        <h6 class="mb-2">Facilities</h6>
                        $facilities_data 
                    </div>
facilities;


                echo <<< guests

                    <div class="mb-3 info-section">
                        <h6 class="mb-2">Guest</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            $roomdata[adult] Adults
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            $roomdata[children] Children
                        </span>
                    </div>
guests;


                echo <<< area
                <div class="mb-3 info-section">
                    <h6 class="mb-2">Area</h6>
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        $roomdata[area] sq. ft. 
                    </span>
                </div>
area;

                if(!$settings_r['shutdown']) {  
                    $login = 0;
                if(isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
                    $login = 1;
                }
                    echo <<< book
                        <button onclick='checkLogintoBook($login,$roomdata[id])' class="btn w-100 text-white custom-bg shadow-none mb-1">Book Now </button>
                    book;
                }             
                ?>

            </div>
        </div>
    </div>
        
        <div class="col-12 mt-4 px-4">
            <div class="description-section">
                <h5>Description</h5>
                <p>
                    <?php echo $roomdata['description'] ?>
                </p>
            </div>

            <div class="reviews-section">
                <h5>Reviews & Ratings</h5>
                <?php

                $review_q = "SELECT rr.*,ud.name AS uname,r.name AS rname FROM `rating_review` rr
                      INNER JOIN `user_details` ud ON rr.user_id = ud.id
                      INNER JOIN `rooms` r ON rr.room_id = r.id
                      WHERE rr.room_id = '$roomdata[id]'
                      ORDER BY `sl_no` DESC LIMIT 15";

                $review_res = mysqli_query($con,$review_q);

                if(mysqli_num_rows($review_res) == 0) {
                echo '<div class="no-reviews">No reviews yet!</div>';
                }
                else {
                while($row = mysqli_fetch_assoc($review_res)) {
                    $stars = "<i class='bi bi-star-fill text-warning'></i>";
                    for($i = 1; $i<$row['rating']; $i++){
                    $stars .= "<i class='bi bi-star-fill text-warning'></i>";
                    }

                echo<<<reviews
                    <div class="review-card">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="m-0">$row[uname]</h6>  
                        </div>
                        <p class="mb-1">
                            $row[review]
                        </p>
                        <div class="review-stars">
                            $stars
                        </div>
                    </div>
                    reviews;
                    }
                }
                ?>            
            </div>
        </div> 
  </div>
</div>

<?php require('user_components/footer.php'); ?>

</body>
</html>