<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> Confirm Booking</title>
   
   <style>
        .page-header {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            padding: 40px 0;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(27, 59, 95, 0.2);
        }
        
        .page-header h2 {
            color: white;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-custom a {
            color: var(--cream);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .breadcrumb-custom a:hover {
            color: var(--primary-gold);
        }
        
        .breadcrumb-custom span {
            color: var(--cream);
            opacity: 0.7;
        }
        
        .room-preview-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(27, 59, 95, 0.15);
            border-top: 4px solid var(--primary-gold);
            transition: all 0.4s ease;
        }
        
        .room-preview-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(201, 169, 97, 0.25);
        }
        
        .room-preview-card img {
            transition: transform 0.5s ease;
            height: 300px;
            object-fit: cover;
        }
        
        .room-preview-card:hover img {
            transform: scale(1.05);
        }
        
        .room-preview-card h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        .room-preview-card h6 {
            color: var(--primary-gold);
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .booking-form-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(27, 59, 95, 0.15);
            border: none;
            position: relative;
        }
        
        .booking-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--primary-gold-light), var(--primary-gold));
        }
        
        .booking-form-card .card-body {
            padding: 30px;
        }
        
        .booking-form-card h6 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
            position: relative;
        }
        
        .booking-form-card h6::after {
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
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 45px;
        }
        
        input[type="date"] {
            position: relative;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: opacity(0.6);
        }
        
        input[type="date"]:hover::-webkit-calendar-picker-indicator {
            filter: opacity(1);
        }
        
        .info-message {
            background: linear-gradient(135deg, var(--light-gray) 0%, var(--cream) 100%);
            border-left: 4px solid var(--info);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .text-danger {
            color: var(--danger) !important;
            font-weight: 600;
        }
        
        .text-dark {
            color: var(--deep-blue) !important;
            font-weight: 600;
        }
        
        .spinner-border {
            width: 2rem;
            height: 2rem;
            border-width: 0.25em;
            color: var(--primary-gold) !important;
        }
        
        .custom-bg {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%) !important;
            border: none !important;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
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
        
        .custom-bg:not(:disabled):hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%) !important;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(27, 59, 95, 0.5);
        }
        
        .custom-bg:disabled {
            background: linear-gradient(135deg, var(--medium-gray) 0%, var(--light-gray) 100%) !important;
            cursor: not-allowed;
            box-shadow: none;
            opacity: 0.6;
        }
        
        #pay_info {
            background: white;
            border: 2px solid var(--medium-gray);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        #pay_info.text-dark {
            border-color: var(--success);
            background: linear-gradient(135deg, rgba(45, 106, 79, 0.05) 0%, rgba(45, 106, 79, 0.1) 100%);
        }
        
        #pay_info.text-danger {
            border-color: var(--danger);
            background: linear-gradient(135deg, rgba(193, 18, 31, 0.05) 0%, rgba(193, 18, 31, 0.1) 100%);
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
        
        .room-preview-card,
        .booking-form-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }
        
        .booking-form-card {
            animation-delay: 0.2s;
        }
        
        @media (max-width: 991px) {
            .room-preview-card {
                margin-bottom: 30px;
            }
        }
        
        .form-label::before {
            content: '•';
            color: var(--primary-gold);
            margin-right: 8px;
            font-weight: bold;
        }
   </style>

</head>

<body class="bg-light">

<?php require('user_components/header.php'); ?>

<?php

    if(!isset($_GET['id']) || $settings_r['shutdown'] == true ) {
        redirect('room.php');
    }
    else if(!(isset($_SESSION['user_login']) && $_SESSION['user_login'] == true)) {
        redirect('room.php');
    }

    // filter and get room data

    $data = filteration($_GET);
    
    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND  `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0) {
        redirect('room.php');
    }

    $roomdata = mysqli_fetch_assoc($room_res);

    $_SESSION['rooms'] = [
        "id" => $roomdata['id'],
        "name" => $roomdata['name'],
        "price" => $roomdata['price'],
        "payment" => null,
        "available" => false,
    ];

    $user_res = select("SELECT * FROM `user_details` WHERE `id`=? LIMIT 1",[$_SESSION['U_Id']],"i");
    $user_data = mysqli_fetch_assoc($user_res);


?>

<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h-font">Confirm Booking</h2>
                <div class="breadcrumb-custom" style="font-size: 14px;">
                    <a href="index.php">Home</a>
                    <span> > </span>
                    <a href="room.php">Rooms</a>
                    <span> > </span>
                    <a href="#">Confirm</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
  <div class="row">

    <div class="col-lg-7 col-md-12 px-4">
        <?php 
            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id` = '$roomdata[id]' AND `thumb` = '1'");


            if(mysqli_num_rows($thumb_q)>0) {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
            }

            echo <<<data

                <div class="room-preview-card p-4">
                    <img src="$room_thumb" class="img-fluid rounded mb-3 w-100">
                    <h5>$roomdata[name]</h5>
                    <h6>₹$roomdata[price] <span style="font-size: 1rem; color: var(--charcoal);">per night</span></h6>
                </div>

            data;
        ?>
    </div>

    <div class="col-lg-5 col-md-12 px-4">
        <div class="booking-form-card">
            <div class="card-body">
                <form action="book_now.php" method="POST" id="booking_form">
                    <h6>Booking Details</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input name="phone_num" type="number" value="<?php echo $user_data['phone_num']?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control shadow-none" rows="2" required><?php echo $user_data['address'] ?></textarea>                
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Check In</label>
                            <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Check Out</label>
                            <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                        </div>
                        <div class="col-12">
                            <div class="spinner-border mb-3 d-none" id="info_loader" role="status">
                             <span class="visually-hidden">Loading...</span>
                            </div>
                            <h6 class="text-danger" id="pay_info">📅 Provide check-in & check-out dates</h6>
                            <button name="pay_now" class="btn w-100 text-white custom-bg shadow-none" disabled>💳 Pay Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<?php require('user_components/footer.php'); ?>
<script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability() {

        let checkin_val = booking_form.elements['checkin'].value;
        let checkout_val = booking_form.elements['checkout'].value;
        booking_form.elements['pay_now'].setAttribute('disabled',true);

        if(checkin_val != '' && checkout_val != '') {

            pay_info.classList.add('d-none');
            pay_info.classList.replace('text-dark','text-danger');
            info_loader.classList.remove('d-none');

            let data = new FormData();

            data.append('check_availability','');
            data.append('check_in',checkin_val);
            data.append('check_out',checkout_val);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","user_ajax/confirm_booking.php",true);

            xhr.onload = function() {
                let data = JSON.parse(this.responseText);
                if(data.status =='check_in_out_equal') {
                    pay_info.innerText = "❌ You cannot check out on same day";
                }
                else if(data.status =='check_out_earlier') {
                    pay_info.innerText = "❌ Check out date earlier than check-in date";
                }
                else if(data.status =='check_in_earlier') {
                    pay_info.innerText = "❌ Check in date earlier than today's date";
                }
                else if(data.status =='unavailable') {
                    pay_info.innerText = "❌ Room not available for selected dates";
                }
                else {
                    pay_info.innerHTML = "✅ No. of Days: <strong>"+ data.days+"</strong><br>💰 Total Amount to Pay: <strong>₹"+data.payment+"</strong>";
                    pay_info.classList.replace('text-danger','text-dark');
                    booking_form.elements['pay_now'].removeAttribute('disabled');
                }

                pay_info.classList.remove('d-none');
                info_loader.classList.add('d-none');

            }
            xhr.send(data);
        }

    }
</script>

</body>
</html>