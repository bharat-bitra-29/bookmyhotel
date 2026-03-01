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
    <title>Booking Records - Novotel Admin</title>
    <?php require('admin_components/link.php')?>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    
    <style>
        .page-header {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(27, 59, 95, 0.2);
        }
        
        .page-header h3 {
            color: white;
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .page-header i {
            color: var(--admin-gold);
            margin-right: 12px;
            font-size: 1.8rem;
        }
        
        .records-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--admin-gold);
        }
        
        .view-toggle-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .btn-view-toggle {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 25px;
        }
        
        .search-container input {
            max-width: 300px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .search-container input:focus {
            border-color: var(--admin-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
        }
        
        #calendar-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
        }
        
        .table thead th {
            color: white;
            font-weight: 600;
            padding: 15px;
            border: none;
            white-space: nowrap;
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(201, 169, 97, 0.05) 0%, rgba(201, 169, 97, 0.1) 100%);
            transform: scale(1.01);
        }
        
        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 2px;
        }
        
        .pagination {
            justify-content: center;
            margin-top: 25px;
        }
        
        .pagination .page-link {
            color: var(--admin-primary);
            border: 2px solid var(--border-color);
            padding: 8px 15px;
            margin: 0 3px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .pagination .page-link:hover {
            background: var(--admin-gold);
            color: white;
            border-color: var(--admin-gold);
            transform: translateY(-2px);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--admin-gold) 0%, var(--admin-gold-dark) 100%);
            border-color: var(--admin-gold);
        }
        
        /* FullCalendar Custom Styling */
        .fc {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .fc-toolbar-title {
            color: var(--admin-primary) !important;
            font-weight: 700;
        }
        
        .fc-button-primary {
            background: linear-gradient(135deg, var(--admin-gold) 0%, var(--admin-gold-dark) 100%) !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 8px 16px !important;
            font-weight: 600 !important;
        }
        
        .fc-button-primary:hover {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%) !important;
        }
        
        .fc-button-primary:disabled {
            opacity: 0.5;
        }
        
        .fc-event {
            background: linear-gradient(135deg, var(--admin-gold) 0%, var(--admin-gold-dark) 100%) !important;
            border: none !important;
            border-radius: 4px !important;
            padding: 4px 8px !important;
        }
        
        .fc-event:hover {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%) !important;
        }
        
        .fc-daygrid-day-number {
            color: var(--admin-primary);
            font-weight: 600;
        }
        
        .fc-col-header-cell {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
            color: white !important;
        }
        
        .fc-scrollgrid {
            border-color: var(--border-color) !important;
        }
        
        .fc-day-today {
            background: linear-gradient(135deg, rgba(201, 169, 97, 0.1) 0%, rgba(201, 169, 97, 0.05) 100%) !important;
        }
    </style>

</head>
<body class="bg-light">

<?php require('admin_components/header.php')?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            
            <div class="page-header">
                <h3>
                    <i class="bi bi-archive"></i>
                    Booking Records
                </h3>
            </div>

            <!-- Main Card -->
            <div class="records-card border-0 shadow mb-4">
                <div class="card-body p-4">
                    
                    <!-- View Toggle Buttons -->
                    <div class="view-toggle-container">
                        <button class="btn btn-outline-primary btn-sm btn-view-toggle shadow-none" onclick="showCalendar()">
                            <i class="bi bi-calendar3 me-1"></i> Calendar View
                        </button>
                        <button class="btn btn-outline-secondary btn-sm btn-view-toggle shadow-none" onclick="showTable()">
                            <i class="bi bi-table me-1"></i> Table View
                        </button>
                    </div>

                    <!-- Calendar Container -->
                    <div id="calendar-container" style="display:none;">
                        <div id="calendar"></div>
                    </div>

                    <!-- Search -->
                    <div class="search-container">   
                        <input type="text" id="search_input" oninput="get_bookings(this.value)" class="form-control shadow-none" placeholder="🔍 Search bookings...">
                    </div>
                    
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Room Details</th>
                                    <th scope="col">Booking Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-data">
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination mt-2" id="table-pagination">
                            
                        </ul>
                    </nav>

                </div>                
            </div>          
        </div>
    </div>
</div>

<?php require('admin_components/scripts.php')?>
<script src="admin_scripts/booking_records.js"></script>
<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

</body>
</html>