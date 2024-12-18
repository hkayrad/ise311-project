<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<?php 
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ise_project";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if(!$conn){
			die("Connection failed: " .mysqli_connect_error());
		}
		//echo "Connected succesfully";
	?>

</body>
</html>