<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Your Seat - Indian Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #ffffff 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .seat-map {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .flight-info {
            background: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .flight-info i {
            margin-right: 10px;
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }

        td {
            position: relative;
            padding: 0 !important;
            width: 60px;
            height: 60px;
        }

        .seat-checkbox {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .seat-label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: #e8f5e9;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #2c3e50;
            border: 2px solid #81c784;
        }

        .seat-checkbox:checked + .seat-label {
            background: #ef5350;
            color: white;
            border-color: #e53935;
            transform: scale(0.95);
        }

        .seat-checkbox:disabled + .seat-label {
            background: #eceff1;
            border-color: #cfd8dc;
            color: #90a4ae;
            cursor: not-allowed;
        }

        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .legend-box {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .btn-submit {
            background: #3498db;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 200px;
        }

        .btn-submit:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .heading {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .heading h1 {
            font-size: 28px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Select Your Seat</h1>
        </div>

        <?php
        include('connection.php');
        $date1 = $_POST["date1"];
        $source = $_POST["source"];
        $dest = $_POST["dest"];

        $q1 = mysqli_query($conn, "select r_id from route where source = '$source' and dest = '$dest';");
        $ex1 = mysqli_fetch_array($q1);
        $num = mysqli_num_rows($q1);
        if ($num == 1) {
            $route = $ex1['r_id'];
        } else {
            echo "<script>
            alert('No routes available');
            window.location.href='home.php';
            </script>";
            exit;
        }

        $q2 = mysqli_query($conn, "select s_id from reserve where r_id = $route and date = '$date1';");
        $q3 = mysqli_query($conn, "SELECT s_id, 'green' color from seat WHERE s_id NOT IN (SELECT s_id from reserve WHERE date='$date1') UNION SELECT s_id, 'red' FROM reserve WHERE date='$date1'");
        $num1 = mysqli_num_rows($q2);
        $num4 = mysqli_num_rows($q3);
        $q4 = mysqli_query($conn, "select s_id from seat;");

        if ($num4 == 0) {
            echo "<script>
            alert('No seats available');
            window.location.href='home.php';
            </script>";
            exit;
        }
        ?>

        <div class="flight-info">
            <div class="row">
                <div class="col-md-6">
                    <p><i class="fas fa-plane-departure"></i> From: <?php echo htmlspecialchars($source); ?></p>
                    <p><i class="fas fa-plane-arrival"></i> To: <?php echo htmlspecialchars($dest); ?></p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-calendar-alt"></i> Date: <?php echo htmlspecialchars($date1); ?></p>
                    <p><i class="fas fa-route"></i> Route ID: <?php echo htmlspecialchars($route); ?></p>
                </div>
            </div>
        </div>

        <div class="seat-map">
            <div class="seat-legend">
                <div class="legend-item">
                    <div class="legend-box" style="background: #e8f5e9; border: 2px solid #81c784;"></div>
                    <span>Available</span>
                </div>
                <div class="legend-item">
                    <div class="legend-box" style="background: #ef5350; border: 2px solid #e53935;"></div>
                    <span>Selected</span>
                </div>
                <div class="legend-item">
                    <div class="legend-box" style="background: #eceff1; border: 2px solid #cfd8dc;"></div>
                    <span>Booked</span>
                </div>
            </div>

            <form method="post" action="details.php">
                <table>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($q3)) {
                        $id = $row['s_id'];
                        $color = $row['color'];
                        if ($i % 3 == 0) echo '<tr>';
                        echo '<td>';
                        if ($color == 'green') {
                            echo '<input type="checkbox" class="seat-checkbox" value="' . htmlspecialchars($id) . '" onclick="checkbox(this)" name="seat[]" id="seat' . htmlspecialchars($id) . '">';
                            echo '<label class="seat-label" for="seat' . htmlspecialchars($id) . '">' . htmlspecialchars($id) . '</label>';
                        } else {
                            echo '<input type="checkbox" class="seat-checkbox" value="' . htmlspecialchars($id) . '" disabled>';
                            echo '<label class="seat-label" style="background: #eceff1; border-color: #cfd8dc; color: #90a4ae;">' . htmlspecialchars($id) . '</label>';
                        }
                        echo '</td>';
                        if ($i % 3 == 2) echo '</tr>';
                        $i++;
                    }
                    ?>
                </table>
                <div class="text-center mt-4">
                    <input type="hidden" name="rot" value="<?php echo htmlspecialchars($route); ?>">
                    <input type="hidden" name="day" value="<?php echo htmlspecialchars($date1); ?>">
                    <input type="hidden" name="source" value="<?php echo htmlspecialchars($source); ?>">
                    <input type="hidden" name="dest" value="<?php echo htmlspecialchars($dest); ?>">
                    <button type="submit" class="btn-submit" name="submit">
                        <i class="fas fa-check-circle"></i> Confirm Selection
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkbox(result) {
            const label = result.nextElementSibling;
            if (result.checked) {
                label.style.backgroundColor = "#ef5350";
                label.style.borderColor = "#e53935";
                label.style.color = "white";
            } else {
                label.style.backgroundColor = "#e8f5e9";
                label.style.borderColor = "#81c784";
                label.style.color = "#2c3e50";
            }
        }
    </script>
</body>
</html>