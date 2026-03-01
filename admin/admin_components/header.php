<!-- Header -->
<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top headercolor">
    <h3 class="mb-0 h-font">
        <i class="bi bi-building" style="color: var(--admin-gold);"></i> Novotel Admin
    </h3>
    <a href="logout.php" class="btn btn-light btn-sm">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
    </a>
</div>

<!-- Sidebar -->
<div class="col-lg-2 bg-dark border-top border-3 border-secondary bgcolor-sidebar" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light">
                <i class="bi bi-speedometer2"></i> Admin Panel
            </h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#bookinglinks">
                            <span><i class="bi bi-calendar-check me-2"></i> Bookings</span>
                            <span><i class="bi bi-caret-down"></i></span>
                        </button>
                        <div class="collapse show px-3 small mb-1" id="bookinglinks">
                            <ul class="nav nav-pills flex-column rounded border border-secondary">
                                
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="new_bookings.php">
                                        <i class="bi bi-bell me-2"></i> New Bookings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="refund_bookings.php">
                                        <i class="bi bi-cash-coin me-2"></i> Refund Bookings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="booking_records.php">
                                        <i class="bi bi-archive me-2"></i> Booking Records
                                    </a>
                                </li>
                                
                            </ul>
                        
                        </div>

                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">
                            <i class="bi bi-people me-2"></i> Users
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="user_reviews.php">
                            <i class="bi bi-chat-dots me-2"></i> User Reviews
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rate_review.php">
                            <i class="bi bi-star me-2"></i> Ratings and Reviews
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rooms.php">
                            <i class="bi bi-door-open me-2"></i> Rooms
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="features_facilities.php">
                            <i class="bi bi-gear me-2"></i> Features and Facilities
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="carousel.php">
                            <i class="bi bi-images me-2"></i> Carousel
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">
                            <i class="bi bi-sliders me-2"></i> Settings
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="admin_reports.php">
                            <i class="bi bi-file-earmark-text me-2"></i> Download Reports
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>