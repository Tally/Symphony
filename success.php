
 
 <!DOCTYPE html>
<html lang="en"  style="background: url(logoHeadphones.gif) no-repeat center center fixed;background-size: cover;" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Symphony - Log In Page </title>
	<br><br><br><br>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	<!--	<script src="login.js"></script>  -->
	
	<script>	

	</script>		
</style>
	
	
	
</head>

<body> 
<div id = "container">
	<h1>Login</h1>
	<h1>Login <?php
	echo $_COOKIE['SYMPHONY'];
	
	?> </h1>

	<br><br><br><br>
	<h5>
	if (!isset($_COOKIE['SYMPHONY'])) {
		  header("Location:http://wwwp.cs.unc.edu/Courses/comp426-f13/lassitet/final/login.php")
	}else{
		
 }
 <br>
 
	<?php
	echo $_COOKIE['SYMPHONY'];
	
	?>
 
	
	</h5>
	
</div>
	
</body>
</html>