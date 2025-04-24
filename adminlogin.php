<?php
   include("connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myadminname = $_POST["adminname"];
      $mypassword = $_POST["password"];
      
      $sql = "SELECT AdminName FROM admin WHERE AdminName = '$myadminname' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) {
         $_SESSION['login_user'] = $myadminname;
         
         header("location: profile.php");
      }else {
         $error = "Your Admin Name or Password is invalid";
         echo "<script type='text/javascript'>alert('$error');</script>"; 
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Indian Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2ECC71;
            --secondary: #D0D3D4;
            --dark: #2c3e50;
            --light: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)), url(images/408200.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .brand {
            color: var(--secondary);
            font-size: 45px;
            font-weight: 600;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            color: var(--secondary);
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links .active {
            color: var(--primary);
            text-decoration: underline;
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .form-title {
            color: var(--secondary);
            font-size: 22px;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: var(--secondary);
            font-size: 16px;
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255,255,255,0.9);
            border: none;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.3);
        }

        .btn {
            background: var(--primary);
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .form-container {
                margin: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="brand">Indian Airlines</a>
        <div class="nav-links">
            <a href="homepage.html">Home</a>
            <a href="offers.html">Offers</a>
            <a href="pnr.html">View Tickets</a>
            <a href="login.php">User Login</a>
            <a href="#" class="active">Admin</a>
        </div>
    </nav>

    <div class="form-container">
        <h2 class="form-title">
            <i class="fas fa-user-shield"></i>
            Admin Login
        </h2>
        <form action="" method="post">
            <div class="form-group">
                <label class="form-label" for="adminname">Username</label>
                <input type="text" class="form-control" id="adminname" name="adminname" placeholder="Enter username" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
    </div>
</body>
</html>