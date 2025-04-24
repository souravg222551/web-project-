<?php
include 'connection.php';

// Use prepared statement for security
$stmt = mysqli_prepare($conn, "SELECT * FROM booking WHERE flightID = ?");
mysqli_stmt_bind_param($stmt, "s", $_POST['flightID']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num_of_rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Indian Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #2ecc71;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url(images/408134.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            padding: 40px 0;
            color: var(--dark);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .details-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .card-title {
            color: var(--secondary);
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin: 0;
            background: white;
        }

        .table thead th {
            background: var(--primary);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px;
            border: none;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #f0f0f0;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .no-bookings {
            text-align: center;
            padding: 40px;
            color: var(--secondary);
            font-size: 18px;
        }

        .price-column {
            font-weight: 500;
            color: var(--primary);
        }

        .btn-back {
            background: var(--primary);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="details-card">
            <?php if ($num_of_rows >= 1): ?>
                <h2 class="card-title">
                    <i class="fas fa-ticket-alt"></i>
                    Booking Details
                </h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> Booking ID</th>
                                <th><i class="fas fa-user"></i> Username</th>
                                <th><i class="fas fa-ticket-alt"></i> Tickets</th>
                                <th><i class="fas fa-money-bill-wave"></i> Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['BookingID']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_of_tickets']); ?></td>
                                    <td class="price-column">₹<?php echo number_format($row['price']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-bookings">
                    <i class="fas fa-exclamation-circle"></i>
                    No bookings found for this flight
                </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="profile.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>