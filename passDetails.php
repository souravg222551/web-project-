<?php
 session_start();
 if (!(isset($_SESSION["numOfPassengers"])))
{
         die("There was an error");
}

if($_SESSION["numOfPassengers"] == 0)
{
    header("Location: finalprice.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Passenger Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(rgba(50,50,50,0.2), rgba(50,50,50,0.2)), url(images/flight2.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .pass {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-row {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .radio-group {
            display: flex;
            gap: 30px;
            padding: 5px 0;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn {
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
            margin-top: 10px;
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        label {
            font-weight: 500;
            color: #2c3e50;
            display: inline-block;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <form action="passenger.php" method="post" class="pass">
        <div class="form-group">
            <label class="form-label">Name</label>
            <div class="form-row">
                <input type="text" name="name" required placeholder="Enter full name">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Age</label>
            <div class="form-row">
                <input type="text" name="age" required placeholder="Enter age">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Gender</label>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="gender" value="male" required>
                    <span>Male</span>
                </label>
                <label class="radio-label">
                    <input type="radio" name="gender" value="Female">
                    <span>Female</span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Contact</label>
            <div class="form-row">
                <input type="text" name="contact" required placeholder="Enter contact number">
            </div>
        </div>

        <button type="submit" name="submit" class="btn">CONFIRM</button>
    </form>
</body>
</html>



