<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Confirmed - Indian Airlines</title>
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
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(images/bookconf.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--light);
            padding: 40px 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .confirmation-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .confirmation-title {
            font-size: 32px;
            font-weight: 600;
            color: var(--success);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .table {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow: hidden;
            margin: 30px 0;
            color: var(--light);
        }

        .table th {
            background: rgba(52, 152, 219, 0.2);
            padding: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }

        .table td {
            padding: 15px;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 10px;
        }

        .btn-success {
            background: var(--success);
            color: white;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        @media print {
            body {
                background: white;
                color: black;
            }
            .confirmation-card {
                background: white;
                border: 1px solid #ddd;
            }
            .table {
                color: black;
            }
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php
    include 'session.php';
    include 'connection.php';

    $departure = $_SESSION["departure"];
    $destination = $_SESSION["destination"];
    $date =  $_SESSION["date"];
    $contact = $_SESSION["contact"];
    $num = $_SESSION["number"];
    $price =  $_SESSION["finalprice"];
    $today = date('Y-m-d');
    $payment = $_SESSION["payment"];

    $query = "select flightID from flights where departure ='$departure' and destination = '$destination' and Date = '$date' limit 1";
    $exec1 = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($exec1);
    $FlightID = $row["flightID"];

    $query1 = "insert into booking (username, flightID, no_of_tickets, price) values('$login_session', '$FlightID', '$num', '$price')";
    $exec2 = mysqli_query($conn, $query1);

    $query2 = "select BookingID from booking where username='$login_session' and flightID='$FlightID' limit 1";
    $exec3 = mysqli_query($conn, $query2);
    $row1 = mysqli_fetch_assoc($exec3);
    $bookid = $row1["BookingID"];

    $query3 = "insert into transactions (BookingID, booking_date, amount, paymentMethod) values('$bookid', '$today', '$price', '$payment')";
    $exec4 = mysqli_query($conn, $query3);

    $proc = "call procedure1('$FlightID', '$contact')";
    $result = mysqli_query($conn, $proc);
    ?>

    <div class="container">
        <div class="confirmation-card">
            <h1 class="confirmation-title">
                <i class="fas fa-check-circle"></i>
                Booking Confirmed
            </h1>
            
            <?php if ($exec2 && $exec4): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> PNR Number</th>
                                <th><i class="fas fa-user"></i> Name</th>
                                <th><i class="fas fa-plane"></i> Flight ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['PNRNumber']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['flightID']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="buttons">
                    <button class="btn btn-success" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Ticket
                    </button>
                    <a href="welcome.php" class="btn btn-primary">
                        <i class="fas fa-home"></i> Back to Dashboard
                    </a>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    There was an error processing your booking
                </div>
                <a href="welcome.php" class="btn btn-primary">
                    <i class="fas fa-redo"></i> Try Again
                </a>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
