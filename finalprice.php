<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Summary - Indian Airlines</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --success: #2ecc71;
            --light: #f8f9fa;
            --dark: #2c3e50;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(images/408193.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }

        .price-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .booking-title {
            color: var(--light);
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .flight-details {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .price-amount {
            font-size: 48px;
            font-weight: 600;
            color: var(--success);
            margin: 30px 0;
        }

        .btn-confirm {
            background: var(--success);
            color: white;
            padding: 15px 40px;
            border-radius: 10px;
            border: none;
            font-size: 18px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: auto;
            min-width: 200px;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }

        .discount-badge {
            background: var(--primary);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    include 'connection.php';
    session_start();
    
    $departure = $_SESSION["departure"];
    $destination = $_SESSION["destination"];
    $date = $_SESSION["date"];
    $contact = $_SESSION["contact"];
    
    // Get flight price
    $query = "SELECT Price FROM flights WHERE departure = ? AND destination = ? AND Date = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $departure, $destination, $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $newprice = $row["Price"];
    
    // Calculate discount
    $coupon = $_SESSION["couponcode"];
    $rs1 = mysqli_query($conn, "CALL Discount('$newprice','$coupon',@final)");
    $rs = mysqli_query($conn, 'SELECT @final as final');
    $row1 = mysqli_fetch_array($rs);
    $finalprice = $row1['final'];
    
    $_SESSION["finalprice"] = $finalprice;
    $_SESSION["contact"] = $contact;
    ?>

    <div class="container">
        <div class="price-card">
            <h1 class="booking-title">
                <i class="fas fa-check-circle"></i>
                Booking Summary
            </h1>

            <div class="flight-details">
                <div class="detail-item">
                    <span><i class="fas fa-plane-departure"></i> From</span>
                    <span><?php echo htmlspecialchars($departure); ?></span>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-plane-arrival"></i> To</span>
                    <span><?php echo htmlspecialchars($destination); ?></span>
                </div>
                <div class="detail-item">
                    <span><i class="fas fa-calendar-alt"></i> Date</span>
                    <span><?php echo htmlspecialchars($date); ?></span>
                </div>
            </div>

            <?php if($finalprice < $newprice): ?>
                <div class="discount-badge">
                    <i class="fas fa-tag"></i> Discount Applied
                </div>
            <?php endif; ?>

            <div class="price-amount">
                ₹<?php echo number_format($finalprice); ?>
            </div>

            <form action="bookingConfirmed.php" method="post">
                <button type="submit" class="btn-confirm">
                    <i class="fas fa-lock"></i> Confirm Booking
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
