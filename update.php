<?php

 include 'connection.php';

    

     $flightID = $_POST['flightID'];

     $query = "select * from flights where flightID='$flightID'";
     $result = mysqli_query($conn, $query);
     
     if($result === false) {
         echo "error while executing mysql: " . mysqli_error($conn);
        }       
 
     else 
      {
      while ($row = mysqli_fetch_row($result)) 
        {
            
            $flight_id=$row[0];
            $departure=$row[1];
            $destination=$row[2];
            $date=$row[3];
            $time=$row[4];
            $arr=$row[5];
            $arrtime=$row[6];
            $capacity=$row[7];	
            $price=$row[8];
            
        }
    }
        echo '  <CENTER><font size=18>ENTER DETAILS TO BE UPDATED</font></CENTER> 
        <form  action="updated.php" method="POST">
       <div class="form-row" >      <br><br>
       <div class="form-group col-md-6">
       <label for="flightID">FLIGHT ID</label>&nbsp; &nbsp; &nbsp; &nbsp;
        <input type="hidden" name="flightID" class="abcd" id="flight"  value="'.$flight_id.'">
   
       </div><br><br>
       <div class="form-row">
       <div class="form-group col-md-6">
       <label for="inputCity">DEPARTURE : </label>&nbsp; &nbsp; &nbsp; &nbsp;
       <input type="text" name="departure" class="abcd" id="inputCity" value="'.$departure.'">
       </div>
       <br><br>
       <div class="form-group col-md-4">
       <label for="toCity">DESTINATION :</label>&nbsp; &nbsp;&nbsp;
       <input type="text" name= "dest" id="toCity"  class="abcd" value="'.$destination.'">
       </div>
            <br><br>
        <div class="form-group col-md-2">
       <label for="depdate">DATE : </label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
     
        <input type="DATE" name="date" class="abcd" id="depdate" value="'.$date.'" >
       </div>
            <br><br>
       <div class="form-row">
      <div class="form-group col-md-6">
      <label for="time">TIME : </label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
      <input type="TIME" name="time" class="abcd" id="time" value="'.$time.'">
       </div>
       <br><br>

      <label for="time">ARRIVAL DATE : </label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
      <input type="Date" name="arr" class="abcd" id="arr" value="'.$arr.'">
       </div>
       <br><br>

       <label for="time">ARRIVAL TIME : </label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
      <input type="TIME" name="arrtime" class="abcd" id="arrtime" value="'.$arrtime.'">
       </div>

            <br><br>
       <div class="form-group col-md-2">
       <label for="capacity">CAPACITY : </label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
       <input type="text" name="capacity" class="abcd" id="capacity" value="'.$capacity.'">
       </div>
            <br><br>
       <div class="form-group col-md-2">
       <label for="price">PRICE : </label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
        <input type="text" name="price" class="abcd" id="price" value="'.$price.'"><br><br>
        </div>
   
    
  
';


?>

    <center><input type="submit" name="submit" value="UPDATE" class="btn" required /><center>

<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
 
  <title>UPDATE</title>
  <style>
    *{
      font-family: Lato;
     }
    body{
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-image:linear-gradient(rgba(250,250,250,0.6),rgba(250,250,250,0.6)) ,url(images/update.jpg);
       }
   .btn {
   	     width: 25%;
        background: none;
        padding: 6px 10px 6px 10px;
      height: 35px;
      border: 1px solid black;
      font-size: 15px;
      font-weight: bold;
      }
     .abcd 
     {
      width: 25%;
      border: 1px solid black;
      border-radius: 3px;
      height: 40px;
      margin-top: 5px;
      background: none;
       }
    
  </style>
</head>
<body>
	<br>
   
</body>
</html>
