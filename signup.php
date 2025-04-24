<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]); // Direct password storage
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    // Check if user exists
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $message = ["type" => "error", "text" => "User or email already exists"];
    } else {
        // Insert new user with plain password
        $query = "INSERT INTO users (username, password, Fname, Lname, Contact, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $username, $password, $firstname, $lastname, $contact, $email);
        
        if (mysqli_stmt_execute($stmt)) {
            $message = ["type" => "success", "text" => "Account created successfully!"];
        } else {
            $message = ["type" => "error", "text" => "Error creating account"];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Indian Airlines</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(images/hello.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .form-title {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
            outline: none;
        }

        .btn {
            background: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .links a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($message)): ?>
            <div class="message <?php echo $message['type']; ?>">
                <?php echo $message['text']; ?>
            </div>
        <?php endif; ?>

        <h1 class="form-title">Create Account</h1>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="firstname"><i class="fas fa-user-circle"></i> First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="lastname"><i class="fas fa-user-circle"></i> Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="contact"><i class="fas fa-phone"></i> Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn">Sign Up</button>
        </form>

        <div class="links">
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> Already have an account? Login</a>
            <a href="homepage.html"><i class="fas fa-home"></i> Back to Home</a>
        </div>
    </div>
</body>
</html>