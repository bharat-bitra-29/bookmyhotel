<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?>-Bookings</title>

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
        
        .booking-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-top: 4px solid var(--primary-gold);
            position: relative;
        }
        
        .booking-card::before {
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
        
        .booking-card:hover::before {
            opacity: 1;
        }
        
        .booking-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(201, 169, 97, 0.25);
        }
        
        .booking-card h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .booking-card p {
            color: var(--charcoal);
            margin-bottom: 10px;
            line-height: 1.6;
        }
        
        .booking-card b {
            color: var(--deep-blue);
            font-weight: 600;
        }
        
        .price-highlight {
            color: var(--primary-gold);
            font-size: 1.2rem;
            font-weight: 700;
        }
        
        .badge {
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 6px;
        }
        
        .bg-success {
            background: linear-gradient(135deg, var(--success) 0%, var(--accent-emerald) 100%) !important;
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
        }
        
        .bg-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #A00F1F 100%) !important;
            box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
        }
        
        .bg-warning {
            background: linear-gradient(135deg, var(--warning) 0%, #E67200 100%) !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(247, 127, 0, 0.3);
        }
        
        .bg-primary {
            background: linear-gradient(135deg, var(--info) 0%, #3A6B8A 100%) !important;
            box-shadow: 0 4px 12px rgba(69, 123, 157, 0.3);
        }
        
        /* Button Styling */
        .btn-dark {
            background: linear-gradient(135deg, var(--charcoal) 0%, var(--deep-blue) 100%);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.3);
        }
        
        .btn-dark:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 59, 95, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #A00F1F 100%);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #A00F1F 0%, #8B0D1A 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(193, 18, 31, 0.4);
        }
        
        .info-row {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .info-row p {
            margin-bottom: 5px;
        }
        
        .modal-content {
            border-radius: 12px;
            border: none;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }
        
        .modal-header .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .modal-header .modal-title i {
            color: var(--primary-gold);
        }
        
        .modal-header .btn-close {
            background: white;
            opacity: 1;
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }
        
        .modal-body {
            padding: 30px 25px;
        }
        
        .form-label {
            color: var(--deep-blue);
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-select,
        .form-control {
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-select:focus,
        .form-control:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
        }
        
        .custom-bg {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%) !important;
            border: none !important;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(201, 169, 97, 0.3);
        }
        
        .custom-bg:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(27, 59, 95, 0.4);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--charcoal);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--primary-gold);
            margin-bottom: 20px;
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
        
        .booking-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }
        
        .booking-card:nth-child(1) { animation-delay: 0.1s; }
        .booking-card:nth-child(2) { animation-delay: 0.2s; }
        .booking-card:nth-child(3) { animation-delay: 0.3s; }
        .booking-card:nth-child(4) { animation-delay: 0.4s; }
        .booking-card:nth-child(5) { animation-delay: 0.5s; }
        .booking-card:nth-child(6) { animation-delay: 0.6s; }
    </style>

</head>

<body class="bg-light">

    <?php 
    require('user_components/header.php');
    if(!(isset($_SESSION['user_login']) && $_SESSION['user_login'] == true)) {
            redirect('index.php');
        } 
    ?>

<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h-font">My Bookings</h2>
                <div class="breadcrumb-custom" style="font-size: 14px;">
                    <a href="index.php">Home</a>
                    <span> > </span>
                    <a href="bookings.php">Bookings</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
  <div class="row">

    <?php

    $query = "SELECT bo.* , bd.* FROM `booking_order` bo 
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
        WHERE ((bo.booking_status = 'booked') OR (bo.booking_status='cancelled'))
        AND (bo.user_id =?)
        ORDER BY bo.booking_id DESC";

    $result = select($query,[$_SESSION['U_Id']],'i');


    while($data = mysqli_fetch_assoc($result)) {
        $date = date("d-m-Y",strtotime($data['order_date']));
        $checkin = date("d-m-Y",strtotime($data['check_in']));
        $checkout = date("d-m-Y",strtotime($data['check_out']));

        $status_bg = "";
        $btn ="";

        if($data['booking_status'] == 'booked') {
            $status_bg = "bg-success";

            if($data['arrival']==1){
                $btn="<a type='button' href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
                if($data['rate_review'] == 0) {
                $btn .= "<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none ms-2'>Rate & Review</button>";
                }
            }
            else {
                $btn="<button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-danger btn-sm shadow-none'>Cancel</button>";                
            }
        }

        else if($data['booking_status'] == 'cancelled') {
            $status_bg = "bg-danger";

            if($data['refund'] == 0) {
                $btn="<span class='badge bg-primary'>Refund in Process</span>";
            } else {
                $btn="<a type='button' href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
            }
        }
        else {
            $status_bg = "bg-warning";
            $btn="<a type='button' href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
        }

        echo<<<bookings
            <div class='col-md-4 px-4 mb-4'>
                <div class='booking-card p-4'>
                    <h5>$data[room_name]</h5>
                    <p class='price-highlight'>₹$data[price] <span style='font-size: 0.9rem; color: var(--charcoal);'>per night</span></p>
                    
                    <div class='info-row'>
                        <p><b>Check In:</b> $checkin</p>
                        <p><b>Check Out:</b> $checkout</p>
                    </div>
                    
                    <div class='info-row'>
                        <p><b>Total Amount:</b> ₹$data[price]</p>
                        <p><b>Order ID:</b> $data[order_id]</p>
                        <p><b>Booking Date:</b> $date</p>
                    </div>
                    
                    <div class='mb-3'>
                        <span class='badge $status_bg'>$data[booking_status]</span>
                    </div>
                    
                    $btn
                </div>
            </div>
         bookings;
    }
    
    ?>
  </div>
</div>

<div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="review-form">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i>Rate & Review</h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="mb-3">
             <label class="form-label">Rating</label>
             <select class="form-select shadow-none" name="rating">
                <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                <option value="4">⭐⭐⭐⭐ Good</option>
                <option value="3">⭐⭐⭐ Ok</option>
                <option value="2">⭐⭐ Poor</option>
                <option value="1">⭐ Bad</option>
            </select>
          </div>
            <div class="mb-4">
             <label class="form-label">Review</label>
             <textarea name="review" type="text" rows="4" class="form-control shadow-none" placeholder="Share your experience with us..." required></textarea>
            </div>
            <input type="hidden" name="booking_id">
            <input type="hidden" name="room_id">

            <div class="text-end">
            <button type="submit" class="btn custom-bg text-white shadow-none">Submit Review</button>
            </div>
      </div>
      </form>
    </div>
  </div>
</div>

<?php

if(isset($_GET['cancel_status'])) {
    alert('success','Booking Cancelled');
}
else if(isset($_GET['review_status'])) {
    alert('success','Thank You for Rating!');
}

?>

<?php require('user_components/footer.php'); ?>

<script>
    function cancel_booking(id) {
        if(confirm('Are you sure to cancel booking?')){
            let xhr = new XMLHttpRequest();
        xhr.open("POST","user_ajax/cancel_booking.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function() {
            if(this.responseText == 1) {
                window.location.href = "bookings.php?cancel_status=true";
            }
            else {
                alert('error','Cancellation Failed!');
            }
        }
        xhr.send('cancel_booking&id='+id);
        }
    }


    let review_form = document.getElementById('review-form');

    function review_room(bid,rid) {
        review_form.elements['booking_id'].value = bid;
        review_form.elements['room_id'].value = rid;
    }

    review_form.addEventListener('submit',function(e){
        e.preventDefault();

        let data = new FormData();

        data.append('review_form','');
        data.append('rating',review_form.elements['rating'].value);
        data.append('review',review_form.elements['review'].value);
        data.append('booking_id',review_form.elements['booking_id'].value);
        data.append('room_id',review_form.elements['room_id'].value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST","user_ajax/review_room.php",true);

        xhr.onload = function() {

            if(this.responseText == 1){
                window.location.href = 'bookings.php?review_status=true';
            }
            else{
                var myModal = document.getElementById('reviewModal');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
    
                alert('error',"Rating and Review Failed");       
            }
        }
        xhr.send(data);
    })

</script>

</body>
</html>