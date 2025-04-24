<?php

 include 'connection.php';

if(isset($_POST['submit']))

 { 
  $flightID = $_POST['flightID'];
  $departure = $_POST['departure'];
  $destination = $_POST['dest'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $arr =  $_POST['arr'];
  $arrtime =  $_POST['arrtime'];
  $capacity = $_POST['capacity'];
  $price = $_POST['price'];
  
  


  $query = "update flights set departure = '$departure', destination = '$destination' , Date = '$date' , Time = '$time' ,ARRDATE = '$arr',  ARRTIME = '$arrtime' , Capacity = '$capacity' , Price = '$price' where flightID='$flightID'";
  $exec = mysqli_query($conn, $query);


  if($exec)
  {
  $query1 = "select * from flights where flightID='$flightID'";
  $exec1 = mysqli_query($conn, $query1);

  $num_of_rows = mysqli_num_rows($exec1);
  if ($num_of_rows>=1) {
  	echo "<p>UPDATED</p>";
		echo '<table>';
		echo '<tr><th>FLIGHTID</th>';
		echo '<th>DEPARTURE</th>';
		echo '<th>DESTINATION</th>';
		echo '<th>DATE</th>';
	    echo '<th>TIME</th>';
      echo '<th>ARRIVAL</th>';
       echo '<th>ARRIVAL TIME</th>';
	    echo '<th>CAPACITY</th>';
       echo '<th>PRICE</th>';

		echo '</tr>';
		while($row=mysqli_fetch_assoc($exec1))
    	{
    		echo '<tr>';
        	echo '<td>'.$row['flightID'].'</td>';
        	echo '<td>'.$row['departure'].'</td>';
        	echo '<td>'.$row['destination'].'</td>';
        	echo '<td>'.$row['Date'].'</td>';
        	echo '<td>'.$row['Time'].'</td>';
          echo '<td>'.$row['ARRDATE'].'</td>';
          echo '<td>'.$row['ARRTIME'].'</td>';
        	echo '<td>'.$row['Capacity'].'</td>';
        	echo '<td>'.$row['Price'].'</td>';



        	echo '</tr>';
    	}
    	
	}
}
else{
		echo '<center>'.'<div>Update not possible ...</div>'.'</center>';
         }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
 
  <title>UPDATE SUCCESSFULL</title>
  <style>
    *{
      font-family: Lato;
    }
    body{
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-image:linear-gradient(rgba(250,250,250,0.6),rgba(250,250,250,0.6)) ,url(images/updated.jpg);
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
       <center><a href="profile.php"><button class="btn">Go Back</button></a></center>
</body>
</html>