<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('user_components/link.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Rooms</title>
   
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

        .page-title-section {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            padding: 50px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(27, 59, 95, 0.2);
        }

        .page-title-section h2 {
            color: white;
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0;
            text-align: center;
        }

        .h-line {
            width: 100px;
            height: 3px;
            background: var(--primary-gold) !important;
            margin: 15px auto;
        }

        .filter-sidebar {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-gold);
            overflow: hidden;
            position: sticky;
            top: 80px;
            animation: fadeInLeft 0.6s ease-out;
        }

        .filter-sidebar h4 {
            color: var(--deep-blue);
            font-weight: 700;
            padding: 20px 20px 15px;
            margin: 0;
            border-bottom: 2px solid var(--light-gray);
            background: linear-gradient(135deg, var(--light-gray) 0%, white 100%);
        }

        .filter-section {
            border: 2px solid var(--medium-gray);
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .filter-section:hover {
            border-color: var(--primary-gold-light);
            box-shadow: 0 5px 15px rgba(201, 169, 97, 0.2);
        }

        .filter-section h5 {
            color: var(--deep-blue);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .filter-section label {
            color: var(--charcoal);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .filter-section .form-control {
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            padding: 10px 12px;
            transition: all 0.3s ease;
        }

        .filter-section .form-control:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
        }

        .filter-section .form-check-input {
            border: 2px solid var(--medium-gray);
            border-radius: 4px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .filter-section .form-check-input:checked {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
        }

        .filter-section .form-check-label {
            color: var(--charcoal);
            font-weight: 500;
            cursor: pointer;
            margin-left: 5px;
        }

        .btn-reset {
            color: var(--primary-gold);
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            background: transparent;
            border: 1px solid var(--primary-gold);
        }

        .btn-reset:hover {
            background: var(--primary-gold);
            color: white;
        }

        .spinner-border.text-info {
            color: var(--primary-gold) !important;
            width: 3rem;
            height: 3rem;
        }

        #rooms-data {
            animation: fadeInRight 0.6s ease-out;
        }

        @media screen and (max-width: 991px) {
            .filter-sidebar {
                position: relative;
                top: 0;
                margin-bottom: 30px;
            }

            .page-title-section h2 {
                font-size: 2rem;
            }
        }

        @media screen and (max-width: 768px) {
            .page-title-section {
                padding: 40px 20px;
            }

            .page-title-section h2 {
                font-size: 1.7rem;
            }

            .filter-section {
                padding: 15px;
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .navbar-toggler {
            border: 2px solid var(--primary-gold);
            padding: 8px 12px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
        }
    </style>

</head>

<body class="bg-light">

<?php 
require('user_components/header.php');
    $checkin_default ="";
    $checkout_default ="";
    $adult_default ="";
    $children_default ="";

if(isset($_GET['check_availability'])){
    $form_data = filteration($_GET);

    $checkin_default =$form_data['checkin'];
    $checkout_default =$form_data['checkout'];
    $adult_default = $form_data['adult'];
    $children_default = $form_data['children'];

}
?>

<div class="page-title-section">
    <h2 class="h-font">Our Rooms</h2>
    <div class="h-line bg-dark"></div>
</div>

<div class="container-fluid">
  <div class="row">
        <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
            <nav class="navbar navbar-expand-lg navbar-light filter-sidebar">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <h4 class="mt-2">Filters</h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                       <div class="filter-section">
                            <h5 class="d-flex align-items-center justify-content-between mb-3">
                                <span>Check Availability</span>
                                <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn btn-sm btn-reset d-none">Reset</button>
                            </h5>
                            <label class="from-label">Check-in</label>
                            <input type="date" class="form-control shodow-none mb-3" value="<?php echo $checkin_default ?>" id="checkin" onchange="chk_avail_filter()">
                            <label class="from-label">Check-out</label>
                            <input type="date" class="form-control shodow-none" value="<?php echo $checkout_default ?>" id="checkout" onchange="chk_avail_filter()">
                       </div>

                       <div class="filter-section">
                            <h5 class="d-flex align-items-center justify-content-between mb-3">
                                <span>Facilities</span>
                                <button id="facilities_btn" onclick="facilities_clear()" class="btn btn-sm btn-reset d-none">Reset</button>
                            </h5>
                            <?php

                            $facilities_q = selectAll('hotel_facilities');
                            while($row = mysqli_fetch_assoc($facilities_q)) {
                                echo<<<facilities
                                    <div class="mb-2">
                                        <input type="checkbox" onclick="fetch_rooms()" name="facilities" value="$row[id]" class="form-check-input shodow-none me-1" id="$row[id]">
                                        <label class="from-check-label" for="$row[id]" >$row[name]</label>
                                    </div>
                                facilities;
                            }
                            ?>
                       </div>

                       <div class="filter-section">
                            <h5 class="d-flex align-items-center justify-content-between mb-3">
                                <span>Guests</span>
                                <button id="guests_btn" onclick="guests_clear()" class="btn btn-sm btn-reset d-none">Reset</button>
                            </h5>
                            <div class="d-flex">
                                <div class="me-3">
                                    <label class="from-label">Adults</label>
                                    <input type="number" min="1" id="adults" value="<?php echo $adult_default ?>" oninput="guests_filter()" class="form-control shodow-none" >
                                </div>
                                <div>
                                    <label class="from-label">Children</label>
                                    <input type="number" min="1" id="children" value="<?php echo $children_default ?>" oninput="guests_filter()" class="form-control shodow-none" >
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-lg-9 col-md-12 px-4" id="rooms-data" >
            
        </div> 
  </div>
</div>

<script>
    let rooms_data = document.getElementById('rooms-data');

    let checkin = document.getElementById('checkin');
    let checkout = document.getElementById('checkout');
    let chk_avail_btn = document.getElementById('chk_avail_btn');

    let adults = document.getElementById('adults');
    let children = document.getElementById('children');
    let guests_btn = document.getElementById('guests_btn');

    let facilities_btn = document.getElementById('facilities_btn');
    


    function fetch_rooms() {

        let chk_avail = JSON.stringify({
            checkin: checkin.value,
            checkout: checkout.value
        });

        let guests = JSON.stringify({
            adults: adults.value,
            children: children.value
        });

        let facility_list = {"facilities":[]};

        let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
        if(get_facilities.length>0) {
            get_facilities.forEach((facility)=>{
                facility_list.facilities.push(facility.value);
            });

            facilities_btn.classList.remove('d-none');
        }

        else {
            facilities_btn.classList.add('d-none');
        }

        facility_list = JSON.stringify(facility_list);

        let xhr = new XMLHttpRequest();
        xhr.open("GET","user_ajax/rooms.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests+"&facility_list="+facility_list,true);


        xhr.onprogress = function() {

            rooms_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto " id="loader" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>`;


        }

        xhr.onload = function() {
            rooms_data.innerHTML = this.responseText;

        }

        xhr.send();
    }

    function chk_avail_filter() {
        if(checkin.value != '' && checkout.value != '') {
            fetch_rooms();
            chk_avail_btn.classList.remove('d-none');
        }
    }

    function chk_avail_clear() {
        checkin.value = '';
        checkout.value = '';
        chk_avail_btn.classList.add('d-none');
        fetch_rooms();
        
    }


    function guests_filter(){
        if(adults.value > 0 || children.value > 0) {
            fetch_rooms();
            guests_btn.classList.remove('d-none');
        }
    }
    
    function guests_clear(){
        adults.value = '';
        children.value = '';
        guests_btn.classList.add('d-none');
        fetch_rooms();
    }

    function facilities_clear(){
        let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
        get_facilities.forEach((facility)=>{
            facility.checked =false;
        });

        facilities_btn.classList.add('d-none');
        fetch_rooms();
    }

    window.onload = function() {
        fetch_rooms();
    }
    


</script>



<?php require('user_components/footer.php'); ?>

</body>
</html>