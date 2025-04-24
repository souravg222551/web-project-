<?php
include 'connection.php';

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
$query = "SELECT * FROM flights WHERE departure = ? AND destination = ? AND Date = ? ORDER BY Price ASC";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $dep_place, $des_place, $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<p>FLIGHT DETAILS</p>";
        echo '<table>';
        echo '<tr><th>Flight ID</th>';
        echo '<th>Departure</th>';
        echo '<th>Destination</th>';
        echo '<th>Date</th>';
        echo '<th>Time</th>';
        echo '<th>Arrival Date</th>';
        echo '<th>Arrival Time</th>';
        echo '<th>Price</th>';
        echo '</tr>';
        
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'.htmlspecialchars($row['flightID']).'</td>';
            echo '<td>'.htmlspecialchars($row['departure']).'</td>';
            echo '<td>'.htmlspecialchars($row['destination']).'</td>';
            echo '<td>'.htmlspecialchars($row['Date']).'</td>';
            echo '<td>'.htmlspecialchars($row['Time']).'</td>';
            echo '<td>'.htmlspecialchars($row['ARRDATE']).'</td>';
            echo '<td>'.htmlspecialchars($row['ARRTIME']).'</td>';
            echo '<td>'.htmlspecialchars($row['Price']).'</td>';
            echo '<td><a href="login.php">BOOK TICKETS</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<div class="flight">Sorry! No Flights available...</div>';
    }
    mysqli_stmt_close($stmt);
} else {
    echo '<div class="flight">Error executing query</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
 
	<style>
		*{
			font-family: Lato;
		}
		body{
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-image:linear-gradient(rgba(250,250,250,0.6),rgba(250,250,250,0.6)) ,url(images/408134.jpg);
		}
		.flight{
			text-align: center;
	
		}
		td{
			border:0.2px solid black;
			padding: 10px;
		}
		table{
			padding: 5px;
			width: 70%;
			text-align: center;
			

		}
		input[type=text]{
			font-size: 20px;
			width: 250px;
			height: 30px;
			border: 0.5px solid black;
			border-radius: 2px;
		}
		a{
			text-decoration:none;
			font-size: 20px;
			color: black;
			border:2px solid #16404F;
			border-radius: 2px;
			padding:5px 10px;
			
		}
		p{
			width: 100%;
			text-align: center;
			font-size: 30px;
			font-weight: bold;

		}
		
	</style>
</head>
<body>

</body>
</html>