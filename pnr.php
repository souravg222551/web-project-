<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boarding Pass - Indian Airlines</title>
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
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(images/943246.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--light);
            padding: 40px 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .brand {
            text-align: center;
            margin-bottom: 40px;
        }

        .brand-name {
            font-size: 48px;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 30px;
            margin-bottom: 30px;
        }

        .card-title {
            color: var(--primary);
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table {
            color: var(--light);
            border-radius: 10px;
            overflow: hidden;
            margin: 0;
        }

        .table th {
            background: rgba(52, 152, 219, 0.2);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px;
            border: none;
        }

        .table td {
            padding: 15px;
            border-color: rgba(255, 255, 255, 0.1);
            vertical-align: middle;
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
            border: none;
            margin: 5px;
        }

        .btn-print {
            background: var(--primary);
            color: white;
        }

        .btn-home {
            background: var(--success);
            color: white;
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
            .btn {
                display: none;
            }
            .card {
                background: white;
                border: 1px solid #ddd;
            }
            .table {
                color: black;
            }
            .table th {
                background: #f8f9fa;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">
            <h1 class="brand-name">Indian Airlines</h1>
        </div>

        <div class="card">
            <h2 class="card-title">
                <i class="fas fa-ticket-alt"></i>
                Boarding Pass Details
            </h2>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-birthday-cake"></i> Age</th>
                            <th><i class="fas fa-venus-mars"></i> Gender</th>
                            <th><i class="fas fa-plane"></i> Flight ID</th>
                            <th><i class="fas fa-hashtag"></i> PNR Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connection.php';
                        
                        $pnr = mysqli_real_escape_string($conn, $_POST['pnrnum']);
                        $stmt = mysqli_prepare($conn, "SELECT * FROM passengers WHERE PNRNumber = ?");
                        mysqli_stmt_bind_param($stmt, "s", $pnr);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["age"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["gender"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["flightID"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["PNRNumber"]) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<script>
                                alert('Invalid PNR Number');
                                window.location.href='pnr.html';
                            </script>";
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Print Ticket
            </button>
            <a href="homepage.html" class="btn btn-home">
                <i class="fas fa-home"></i> Homepage
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>