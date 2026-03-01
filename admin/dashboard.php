<?php 

    require('admin_components/essentials.php');
    require('admin_components/db_config.php');
    adminLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('admin_components/link.php');?>
    <link rel="stylesheet" href="admin_luxury_theme.css">
</head>
<body class="bg-light">

<?php 
    require('admin_components/header.php');
    $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `admin_settings`"));

    $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
    COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`,
    COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
    FROM `booking_order`"));

    $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sl_no) AS `count` FROM `user_reviews` 
    WHERE `ur_seen` = 0"));

    $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sl_no) AS `count` FROM `rating_review` 
    WHERE `seen` = 0"));

    $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT
    COUNT(id) AS `total`, 
    COUNT(CASE WHEN `status` = 1 THEN 1 END) AS `active`,
    COUNT(CASE WHEN `status` = 0 THEN 1 END) AS `inactive`,
    COUNT(CASE WHEN `is_verified` = 0 THEN 1 END) AS `unverified`
    FROM `user_details`"));
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3><i class="bi bi-speedometer2 me-2"></i>Dashboard</h3>
                <?php
                    if($is_shutdown['shutdown']) {
                        echo<<<data
                        <h6 class="badge bg-danger py-2 px-3 rounded"><i class="bi bi-exclamation-triangle me-2"></i>Shutdown mode is active!</h6>
                        data;
                    }            
                ?>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <a href="new_bookings.php" class="text-decoration-none">
                        <div class="card text-center text-success p-3">
                            <h6><i class="bi bi-calendar-check me-2"></i>New Bookings</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="refund_bookings.php" class="text-decoration-none">
                        <div class="card text-center text-warning p-3">
                            <h6><i class="bi bi-arrow-counterclockwise me-2"></i>Refund Bookings</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_bookings['refund_bookings'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="user_reviews.php" class="text-decoration-none">
                        <div class="card text-center text-info p-3">
                            <h6><i class="bi bi-chat-dots me-2"></i>User Reviews</h6>
                            <h1 class="mt-2 mb-0"><?php echo $unread_queries['count'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="rate_review.php" class="text-decoration-none">
                        <div class="card text-center text-info p-3">
                            <h6><i class="bi bi-star me-2"></i>Rating & Reviews</h6>
                            <h1 class="mt-2 mb-0"><?php echo $unread_reviews['count'] ?></h1>
                        </div>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5><i class="bi bi-graph-up me-2"></i>Booking Analytics</h5>
                <select class="form-select shadow-none bg-light w-auto" onchange="booking_analytics(this.value)">
                    <option value="1">Past 30 Days</option>
                    <option value="2">Past 90 Days</option>
                    <option value="3">Past 1 Year</option>
                    <option value="4">All time</option>
                </select>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-primary p-3">
                        <h6><i class="bi bi-clipboard-data me-2"></i>Total Bookings</h6>
                        <h1 class="mt-2 mb-0" id="total_bookings"></h1>
                        <h4 class="mt-2 mb-0" id="total_amt"></h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-success p-3">
                        <h6><i class="bi bi-check-circle me-2"></i>Active Bookings</h6>
                        <h1 class="mt-2 mb-0" id="active_bookings"></h1>
                        <h4 class="mt-2 mb-0" id="active_amt"></h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-primary p-3">
                        <h6><i class="bi bi-x-circle me-2"></i>Cancelled Bookings</h6>
                        <h1 class="mt-2 mb-0" id="cancelled_bookings"></h1>
                        <h4 class="mt-2 mb-0" id="cancelled_amt"></h4>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5><i class="bi bi-people me-2"></i>User, Queries & Reviews Analytics</h5>
                <select class="form-select shadow-none bg-light w-auto" onchange="user_analytics(this.value)">
                    <option value="1">Past 30 Days</option>
                    <option value="2">Past 90 Days</option>
                    <option value="3">Past 1 Year</option>
                    <option value="4">All time</option>
                </select>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-success p-3">
                        <h6><i class="bi bi-person-plus me-2"></i>New Registration</h6>
                        <h1 class="mt-2 mb-0" id="total_new_reg"></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-primary p-3">
                        <h6><i class="bi bi-chat-left-text me-2"></i>Queries</h6>
                        <h1 class="mt-2 mb-0" id="total_queries"></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-primary p-3">
                        <h6><i class="bi bi-star-fill me-2"></i>Reviews</h6>
                        <h1 class="mt-2 mb-0" id="total_reviews"></h1>
                    </div>
                </div>
            </div>

            <h5><i class="bi bi-people-fill me-2"></i>Users</h5>
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-info p-3">
                        <h6><i class="bi bi-collection me-2"></i>Total</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-success p-3">
                        <h6><i class="bi bi-check2-circle me-2"></i>Active</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['active'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-warning p-3">
                        <h6><i class="bi bi-pause-circle me-2"></i>Inactive</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['inactive'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center text-danger p-3">
                        <h6><i class="bi bi-shield-exclamation me-2"></i>Unverified</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['unverified'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('admin_components/scripts.php')?>
<script src="admin_scripts/dashboard.js"></script>
     
</body>
</html>