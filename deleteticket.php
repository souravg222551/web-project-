<?php

 include 'connection.php';

  $pnr = $_POST['cancel'];
  $query = "delete from passengers where PNRNumber = '$pnr'";
  $exec = mysqli_query($conn, $query);

  if($exec)
    echo "<center><font size=14>"."Ticket Cancelled"."</font></center>";
  else
    echo "<center><font size=14>"."Ticket Could Not Be Cancelled"."</font></center>"
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
 
  <title>Cancel flight</title>
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
    p{
      width: 100%;
      text-align: center;
      font-size: 30px;
      font-weight: bold;

    }
    .btn {
        background: none;
        padding: 6px 10px 6px 10px;
      height: 35px;
      border: 1px solid black;
      font-size: 15px;
      font-weight: bold;
      }
  </style>
</head>
<body>
       <br/>
       <a href="homepage.html" >
      <center> <button class="btn">Back</button></center>
      </a>

</body>
</html>