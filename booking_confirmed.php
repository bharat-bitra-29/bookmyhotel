<?php
require('user_components/link.php');
require('user_components/header.php');

if (!isset($_GET['order_id'])) {
    redirect('room.php');
}

$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>

    <style>
        .success-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        
        .success-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(27, 59, 95, 0.15);
            max-width: 600px;
            width: 100%;
            position: relative;
        }
        
        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-gold), var(--primary-gold-light), var(--primary-gold));
        }
        
        .success-header {
            background: linear-gradient(135deg, var(--cream) 0%, var(--light-gray) 100%);
            padding: 40px;
            text-align: center;
            position: relative;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--success) 0%, var(--accent-emerald) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.3);
            animation: successPop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .success-icon::before {
            content: '✓';
            color: white;
            font-size: 48px;
            font-weight: bold;
            line-height: 1;
        }
        
        .success-icon::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid var(--success);
            border-radius: 50%;
            animation: ripple 1.5s ease-out infinite;
            opacity: 0.5;
        }
        
        @keyframes successPop {
            0% {
                transform: scale(0) rotate(-180deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.1) rotate(10deg);
            }
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }
        
        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }
            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }
        
        .success-card h3 {
            color: var(--success);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            animation: fadeInUp 0.6s ease-out 0.2s backwards;
        }
        
        .success-body {
            padding: 40px;
            text-align: center;
        }
        
        .booking-id-wrapper {
            background: linear-gradient(135deg, var(--light-gray) 0%, var(--cream) 100%);
            border-left: 4px solid var(--primary-gold);
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
            animation: fadeInUp 0.6s ease-out 0.4s backwards;
        }
        
        .booking-id-label {
            color: var(--charcoal);
            font-size: 0.95rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        
        .booking-id-value {
            color: var(--deep-blue);
            font-size: 1.8rem;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }
        
        .success-message {
            color: var(--charcoal);
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out 0.6s backwards;
        }
        
        .btn-back {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
            color: white;
            border: 2px solid var(--primary-gold);
            padding: 14px 40px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(201, 169, 97, 0.3);
            animation: fadeInUp 0.6s ease-out 0.8s backwards;
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
            border-color: var(--deep-blue);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(27, 59, 95, 0.4);
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
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--primary-gold);
            animation: confetti-fall 3s ease-out infinite;
        }
        
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin: 25px 0;
            animation: fadeInUp 0.6s ease-out 0.5s backwards;
        }
        
        .info-item {
            background: white;
            border: 2px solid var(--medium-gray);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            border-color: var(--primary-gold);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(201, 169, 97, 0.2);
        }
        
        .info-item-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }
        
        .info-item-label {
            font-size: 0.85rem;
            color: var(--charcoal);
            font-weight: 500;
        }
    </style>

</head>
<body class="bg-light">
    <div class="success-container">
        <div class="container">
            <div class="success-card">
                <div class="success-header">
                    <div class="success-icon"></div>
                    <h3>Booking Confirmed!</h3>
                </div>
                
                <div class="success-body">
                    <p class="success-message">
                        Thank you for choosing Novotel! Your reservation has been successfully confirmed. 
                        We look forward to welcoming you and ensuring you have a wonderful stay.
                    </p>
                    
                    <div class="booking-id-wrapper">
                        <div class="booking-id-label">Your Booking ID</div>
                        <div class="booking-id-value"><?php echo $order_id; ?></div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-icon">📧</div>
                            <div class="info-item-label">Confirmation Email Sent</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">📱</div>
                            <div class="info-item-label">SMS Notification</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">🎫</div>
                            <div class="info-item-label">E-Ticket Ready</div>
                        </div>
                    </div>
                    
                    <p style="color: var(--charcoal); font-size: 0.95rem; margin: 20px 0;">
                        Please save your booking ID for future reference. You can view your booking details anytime.
                    </p>
                    
                    <a href="bookings.php" class="btn-back">View My Bookings</a>
                </div>
            </div>
        </div>
    </div>
    
<?php require('user_components/footer.php'); ?>
</body>
</html>