<?php
include 'connection.php'; // Added missing semicolon

// Check if POST variables exist and set defaults if not
$dep_place = isset($_POST['from']) ? $_POST['from'] : '';
$des_place = isset($_POST['to']) ? $_POST['to'] : '';
$date = isset($_POST['depdate']) ? $_POST['depdate'] : '';

// Validate inputs
if (empty($dep_place) || empty($des_place) || empty($date)) {
    echo '<div class="flight">Please fill all required fields</div>';
    exit();
}

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM flights WHERE departure = ? AND destination = ? AND Date = ?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $dep_place, $des_place, $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="flight">';
            echo "<h2>FLIGHT DETAILS</h2>";
            echo '<pre>';
            echo '  Flight ID: <input type="text" value="'.htmlspecialchars($row['flightID']).'" readonly><br/><br>';
            echo '  Departure: <input type="text" value="'.htmlspecialchars($row['departure']).'" readonly><br><br>';
            echo 'Destination: <input type="text" value="'.htmlspecialchars($row['destination']).'" readonly><br><br>';
            echo '       Date: <input type="text" value="'.htmlspecialchars($row['Date']).'" readonly><br><br>';
            echo '       Time: <input type="text" value="'.htmlspecialchars($row['Time']).'" readonly><br><br>';
            echo '   Capacity: <input type="text" value="'.htmlspecialchars($row['Capacity']).'" readonly><br><br>';
            echo '      Price: <input type="text" value="'.htmlspecialchars($row['Price']).'" readonly><br><br>';
            echo '<a href="login.php">BOOK TICKETS</a>';
            echo '</pre>';
            echo '</div>';
        }
    } else {
        echo '<div class="flight">Sorry! No Flights available...</div>';
    }
    mysqli_stmt_close($stmt);
} else {
    echo '<div class="flight">Error executing query</div>';
}
?>