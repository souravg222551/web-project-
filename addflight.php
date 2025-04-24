<?php
	include 'connection.php';

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	$flightID = $_POST["flightID"];
	$departure = $_POST["dep_place"];
	$destination = $_POST["des_place"];
	$date = $_POST["date"];
	$time = $_POST["time"];
	$Adate = $_POST["Adate"];
	$Atime = $_POST["Atime"];
	$capacity = $_POST["capacity"];
	$price = $_POST["price"];

	
	 $query = "select * from flights where flightID ='$flightID'";


  //execute the query stored in variable $query and store result in variable $exec
 $exec = mysqli_query($conn,$query); 

// return number of rows

 $result = mysqli_num_rows($exec); 

 if($result == 1){
 	echo "<font size='18'>"."flight already exists"."</font>";
 }
 else{
 	$query1 = "insert into flights(flightID, departure, destination, Date, Time,ARRDATE,ARRTIME,Capacity, Price) values ('$flightID', '$departure', '$destination', '$date', '$time','$Adate', '$Atime', '$capacity', '$price')";
 	$exec1 = mysqli_query($conn,$query1);
 	echo "<font size='18'>"."flight details added successfully"."</font>";
 }	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Flight Added</title>
	<meta charset="utf-8" meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

	<style>
		body{
			background-size: cover;
			background-repeat: no-repeat;	
      background-image:linear-gradient(rgba(50,50,50,0.2),rgba(50,50,50,0.2)) ,url(images/add.jpg);
		}
		form
		{
			text-align: center;
			font-size: 30px; 
			color: black;
			margin-left: 270px;
		}
		 .flight{
      width: 50%;
      margin-left: 400px;
      margin-top: 21px;
      border-radius: 10px;
       }
		
		input[type = text], input[type = password]{
  width: 55%;
  height: auto;
  border: 0.5px solid #B9B9BA;
  padding: 10px;

}
.para{
	font-size: 85px;
	margin-left: 40px;
}

       
		input[type=submit]{
			background-color: #4CAF50;
  			color: black;
  			padding: 1px 5px;
  			border: none;
  			border-radius: 8px;
  			cursor: pointer;
  			width: 30%;
 			margin-bottom:1px;
 			
		}
		h2{
			text-align: center;
		}
		.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  width: 38%;
  opacity: 0.8;
}

	</style>

</head>
<body>
	<br/>
<a href="profile.php">
 	  <center> <button><font size='18'>Go Back</font></button></center>
       </a>
	
</form>
</body>
</html>



