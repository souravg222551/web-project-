<?php
// session_start();
    include('session.php');
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Indian Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(rgba(250,250,250,0.35),rgba(250,250,250,0.35)), url(images/878630.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .sign_out {
            text-align: right;
            margin-bottom: 40px;
        }

        .sign_out a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            padding: 10px 20px;
            border: 2px solid #2c3e50;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sign_out a:hover {
            background: #2c3e50;
            color: white;
        }

        .my_form {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .city, input[type="text"], input[type="date"] {
            width: 100%;
            max-width: 400px;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background: white;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .city:focus, input[type="text"]:focus, input[type="date"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .book {
            background: #3498db;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 400px;
        }

        .book:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        pre {
            font-family: 'Poppins', sans-serif;
            white-space: pre-line;
        }
    </style>
</head>
<body>
    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if(!empty($_POST["num_of_tickets"]))
      {
        $_SESSION["departure"] = $_POST["dep_place"];
        $dep_place = $_SESSION["departure"];
        $_SESSION["destination"] = $_POST["des_place"];
        $des_place = $_SESSION["destination"];
        $_SESSION["date"] = $_POST["date"];
        $date = $_SESSION["date"];
        $_SESSION["payment"]=$_POST["payment"];
        $paymment= $_SESSION["payment"];
        $_SESSION["numOfPassengers"] = $_SESSION["number"] = (int)$_POST["num_of_tickets"];
        $_SESSION["couponcode"] = $_POST["couponcode"];
        $query = "select Capacity from flights where departure = '$dep_place' and destination = '$des_place' and Date = '$date' limit 1";
        $exec1= mysqli_query($conn, $query);
        $num_of_rows = mysqli_num_rows($exec1);

        if ($num_of_rows == 0) {
        $message = "No flight available";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else{
           $row = mysqli_fetch_assoc($exec1);
        
           $capacity = $row["Capacity"];

            if($capacity >= $_SESSION["number"])
           {
               header("Location: passDetails.php");
           }
           else{
              $message = "Booking full";
              echo "<script type='text/javascript'>alert('$message');</script>";
           } 
         }
      }
    }

     ?>
    <div class="container">
        <h1>Welcome <?php echo $login_session; ?></h1>
        <p class="sign_out"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></p>
        
        <form class="my_form" action="" method="post">
            <pre>
                <div class="form-group">
                    <label><i class="fas fa-plane-departure"></i> Enter departure:</label>
                    <select id="city" name="dep_place" class="city">
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
                    <label><i class="fas fa-plane-arrival"></i> Enter destination:</label>
                    <select id="city" name="des_place" class="city">
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
                    <label><i class="fas fa-calendar-alt"></i> Enter date:</label>
                    <input type="date" name="date">
                </div>

                <div class="form-group">
                    <label><i class="fas fa-users"></i> Enter number of tickets:</label>
                    <input type="text" name="num_of_tickets" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Enter coupon code:</label>
                    <select id="coupon" name="couponcode" class="city">
                        <option value="">--</option>
                        <option value="NEWUSER57">NEWUSER57</option>
                        <option value="STUD21">STUD21</option>
                        <option value="WED17">WED17</option>
                        <option value="OLDGOLD60">OLDGOLD60</option>
                        <option value="FAM42">FAM42</option>
                        <option value="FEMALE20">FEMALE20</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-credit-card"></i> Enter Payment Method:</label>
                    <select id="payment" name="payment" class="city">
                        <option value="CASH">CASH</option>
                        <option value="DEBIT CARD">DEBIT CARD</option>
                        <option value="CREDIT CARD">CREDIT CARD</option>
                        <option value="NET BANKING">NET BANKING</option>
                    </select>
                </div>

                <button class="book"><i class="fas fa-ticket-alt"></i> Book Tickets</button>
            </pre>
        </form>
    </div>
</body>
</html>