<?php
include 'connection.php';
include('session1.php');

// Use prepared statements for delete operation
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $flightID = mysqli_real_escape_string($conn, $_POST["flightID"]);
    $stmt = mysqli_prepare($conn, "DELETE FROM flights WHERE flightID = ?");
    mysqli_stmt_bind_param($stmt, "s", $flightID);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "Flight deleted successfully";
    } else {
        $message = "Error deleting flight";
    }
    echo "<script type='text/javascript'>alert('$message');</script>";
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Jarvis Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url(images/878630.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            padding: 20px;
            color: var(--secondary-color);
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text {
            font-size: 24px;
            font-weight: 600;
        }

        .sign-out {
            text-decoration: none;
            color: var(--danger-color);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23666' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="welcome-text">
                <i class="fas fa-user-shield"></i> Welcome, <?php echo htmlspecialchars($login_session); ?>
            </div>
            <a href="logout1.php" class="sign-out">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </a>
        </div>

        <!-- Add Flight Form -->
        <div class="card">
            <h2 class="card-title"><i class="fas fa-plane-departure"></i> Add New Flight</h2>
            <form action="addflight.php" method="post">
                <div class="form-group">
                    <label class="form-label">Flight ID:</label>
                    <input type="text" name="flightID" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Departure:</label>
                    <select name="dep_place" class="form-control">
                        <option value="">--</option>
                        <option value="Bangalore">Bangalore</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Chennai">Chennai</option>
                        <option value="Goa">Goa</option>
                        <option value="Kolkata">Kolkata</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Destination:</label>
                    <select name="des_place" class="form-control">
                        <option value="">--</option>
                        <option value="Bangalore">Bangalore</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Chennai">Chennai</option>
                        <option value="Goa">Goa</option>
                        <option value="Kolkata">Kolkata</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Date:</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Time:</label>
                    <input type="time" name="time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Arrival Date:</label>
                    <input type="date" name="Adate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Arrival Time:</label>
                    <input type="time" name="Atime" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity:</label>
                    <input type="text" name="capacity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Price:</label>
                    <input type="text" name="price" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Flight</button>
            </form>
        </div>

        <!-- Update Flight Form -->
        <div class="card">
            <h2 class="card-title"><i class="fas fa-edit"></i> Update Flight</h2>
            <form method="post" action="update.php">
                <div class="form-group">
                    <label class="form-label">Flight ID:</label>
                    <input type="text" name="flightID" class="form-control" required>
                </div>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </form>
        </div>

        <!-- Check Bookings Form -->
        <div class="card">
            <h2 class="card-title"><i class="fas fa-ticket-alt"></i> Check Bookings</h2>
            <form method="post" action="details.php">
                <div class="form-group">
                    <label class="form-label">Flight ID:</label>
                    <input type="text" name="flightID" class="form-control" required>
                </div>
                <button type="submit" name="checkbook" class="btn btn-primary">Check Booking</button>
            </form>
        </div>

        <!-- Delete Flight Form -->
        <div class="card">
            <h2 class="card-title"><i class="fas fa-trash-alt"></i> Delete Flight</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label class="form-label">Flight ID:</label>
                    <input type="text" name="flightID" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <script>
        // Add any JavaScript enhancements here
    </script>
</body>
</html>