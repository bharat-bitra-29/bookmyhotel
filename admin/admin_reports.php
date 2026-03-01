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
  <title>Generate Reports - Novotel Admin</title>
  <?php require('admin_components/link.php'); ?>
  <style>
    .report-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
      border-top: 4px solid var(--admin-gold);
      transition: all 0.3s ease;
    }
    
    .report-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(201, 169, 97, 0.2);
    }
    
    .report-header {
      background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
      color: white;
      padding: 20px 25px;
      border-radius: 12px 12px 0 0;
      margin: -1px -1px 25px -1px;
    }
    
    .report-header h4 {
      color: white;
      margin: 0;
      font-weight: 700;
      display: flex;
      align-items: center;
    }
    
    .report-header i {
      color: var(--admin-gold);
      margin-right: 12px;
      font-size: 1.5rem;
    }
    
    .form-label {
      color: var(--admin-primary);
      font-weight: 600;
      margin-bottom: 8px;
    }
    
    .form-label::before {
      content: '•';
      color: var(--admin-gold);
      margin-right: 8px;
      font-weight: bold;
    }
    
    .download-btn {
      background: linear-gradient(135deg, var(--admin-gold) 0%, var(--admin-gold-dark) 100%);
      border: none;
      padding: 12px 35px;
      border-radius: 8px;
      font-weight: 700;
      font-size: 1.05rem;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(201, 169, 97, 0.3);
    }
    
    .download-btn:hover {
      background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-dark) 100%);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(27, 59, 95, 0.4);
    }
    
    .info-box {
      background: linear-gradient(135deg, rgba(201, 169, 97, 0.1) 0%, rgba(201, 169, 97, 0.05) 100%);
      border-left: 4px solid var(--admin-gold);
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 25px;
    }
    
    .info-box p {
      margin: 0;
      color: var(--admin-primary);
      font-weight: 500;
    }
    
    .info-box i {
      color: var(--admin-gold);
      margin-right: 10px;
    }
  </style>
</head>
<body class="bg-light">
<?php require('admin_components/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          
          <div class="report-card">
            <div class="report-header">
              <h4>
                <i class="bi bi-file-earmark-bar-graph"></i>
                Download Booking Reports
              </h4>
            </div>
            
            <div class="card-body p-4">
              <div class="info-box">
                <p>
                  <i class="bi bi-info-circle-fill"></i>
                  Generate comprehensive booking reports by selecting a date range and optional filters below.
                </p>
              </div>
              
              <form method="POST" action="generate_report.php">
                <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                    <label class="form-label">From Date</label>
                    <input type="date" name="from_date" required class="form-control shadow-none">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">To Date</label>
                    <input type="date" name="to_date" required class="form-control shadow-none">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Room Type (optional)</label>
                    <input type="text" name="room_type" class="form-control shadow-none" placeholder="Ex: Deluxe, Suite">
                  </div>
                </div>
                
                <div class="text-center mt-4">
                  <button class="btn text-white download-btn" name="generate_report">
                    <i class="bi bi-download me-2"></i> Download Report
                  </button>
                </div>
              </form>
            </div>
          </div>
          
        </div>
    </div>
</div>

<?php require('admin_components/scripts.php'); ?>
</body>
</html>