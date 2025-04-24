<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Passenger Details - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #2ecc71;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #ffffff 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .dashboard-title {
            color: var(--secondary);
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin: 0;
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

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--secondary);
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">
                <i class="fas fa-users"></i> Passenger Management
            </h1>
            <p class="text-muted">View and manage passenger details</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <?php
                include 'connection.php';
                $total = mysqli_query($conn, "SELECT COUNT(*) as total FROM passengers");
                $count = mysqli_fetch_assoc($total)['total'];
                ?>
                <div class="stat-value"><?php echo $count; ?></div>
                <div class="stat-label">Total Passengers</div>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-birthday-cake"></i> Age</th>
                            <th><i class="fas fa-venus-mars"></i> Gender</th>
                            <th><i class="fas fa-plane"></i> Flight ID</th>
                            <th><i class="fas fa-ticket-alt"></i> PNR Number</th>
                            <th><i class="fas fa-cog"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM passengers ORDER BY name";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["age"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["gender"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["flightID"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["PNRNumber"]) . "</td>";
                            echo "<td class='actions'>";
                            echo "<button class='btn btn-primary btn-action' onclick='viewDetails(\"" . htmlspecialchars($row["PNRNumber"]) . "\")'><i class='fas fa-eye'></i></button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No passengers found</td></tr>";
                    }
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewDetails(pnr) {
            // Add your view details logic here
            alert('Viewing details for PNR: ' + pnr);
        }
    </script>
</body>
</html>